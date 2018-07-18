<?php

namespace App\Form;

use App\Entity\Pet\Breed;
use App\Entity\Pet\Pet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'entity.pet.name',
            ])
            ->add('breed', EntityType::class, [
                'label' => 'entity.pet.breed',
                'class' => Breed::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('microchipId', TextType::class, [
                'label' => 'entity.pet.microchip_id',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.pet.submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pet::class,
        ]);
    }
}
