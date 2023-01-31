<?php

namespace App\Controller;

use App\Entity\Modules;
use App\Form\ModulesType;
use App\Repository\ModulesRepository;
use App\Repository\UptimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MesuresRepository;

/**
 * This is a classic CRUD controller
 * I did some modifications on the Index function and the Show function
 * Didn't touch the other ones since they're working as intended
 */
#[Route('/modules')]
class ModulesController extends AbstractController
{
    #[Route('/', name: 'app_modules_index', methods: ['GET'])]
    public function index(ModulesRepository $modulesRepository, UptimeRepository $uptimeRepository): Response
    {
        $modules = $modulesRepository->findAll();
        $activity = [];

        /*
        this is a function that takes from the Entity "Uptime" and returns the a table with all the most recent status
        it returns a 1 if it's an active status, 2 if it's inactive, and 0 in all other cases.
        */
        foreach ($modules as $module) {
            $uptimes = $module->getDurationSignal()->toArray();
            usort($uptimes, function ($a, $b) {
                return $a->getDateValue() > $b->getDateValue();
            });
            
            if (!empty($uptimes)) {
                $uptime = end($uptimes)->isActive();
                if ($uptime === true) {
                    $activity[] = 1;
                }
                elseif ($uptime === false) {
                    $activity[] = 2;
                }
            } else {
                $activity[] = 0;
            }
        }

        return $this->render('modules/index.html.twig', [
            'modules' => $modules,
            'activity' => $activity,
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
        /**
         * this part is about taking the different measurements and sending them to the template
         * in order to use them in charts
         */
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
