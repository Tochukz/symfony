<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticlesController extends Controller
{
    /**
     * @Route("/", name="article_list")
     * @Method({"GET"})
     * @return Response
     */
    public function index()
    {
        //return new Response('<html><body>Hello World</body></html>');

        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('articles/index.html.twig', ['articles'=>$articles]);
    }


    /**
     * @Route("/article/add", name="add_attcle")
     * @Method({"GET", "POST"})
     */
    public function addArticle(Request $request)
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title', TextType::class, ['attr'=>['class'=>'form-control']])
                     ->add('body', TextareaType::class, ['attr'=>['class'=>'form-control'], 'required'=>false])
                     ->add('save', SubmitType::class, [ 'attr'=>['class'=>'btn btn-primary mt-3'], 'label'=>'Create',])
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist(($article));
            $entityManager->flush();

            return $this->redirectToRoute('article_list');
        }
        return $this->render('articles/add-article.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @param $id
     * @return
     */
    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        return $this->render('articles/show.html.twig', ['article'=>$article]);
    }

    /**
     * @Route("/article/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     * @Method({"GET", "POST"})
     */
      public function edit(Request $request, $id)
      {
          $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

          $form = $this->createFormBuilder($article)
                       ->add('title', TextType::class, ['attr'=>['class'=>'form-control']])
                       ->add('body', TextareaType::class, ['attr'=>['class'=>'form-control'], 'required'=>false])
                       ->add('save', SubmitType::class, ['attr'=>['class'=>'btn btn-light mt-3'], 'label'=>'Update'])
                       ->getForm();

          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()){
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->redirectToRoute("article_list");
          }

          return $this->render("articles/edit.html.twig", ['form'=>$form->createView()]);
      }

    /**
     * @Route("article/save")
     */
    public function save()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle("Article One");
        $article->setBody("This is content for article One");

        //$entityManager->persist(($article)); //prepare to save
        //$entityManager->flush(); //Save to database

        //return new Response("Article has been save with ID ". $article->getId());
    }
}