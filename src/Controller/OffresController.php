<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;

class OffresController extends AbstractController
{
    /**
     * @Route("/offres", name="offres")
     */
    public function index(OffreRepository $offreRepository, Request $request, PaginatorInterface $paginator): Response
    {
        // Instanciation d'un objet Recherche, création du formulaire et récupération de la requête
        $recherche = new Recherche();
        $form = $this->createForm(RechercheType::class, $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données entrées par l'utilisateur
            $cp = $form->getData()->getCodePostal();
            $domaine = $form->getData()->getDomaine();
            // Pagination des biens grâce à la PaginatorInterface
            $offre = $paginator->paginate(
                $offreRepository->findByCpOrDomaine($cp, $domaine),
                $request->query->getInt('page', 1),
                3
            );

            return $this->render("offres/index.html.twig", [
                'offre' => $offre,
                'form'  => $form->createView()
            ]);
        }
        // Retourne simplement les offres et le formulaire de recherche si aucune recherche n'est effectuée
        return $this->render("offres/index.html.twig", [
            'offre' => $paginator->paginate($offreRepository->findBy([], ['create_at' => 'DESC']), $request->query->getInt('page', 1), 4),
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/offres/{id<[0-9]+>}", name="show_offre")
     */
    public function showOffre(Offre $offre)
    {
        return $this->render('offres/offre.html.twig', compact('offre'));
    }
}
