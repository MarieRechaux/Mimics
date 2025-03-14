<?php

namespace App\Form;

use App\Entity\Orders;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orderNumber')
            ->add('rising')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('sentAt', null, [
                'widget' => 'single_text',
            ])
            ->add('deliveredAt', null, [
                'widget' => 'single_text',
            ])
            ->add('state')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
