<?php
namespace Fw\Components\Redis;

use Predis\Client;

class Redis {

    private $client;

    public function __construct(Client $client)
    {
        $this->client=$client;
    }
    public function execute ($command,$params)
    {
        return $this->client->$command($params[0],$params[1]);
    }
}