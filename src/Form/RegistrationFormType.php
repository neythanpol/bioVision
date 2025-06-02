<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nombre de usuario',
                'attr' => [
                    'placeholder' => 'Entre 4-20 caracteres (letras, números, _)',
                    'minlength' => 4,
                    'mexlength' => 20,
                    'pattern' => '[a-zA-Z0-9_]+'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, ingresa un nombre de usuario'])
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'tu@email.com',
                    'autocomplete' => 'email'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Por favor, ingresa un email']),
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Acepto los términos y condiciones',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes aceptar los términos y condiciones',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'options' => [
                    'attr' => ['autocomplete' => 'new-password'],
                ],
                'required' => true,
                'first_options' => [
                    'label' => 'Contraseña',
                    'attr' => [
                        'placeholder' => 'Mínimo 8 caracteres',
                        'minlength' => 8,
                    ],
                ],
                'second_options' => [
                    'label' => 'Repite la contraseña',
                    'attr' => [
                        'placeholder' => 'Repite tu contraseña',
                    ],
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, ingresa una contraseña',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                        'message' => 'La contraseña debe tener al menos una letra mayúscula, una minúscula y un número',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
