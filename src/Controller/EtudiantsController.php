<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Etudiant;
use App\Form\EditDemandeType;
use App\Form\EditEtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantsController extends AbstractController
{
    /**
     * @Route("/etudiant", name="compte_etudiant")
     */
    public function indexEtudiant()
    {
        $etudiant = $this->getUser()->getEtudiant();
        // $demandes = $this->getUser()->getEtudiant()->getDemande();
        $demandes = $etudiant->getDemande();
        return $this->render('etudiants/index.html.twig', compact('etudiant', 'demandes'));
    }

    /**
     * @Route("/etudiant/editInfos/{id<[0-9]+>}", name="etudiant_edit_infos")
     */
    public function editInfos(Etudiant $etudiant, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditEtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('compte_etudiant');
        }

        return $this->render('etudiants/editInfos.html.twig', [
            'infosForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/etudiant/createDemande", name="etudiant_create_demande")
     */
    public function createDemande(Request $request, EntityManagerInterface $em)
    {
        $demande = new Demande;
        $demande->setEtudiant($this->getUser()->getEtudiant());
        $form = $this->createForm(EditDemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('compte_etudiant');
        }

        return $this->render('etudiants/createDemande.html.twig', [
            'demandeForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/etudiant/deleteDemande{id<[0-9]+>}", name="etudiant_delete_demande")
     */
    public function deleteDemande(Demande $demande, EntityManagerInterface $em)
    {
        $em->remove($demande);
        $em->flush();

        return $this->redirectToRoute('compte_etudiant');
    }

    /**
     * @Route("/etudiant/editDemande/{id<[0-9]+>}", name="etudiant_edit_demande")
     */
    public function editDemande(Demande $demande, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditDemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('compte_etudiant');
        }

        return $this->render('etudiants/editDemande.html.twig', [
            'demandeForm' => $form->createView()
        ]);
    }
}
