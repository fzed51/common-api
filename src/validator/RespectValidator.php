<?php

namespace CommonApi\Validator;

use Respect\Validation\Exceptions\NestedValidationException;
use CommonApi\Exception\ValidatorException;

abstract class RespectValidator implements ValidatorInterface
{

    /**
     * errors
     * @var null|string[]
     */
    private $errors;

    /**
     * Validateur local
     * @var \Respect\Validation\Validator
     */
    protected $validator;

    public function __invoke(array $data)
    {
        $this->errors = [];
        try {
            $this->validator->assert($data);
        } catch (NestedValidationException $exception) {
            $this->errors = $exception->getMessages();
            $localException = new ValidatorException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );
            $localException->setDetail($this->errors);
            throw $localException;
        }
    }

    /**
     * Test
     * @param array $data
     * @return boolean
     */
    public function test(array $data): bool
    {
        $this->errors = [];
        try {
            $this->validator->assert($data);
            return true;
        } catch (NestedValidationException $exception) {
            $this->errors = $exception->getMessages();
            return false;
        }
    }

    /**
     * Liste des erreurs
     * @param array $data
     * @return array
     */
    public function getError(array $data): array
    {
        if (null === $this->errors) {
            $this->errors = [];
            try {
                $this->validator->assert($data);
            } catch (NestedValidationException $exception) {
                $this->errors = $exception->getMessages();
            }
        }
        return $this->errors;
    }
}
