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

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="receiver")
     */
    protected $receivedNotifications;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="sender")
     */
    protected $sentNotifications;

    public function __construct()
    {
        parent::__construct();

        $this->pets = new ArrayCollection();
        $this->receivedNotifications = new ArrayCollection();
        $this->sentNotifications = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getReceivedNotifications(): Collection
    {
        return $this->receivedNotifications;
    }

    /**
     * @param Collection $receivedNotifications
     *
     * @return User
     */
    public function setReceivedNotifications(Collection $receivedNotifications): User
    {
        $this->receivedNotifications = $receivedNotifications;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSentNotifications(): Collection
    {
        return $this->sentNotifications;
    }

    /**
     * @param Collection $sentNotifications
     *
     * @return User
     */
    public function setSentNotifications(Collection $sentNotifications): User
    {
        $this->sentNotifications = $sentNotifications;

        return $this;
    }
}
