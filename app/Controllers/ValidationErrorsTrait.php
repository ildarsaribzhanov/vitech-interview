<?php

namespace App\Controllers;


use Symfony\Component\Form\FormInterface;

/**
 * Trait ValidationErrorsTrait
 *
 * @package App\Controllers
 */
trait ValidationErrorsTrait
{
    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return mixed
     */
    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = [];

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = self::getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        return $errors;
    }
}