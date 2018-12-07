<?php

namespace App\Form;

use App\Entity\Objednavka;
use App\Entity\Doprava;
use App\Entity\Platba;
use App\Entity\Zeme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjednavkaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jmeno')
            ->add('email')
            ->add('telefon')
            ->add('ulice')
            ->add('mesto')
            ->add('psc')
            ->add('zeme', EntityType::class, [
    'class' => Zeme::class, 
    'choice_label' => 'zemeDoruceni'
  ])
         
            ->add('doprava', EntityType::class, [
    'class' => Doprava::class, 
    'choice_label' => 'typDopravy'
  ])
            ->add('platba', EntityType::class, [
    'class' => Platba::class, 
    'choice_label' => 'typPlatby'
  ])
            ->add('poznamka')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objednavka::class,
        ]);
    }
}

