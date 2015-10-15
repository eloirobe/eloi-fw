<?php

namespace Fw\Components\Sphinx;


use Sphinx\SphinxClient;

class Sphinx
{
    private $client;

    public function __construct(SphinxClient $client,$host, $port)
    {
        $this->client = $client;
        $this->client->setServer($host,$port);
        $this->client->SetMatchMode(SphinxClient::SPH_MATCH_EXTENDED2);
    }

    public function setSortMode ($condition)
    {
        $this->client->setSortMode(SphinxClient::SPH_SORT_EXTENDED,$condition);
    }
    public function setLimits ($min,$max)
    {
        $this->client->setLimits($min,$max);
    }
    public function setFilter ($attribute,$value)
    {
        $this->client->setFilter($attribute,$value);
    }
    public function query ($query, $index="*",$comment="")
    {
        return $this->client->query($query,$index,$comment);
    }



}