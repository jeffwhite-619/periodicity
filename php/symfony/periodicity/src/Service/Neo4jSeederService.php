<?php

namespace App\Service;

use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\Client\Exception\Neo4jException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Neo4jSeederService
{

    /**
     * @var ParameterBagInterface
     */
    protected $parameterBag;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * 
     * 
     * @param ParameterBagInterface $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag, ClientInterface $client)
    {
        $this->parameterBag = $parameterBag;
        $this->client       = $client;
    }

    /**
     * Seed the Neo4j database with a publicly available periodic table in csv format
     * 
     * @return Neo4jSeederService
     */
    public function seed(): self
    {
        $file  = $this->parameterBag->get('kernel.project_dir') . '/../../../atoms/neo4j/load-csv-seed.cypher';
        $query = file_get_contents($file);
        if (!$query) {
            throw new Neo4jException('Could not find seed query file: ' . $file);
        }
        $this->client->run($query);
        return $this;
    }

    /**
     * @return Neo4jSeederService
     */
    public function truncate(): self
    {
        $this->client->run("MATCH(n) DETACH DELETE n");
        return $this;
    }

    /**
     * @return Neo4jSeederService
     */
    public function relateBlocks(): self
    {

        $query = <<<HEREDOC
MATCH (element:Element)
MERGE (block:Block { name: element.Block })
MERGE (element)-[:IN_BLOCK]->(block);
HEREDOC;
        $this->client->run($query);
        return $this;
    }

}