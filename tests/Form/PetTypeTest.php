<?php

namespace App\Tests\Form;

use App\Entity\Pet\Breed;
use App\Entity\Pet\Pet;
use App\Entity\Pet\Species;
use App\Form\PetType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Symfony\Bridge\Doctrine\Test\DoctrineTestHelper;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class PetTypeTest extends TypeTestCase
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Species
     */
    protected $species;

    /**
     * @var Breed
     */
    protected $breed;

    public function testSubmitValidData()
    {
        $pet = (new Pet())
            ->setName('Shiro')
            ->setMicrochipId('6dfdc384d6025b2ab9b71ec15971aa11')
            ->setBreed($this->breed)
        ;

        $formData = [
            'name' => 'Shiro',
            'microchipId' => '6dfdc384d6025b2ab9b71ec15971aa11',
            'breed' => $this->breed->getId(),
        ];

        $petToCompare = new Pet();
        $form = $this->factory->create(PetType::class, $petToCompare);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($pet, $petToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function setUp()
    {
        $this->entityManager = DoctrineTestHelper::createTestEntityManager();

        $entities = [
            Species::class,
            Breed::class,
            Pet::class,
        ];

        $this->createSchema($entities);

        $species = (new Species())
            ->setName('Cat')
        ;

        $breed = (new Breed())
            ->setName('Thai')
            ->setSpecies($species)
        ;

        $this->entityManager->persist($species);
        $this->entityManager->persist($breed);
        $this->entityManager->flush();

        $this->species = $species;
        $this->breed = $breed;

        parent::setUp();
    }

    protected function createSchema(array $entities): void
    {
        $schemaTool = new SchemaTool($this->entityManager);

        $classMetadata = [];
        foreach ($entities as $entity) {
            $classMetadata[] = $this->entityManager->getClassMetadata($entity);
        }

        $schemaTool->createSchema($classMetadata);
    }

    protected function getExtensions()
    {
        $manager = $this->createMock(ManagerRegistry::class);

        $manager->expects($this->any())
            ->method('getManager')
            ->will($this->returnValue($this->entityManager));

        $manager->expects($this->any())
            ->method('getManagerForClass')
            ->will($this->returnValue($this->entityManager));

        return [
            new CoreExtension(),
            new DoctrineOrmExtension($manager),
        ];
    }
}
