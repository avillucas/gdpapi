<?php

namespace App\Infrastructure\Service;

use App\Application\Settings\SettingsInterface;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Container\ContainerInterface;

class JWTService implements JWTServiceInterface
{

    /** @var string $jwt_secret */
    protected $jwt_secret;

    public function __construct(ContainerInterface $c)
    {
        $settings = $c->get(SettingsInterface::class);
        $jwtSetting = $settings->get('jwt');
        if (empty($jwtSetting['secret'])) {
            throw new Exception('The secret is not set ');
        }
        $this->jwt_secret = $jwtSetting['secret'];
    }

    /**
     * Retrieve  a token
     *
     * @return string
     */
    public function getToken(): string
    {
        $expire = (new DateTime("now"))->modify("+1 hour")->format("Y-m-d H:i:s");
        return  JWT::encode(["expired_at" => $expire], $this->jwt_secret);
    }


    /**
     * Retrieve  a token decoded or fail 
     *
     * @throws Exception
     * @param string $token;
     */
    public function decodeToken($token) 
    {
        $key = new Key($this->jwt_secret, "HS256");
        $payload = JWT::decode($token, $key);
        $now = (new DateTime('now'))->format("Y-m-d H:i:s");
        if ($payload->expired_at < $now) {
            throw new Exception("Token Expirado!", 401);
        }
        return $payload;
    }
}
