<?php

declare(strict_types=1);

namespace App\Entity\Pet;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\NotBlank()
     */
    protected $microchipId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="pets")
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
    public function setMicrochipId(string $microchipId): self
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
    public function setName(string $name): self
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
    public function setBreed(Breed $breed): self
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
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
