<?php

namespace App\Controller;

use App\Entity\Diagnosis;
use App\Form\DiagnosisForm;
use App\Repository\DiagnosisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/diagnosis')]
final class DiagnosisController extends AbstractController
{
    #[Route(name: 'app_diagnosis_index', methods: ['GET'])]
    public function index(Request $request, DiagnosisRepository $diagnosisRepository, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $diagnosisRepository->createQueryBuilder('p');

        $description = $request->query->get('description');
        if ($description) {
            $queryBuilder->andWhere('d.description LIKE :description')
                ->setParameter('description', '%' . $description . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            $request->query->getInt('itemsPerPage', 10)
        );

        return $this->render('diagnosis/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_diagnosis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $diagnosi = new Diagnosis();
        $form = $this->createForm(DiagnosisForm::class, $diagnosi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($diagnosi);
            $entityManager->flush();

            return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('diagnosis/new.html.twig', [
            'diagnosi' => $diagnosi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diagnosis_show', methods: ['GET'])]
    public function show(Diagnosis $diagnosi): Response
    {
        return $this->render('diagnosis/show.html.twig', [
            'diagnosi' => $diagnosi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_diagnosis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Diagnosis $diagnosi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DiagnosisForm::class, $diagnosi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('diagnosis/edit.html.twig', [
            'diagnosi' => $diagnosi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_diagnosis_delete', methods: ['POST'])]
    public function delete(Request $request, Diagnosis $diagnosi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diagnosi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($diagnosi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_diagnosis_index', [], Response::HTTP_SEE_OTHER);
    }
}
