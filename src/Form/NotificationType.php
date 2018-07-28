<?php

namespace App\Form;

use App\Entity\Notification;
use App\Entity\User\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['add_receiver']) {
            $builder
                ->add('receiver', EntityType::class, [
                    'label' => 'entity.notification.receiver',
                    'class' => User::class,
                    'choice_label' => 'username',
                    'multiple' => false,
                    'expanded' => false,
                ])
            ;
        }

        $builder
            ->add('subject', TextType::class, [
                'label' => 'entity.notification.subject',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'entity.notification.message',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.notification.submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
            'add_receiver' => true,
        ]);
    }
}
