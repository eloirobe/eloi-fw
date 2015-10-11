<?php

namespace Fw\Components\Database;




use Fw\Components\Cache\MemCache;

class MyPdo implements  Mysql{

    /**
     * @var Mysql
     */
    private $db;
    private $cache;
    /**
     * @var \PDOStatement
     */
    private $statement;

    public function __construct($db,MemCache $cache = null)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    public function prepare($query)
    {
        return $this->db->prepare($query);
    }


    public function fetch ($query,$params,$fetch_type,$option)
    {
        $key_query = $this->PrepareQuery($query,$params);
        if ($this->cache) {
            $result=$this->cache->get($key_query);
            if (!$result){
                $this->statement->execute();
                $result = $this->statement->$fetch_type($option);
                $this->cache->set($key_query, $result);
            }
        }else{
            $this->statement->execute();
            $result = $this->statement->$fetch_type($option);
        }
        return $result;
    }

    private function PrepareQuery ($query,$params)
    {
        $this->statement=$this->db->prepare($query);
        foreach ($params as $k => $p)
            if (isset($p[1]))
                $this->statement->bindParam($k,$p[0],$p[1]);
            else
                $this->statement->bindParam($k,$p[0]);

        return serialize([$query,$params]);
    }

}