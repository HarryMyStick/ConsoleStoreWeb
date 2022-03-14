<?php

namespace App\Form;

use App\Entity\Profiles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Fullname')
            ->add('Email')
            ->add('Address')
            ->add('Telephone')
            ->add('Gender')
            ->add('DOB')
            ->add('ID_Account')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profiles::class,
        ]);
    }
}
