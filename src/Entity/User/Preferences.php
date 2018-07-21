<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Preferences
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $showContactInfoToVisitors = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $showContactInfoToUsers = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $showContactInfoToVets = false;

    /**
     * @return bool
     */
    public function showContactInfoToVisitors(): bool
    {
        return $this->showContactInfoToVisitors;
    }

    /**
     * @param bool $showContactInfoToVisitors
     *
     * @return Preferences
     */
    public function setShowContactInfoToVisitors(bool $showContactInfoToVisitors): Preferences
    {
        $this->showContactInfoToVisitors = $showContactInfoToVisitors;

        return $this;
    }

    /**
     * @return bool
     */
    public function showContactInfoToUsers(): bool
    {
        return $this->showContactInfoToUsers;
    }

    /**
     * @param bool $showContactInfoToUsers
     *
     * @return Preferences
     */
    public function setShowContactInfoToUsers(bool $showContactInfoToUsers): Preferences
    {
        $this->showContactInfoToUsers = $showContactInfoToUsers;

        return $this;
    }

    /**
     * @return bool
     */
    public function showContactInfoToVets(): bool
    {
        return $this->showContactInfoToVets;
    }

    /**
     * @param bool $showContactInfoToVets
     *
     * @return Preferences
     */
    public function setShowContactInfoToVets(bool $showContactInfoToVets): Preferences
    {
        $this->showContactInfoToVets = $showContactInfoToVets;

        return $this;
    }
}
