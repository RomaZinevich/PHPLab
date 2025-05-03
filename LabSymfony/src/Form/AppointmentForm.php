<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Doctor;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('appointmentTime')
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
                'choice_label' => 'id',
            ])
            ->add('doctor', EntityType::class, [
                'class' => Doctor::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
