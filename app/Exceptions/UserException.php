<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function render()
    {
        return response()->json([
            'message' => $this->getMessage(),
        ], 500);
    }
}
