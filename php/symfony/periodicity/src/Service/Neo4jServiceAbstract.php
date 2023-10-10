<?php

namespace App\Service;

use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\OGM\EntityManagerInterface;

abstract class Neo4jServiceAbstract
{
    /**  @var ClientInterface */
    protected $client;

    /** @var EntityManagerInterface */
    protected $manager;

    /**
     * 
     * @param ClientInterface           $client
     * @param EntityManagerInterface    $manager
     */
    public function __construct(ClientInterface $client, EntityManagerInterface $manager)
    {
        $this->client  = $client;
        $this->manager = $manager;
    }
}
