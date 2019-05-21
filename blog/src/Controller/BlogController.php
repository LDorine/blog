<?php
// src/Controller/BlogController.php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Category;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     * @return Response
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @Route("/blog/show/{slug<^[a-z0-9-]+$>}",
     *     name="blog_show",
     *     defaults={"slug" = null}
     *     )
     * @param $slug
     * @return Response
     */
    public function show(?string $slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'articles' => $article
            ]
        );
    }

    /**
     * @Route("/blog/category/{name}",
     *     name="show_category"
     *      )
     * @param Category $categoryName
     * @return Response
     */
    public function showByCategory(Category $categoryName) : Response
    {
        $articles = $categoryName->getArticles();

        return $this->render(
            'blog/category.html.twig',
            ['articles' => $articles, 'category' => $categoryName->getName()]
        );
    }

}