<?php

namespace App\Form;

use App\Entity\PlageHasEtude;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlageHasEtudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('idplage')
           // ->add('idetude')
            ->add('angle1')
            ->add('angle2')
            ->add('angle3')
            ->add('angle4')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlageHasEtude::class,
        ]);
    }
}
