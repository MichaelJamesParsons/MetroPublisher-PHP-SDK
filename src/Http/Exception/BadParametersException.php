<?php

namespace MetroPublisher\Http\Exception;

use Exception;

/**
 * Class BadParametersException
 * @package MetroPublisher\Exception
 */
class BadParametersException extends ApiException
{
    /** @var  array */
    private $errors;

    public function __construct($message, array $errors, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}