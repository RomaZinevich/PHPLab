<?php
namespace App\Form;

use App\Entity\Doctor;
use App\Entity\Patient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentFilterType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
$builder
->add('dateFrom', DateType::class, [
'widget' => 'single_text',
'required' => false,
'label' => 'Дата від',
])
->add('dateTo', DateType::class, [
'widget' => 'single_text',
'required' => false,
'label' => 'Дата до',
])
->add('patient', EntityType::class, [
'class' => Patient::class,
'choice_label' => 'id',
'required' => false,
])
->add('doctor', EntityType::class, [
'class' => Doctor::class,
'choice_label' => 'id',
'required' => false,
]);
}

public function configureOptions(OptionsResolver $resolver): void
{
$resolver->setDefaults([]);
}
}
