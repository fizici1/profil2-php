<?php

namespace App\Form;

use App\Entity\Evaluation;
use App\Entity\Competence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('date')
            ->add('competences' , EntityType::class, [
              'class' => Competence::class,
              'choice_label' => 'title',
              'multiple' => true,
              'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
