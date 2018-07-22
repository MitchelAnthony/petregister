<?php

namespace App\Entity\User;

use App\Enum\Preference;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Contact
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * @var Address
     *
     * @ORM\Embedded(class="App\Entity\User\Address", columnPrefix=false)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $preference;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="contacts")
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Contact
     */
    public function setName(string $name): Contact
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return Contact
     */
    public function setPhone(string $phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return Contact
     */
    public function setAddress(Address $address): Contact
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Preference
     */
    public function getPreference(): Preference
    {
        return new Preference($this->preference);
    }

    /**
     * @param Preference $preference
     *
     * @return Contact
     */
    public function setPreference(Preference $preference): Contact
    {
        $this->preference = $preference->getValue();

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
     * @return Contact
     */
    public function setUser(User $user): Contact
    {
        $this->user = $user;

        return $this;
    }
}
