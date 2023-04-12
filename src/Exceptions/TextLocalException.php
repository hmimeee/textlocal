<?php

namespace Hmimeee\TextLocal\Exceptions;

use Exception;

class TextLocalException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
