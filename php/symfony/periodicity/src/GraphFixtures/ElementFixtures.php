<?php

namespace App\GraphFixtures;

use App\Service\Neo4jSeederService;

/**
 * Seed the existing neo4j database
 */
class ElementFixtures
{
    protected $service;

    public function __construct(Neo4jSeederService $service)
    {
        $this->service = $service;
    }

    public function load()
    {
        $this->service->truncate()->seed()->relateBlocks()->relatePeriods()->relateCategories();
    }
}
