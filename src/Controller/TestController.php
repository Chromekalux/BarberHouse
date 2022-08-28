<?php

namespace App\Controller;

use App\Entity\Salon;
use App\Entity\User;
use App\Entity\SalonAgenda;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = new User;
        $salon = new Salon;
        $user->setManagedSalon($salon);
        $agenda = new SalonAgenda;
        $salon->setAgenda($agenda);

        dd($salon);
    }
}
