<?php

namespace App\Entity\Pet;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Breed
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Species
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pet\Species")
     */
    protected $species;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Breed
     */
    public function setName(string $name): Breed
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Species
     */
    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    /**
     * @param Species $species
     *
     * @return Breed
     */
    public function setSpecies(Species $species): Breed
    {
        $this->species = $species;

        return $this;
    }
}
