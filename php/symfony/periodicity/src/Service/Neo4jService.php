<?php

namespace App\Service;

use App\Entity\Element;
use GraphAware\Common\Result\Result;

class Neo4jService extends Neo4jServiceAbstract
{

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
