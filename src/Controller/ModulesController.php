<?php

namespace App\Controller;

use App\Entity\Modules;
use App\Entity\Mesures;
use App\Entity\Vitesses;
use App\Form\ModulesType;
use App\Repository\ModulesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MesuresRepository;

#[Route('/modules')]
class ModulesController extends AbstractController
{
    #[Route('/', name: 'app_modules_index', methods: ['GET'])]
    public function index(ModulesRepository $modulesRepository): Response
    {


        return $this->render('modules/index.html.twig', [
            'modules' => $modulesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_modules_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModulesRepository $modulesRepository): Response
    {
        $module = new Modules();
        $form = $this->createForm(ModulesType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modulesRepository->save($module, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('modules/new.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modules_show', methods: ['GET'])]
    public function show(Modules $module, MesuresRepository $mesuresRepository): Response
    {

        $vitessesQuery = $mesuresRepository->findByTypeAndModule('vitesse', $module->getId());
        $tempraturesQuery = $mesuresRepository->findByTypeAndModule('temprature', $module->getId());
        $consommationsQuery = $mesuresRepository->findByTypeAndModule('consommation', $module->getId());

        $vitesses = [];
        $tempratures = [];
        $consommations = [];

        foreach ($vitessesQuery as $vitesse) {
            $vitesses[] = $vitesse->getVitesse()->getValeur();
        }
        foreach ($tempraturesQuery as $temprature) {
            $tempratures[] = $temprature->getTemprature()->getValeur();
        }
        foreach ($consommationsQuery as $consommation) {
            $consommations[] = $consommation->getConsommation()->getValeur();
        }

        return $this->render('modules/show.html.twig', [
            'module' => $module,
            'vitesses' => $vitesses,
            'tempratures' => $tempratures,
            'consommations' => $consommations,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_modules_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Modules $module, ModulesRepository $modulesRepository): Response
    {
        $form = $this->createForm(ModulesType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modulesRepository->save($module, true);

            return $this->redirectToRoute('app_modules_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modules/edit.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modules_delete', methods: ['POST'])]
    public function delete(Request $request, Modules $module, ModulesRepository $modulesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$module->getId(), $request->request->get('_token'))) {
            $modulesRepository->remove($module, true);
        }

        return $this->redirectToRoute('app_modules_index', [], Response::HTTP_SEE_OTHER);
    }
}
