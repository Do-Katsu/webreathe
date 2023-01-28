<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Modules;
use App\Repository\ModulesRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ModulesRepository $modulesRepository): Response
    {
        $modules = $modulesRepository->findAll();
        $moduleCount = count($modules);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'modules' => $modules,
            'count' => $moduleCount,
        ]);
    }
}
