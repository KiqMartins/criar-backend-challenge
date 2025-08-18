<?php

namespace App\Domain\Discount\Exceptions;

use Exception;

class DiscountInUseException extends Exception
{
    protected $code = 409;
    
    protected $message = 'Este desconto não pode ser excluído pois está sendo utilizado por uma ou mais campanhas.';
}