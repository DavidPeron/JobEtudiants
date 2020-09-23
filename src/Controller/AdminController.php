<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Offre;
use App\Entity\User;
use App\Form\EditDemandeType;
use App\Form\EditOffreType;
use App\Form\EditUserType;
use App\Repository\DemandeRepository;
use App\Repository\OffreRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="gestion")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * Liste les utilisateurs du site
     * 
     * @Route("/utilisateur", name="utilisateur")
     */
    public function usersList(UserRepository $users)
    {

        return $this->render("admin/users.html.twig", [
            'user' => $users->findAll()
        ]);
    }

    /**
     * Modifier un utilisateur du site
     * 
     * @Route("/utilisateur/modifier/{id<[0-9]+>}", name="utilisateur_modifier", methods={"PATCH", "GET", "POST"})
     */
    public function usersEdit(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_utilisateur');
        }

        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    /**
     * Supprime un utilisateur du site
     * 
     * @Route("/utilisateur/supprimer/{id<[0-9]+>}", name="utilisateur_supprimer")
     */
    public function usersDelete(User $user, EntityManagerInterface $em)
    {

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_utilisateur');
    }

    /**
     * Liste les offres du site
     * 
     * @Route("/offres", name="offres")
     */
    public function offersList(OffreRepository $offre)
    {

        return $this->render("admin/offres.html.twig", [
            'offres' => $offre->findAll()
        ]);
    }

    /**
     * Modifier les offres du site
     * 
     * @Route("/offres/modifier/{id<[0-9]+>}", name="offre_modifier")
     */
    public function offersEdit(Offre $offre, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(EditOffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('admin_offres');
        }

        return $this->render('admin/editOffre.html.twig', [
            'offreForm' => $form->createView()
        ]);
    }

    /**
     * Supprimer une offre du site
     * 
     * @Route("/offres/supprimer/{id<[0-9]+>}", name="offre_supprimer")
     */
    public function offersDelete(Offre $offre, EntityManagerInterface $em)
    {

        $em->remove($offre);
        $em->flush();

        return $this->redirectToRoute('admin_offres');
    }

    /**
     * Liste les demandes du site
     * 
     * @Route("/demandes", name="demandes")
     */
    public function demandesList(DemandeRepository $demande)
    {

        return $this->render("admin/demandes.html.twig", [
            'demandes' => $demande->findAll()
        ]);
    }

    /**
     * Modifier les demandes du site
     * 
     * @Route("/demandes/modifier/{id<[0-9]+>}", name="demande_modifier")
     */
    public function demandesEdit(Demande $demande, Request $request, EntityManagerInterface $em)
    {

        $form = $this->createForm(EditDemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('admin_demandes');
        }

        return $this->render('admin/editDemande.html.twig', [
            'demandeForm' => $form->createView()
        ]);
    }

    /**
     * Supprimer les demandes du site
     * 
     * @Route("/demandes/supprimer/{id<[0-9]+>}", name="demande_supprimer")
     */
    public function demandesDelete(Demande $demande, EntityManagerInterface $em)
    {

        $em->remove($demande);
        $em->flush();

        return $this->redirectToRoute('admin_demandes');
    }
}
