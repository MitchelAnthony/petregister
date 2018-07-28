<?php

namespace App\Tests\Form;

use App\Entity\Notification;
use App\Entity\User\User;
use App\Form\NotificationType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Symfony\Bridge\Doctrine\Test\DoctrineTestHelper;
use Symfony\Component\Form\Extension\Core\CoreExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class NotificationTypeTest extends TypeTestCase
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var User
     */
    protected $user;

    public function testSubmitValidData()
    {
        $notification = (new Notification())
            ->setReceiver($this->user)
            ->setSubject('Test')
            ->setMessage('Lorem ipsum :-)')
        ;

        $formData = [
            'receiver' => $this->user->getId(),
            'subject' => 'Test',
            'message' => 'Lorem ipsum :-)',
        ];

        $notificationToCompare = new Notification();
        $form = $this->factory->create(NotificationType::class, $notificationToCompare);
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($notification, $notificationToCompare);

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
            User::class,
            Notification::class,
        ];

        $this->createSchema($entities);

        $user = (new User())
            ->setUsername('admin')
            ->setPlainPassword('admin')
            ->setEmail('admin@example.com')
            ->setEnabled(true)
            ->setRoles(['ROLE_SUPER_ADMIN'])
        ;

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->user = $user;

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
