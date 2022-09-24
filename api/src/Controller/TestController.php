<?php

namespace Api\Controller;

use Api\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('add')]
    public function add(EntityManagerInterface $entityManager)
    {
        $entityManager->persist(
            (new Book)->setName('aa')->setDescription('dd')
        );
        $entityManager->flush();
    }
}