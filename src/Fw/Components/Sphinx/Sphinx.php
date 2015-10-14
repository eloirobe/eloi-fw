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
    }

    public function setSortMode ($sort_mode,$condition)
    {
        $this->client->setSortMode($sort_mode,$condition);
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