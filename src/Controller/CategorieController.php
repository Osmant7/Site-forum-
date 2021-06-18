<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Forums;
use App\Entity\SousCategories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="categories")
     */ 
     public function readAll(): Response {
        $repository = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repository->findAll();

        return $this->render("accueil/index.html.twig", [
            "categories" => $categories
        ]);
    }

    /**
     * @Route("/forum/{id}", name="souscategories")
     */ 
     public function forum($id) {
            $repo = $this->getDoctrine()->getRepository(SousCategories::class);
            $forum = $repo->find($id);
            return $this->render("accueil/forum.html.twig", [
            'forum' => $forum
        ]);
    }

    /**
     * @Route("/staff", name="staff_page")
     */
    public function staff(){
        return $this->render("staff/index.html.twig");
    }

}
