<?php

namespace App\Service;

use GraphAware\Neo4j\Client\ClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

abstract class Neo4jSeederServiceAbstract
{

    /**  @var ParameterBagInterface */
    protected $parameterBag;

    /** @var ClientInterface */
    protected $client;

    /**
     * @param ParameterBagInterface $parameterBag
     * @param ClientInterface       $client
     */
    public function __construct(ParameterBagInterface $parameterBag, ClientInterface $client)
    {
        $this->parameterBag = $parameterBag;
        $this->client       = $client;
    }
}
