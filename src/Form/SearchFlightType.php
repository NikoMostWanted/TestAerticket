<?php
declare(strict_types=1);

namespace App\Form;

use App\Core\Traits\Aware\TEntityManagerAware;
use App\Entity\AirTransport\Airport;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
    use TEntityManagerAware;

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
                ->add('departureDate', DateTimeType::class, [
                    'format' => 'yyyy-MM-dd',
                    'widget' => 'single_text',
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
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $this->isExistAirport('departureAirport', $event);
                $this->isExistAirport('arrivalAirport', $event);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
        ]);
    }

    /**
     * @param string $fieldName
     * @param FormEvent $event
     */
    public function isExistAirport(string $fieldName, FormEvent $event): void
    {
        $value = $event->getData()['filters'][$fieldName];
        $form = $event->getForm();
        $airportRepository = $this->getEm()->getRepository(Airport::class);

        if (!$airportRepository->findOneBy(['iata' => $value])) {
            $error = new FormError('Airport ' . $value . 'not exist in data-base');
            $form->get('filters')->get($fieldName)->addError($error);
        }
    }
}