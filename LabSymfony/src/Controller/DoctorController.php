<?php
namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Patient;
use App\Form\DoctorForm;
use App\Repository\DoctorRepository;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/doctor')]
final class DoctorController extends AbstractController
{
    #[Route(name: 'app_doctor_index', methods: ['GET'])]
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_doctor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorForm::class, $doctor);
        $form->handleRequest($request);

        $patients = $patientRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($doctor);
            $entityManager->flush();

            $selectedPatientIds = $request->request->get('patients');

            if ($selectedPatientIds) {
                foreach ($selectedPatientIds as $patientId) {
                    $patient = $patientRepository->find($patientId);
                    if ($patient) {
                        $doctor->addPatient($patient);
                        $entityManager->flush();
                    }
                }
            }

            return $this->redirectToRoute('app_doctor_index');
        }

        return $this->render('doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
            'patients' => $patients,
        ]);
    }

    #[Route('/{id}', name: 'app_doctor_show', methods: ['GET'])]
    public function show(Doctor $doctor): Response
    {
        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_doctor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Doctor $doctor, EntityManagerInterface $entityManager, PatientRepository $patientRepository): Response
    {
        $form = $this->createForm(DoctorForm::class, $doctor);
        $form->handleRequest($request);

        $patients = $patientRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $selectedPatientIds = $request->request->get('patients');

            if ($selectedPatientIds) {
                foreach ($selectedPatientIds as $patientId) {
                    $patient = $patientRepository->find($patientId);
                    if ($patient) {
                        $doctor->addPatient($patient);
                        $entityManager->flush();
                    }
                }
            }

            return $this->redirectToRoute('app_doctor_index');
        }

        return $this->render('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
            'patients' => $patients,
        ]);
    }

    #[Route('/{id}', name: 'app_doctor_delete', methods: ['POST'])]
    public function delete(Request $request, Doctor $doctor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($doctor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_doctor_index');
    }
}



