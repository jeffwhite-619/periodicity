<?php

namespace App\Service;

use App\Entity\Element;
use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\OGM\EntityManagerInterface;


class Neo4jService
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

    /**
     * @return iterable
     */
    public function getElements()
    {
        return $this->manager->getRepository(Element::class)->findAll();
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
