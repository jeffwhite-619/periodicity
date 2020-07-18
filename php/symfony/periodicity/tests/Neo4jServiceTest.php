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
use GraphAware\Neo4j\OGM\EntityManagerInterface;

/**
 * @group neo4j-service
 */
class Neo4jServiceTest extends TestCase
{

    /** @var Mock|ClientInterface */
    private $clientMock;

    /** @var Neo4jService */
    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->clientMock = Mockery::mock(ClientInterface::class)->makePartial();
        $this->clientMock->shouldAllowMockingProtectedMethods();

        $emMock = Mockery::mock(EntityManagerInterface::class)->makePartial();
        $emMock->shouldAllowMockingProtectedMethods();

        $this->service = new Neo4jService($this->clientMock, $emMock);
    }

    public function testRunFail()
    {
        $resultMock = Mockery::mock(Result::class)->makePartial();
        $resultMock->shouldAllowMockingProtectedMethods();

        $this->clientMock->shouldReceive('run')->once()->andReturnNull();

        $results = $this->service->all();
        $this->assertNull($results);
    }


    public function testRunSuccess()
    {
        $resultMock = Mockery::mock(Result::class)->makePartial();
        $resultMock->shouldAllowMockingProtectedMethods();

        $this->clientMock->shouldReceive('run')->once()->andReturn($resultMock);

        $results = $this->service->all();
        $this->assertInstanceOf(Result::class, $results);
    }
}
