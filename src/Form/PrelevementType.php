<?php

namespace App\Form;

use App\Entity\Espece;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PrelevementType extends AbstractType
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

        $repository=$doctrine->getRepository(Espece::class);
        $espece= $repository->findAll();
        $dataEspece = array();
        foreach($espece as $value)
        {   
            if (!empty($value->getNomespece())) 
            {
            $array[$value->getNomespece()] = $value->getNomespece();
            }
        }
        ;
        
        $builder
            ->add('nomespece',ChoiceType::class, array (
                'choices' => $array
            ))
            ->add('nombretotale')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Espece::class,
        ]);
    }
}
