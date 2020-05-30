<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\PlageHasEspece;
use App\Entity\EtudeHasEspece;
use App\Entity\Espece;
use App\Entity\Etude;
use App\Entity\Plage;


class HistoriqueController extends AbstractController
{
    /**
     * @Route("/historique/{idEtude}", name="historique")
     */
    public function index($idEtude)
    {

        $repository_etude_has_espece=$this->getDoctrine()->getRepository(EtudeHasEspece::class);
        $repository_plage_has_espece=$this->getDoctrine()->getRepository(PlageHasEspece::class);
        $repository_espece=$this->getDoctrine()->getRepository(Espece::class);
        $repository_etude=$this->getDoctrine()->getRepository(Etude::class);
        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);


        $etude_has_espece= $repository_etude_has_espece->findBy( 
            ['idetude' => $idEtude]
            );     
            
        $plage_has_espece= $repository_plage_has_espece->findBy( 
            ['idetude' => $idEtude]
            );     

        $espece = $repository_espece->findAll();
        $plage = $repository_plage->findAll();
        $etude = $repository_etude->find($idEtude);

            return $this->render('historique/index.html.twig', [
                'controller_name' => 'HistoriqueController',
                "etude_has_especes"=>$etude_has_espece,
                "plage_has_especes"=>$plage_has_espece,
                "plages"=>$plage,
                "especes"=>$espece,
                "etudes"=>$etude,
            ]);
        
    }
}
