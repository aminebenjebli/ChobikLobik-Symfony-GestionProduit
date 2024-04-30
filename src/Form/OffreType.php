<?php

namespace App\Form;

use App\Entity\OffreResto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use App\Entity\Plat;
use App\Entity\Gerant;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\Mapping\Entity;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pourcentage', IntegerType::class, [
                'label' => 'Percentage',
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Start Date',
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'End Date',
            ])
            ->add('newPrice', HiddenType::class, [
                'mapped' => false,
                'attr' => ['class' => 'new-price-input']
            ])
            ->add('idPlat', EntityType::class, [
                'class' => Plat::class,
                'choice_label' => 'nom',
                'label' => 'Plat',
                'placeholder' => 'Select a Plat',
            ])
            ->add('idResto', EntityType::class, [
                'class' => Gerant::class,
                'choice_label' => 'name',
                'label' => 'Restaurant',
                'placeholder' => 'Select a Restaurant',
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreResto::class,
        ]);
    }
}
