<?php

namespace App\Security;

use App\Entity\Pet\Pet;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PetVoter extends Voter
{
    public const PET_UPDATE = 'update';
    public const PET_DELETE = 'delete';

    protected function supports($attribute, $subject): bool
    {
        if (!in_array($attribute, [self::PET_UPDATE, self::PET_DELETE])) {
            return false;
        }

        if (!$subject instanceof Pet) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $this->isOwner($subject, $user);
    }

    private function isOWner(Pet $pet, User $user): bool
    {
        return $pet->getUser() === $user;
    }
}
