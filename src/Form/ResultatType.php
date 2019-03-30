<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Resultat;
use App\Entity\Evaluation;
use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ResultatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note')
            ->add('eval', EntityType::class, [
              'class' => Evaluation::class,
              'choice_label' => 'title',
            ])
            ->add('eleve', EntityType::class, [
              'class' => Eleve::class,
              'choice_label' => 'login',
            ])
            ->add('competence', EntityType::class, [
              'class' => Competence::class,
              'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resultat::class,
        ]);
    }
}
