<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 22/6/15
 * Time: 18:34
 */

namespace Fw\Components\Database;




class MyPdo implements  Mysql{

    private $db;

    public function __construct($db)
    {
        $this->db =$db;
    }

    public function prepare($query)
    {
        return $this->db->prepare($query);
    }


}