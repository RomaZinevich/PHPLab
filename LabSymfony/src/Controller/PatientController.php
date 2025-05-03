<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Doctor;
use App\Form\PatientForm;
use App\Repository\PatientRepository;
use App\Repository\DoctorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/patient')]
final class PatientController extends AbstractController
{
    #[Route(name: 'app_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_patient_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, DoctorRepository $doctorRepository): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientForm::class, $patient);
        $form->handleRequest($request);

        $doctors = $doctorRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($patient);
            $entityManager->flush();

            $selectedDoctorIds = $request->request->get('doctors');

            if ($selectedDoctorIds) {
                foreach ($selectedDoctorIds as $doctorId) {
                    $doctor = $doctorRepository->find($doctorId);
                    if ($doctor) {
                        $patient->addDoctor($doctor);
                        $entityManager->flush();
                    }
                }
            }

            return $this->redirectToRoute('app_patient_index');
        }

        return $this->render('patient/new.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
            'doctors' => $doctors,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_show', methods: ['GET'])]
    public function show(Patient $patient): Response
    {
        return $this->render('patient/show.html.twig', [
            'patient' => $patient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_patient_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Patient $patient, EntityManagerInterface $entityManager, DoctorRepository $doctorRepository): Response
    {
        $form = $this->createForm(PatientForm::class, $patient);
        $form->handleRequest($request);

        $doctors = $doctorRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $selectedDoctorIds = $request->request->get('doctors');

            if ($selectedDoctorIds) {
                foreach ($selectedDoctorIds as $doctorId) {
                    $doctor = $doctorRepository->find($doctorId);
                    if ($doctor) {
                        $patient->addDoctor($doctor);
                        $entityManager->flush();
                    }
                }
            }

            return $this->redirectToRoute('app_patient_index');
        }

        return $this->render('patient/edit.html.twig', [
            'patient' => $patient,
            'form' => $form->createView(),
            'doctors' => $doctors,
        ]);
    }

    #[Route('/{id}', name: 'app_patient_delete', methods: ['POST'])]
    public function delete(Request $request, Patient $patient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$patient->getId(), $request->request->get('_token'))) {
            $entityManager->remove($patient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_patient_index');
    }
}
