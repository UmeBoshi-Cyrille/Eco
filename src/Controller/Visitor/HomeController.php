<?php

namespace App\Controller\Visitor;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'EcoIT' => 'EcoIt',
        ]);
    }

    #[Route('/home/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('base/contact.html.twig', [
            'contact' => 'Contact',
        ]);
    }

    #[Route('/home/formations', name: 'formations')]
    public function formation(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findAll();

        return $this->render('base/formations.html.twig', [
            'formations' => $formations
        ]);
    }
}
