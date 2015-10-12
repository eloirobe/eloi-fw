<?php
namespace Fw\Components\Redis;

use Predis\Client;

class Redis {

    private $client;

    public function __construct(Client $client)
    {
        $this->client=$client;
    }
    public function execute ($command,$params,$options = null )
    {
        if ($options==null)
            return $this->client->$command($params[0],$params[1],$params[2]);
        else
            return $this->client->$command($params[0],$params[1],$params[2],$options);
    }
}