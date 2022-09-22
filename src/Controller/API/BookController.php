<?php

namespace App\Controller\API;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractFOSRestController
{
    #[Post('')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $book = new Book;
        $form = $this->createForm(BookType::class, $book);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->handleView(View::create($form));
        }

        $em->persist($book);
        $em->flush();

        return $this->handleView(View::create([
            'message' => 'Successfully created book.'
        ], 201));
    }
}