<?php

namespace App\Exceptions;


use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class BusinessException extends \Exception
{

    public function __construct(string $message = "Business error", int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public static function throw(string $message = "Business error", int $code = 500)
    {
        throw new self($message, $code);
    }


}
