<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class, [
                'label' => 'Título del artículo',
                'attr' => ['class' => 'form-control']
            ])
            ->add('slug', TextType::class, [
                'label' => 'URL del artículo',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('contenido', TextareaType::class, [
                'label' => 'Contenido',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 15
                ]
            ])
            ->add('imagenFile', VichImageType::class, [
                'label' => ' ',
                'required' => false,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
                'imagine_pattern' => 'article_thumb',
                'attr' => ['accept' => 'image/*']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}