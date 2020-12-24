<?php

namespace App\Controllers;


use App\Exceptions\ValidateException;
use App\Forms\Dto\FormDtoInterface;
use Exception;
use Laminas\Diactoros\ServerRequest;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

/**
 * Trait FormBuilder
 *
 * @package App\Controllers
 */
trait FormBuilderTrait
{
    use ValidationErrorsTrait;

    /**
     * @param ServerRequest $request
     * @param string        $formType
     *
     * @return FormDtoInterface
     * @throws Exception
     */
    private function buildForm(ServerRequest $request, string $formType): FormDtoInterface
    {
        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

        $queryForm = $formFactory->createBuilder($formType)->getForm();
        $data      = json_decode($request->getBody()->getContents(), 1);
        $queryForm->submit($data);

        if (!$queryForm->isValid()) {
            throw (new ValidateException("Validation error"))->withAdditional($this->getErrorsFromForm($queryForm));
        }

        return $queryForm->getData();
    }
}