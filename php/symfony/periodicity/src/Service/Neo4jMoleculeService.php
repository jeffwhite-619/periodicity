<?php

namespace App\Service;

use stdClass;
use App\Entity\Molecule;
use App\Service\Adapters\Molecule\Interfaces\Molecular;
use GraphAware\Common\Result\Result;
use GraphAware\Neo4j\Client\ClientInterface;
use GraphAware\Neo4j\OGM\EntityManagerInterface;
use App\Service\Adapters\Molecule\WaterAdapter;
use App\Service\Neo4jServiceAbstract;

/**
 * Service to get molecules
 */
class Neo4jMoleculeService extends Neo4jServiceAbstract
{

    private const MOLECULE_WATER = 'water';
    private const MOLECULE_CO2 = 'co2';
    private const MOLECULE_BENZENE = 'benzene';
    private const MOLECULE_METHANOL = 'methanol';
    private const MOLECULE_ALCOHOL = 'alcohol';
    private const MOLECULE_SALT = 'salt';
    private const MOLECULE_CAFFEINE = 'caffeine';
    private const MOLECULE_GRAPHENE = 'graphene';
    private const MOLECULE_LSD = 'lsd';
    private const MOLECULE_DMT = 'dmt';

    // Known molecules are indexed by their common name (lower-case)
    // and refer to their relationship name in neo4j
    private const KNOWN_MOLECULES = [
        self::MOLECULE_WATER => 'WATER',
    ];

    /**  @var ClientInterface */
    protected $client;

    /** @var EntityManagerInterface */
    protected $manager;

    /**
     * 
     * @param ClientInterface           $client
     * @param EntityManagerInterface    $manager
     */
    public function __construct(ClientInterface $client, EntityManagerInterface $manager)
    {
        $this->client  = $client;
        $this->manager = $manager;
    }

    /**
     * Get molecule by its name
     * 
     * @param string $moleculeName
     * @return string|json
     */
    public function getMolecule(string $moleculeName): string
    {
        $molecule = $this->cleanMoleculeName($moleculeName);

        $response = new stdClass;
        $response->$molecule = new stdClass;
        $response->success = false;

        // fail early if molecule is unknown
        if (!$this->knownMolecule($molecule)) {
            return json_encode($response);
        }

        $namedMolecule = $this->getAdapter($molecule)->get();
        $response->$molecule->atoms = [];
        foreach ($namedMolecule as $atoms => $atom) {
            $atom = (array) $atom;
            $response->$molecule->atoms[] = $atom[0]->values();
        }

        $response->success = true;

        return json_encode($response);
    }


    /**
     * Get service adapter by molecule name
     * 
     * @param string $molecule
     * @return Molecular|null
     */
    private function getAdapter(string $molecule): ?Molecular
    {
        $molecularAdapter = __NAMESPACE__ . '\Adapters\Molecule\\' . $molecule . 'Adapter';
        return (new $molecularAdapter($this->client, $this->manager));
    }

    /**
     * Format molecule name to match adapter prefix convention
     * 
     * @param string $moleculeName
     * @return string
     */
    private function cleanMoleculeName(string $moleculeName): string
    {
        return ucfirst(strtolower($moleculeName));
    }

    /**
     * Determine if a molecule name is known by the project
     * 
     * @param string $moleculeName
     * @return bool
     */
    private function knownMolecule(string $moleculeName): bool
    {
        if (in_array(strtolower($moleculeName), array_keys(self::KNOWN_MOLECULES))) {
            return true;
        }
        return false;
    }
}