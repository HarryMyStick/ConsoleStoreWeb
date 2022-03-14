<?php

namespace App\Form;

use App\Entity\Orderdetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderdetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Price')
            ->add('Quantity')
            ->add('Total')
            ->add('ID_Order')
            ->add('ID_Product')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orderdetail::class,
        ]);
    }
}
