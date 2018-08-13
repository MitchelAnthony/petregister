<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;

class AuthenticationSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            AuthenticationEvents::AUTHENTICATION_FAILURE => [
                ['processFailure', 10],
                ['logFailure', 0],
            ],
        ];
    }

    public function processFailure(AuthenticationFailureEvent $event)
    {
        // Todo implement this
    }

    public function logFailure(AuthenticationFailureEvent $event)
    {
        $this->logger->warning('Invalid login attempt for user '.$event->getAuthenticationToken()->getUsername());
    }
}
