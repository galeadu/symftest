<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Comments;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index()
    {
        $comments = $this->getDoctrine()->getRepository(Comments::class)->findBy(array(),array('dateinsert' => 'DESC'));
        return $this->render('comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }
    
    /**
     * @Route("/comments/form", name="comments/form")
     */
    public function form(Request $request)
    {
       $comments = new Comments();
       $form = $this->createFormBuilder($comments)
            ->add('shortdescription', TextType::class, array('label' => 'Anotace'))
            ->add('description', TextareaType::class, array('label' => 'Text'))
            ->add('save', SubmitType::class, array('label' => 'Uložit'))
            ->getForm();

            
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid())
       {
       
        $newComment = $form->getData();
        $newComment->setDateinsert(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
                     
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($newComment);
        $entityManager->flush();
        
        return $this->redirectToRoute('comments');
       
       }     
      
       return $this->render('comments/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
   
       /**
     * @Route("/comments/detail/{id}", name="comments/detail")
     */
    public function detail(Comments $comments, Request $request )
    {     
       return $this->render('comments/detail.html.twig', array(
             'comment' => $comments
        )); 
        
    }
    
           /**
     * @Route("/comments/delete/{id}", name="comments/delete")
     */
    public function delete(Comments $comments)
    {     
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->remove($comments);
           $entityManager->flush();
            
           return $this->redirectToRoute('comments');
       
    }
   
     
}
