<?php


namespace CommonApi\Exception;

use Exception;

class ValidatorException extends Exception
{
    /**
     * Detail
     * @var array
     **/
    private $detail;

    public function getDetail(): array
    {
        return $this->detail;
    }

    public function setDetail(array $detail): self
    {
        $this->detail = $detail;
        return $this;
    }
}
