<?php

namespace App\Service;

use App\Entity\Element;
use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\OGM\EntityManager;


class Neo4jService
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var EntityManager
     */
    protected $manager;

    /**
     * 
     * @param ClientInterface   $client
     * @param EntityManager     $manager
     */
    public function __construct(ClientInterface $client, EntityManager $manager)
    {
        $this->client  = $client;
        $this->manager = $manager;
    }

    public function getElements()
    {
        $repository = $this->manager->getRepository(Element::class);
        $result = $repository->all();
        return $result;
    }

    /**
     * Get all nodes regardless of relationships
     * Result has Records has RecordView
     * 
     * @return Result|null
     */
    public function all(): ?Result
    {
        return $this->client->run("MATCH(n:Element) RETURN n ORDER BY n.AtomicNumber");
    }


}