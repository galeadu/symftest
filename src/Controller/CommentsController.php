<?php

namespace App\Controller;


use App\Components\Model\Mapper\Input\Comments\FormInputMapper;
use App\Components\Model\Mapper\Input\Comments\GetInputMapper;
use App\Entity\Comments;
use App\Components\Model\Facade\CommentsFacade;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


/**
 * Class CommentsController
 * @package App\Controller
 */
class CommentsController extends Controller
{

    /** @var \App\Components\Model\Facade\CommentsFacade **/
    protected $commentsFacade;

    protected $formInputMapper;


    /**
     * CommentsController constructor.
     * @param CommentsFacade $commentsFacade
     */
    public function __construct(
        CommentsFacade $commentsFacade
    )
    {
        $this->commentsFacade = $commentsFacade;
    }


    /**
     * @Route("/comments", name="comments")
     */
    public function index()
    {
        $comments = $this->commentsFacade->getIndexPageData();

        return $this->render('comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }
    
    /**
     * @Route("/comments/form", name="comments/form")
     */
    public function form(formInputMapper $formInputMapper, Request $request)
    {

       $comment = new Comments();

       $form = $this->createFormBuilder($comment)
            ->add('shortdescription', TextType::class, array('label' => 'Anotace'))
            ->add('description', TextareaType::class, array('label' => 'Text'))
            ->add('save', SubmitType::class, array('label' => 'Uložit'))
            ->getForm();

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid())
       {
           $formdata = $formInputMapper->getInput();

           //TODO zatim takto
           $comment->setDescription($formdata->getDescription());
           $comment->setShortdescription($formdata->getShortdescription());

           $this->commentsFacade->insertNewComment($comment);

           return $this->redirectToRoute('comments');
       }
       else
       {
           return $this->render('comments/form.html.twig', array(
               'form' => $form->createView(),
           ));
       }

    }

       /**
     * @Route("/comments/detail/{id}", name="comments/detail")
     */
    public function detail(GetInputMapper $getInputMapper)
    {

       $comment = $this->commentsFacade->getDetailPageData($getInputMapper->getInput()->getId());

       return $this->render('comments/detail.html.twig', array(
             'comment' => $comment
        ));
        
    }
    
    /**
     * @Route("/comments/delete/{id}", name="comments/delete")
     */
    public function delete(GetInputMapper $getInputMapper)
    {
       $this->commentsFacade->deleteComment($getInputMapper->getInput()->getId());

       return $this->redirectToRoute('comments');
    }

}
