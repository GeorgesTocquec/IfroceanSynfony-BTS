<?php

namespace App\Form;

use App\Entity\Lieu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // try to avoid this solution and find something nicer, without any global variables.
        global $kernel;

        if ( 'AppCache' == get_class($kernel) )
        {
            $kernel = $kernel->getKernel();
        }
        $doctrine = $kernel->getContainer()->get( 'doctrine' );
        //

        $repository=$doctrine->getRepository(Lieu::class);
        $departement= $repository->findAll();
        $dataDepartement = array();
        foreach($departement as $value)
        {   
            if (!empty($value->getNomdepartement())) 
            {
            $array[$value->getNomdepartement()] = $value->getNomdepartement();
            }
        };


        $builder
            ->add('nomdepartement',ChoiceType::class, array (
                 'choices' => $array
             ))
           // ->add('idcommune')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
