<?php

namespace App\Controller;

use App\Entity\PlageHasEtude;
use App\Entity\Plage;
use App\Entity\Etude;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlageHasEtudeController extends AbstractController
{
     /**
     * @Route("/etude_has_plage/{id}", name="etude_has_plage")
     */
    public function PlageDeLetude($id, Request $request)
    {
        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);
        $repository=$this->getDoctrine()->getRepository(PlageHasEtude::class);
        $repository_etude=$this->getDoctrine()->getRepository(Etude::class);

        $etude=$repository_etude->find($id);
        $etude_has_plage= $repository->findBy( 
            ['idetude' => $id]
            ); 
        $plage=$repository_plage->findAll();
            

        return $this->render('etude/etude_has_plage.html.twig', [
            "etude_has_plages"=>$etude_has_plage,
             "plages" =>$plage,
             "etudes" =>$etude,
        ]);
    }    
}
