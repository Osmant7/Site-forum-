<?php

namespace App\Controller;

use App\Entity\Forums;
use App\Entity\SousCategories;
use App\Form\ForumType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumsController extends AbstractController {
     /**
     * @Route("/CreerUnSujet/{id}", name="New_Forum")
     */
    public function new(Request $request, int $id): Response {
        $forum = new Forums();
        
        $form = $this->createForm(ForumType::class, $forum);

        // on met à jour l'objet $form avec les données saisies
        $form->handleRequest($request);

        // On s'assure que le formulaire à été soumis et que les données sont cohérentes 
        if($form->isSubmitted() && $form->isValid()) {
            $forum->setCreatedAt(new \DateTime());
            $souscategories = $this->getDoctrine()->getRepository(SousCategories::class)->find($id);
            $forum->setSouscategories($souscategories);
            $forum->setUser($this->getUser());
            // on récupère une instance de l'Entity Manager gràce à la méthode getDoctrine()
            //issu de la class AbstractController
            $em = $this->getDoctrine()->getManager();
            $em->persist($forum); // on ajoute l'objet $article à l'Entity Manager
            $em->flush(); // on synchronise l'objet ajouté a l'entity manager avec la BDD
            return $this->redirectToRoute('souscategories', ['id' => $id]);

        }
        return $this->render('Forums/CreerForums.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/Topic/{id}", name="forums_page")
     */ 
     public function forum($id) {
            $repo = $this->getDoctrine()->getRepository(Forums::class);
            $topic = $repo->find($id);
            return $this->render("post/index.html.twig", [
            'topic' => $topic
        ]);
    }

    /**
    * @Route("/delete/{id}", name="delete_forums")
    */    
    public function delete(int $id) : Response {
        // On utilise l'entity manager pour supprimer l'article

        $forum = $this->getDoctrine()
        ->getRepository(Forums::class)
        ->find($id);

        $delete = $this->getDoctrine()->getManager();
        $delete->remove($forum);
        $delete->flush();

        //redirige l'utilisateur vers la page d'accueil

        return $this->redirectToRoute("categories");
        }

    
}