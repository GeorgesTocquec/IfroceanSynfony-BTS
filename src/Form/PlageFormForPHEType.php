<?php

namespace App\Form;

use App\Entity\Plage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;  

class PlageFormForPHEType extends AbstractType
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
 
         $repository=$doctrine->getRepository(Plage::class);
         $plage= $repository->findAll();
         $dataPlage = array();
         foreach($plage as $value)
         {   
             if (!empty($value->getNomplage())) 
             {
             $array[$value->getNomplage()] = $value->getNomplage();
             }
         };


        $builder
            ->add('nomplage',ChoiceType::class, array (
                'choices' => $array
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plage::class,
        ]);
    }
}
