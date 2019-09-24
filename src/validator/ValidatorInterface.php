<?php

namespace CommonApi\Validator;

use Repository\ValidatorInterface as RepositoryValidatorInterface;
use Respect\Validation\Validator as V;

interface ValidatorInterface extends RepositoryValidatorInterface
{

    /**
     * __invoke
     * @param array $data
     * @return void
     * @throws \CommonApi\Exception\ValidatorException
     */
    public function __invoke(array $data);

    /**
     * Test
     * @param array $data
     * @return boolean
     */
    public function test(array $data): bool;

    /**
     * Liste des erreurs
     * @param array $data
     * @return array
     */
    public function getError(array $data): array;
}
