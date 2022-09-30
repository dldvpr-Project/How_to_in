<?php

namespace App\Form;

use App\Entity\Definition;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre",
                'required' => "Le titre est obligatoire",
                'constraints' => [
                    new NotBlank(['message' => "Ce champ est obligatoire."]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le champs doit comporter au maximum {{ limit }} caractères.'
                    ])
                ]
            ])
            ->add('body', TextType::class, [
                'label' => "Description...",
                'required' => "La description est obligatoire.",
                'constraints' => [
                    new NotBlank(['message' => "Ce champs est obligatoire"]),
                ]
            ])
            ->add('language', ChoiceType::class, [
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Definition::class,
        ]);
    }
}
