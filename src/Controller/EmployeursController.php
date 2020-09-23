<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Employeur;
use App\Entity\Offre;
use App\Form\EditOffreType;
use App\Form\EmployeurType;
use App\Repository\DemandeRepository;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EmployeursController extends AbstractController
{

    /**
     * @Route("/employeur", name="compte_employeur")
     */
    public function indexEmployeur()
    {
        $employeur = $this->getUser()->getEmployeur();
        // $offres = $this->getUser()->getEmployeur()->getOffre();
        $offres = $employeur->getOffre();
        return $this->render("employeurs/index.html.twig", compact('employeur', 'offres'));
    }

    /**
     * @Route("/employeur/editInfos/{id<[0-9]+>}", name="employeur_edit_infos")
     */
    public function editInfos(Employeur $employeur, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EmployeurType::class, $employeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($employeur);
            $em->flush();

            return $this->redirectToRoute('compte_employeur');
        }

        return $this->render('employeurs/editInfos.html.twig', [
            'infosForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/employeur/deleteOffre/{id<[0-9]+>}", name="employeur_delete_offre")
     */
    public function deleteOffre(Offre $offre, EntityManagerInterface $em)
    {
        $em->remove($offre);
        $em->flush();

        return $this->redirectToRoute('compte_employeur');
    }

    /**
     * @Route("/employeur/createOffre", name="employeur_create_offre" )
     */
    public function createOffre(Request $request, EntityManagerInterface $em)
    {
        $offre = new Offre;
        $offre->setEmployeur($this->getUser()->getEmployeur());
        $form = $this->createForm(EditOffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('compte_employeur');
        }

        return $this->render('employeurs/createOffre.html.twig', [
            'offreForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/employeur/editOffre/{id<[0-9]+>}", name="employeur_edit_offre")
     */
    public function editOffre(Offre $offre, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditOffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('compte_employeur');
        }

        return $this->render('employeurs/editOffre.html.twig', [
            'offreForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/employeur/liste-etudiants", name="liste_etudiants")
     */
    public function listeEtudiants(EtudiantRepository $etudiants)
    {
        return $this->render("employeurs/liste_etudiants.html.twig", [
            'etudiants' => $etudiants->findAll()
        ]);
    }
}
