<?php
/**
 * Created by PhpStorm.
 * User: chucks
 * Date: 2018/12/06
 * Time: 9:36 AM
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response("My first pageb already!");
    }

    /**
     * @Route("/news/{slug}")
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        return new Response($slug);
    }
}