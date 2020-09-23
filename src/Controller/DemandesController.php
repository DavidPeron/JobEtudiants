<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Recherche;
use App\Form\RechercheType;
use App\Repository\DemandeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DemandesController extends AbstractController
{
    /**
     * @Route("/demandes", name="demandes")
     */
    public function index(DemandeRepository $demandeRepository, Request $request, PaginatorInterface $paginator)
    {
        $recherche = new Recherche();
        $form = $this->createForm(RechercheType::class, $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cp = $form->getData()->getCodePostal();
            $domaine = $form->getData()->getDomaine();
            $demande = $paginator->paginate(
                $demandeRepository->findByCpOrDomaine($cp, $domaine),
                $request->query->getInt('page', 1),
                3
            );

            return $this->render("demandes/index.html.twig", [
                'demandes' => $demande,
                'form'  => $form->createView()
            ]);
        }

        return $this->render('demandes/index.html.twig', [
            'demandes' => $paginator->paginate($demandeRepository->findBy([], ['create_at' => 'DESC']), $request->query->getInt('page', 1), 4),
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/demandes/{id<[0-9]+>}", name="show_demande")
     */
    public function showDemande(Demande $demande)
    {
        return $this->render('demandes/demande.html.twig', compact('demande'));
    }
}
