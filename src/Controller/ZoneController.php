<?php

namespace App\Controller;

use App\Entity\PlageHasEtude;
use App\Entity\Plage;
use App\Entity\Etude;
use App\Entity\Zone;

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
        

        return $this->render('zone/index.html.twig', [
            "etude_has_plages"=>$etude_has_plage,
             "plages" =>$plage,
             "etudes" =>$etude,
             "zones" =>$zone,
        ]);
    }
}
