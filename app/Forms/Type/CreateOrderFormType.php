<?php

namespace App\Forms\Type;


use App\Dto\OrderItmDto;
use App\Forms\Dto\CreateOrderFormDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CreateOrderFormType
 *
 * @package App\Forms\Type
 */
class CreateOrderFormType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('products', CollectionType::class, [
                'allow_add'    => true,
                'allow_delete' => true,
                'entry_type'   => CreateOrderItemType::class,
            ])
            ->addModelTransformer(new CallbackTransformer(
                function ($dto) {
                    return $dto;
                },
                function (CreateOrderFormDto $dto) {
                    $products = [];

                    foreach ($dto->products as $item) {
                        $products[] = new OrderItmDto($item['id'], $item['count']);
                    }

                    $dto->products = $products;

                    return $dto;
                }
            ));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateOrderFormDto::class,
        ]);
    }
}