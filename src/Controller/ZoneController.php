<?php

namespace App\Controller;

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
        $repository_plage_has_etude=$this->getDoctrine()->getRepository(PlageHasEtude::class);
        $repository_etude=$this->getDoctrine()->getRepository(Etude::class);

        $plage=$repository_plage->find($idPlage);
        $etude=$repository_etude->find($idEtude);

        $etude_has_plage= $repository->findBy( 
            ['idetude' => $idEtude],
            ['idplage' => $idPlage]
            ); 
        

        return $this->render('zone/index.html.twig', [
            "etude_has_plages"=>$etude_has_plage,
             "plages" =>$plage,
             "etudes" =>$etude,
        ]);
    }
}
