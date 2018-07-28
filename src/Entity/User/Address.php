<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;

    /**
     * @return string
     */
    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     *
     * @return Address
     */
    public function setAddressLine1(string $addressLine1): Address
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    /**
     * @param string $addressLine2
     *
     * @return Address
     */
    public function setAddressLine2(string $addressLine2): Address
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;

        return $this;
    }
}