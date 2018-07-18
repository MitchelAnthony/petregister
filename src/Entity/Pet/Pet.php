<?php

namespace App\Entity\Pet;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Pet
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
    protected $microchipId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var Breed
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Pet\Breed")
     */
    protected $breed;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pets")
     */
    protected $user;

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
    public function getMicrochipId(): ?string
    {
        return $this->microchipId;
    }

    /**
     * @param string $microchipId
     *
     * @return Pet
     */
    public function setMicrochipId(string $microchipId): Pet
    {
        $this->microchipId = $microchipId;

        return $this;
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
     * @return Pet
     */
    public function setName(string $name): Pet
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Breed
     */
    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    /**
     * @param Breed $breed
     *
     * @return Pet
     */
    public function setBreed(Breed $breed): Pet
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Pet
     */
    public function setUser(User $user): Pet
    {
        $this->user = $user;

        return $this;
    }
}
