<?php

namespace App\Entity;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Notification
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
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @var User
     *
     * A notification must always have a registered User as the receiver ...
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="receivedNotifications")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $receiver;

    /**
     * @var User
     *
     * ... whereas the sender could be an unregistered visitor.
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="sentNotifications")
     */
    protected $sender;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $read = false;

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
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Notification
     */
    public function setSubject(string $subject): Notification
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Notification
     */
    public function setMessage(string $message): Notification
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Notification
     */
    public function setDate(\DateTime $date): Notification
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return User
     */
    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    /**
     * @param User $receiver
     *
     * @return Notification
     */
    public function setReceiver(User $receiver): Notification
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * @return User
     */
    public function getSender(): ?User
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     *
     * @return Notification
     */
    public function setSender(User $sender): Notification
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRead(): bool
    {
        return $this->read;
    }

    /**
     * @param bool $read
     *
     * @return Notification
     */
    public function setRead(bool $read): Notification
    {
        $this->read = $read;

        return $this;
    }
}
