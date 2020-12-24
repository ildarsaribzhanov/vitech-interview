<?php

namespace App\Exceptions;


use Exception;

/**
 * Class ApiException
 *
 * @package App\Exceptions
 */
class ApiException extends Exception
{
    /** @var array */
    private array $additional = [];

    /**
     * @param array $data
     *
     * @return ApiException
     */
    public function withAdditional(array $data): self
    {
        $this->additional = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getAdditional(): array
    {
        return $this->additional;
    }
}