<?php

namespace App\Service;

use GraphAware\Neo4j\Client\Exception\Neo4jException;

class Neo4jSeederService extends Neo4jSeederServiceAbstract
{

    /**
     * Seed the Neo4j database with a periodic table in csv format
     *
     * @return Neo4jSeederService
     * @throws Neo4jException
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
     * Drop and detach all nodes and relationships; truncates the database
     * 
     * @return Neo4jSeederService
     */
    public function truncate(): self
    {
        $this->client->run("MATCH(n) DETACH DELETE n");
        return $this;
    }

    /**
     * Relate elements to their respective Blocks
     * 
     * @return Neo4jSeederService
     */
    public function relateBlocks(): self
    {
        $query = <<<HEREDOC
MATCH (element:Element)
MERGE (block:Block { name: element.Block })
MERGE (element)-[:IN_BLOCK]-(block);
HEREDOC;
        $this->client->run($query);
        return $this;
    }

    /**
     * Relate elements to their respective Periods
     * 
     * @return Neo4jSeederService
     */
    public function relatePeriods(): self
    {
        $query = <<<HEREDOC
MATCH (element:Element)
MERGE (period:Period { name: element.Period })
MERGE (element)-[:IN_PERIOD]-(period);
HEREDOC;
        $this->client->run($query);
        return $this;
    }

    /**
     * Relate elements to their respective category, subcategory, and group
     * 
     * @return Neo4jSeederService
     */
    public function relateCategories(): self
    {
        $this->relateElementCategories();
        $this->relatePnictogens();
        $this->relateChalcogens();
        $this->relateHalogens();
        $this->relateTransactinides();
        return $this;
    }

    /**
     * Relate elements by category and subcategory
     * 
     */
    public function relateElementCategories(): void
    {
        // breakdown category type by deconstructing the array
        $query = <<<HEREDOC
MATCH (element:Element)
MERGE (category:ElementCategory { name: element.ElementCategory, categoryType: "elementSubcategory"})
MERGE (element)-[:IN_CATEGORY]-(category)
HEREDOC;
        $this->client->run($query);
    }

    /**
     * Relate elements belonging to Pnictogen group (group 15)
     */
    public function relatePnictogens(): void
    {
        $query = <<<HEREDOC
MATCH (element:Element {Group: 15})
MERGE (pnictogen:ElementCategory { name: "Pnictogen", categoryType: "group"})
MERGE (element)-[:IN_CATEGORY]-(pnictogen);
HEREDOC;
        $this->client->run($query);
    }

    /**
     * Relate elements belonging to Chalcogen group (group 16)
     */
    public function relateChalcogens(): void
    {
        $query = <<<HEREDOC
MATCH (element:Element {Group: 16})
MERGE (chalcogen:ElementCategory { name: "Chalcogen", categoryType: "group"})
MERGE (element)-[:IN_CATEGORY]-(chalcogen);
HEREDOC;
        $this->client->run($query);
    }

    /**
     * Relate elements belonging to Halogen group (group 17)
     */
    public function relateHalogens(): void
    {
        $query = <<<HEREDOC
MATCH (element:Element {Group: 17})
MERGE (halogen:ElementCategory { name: "Halogen", categoryType: "group"})
MERGE (element)-[:IN_CATEGORY]-(halogen);
HEREDOC;
        $this->client->run($query);
    }

    /**
     * Relate elements that are Transactinides
     */
    public function relateTransactinides(): void
    {
        $query = <<<HEREDOC
MATCH (element:Element) WHERE element.AtomicNumber > 103
MERGE (transactinide:Transactinide { name: "Transactinide", categoryType: "transactinide"})
MERGE (element)-[:TRANSACTINIDE]-(transactinide);
HEREDOC;
        $this->client->run($query);
    }
}
