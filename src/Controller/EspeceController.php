<?php

namespace App\Controller;


use App\Form\PrelevementType;

use App\Entity\Espece;
use App\Entity\Plage;
use App\Entity\Etude;
use App\Entity\Zone;
use App\Entity\PlageHasEspece;
use App\Entity\EtudeHasEspece;
use App\Form\EspeceType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class EspeceController extends AbstractController
{
    /**
     * @Route("/espece", name="espece")
     */
    public function index()
    {
        $repository_espece=$this->getDoctrine()->getRepository(Espece::class);
        $espece=$repository_espece->findAll();



        return $this->render('espece/index.html.twig', [
            "especes" =>$espece,

        ]);
    }

 /**
     * @Route("/espece/ajout_espece", name="ajout_espece")
     */
    public function AjoutEspece(Request $request)
    {
        $espece = new Espece();

        $form= $this->createForm(EspeceType::class, $espece);
        $form->handleRequest($request);
        $repository_espece=$this->getDoctrine()->getRepository(Espece::class);
       
       // $etude= $repository_etude->find($idEtude);
        if($form->isSubmitted() && $form->isValid() )
        { 
            // $lastidetude = $repository_etude->findOneBy([], ['idetude' => 'desc'])->getIdetude();
            // $lastidetude = $lastidetude+1;
             $espece->setNombretotale(0); 
            $em=$this->getDoctrine()->getManager();
            $em->persist($espece);
            $em->flush(); 

            return $this->redirectToRoute("espece");
        }  

        
        
        return $this->render('espece/ajout_espece.html.twig', [
            'form' => $form->createView(),

        ]);
    }



    /**
     * @Route("/espece/{idEtude}{idPlage}{idZone}", name="prelevement")
     */
    public function prelevement($idEtude,$idPlage, Request $request)
    {

         $espece = new Espece();

        

        $form= $this->createForm(PrelevementType::class, $espece);

        $repository_espece=$this->getDoctrine()->getRepository(Espece::class);
        $repository_plage_has_espece=$this->getDoctrine()->getRepository(PlageHasEspece::class);
        $repository_etude_has_espece=$this->getDoctrine()->getRepository(EtudeHasEspece::class);
        
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid() )
            {  
                $nombreTotale = $form->get('nombretotale')->getData();
                $nomEspece =  $form->get('nomespece')->getData();
                $especeData= $repository_espece->findOneby(['nomespece' => $nomEspece]);
                $idEspeceData = $especeData->getIdespece();

                
            $plagehasespeceData = $repository_plage_has_espece->findOneby( 
                ['idplage' => $idPlage,
                'idespece' => $idEspeceData,
                'idetude' => $idEtude]); 
                
                if (!empty($plagehasespeceData)) // Si l'espece est déjà existant sur la plage
                {
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
                    $nouvelleEspece->setIdetude($idEtude);
                    $nouvelleEspece->setNombreespece($nombreTotale);
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($nouvelleEspece);
                    $em->flush(); 
                }

                $etudehasespeceData = $repository_etude_has_espece->findOneby( 
                    ['idetude' => $idEtude,
                    'idespece' => $idEspeceData]); 

                if (!empty($etudehasespeceData)) // Si l'espece est déjà existant sur l'étude
                    {
                        $nombreActuelPHE = $etudehasespeceData->getNombreespece();
                        $etudehasespeceData->setNombreespece($nombreTotale + $nombreActuelPHE);
                        $em=$this->getDoctrine()->getManager();
                        $em->persist($etudehasespeceData);
                        $em->flush(); 
                    }
                
                else // Si l'espece n'existe pas sur cette etude
                    {
                        $nouvelleEspeceEtude = new EtudeHasEspece();
                        $nouvelleEspeceEtude->setIdetude($idEtude);
                        $nouvelleEspeceEtude->setIdespece($idEspeceData);
                        $nouvelleEspeceEtude->setNombreespece($nombreTotale);
                        $em=$this->getDoctrine()->getManager();
                        $em->persist($nouvelleEspeceEtude);
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

        return $this->render('espece/prelevement.html.twig', [
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
