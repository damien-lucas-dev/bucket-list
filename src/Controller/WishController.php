<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Util\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish")
     */
    public function index(): Response
    {
        return $this->render('wish/index.html.twig', [
            'controller_name' => 'WishController',
        ]);
    }

    /**
     * @Route("/wish/list", name="wish_list")
     */
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy([]);
        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes
        ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="wish_detail")
     */
    public function details(int $id, WishRepository $repo): Response
    {
        //récupère ce wish en fonction de l'id présent dans l'URL
        $wish = $repo->find($id);

        //s'il n'existe pas en bdd, on déclenche une erreur 404
        if (!$wish) {
            throw $this->createNotFoundException('Oops! No wish found!');
        }

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }

    /**
     * @Route("/wish/create", name="wish_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager, Censurator $censurator): Response
    {
        // notre entité vide :
        $wish = new Wish();


        // Préremplir le pseudo dans le formulaire...
        $currentUserUsername = $this->getUser()->getUsername();
        $wish->setAuthor($currentUserUsername);


        // ici, on crée le formulaire en communiquant à la fonction la classe de formulaire (XxxType::class)
        // ainsi que l'objet à hydrater : the object to bind the form to.

        // notre formulaire est donc associé à l'entité vide.
        $wishForm = $this->createForm(WishType::class, $wish);


        // Récupérons les données du form et injectons les dans notre entity $wish
        $wishForm->handleRequest($request);


        // Et maintenant, avant de (peut-être) déclencher l'affichage du formulaire
        // Traitons le ! Pour vérifier s'il a déjà été soumis :
        if ($wishForm->isSubmitted() && $wishForm->isValid())
        {
            // hydrate les propriétés absentes du formulaire
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());

            //censure les méchants mots
            $wish->setDescription(
              $censurator->purify($wish->getDescription())
            );

            // persiste en bdd      /!\ Don't forget the flush /!\
            $entityManager->persist($wish);
            $entityManager->flush();


            // Affiche un gentil message on the next page
            $this->addFlash('success', 'Idea successfully added!');

            // ... et :
            // redirige vers la page de détails du Wish fraichement créée :
            return $this->redirectToRoute('wish_detail', [
                'id' => $wish->getId()
            ]);
        }

        // Affiche le formulaire :
                //!\  Sans oublier le $xxxForm->createView() !!! //!\
        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }
}
