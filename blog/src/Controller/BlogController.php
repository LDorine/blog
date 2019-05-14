<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="blog_")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Thomas',
        ]);
    }

    /**
     * @Route("/blog/show/{slug}", name="show",requirements={"slug"="^[a-z0-9]+(?:-[a-z0-9]+)*$"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug)
    {
        if($slug === "affiche") {
            $slug = 'article-sans-titre';
        }
        $title = str_replace('-',' ',$slug);
        $title = ucwords($title);
        return $this->render('blog/show.html.twig', [
            'slug' => $title,
        ]);
    }

}