<?php

namespace App\Controller;


use App\Form\PrelevementType;

use App\Entity\Espece;
use App\Entity\Plage;
use App\Entity\Etude;
use App\Entity\Zone;
use App\Entity\PlageHasEspece;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EspeceController extends AbstractController
{
    /**
     * @Route("/espece/{idEtude}{idPlage}{idZone}", name="prelevement")
     */
    public function index($idEtude,$idPlage, Request $request)
    {

         $espece = new Espece();

        

        $form= $this->createForm(PrelevementType::class, $espece);

        $repository_espece=$this->getDoctrine()->getRepository(Espece::class);
        $repository_plage_has_espece=$this->getDoctrine()->getRepository(PlageHasEspece::class);
        
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid() )
            {  
                $nombreTotale = $form->get('nombretotale')->getData();
                $nomEspece =  $form->get('nomespece')->getData();
                $especeData= $repository_espece->findOneby(['nomespece' => $nomEspece]);
                $idEspeceData = $especeData->getIdespece();

             

            $plagehasespeceData = $repository_plage_has_espece->findOneby( 
                ['idplage' => $idPlage,
                'idespece' => $idEspeceData]); 
              //  $plagehasespeceData = $repository_plage_has_espece->find($idPlage, $idEspeceData);
                if (!empty($plagehasespeceData)) // Si l'espece est déjà existant sur la plage
                {

                    // $monfichier = fopen('especedemerde.txt', 'a+');
                    // fputs($monfichier, " le idplage récup : ");
                    // fputs($monfichier,  $idPlage);
                    // fputs($monfichier, " lid espece recup  : ");
                    // fputs($monfichier,   $idEspeceData);
                    // fputs($monfichier, " plagehasespeceData  : ");
                    // fputs($monfichier,   $plagehasespeceData);
                    // fclose($monfichier); 
                    $nombreActuelPHE = $plagehasespeceData->getNombreespece();
                    $plagehasespeceData->setNombreespece($nombreTotale + $nombreActuelPHE);
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($plagehasespeceData);
                    $em->flush(); 
                }
                else // Si l'espece n'existe pas sur cette plage
                {
                    $nouvelleEspece = new PlageHasEspece();
                    $nouvelleEspece->setIdplage($idPlage);
                    $nouvelleEspece->setIdespece($idEspeceData);
                    $nouvelleEspece->setNombreespece($nombreTotale);
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($nouvelleEspece);
                    $em->flush(); 
                }
            // $monfichier = fopen('especedemerde', 'a+');
            //      fputs($monfichier, " le nombre récup : ");
            //      fputs($monfichier,  $nombreautre);
            //      fputs($monfichier, " lespece recup  : ");
            //      fputs($monfichier,   $nomEspece);
            //      fclose($monfichier);
                //   $em=$this->getDoctrine()->getManager();
                //   $em->persist($especeData);
                //   $em->flush(); 


                   return $this->redirectToRoute("zone", [
                    'idEtude' => $idEtude,
                    'idPlage' => $idPlage,              
                ]);
            }  

        return $this->render('espece/index.html.twig', [
            'form' => $form->createView(),
            'idEtude' => $idEtude,
            'idPlage' => $idPlage,
            
            
        ]);
    }


    // /**
    //  * @Route("/zone/{idEtude}{idPlage}", name="back_to_zone")
    //  */
    // public function prelevementFormulaire($idEtude, $idPlage, $idZone, Request $request)
    // {
    //     return $this->render('zone/index.html.twig', [
    //         'controller_name' => 'EspeceController',
    //     ]);
    // }
}
