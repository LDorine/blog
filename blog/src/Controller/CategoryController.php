<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="blog_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request) : Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $insert = $this->getDoctrine()->getManager();
            $insert->persist($data);
            $insert->flush();

            $categories = $this->getDoctrine()
                ->getRepository(Category::class)
                ->findAll();
            return $this->render(
                'blog/success.html.twig',
                ['categories' => $categories]
            );
        } else {
            return $this->render(
                'blog/form.html.twig',
                ['form' => $form->createView()]
            );
        }
    }
}