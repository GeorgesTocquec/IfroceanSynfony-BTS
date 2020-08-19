<?php

namespace App\Controller;

use App\Entity\PlageHasEtude;
use App\Entity\Plage;
use App\Entity\Etude;
use App\Entity\Zone;

use App\Form\ZoneType;
use App\Form\PlageHasEtudeType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ZoneController extends AbstractController
{
    /**
     * @Route("/zone/{idEtude}{idPlage}", name="zone")
     */
    public function index($idEtude,$idPlage, Request $request)
    {
        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);
        $repository_etude=$this->getDoctrine()->getRepository(Etude::class);
        $repository_zone=$this->getDoctrine()->getRepository(Zone::class);
        $repository_plage_has_etude=$this->getDoctrine()->getRepository(PlageHasEtude::class);

        $plage=$repository_plage->find($idPlage);       
        $etude=$repository_etude->find($idEtude);
        $zone=$repository_zone->findAll();

        $etude_has_plage= $repository_plage_has_etude->findBy( 
            array('idetude' => $idEtude,
            'idplage' => $idPlage)
            ); 

        //    $dateEtude = $etude->getDateetude()->format('d/m/Y');

        return $this->render('zone/index.html.twig', [
            "etude_has_plages"=>$etude_has_plage,
             "plages" =>$plage,
             "etudes" =>$etude,
             "zones" =>$zone,
            //  "dateetude" =>$dateEtude,
        ]);
    }

     /**
     * @Route("/zone/ajout_zone/{idEtude}{idPlage}", name="ajout_zone")
     */
    public function AjoutZone($idEtude, $idPlage ,Request $request)
    {
        $PHE = new PlageHasEtude();
        $zone = new Zone();

        $formPHE= $this->createForm(PlageHasEtudeType::class, $PHE);
        $formPHE->handleRequest($request);

        $formZone= $this->createForm(ZoneType::class, $zone);
        $formZone->handleRequest($request);

        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);

        $plageData= $repository_plage->findOneby(['idplage' => $idPlage]);
        $idEspeceData = $plageData->getIdplage();
        $PHE->setIdplage($idEspeceData);
        $PHE->setIdetude($idEtude);
       

        if($formZone->isSubmitted())
        { 

        
           

            $em=$this->getDoctrine()->getManager();
            $em->persist($PHE);
            $em->flush(); 

            $em=$this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush(); 

            // $repository_etude=$this->getDoctrine()->getRepository(Etude::class);
            // $etude= $repository_etude->findAll($idEtude);

            // return $this->render(
            //     'etude/etude_has_plage.html.twig',
            //     ['id'  => $idEtude]
            //   );
            return $this->redirectToRoute("etudes");
        }  
       
        
        return $this->render('zone/ajout_zone.html.twig', [
            'formPHE' => $formPHE->createView(),
            'formZone' => $formZone->createView(),

        ]);
    }
}
