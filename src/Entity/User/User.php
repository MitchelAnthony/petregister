<?php

namespace App\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^(?=\P{Ll}*\p{Ll})(?=\P{Lu}*\p{Lu})(?=\P{N}*\p{N})(?=[\p{L}\p{N}]*[^\p{L}\p{N}])[\s\S]{12,}$/")
     *
     * At least 12 characters, one lowercase, one uppercase, one number and a special character. See {@link https://stackoverflow.com/questions/48345922/reference-password-validation}
     */
    protected $plainPassword;

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

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User\Contact", mappedBy="user")
     */
    protected $contacts;

    public function __construct()
    {
        parent::__construct();

        $this->pets = new ArrayCollection();
        $this->receivedNotifications = new ArrayCollection();
        $this->sentNotifications = new ArrayCollection();
        $this->contacts = new ArrayCollection();
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

    /**
     * @return Collection
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    /**
     * @param Collection $contacts
     *
     * @return User
     */
    public function setContacts(Collection $contacts): User
    {
        $this->contacts = $contacts;

        return $this;
    }
}
