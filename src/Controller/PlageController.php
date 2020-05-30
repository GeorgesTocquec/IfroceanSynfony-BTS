<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Plage;
use App\Entity\Lieu;
use App\Entity\Commune;
use App\Form\PlageType;
use App\Form\DepartementType;

class PlageController extends AbstractController
{
    /**
     * @Route("/plage", name="plage")
     */
    public function index()
    {
        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);
        $repository_departement=$this->getDoctrine()->getRepository(Lieu::class);
        $repository_commune=$this->getDoctrine()->getRepository(Commune::class);
        $plage=$repository_plage->findAll();
        $departement=$repository_departement->findAll();
        $commune=$repository_commune->findAll();


        return $this->render('plage/index.html.twig', [
            "plages" =>$plage,
            "departements" =>$departement,
            "communes" =>$commune,
        ]);
    }

     /**
     * @Route("/plage/ajout_plage", name="ajout_plage")
     */
    public function AjoutPlage(Request $request)
    {
        $plage = new Plage();
        $departement = new Lieu();

        $form= $this->createForm(PlageType::class, $plage);
        $form->handleRequest($request);
        $formDepartement= $this->createForm(DepartementType::class, $departement);
        $formDepartement->handleRequest($request);

        $repository_plage=$this->getDoctrine()->getRepository(Plage::class);
        $repository_departement=$this->getDoctrine()->getRepository(Lieu::class);
       
        if($formDepartement->isSubmitted() && $formDepartement->isValid() )
        { 
            $nomDepartement = $formDepartement->get('nomdepartement')->getData();
            $departementData= $repository_departement->findOneby(['nomdepartement' => $nomDepartement]);
            $idDepartement = $departementData->getIdlieu();

            $plage->setIdlieu($idDepartement);
            $plage->setNombredespeceplage(0);
            $em=$this->getDoctrine()->getManager();
            $em->persist($plage);
            $em->flush(); 

            return $this->redirectToRoute("plage");
        }  

        
        
        return $this->render('plage/ajout_plage.html.twig', [
            'form' => $form->createView(),
            'formDepartement' => $formDepartement->createView(),

        ]);
    }
}
