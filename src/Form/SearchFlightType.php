<?php
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class SearchType
 *
 * @package App\Form
 */
class SearchFlightType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add($builder->create('filters', FormType::class, [
                'by_reference' => false,
                'allow_extra_fields' => true
            ])
                ->add('departureDate', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ])
                ->add('departureAirport', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ])
                ->add('arrivalAirport', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                    ]
                ])
            )
            ->add($builder->create('order', FormType::class, [
                'by_reference' => false,
                'allow_extra_fields' => true,
            ])
                ->add('departureDateTime', TextType::class, [
                ])
            )
            ->add($builder->create('pagination', FormType::class, [
                'by_reference' => false,
                'allow_extra_fields' => true,
            ])
                ->add('page', TextType::class, [
                    'constraints' => [
                        new Length(['min' => 10])
                    ]
                ])
                ->add('limit', TextType::class, [
                    'constraints' => [
                    ]
                ])
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
        ]);
    }
}