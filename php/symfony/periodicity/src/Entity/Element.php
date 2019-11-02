<?php

namespace App\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Common\Graph\Node;
use App\Relationship\Block;

/**
 * @OGM\Node(label="Element")
 */
class Element extends Node
{

    /**
     * @OGM\Relationship(type="IN_BLOCK", collection=false, direction="OUTGOING", targetEntity="Block")
     * 
     * @var Block
     */
     protected $block;

    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $AtomicNumber;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    private $Element;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    private $Symbol;

    /**
     * @OGM\Property(type="float")
     * @var float
     */
    private $AtomicMass;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $NumberofNeutrons;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $NumberofProtons;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $NumberofElectrons;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $Period;

    /**
     * @OGM\Property(type="int")
     * @var int
     */
    private $Group;

    /**
     * @OGM\Property(type="string")
     * @var string
     */
    private $Phase;

    /**
     * @OGM\Property(type="string", nullable=true)
     * @var string
     */
    private $Radioactive;

    /**
     * @OGM\Property(type="string", nullable=true)
     * @var string
     */
    private $Natural;

    /**
     * @OGM\Property(type="string", nullable=true)
     * @var string
     */
    private $Metal;

    /**
     * @OGM\Property(type="string", nullable=true)
     * @var string
     */
    private $Type;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $AtomicRadius;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $Electronegativity;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $FirstIonization;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $Density;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $MeltingPoint;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $BoilingPoint;

    /**
     * @OGM\Property(type="int", nullable=true)
     * @var int
     */
    private $NumberOfIsotopes;

    /**
     * @OGM\Property(type="string", nullable=true)
     * @var string
     */
    private $Discoverer;

    /**
     * @OGM\Property(type="int", nullable=true)
     * @var int
     */
    private $Year;

    /**
     * @OGM\Property(type="float", nullable=true)
     * @var float
     */
    private $SpecificHeat;

    /**
     * @OGM\Property(type="int", nullable=true)
     * @var int
     */
    private $NumberofShells;

    /**
     * @OGM\Property(type="int", nullable=true)
     * @var int
     */
    private $NumberofValence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtomicNumber(): ?int
    {
        return $this->AtomicNumber;
    }

    public function setAtomicNumber(int $AtomicNumber): self
    {
        $this->AtomicNumber = $AtomicNumber;

        return $this;
    }

    public function getElement(): ?string
    {
        return $this->Element;
    }

    public function setElement(string $Element): self
    {
        $this->Element = $Element;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->Symbol;
    }

    public function setSymbol(string $Symbol): self
    {
        $this->Symbol = $Symbol;

        return $this;
    }

    public function getAtomicMass(): ?float
    {
        return $this->AtomicMass;
    }

    public function setAtomicMass(float $AtomicMass): self
    {
        $this->AtomicMass = $AtomicMass;

        return $this;
    }

    public function getNumberofNeutrons(): ?int
    {
        return $this->NumberofNeutrons;
    }

    public function setNumberofNeutrons(int $NumberofNeutrons): self
    {
        $this->NumberofNeutrons = $NumberofNeutrons;

        return $this;
    }

    public function getNumberofProtons(): ?int
    {
        return $this->NumberofProtons;
    }

    public function setNumberofProtons(int $NumberofProtons): self
    {
        $this->NumberofProtons = $NumberofProtons;

        return $this;
    }

    public function getNumberofElectrons(): ?int
    {
        return $this->NumberofElectrons;
    }

    public function setNumberofElectrons(int $NumberofElectrons): self
    {
        $this->NumberofElectrons = $NumberofElectrons;

        return $this;
    }

    public function getPeriod(): ?int
    {
        return $this->Period;
    }

    public function setPeriod(int $Period): self
    {
        $this->Period = $Period;

        return $this;
    }

    public function getGroup(): ?int
    {
        return $this->Group;
    }

    public function setGroup(int $Group): self
    {
        $this->Group = $Group;

        return $this;
    }

    public function getPhase(): ?string
    {
        return $this->Phase;
    }

    public function setPhase(string $Phase): self
    {
        $this->Phase = $Phase;

        return $this;
    }

    public function getRadioactive(): ?string
    {
        return $this->Radioactive;
    }

    public function setRadioactive(?string $Radioactive): self
    {
        $this->Radioactive = $Radioactive;

        return $this;
    }

    public function getNatural(): ?string
    {
        return $this->Natural;
    }

    public function setNatural(?string $Natural): self
    {
        $this->Natural = $Natural;

        return $this;
    }

    public function getMetal(): ?string
    {
        return $this->Metal;
    }

    public function setMetal(?string $Metal): self
    {
        $this->Metal = $Metal;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getAtomicRadius(): ?float
    {
        return $this->AtomicRadius;
    }

    public function setAtomicRadius(?float $AtomicRadius): self
    {
        $this->AtomicRadius = $AtomicRadius;

        return $this;
    }

    public function getElectronegativity(): ?float
    {
        return $this->Electronegativity;
    }

    public function setElectronegativity(?float $Electronegativity): self
    {
        $this->Electronegativity = $Electronegativity;

        return $this;
    }

    public function getFirstIonization(): ?float
    {
        return $this->FirstIonization;
    }

    public function setFirstIonization(?float $FirstIonization): self
    {
        $this->FirstIonization = $FirstIonization;

        return $this;
    }

    public function getDensity(): ?float
    {
        return $this->Density;
    }

    public function setDensity(?float $Density): self
    {
        $this->Density = $Density;

        return $this;
    }

    public function getMeltingPoint(): ?float
    {
        return $this->MeltingPoint;
    }

    public function setMeltingPoint(?float $MeltingPoint): self
    {
        $this->MeltingPoint = $MeltingPoint;

        return $this;
    }

    public function getBoilingPoint(): ?float
    {
        return $this->BoilingPoint;
    }

    public function setBoilingPoint(?float $BoilingPoint): self
    {
        $this->BoilingPoint = $BoilingPoint;

        return $this;
    }

    public function getNumberOfIsotopes(): ?int
    {
        return $this->NumberOfIsotopes;
    }

    public function setNumberOfIsotopes(?int $NumberOfIsotopes): self
    {
        $this->NumberOfIsotopes = $NumberOfIsotopes;

        return $this;
    }

    public function getDiscoverer(): ?string
    {
        return $this->Discoverer;
    }

    public function setDiscoverer(?string $Discoverer): self
    {
        $this->Discoverer = $Discoverer;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(?int $Year): self
    {
        $this->Year = $Year;

        return $this;
    }

    public function getSpecificHeat(): ?float
    {
        return $this->SpecificHeat;
    }

    public function setSpecificHeat(?float $SpecificHeat): self
    {
        $this->SpecificHeat = $SpecificHeat;

        return $this;
    }

    public function getNumberofShells(): ?int
    {
        return $this->NumberofShells;
    }

    public function setNumberofShells(?int $NumberofShells): self
    {
        $this->NumberofShells = $NumberofShells;

        return $this;
    }

    public function getNumberofValence(): ?int
    {
        return $this->NumberofValence;
    }

    public function setNumberofValence(?int $NumberofValence): self
    {
        $this->NumberofValence = $NumberofValence;

        return $this;
    }
}
