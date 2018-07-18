<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
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
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Pet\Pet", mappedBy="user")
     */
    protected $pets;

    public function __construct()
    {
        parent::__construct();

        $this->pets = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getPets(): Collection
    {
        return $this->pets;
    }

    /**
     * @param Collection $pets
     *
     * @return User
     */
    public function setPets(Collection $pets): User
    {
        $this->pets = $pets;

        return $this;
    }
}
