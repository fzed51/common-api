<?php

namespace CommonApi\Validator;

use Repository\ValidatorInterface;
use Respect\Validation\Validator as V;

abstract class Validator implements ValidatorInterface
{

    /**
     * Validateur local
     * @var V
     */
    protected $validator;

    public function __invoke(array $data)
    {
        $validator = $this->validator;
        $validator($data);
    }

    /**
     * Test
     * @param array $data
     * @return boolean
     */
    public function test(array $data) : bool
    {
        return false;
    }

    /**
     * Liste des erreurs
     * @param array $data
     * @return array
     */
    public function getError(array $data) : array
    {
        return [];
    }
}
