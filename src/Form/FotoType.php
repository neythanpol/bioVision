<?php

namespace App\Form;

use App\Entity\Ave;
use App\Entity\Foto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class FotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ave', EntityType::class, [
                'class' => Ave::class,
                'choice_label' => 'nombreComun',
                'placeholder' => 'Selecciona un ave',
                'label' => 'Ave fotografiada',
                'attr' => ['class' => 'form-select']
            ])
            ->add('archivo', VichImageType::class, [
                'label' => 'Foto del ave',
                'required' => true,
                'allow_delete' => false,
                'download_uri' => false,
                'image_uri' => true,
                'constraints' => [
                    new Image([
                        'maxSize' => '5M',
                        'maxSizeMessage' => 'El archivo es demasiado grande ({{ size }} {{ suffix }}). Tamaño máximo permitido: {{ limit }} {{suffix }}.',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Por favor, sube una imagen válida (JPEG, PNG o WEBP).'
                    ]),
                    new File([
                        'maxSize' => '5M'
                    ])
                ],
                'attr' => [
                    'accept' => 'image/*',
                    'class' => 'image-upload'
                ]
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción (opcional)',
                'required' => false,
                'attr' => [
                    'rows' => 3,
                    'placeholder' => 'Describe dónde y cuándo viste al ave...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Foto::class,
        ]);
    }
}