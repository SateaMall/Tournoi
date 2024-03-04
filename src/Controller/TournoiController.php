<?php

namespace App\Controller;

use App\Entity\Tournoi; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use App\Repository\TournoiRepository;

class TournoiController extends AbstractController
{


    #[Route('/tournoi', name: 'app_tournoi')]
    public function index(EntityManagerInterface $em) : Response
    {
        $repository = $em->getRepository(Tournoi::class); // Replace Tournoi with your actual entity class name
        $ts = $repository->findAll();
        return $this->render('tournoi/index.html.twig', [
            'Tournois' => $ts           ,
        ]); 
    }


    #[Route("/tournoi/saisieTnoi/{evtid<[0-9]+>}", name: 'saisieTnoi')]
public function saisieTnoi($evtid): Response {
    $tnoi=new Tournoi();
    $tnoi->setNom("");
    $tnoi->setDescription(""); // saisie donc vide
    $form = $this->createFormBuilder($tnoi)
    ->add('nom', TextType::class)
    ->add('description', TextType::class)
    ->add('sauver', SubmitType::class, ['label' => 'Créer letournoi !'])
    ->getForm(); // le formulaire est créé
    return $this->render('tournoi/saisieTnoi.html.twig', 
        [ 'form' => $form->createView() ]);
    }

