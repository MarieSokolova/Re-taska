<?php

namespace App\Form;

use App\Entity\Objednavka;
use App\Entity\StavObjednavky;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StavObjednavkyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('stav', EntityType::class, [
    'class' => StavObjednavky::class, 
    'choice_label' => 'stav'
  ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StavObjednavky::class,
        ]);
    }
}
