<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class PetregisterFixtures extends Fixture
{
    /**
     * @var NativeLoader
     */
    protected $loader;

    public function __construct()
    {
        $this->loader = new NativeLoader();
    }

    public function load(ObjectManager $manager)
    {
        $fixtureFiles = [
            __DIR__ . '/user.yaml',
            __DIR__ . '/contact.yaml',
            __DIR__ . '/species.yaml',
            __DIR__ . '/breed.yaml',
            __DIR__ . '/pet.yaml',
        ];

        foreach ($this->loader->loadFiles($fixtureFiles)->getObjects() as $entity) {
            $manager->persist($entity);
        }

        $manager->flush();
    }
}