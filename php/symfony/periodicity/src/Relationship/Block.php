<?php

namespace App\Relationship;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Common\Graph\Node;

/**
 * @OGM\Relationship(type="IN_BLOCK", direction="BOTH")
 */
class Block extends Node
{
    
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

}
