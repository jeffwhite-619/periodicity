<?php

namespace App\GraphFixtures;

use App\Service\Neo4jService;
use Exception;

class ElementFixtures
{
    protected $service;

    public function __construct(Neo4jService $service)
    {
        $this->service = $service;
    }

    public function load()
    {
        $result = $this->service->truncate()->seed();
    }

}
