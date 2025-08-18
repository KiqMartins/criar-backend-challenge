<?php

namespace App\Domain\Campaign\Exceptions;

use Exception;

class ActiveCampaignDeletionException extends Exception
{
    protected $code = 409;

    protected $message = 'Não é possível excluir uma campanha que está ativa. Por favor, desative-a primeiro.';
}