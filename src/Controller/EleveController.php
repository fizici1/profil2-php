<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use App\Repository\ResultatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eleve")
 */
class EleveController extends AbstractController
{
    /**
     * @Route("/", name="eleve_index", methods={"GET"})
     */
    public function index(EleveRepository $eleveRepository): Response
    {
        return $this->render('eleve/index.html.twig', [
            'current_menu' => 'eleves',
            'eleves' => $eleveRepository->findBy(
              [],
              ['login' => 'ASC']
            ),
        ]);
    }

    /**
     * @Route("/new", name="eleve_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eleve = new Eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eleve);
            $entityManager->flush();

            return $this->redirectToRoute('eleve_index');
        }

        return $this->render('eleve/new.html.twig', [
            'current_menu' => 'eleves',
            'eleve' => $eleve,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eleve_show", methods={"GET"})
     */
    public function show(Eleve $eleve, ResultatRepository $repository,  Request $request): Response
    {
        $result = $repository->findBy(
          ['eleve' => $eleve->getId()]
        );
        dump($result);
        return $this->render('eleve/show.html.twig', [
            'current_menu' => 'eleves',
            'eleve' => $eleve,
            'results' => $result,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="eleve_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Eleve $eleve): Response
    {
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eleve_index', [
                'id' => $eleve->getId(),
            ]);
        }

        return $this->render('eleve/edit.html.twig', [
            'current_menu' => 'eleves',
            'eleve' => $eleve,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eleve_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Eleve $eleve): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eleve->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eleve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('eleve_index');
    }
}
