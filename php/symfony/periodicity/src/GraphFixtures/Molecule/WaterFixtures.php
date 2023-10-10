<?php

namespace App\GraphFixtures\Molecule;

use App\Service\Neo4jMoleculeSeederService;

/**
 * Seed the existing neo4j database
 */
class WaterFixtures
{
    protected $service;

    public function __construct(Neo4jMoleculeSeederService $service)
    {
        $this->service = $service;
    }

    public function load()
    {
        $this->service->createWater();
    }
}
