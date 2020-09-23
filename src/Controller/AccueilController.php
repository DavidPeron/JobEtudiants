<?php

namespace App\Controller;

use App\Repository\DemandeRepository;
use App\Repository\EmployeurRepository;
use App\Repository\EtudiantRepository;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(OffreRepository $offre, EmployeurRepository $emp, DemandeRepository $dem, EtudiantRepository $etud): Response
    {
        $nbOffres = $offre->findAll();
        $offres = $offre->findBy([], ['create_at' => 'DESC'], $limit = 2);
        $etudiants = $etud->findAll();
        $demandes = $dem->findAll();
        $employeurs = $emp->findAll();

        return $this->render('accueil/index.html.twig', compact('offres', 'etudiants', 'demandes', 'employeurs', 'nbOffres'));
    }
}
