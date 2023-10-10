<?php

namespace App\Service\Adapters\Molecule;

use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use App\Service\Adapters\Molecule\Interfaces\Molecular;
use App\Service\Neo4jServiceAbstract;
use GraphAware\Bolt\Record\RecordView;

/**
 * 
 */
class WaterAdapter extends Neo4jServiceAbstract implements Molecular
{

    /** @var RecordView[] */
    private $_molecule = [];

    /**
     * 
     * @param ClientInterface           $client
     * @param EntityManagerInterface    $manager
     */
    public function __construct(ClientInterface $client, EntityManagerInterface $manager)
    {
        parent::__construct($client, $manager);

        $this->_init();
    }

    /**
     * Check if this molecule exists in neo4j yet, create it if it does not.
     * 
     * @return bool
     */
    private function _init(): void
    {
        $cypher = "MATCH (atoms:Atom)-[:WATER]-(:Atom) WITH DISTINCT atoms RETURN DISTINCT count(atoms) as count";
        $molecule = $this->client->run($cypher);

        $moleculeExists = (bool) $molecule->records()[0]->values()[0];

        if (!$moleculeExists) {
            $this->create();
        }
    }

    /**
     * Gets the Water molecule atoms with the WATER relationship, creates them if they don't exist
     * 
     * 
     * @return array|null
     */
    public function get(): ?array
    {
        if (!empty($this->_molecule)) {
            return $this->_molecule;
        }
        $this->_set();
        return $this->_molecule;
    }

    /**
     * Set the Water molecule local property
     * 
     * // TODO: cache molecule responses
     */
    private function _set(): void
    {
        $this->_molecule = [];
        // when setting the atoms, 
        // copy the properties of their corresponding elements
        $query = 'MATCH (water:Atom)-[:WATER]-(:Atom) '
            . 'MERGE (e:Element {Element: water.Element}) '
            . 'WITH water, e SET water += properties(e) RETURN DISTINCT water';
        $atomsInMolecule = $this->client->run($query)->records();

        // TODO: try with entity manager instead

        foreach ($atomsInMolecule as $atom) {
            $this->_molecule[] = (object) $atom->values();
        }
    }

    /**
     * @return object|null
     */
    public function create(): ?Result
    {
        $query = <<<HEREDOC
CREATE (H1:Atom {Symbol: "H", Element:"Hydrogen"})
<-[:WATER]-
(O1:Atom {Symbol: "O", Element:"Oxygen"})
-[:WATER]->
(H2:Atom {Symbol: "H", Element:"Hydrogen"})
 RETURN O1, H1, H2
HEREDOC;
        return $this->client->run($query);
    }

    /**
     * Delete the Water molecule
     */
    public function delete(): void
    {
        $this->client->run("MATCH (a:Atom)-[:WATER]-(:Atom) DETACH DELETE a");
    }
}
