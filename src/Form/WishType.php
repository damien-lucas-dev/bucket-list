<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Wish;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Your idea :'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :'
            ])
            ->add('author', TextType::class, [
                'label' => 'Your name :'
            ])
            ->add('category', EntityType::class, [
                'label' => 'Category',
                // quelle est la classe à afficher ici ?
                'class' => Category::class,
                // quelle propriété utiliser pour les <options> dans la liste déroulante ?
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
