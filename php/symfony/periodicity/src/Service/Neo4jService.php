<?php

namespace App\Service;

use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;

//use GraphAware\Neo4j\OGM\EntityManager;


class Neo4jService
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * 
     * 
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Get all nodes regardless of relationships
     * 
     * @return Result|null
     */
    public function all(): ?Result
    {
        return $this->client->run("MATCH(n:Element) RETURN n ORDER BY n.AtomicNumber");
    }


}