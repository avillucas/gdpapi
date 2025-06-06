<?php
declare(strict_types=1);

namespace App\Application\Utils;

use Yiisoft\Validator\Result;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Message\ServerRequestInterface;

class ValidatorException extends HttpBadRequestException
{

    /**
     * @var int
     */
    protected $code = 422;

    /**
     * @var string
     */
    protected $message = 'Unprocessable entity';

    protected string $title = '422 Unprocessable entity';
    protected string $description = 'The server cannot or will not process ' .
        'the request due to an apparent client error.';

    public function __construct(ServerRequestInterface $request, string|null $message = null, \Throwable|null $previous = null)
    {
        parent::__construct($request, $message, $previous);
    }

    public static function fromResult(ServerRequestInterface $request, Result $result): ValidatorException
    {
        $messageArray = $result->getErrorMessages();
        $message = implode(',', $messageArray);
        return new ValidatorException($request, $message);
    }
}
