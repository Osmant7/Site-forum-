<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Forums;
use App\Form\ForumType;
use App\Form\PostsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;




class PostsController extends AbstractController
{
    /**
     * @Route("/AjoutezCommentaire/{id}", name="New_Post")
     */
     public function new(Request $request, int $id, SluggerInterface $slugger) {
        $post = new Posts();
        
        $form = $this->createForm(PostsType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $post->setCreatedAt(new \DateTime());
            $forum = $this->getDoctrine()->getRepository(Forums::class)->find($id);
            $post->setTheForum($forum);

            $post->setUser($this->getUser());

            $brochureFile = $form->get('brochure')->getData();
           
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }

                $post->setBrochureFilename($newFilename);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($post); 
            $em->flush(); 


            return $this->redirectToRoute('forums_page', ['id' => $id]);

        }
        return $this->render('post/CreerPost.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
    * @Route("/delet/{id}", name="delete_commentaire")
    */    
    public function delete(int $id) : Response {
        // On utilise l'entity manager pour supprimer l'article

         $commentaire = $this->getDoctrine()
        ->getRepository(Posts::class)
        ->find($id);

        $delete = $this->getDoctrine()->getManager();
        $delete->remove($commentaire);
        $delete->flush();

        //redirige l'utilisateur vers la page d'accueil

        return $this->redirectToRoute("categories");
        }

}
