<?php

namespace App\Tests;

use GraphAware\Neo4j\Client\ClientBuilder;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use App\Service\Neo4jService;
use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\Exception\Neo4jExceptionInterface;
use GraphAware\Neo4j\Client\ClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Neo4jServiceTest extends TestCase
{

    /**
     * @var Mock
     */
    protected $clientMock;

    /**
     * @var Neo4jService
     */
    protected $service;

    public function setUp(): void
    {
        // alias for testing static methods
        $this->clientMock = Mockery::mock('alias:' . ClientInterface::class)->makePartial();
        $this->clientMock->shouldAllowMockingProtectedMethods();

        $parameterBagMock = Mockery::mock(ParameterBagInterface::class)->makePartial();
        $parameterBagMock->shouldAllowMockingProtectedMethods();
        $parameterBagMock->add(['kernel.project_dir' => '../../']);

        $this->service = new Neo4jService($parameterBagMock, $this->clientMock);
    }

    public function testRunFails()
    {
        
    }
}
