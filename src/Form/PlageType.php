<?php

namespace App\Form;

use App\Entity\Plage;
use App\Entity\Lieu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PlageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
           // ->add('idplage')
            ->add('nomplage')
            ->add('superficietotaleplage')
           // ->add('nombredespeceplage')
            ->add('densiteespeceplage')
            // ->add('idlieu',ChoiceType::class, array (
            //     'choices' => $array
            // ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plage::class,
        ]);
    }
}
