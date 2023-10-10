<?php

namespace App\Service\Adapters\Molecule\Interfaces;

use GraphAware\Common\Result\Result;
use GraphAware\Bolt\Record\RecordView;

/**
 * Methods belonging to a Molecule
 */
interface Molecular
{
    /**
     * @return Result|null
     */
    public function create(): ?Result;

    /**
     * 
     */
    public function delete(): void;

    /**
     * @return array|null
     */
    public function get(): ?array;
}
