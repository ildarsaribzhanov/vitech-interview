<?php


namespace App\Forms\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CreateOrderItemType
 *
 * @package App\Forms\Type
 */
class CreateOrderItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('count', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ]);
    }
}