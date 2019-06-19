<?php

namespace App\Controller;

use App\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="tag")
     * @return Response
     */
    public function index() : Response
    {

        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }

    /**
     * @Route("/tag/{name}", name="show_tag")
     * @param Tag $tagName
     * @return Response
     */
    public function showByTag(Tag $tagName) : Response
    {
        return $this->render('tag/show.html.twig', [
             'tag' => $tagName,
        ]);
    }
}
