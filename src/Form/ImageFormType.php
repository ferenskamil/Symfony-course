<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// do użycia w walidacji
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\mimeTypeMessage;

class ImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('path') // do usunięcia

            // Przycisk do uploadowania obrazka
            ->add('imageFile' , FileType::class , [
                'mapped' => false, // to musi być ustawiona na false, jeżeli to pole nie jest obecne w Entity (a nie jest)

                // walidacja dla tego pola
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file: png, jpeg, gif, svg'
                    ])
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}