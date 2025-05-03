<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Yiisoft\Validator\Rule\Email;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Required;
use App\Application\Utils\RequestValidator;

class ContactValidatorMiddleware extends RequestValidator
{
    public function getRules(): iterable
    {
        return [
            'name' => [
                new Required(),
                new Length(null, 3, 120)
            ],
            'email' => [
                new Required(),
                new Email()
            ],
            'comment' => [
                new Required(),
                new Length(null, 3, 120)
            ],
        ];
    }
}
