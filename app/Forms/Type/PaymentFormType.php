<?php

namespace App\Forms\Type;


use App\Forms\Dto\PaymentFormDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Форма обработки запроса на оплату
 *
 * Class PaymentFormType
 *
 * @package App\Forms\Type
 */
class PaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cost', IntegerType::class, [
                'required'    => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 0])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PaymentFormDto::class,
        ]);
    }
}