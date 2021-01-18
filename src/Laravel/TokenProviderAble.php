<?php

declare(strict_types=1);
/**
 * This file is part of qbhy/simple-jwt.
 *
 * @link     https://github.com/qbhy/simple-jwt
 * @document https://github.com/qbhy/simple-jwt/blob/master/README.md
 * @contact  appledady@foxmail.com
 * @license  https://github.com/qbhy/simple-jwt/blob/master/LICENSE
 */
namespace Gdshenrun\SimpleJwt\Laravel;

use Illuminate\Database\Eloquent\Model;
use Gdshenrun\SimpleJwt\Exceptions\TokenProviderException;
use Gdshenrun\SimpleJwt\JWT;
use Gdshenrun\SimpleJwt\JWTManager;

/**
 * Trait TokenProviderAble.
 *
 * @mixin \Gdshenrun\SimpleJwt\Interfaces\TokenProviderInterface
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait TokenProviderAble
{
    /**
     * @throws TokenProviderException
     * @throws \Gdshenrun\SimpleJwt\Exceptions\InvalidTokenException
     * @throws \Gdshenrun\SimpleJwt\Exceptions\SignatureException
     * @throws \Gdshenrun\SimpleJwt\Exceptions\TokenExpiredException
     * @return Model|TokenProviderAble
     */
    public static function fromToken(string $token)
    {
        /** @var JWT $jwt */
        $jwt = static::jwtManager()->parse($token);

        static::checkJwt($jwt);

        return static::fromPayload($jwt->getPayload());
    }

    /**
     * @return string
     */
    public function getToken()
    {
        $jwtManager = static::jwtManager();

        return $jwtManager->make($this->buildPayload(), static::matchHeaders())->token();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    abstract public static function fromPayload(array $payload);

    /**
     * @throws TokenProviderException
     */
    protected static function checkJwt(JWT $jwt)
    {
        $headers = $jwt->getHeaders();
        foreach (static::matchHeaders() as $key => $header) {
            if (! isset($headers[$key]) || $headers[$key] !== $header) {
                throw new TokenProviderException('header invalid');
            }
        }

        $payload = $jwt->getPayload();

        $needPayloadsCount = count($needPayloads = static::needPayloads());
        $intersectCount = count(array_intersect($needPayloads, array_keys($payload)));

        if ($needPayloadsCount !== $intersectCount) {
            throw new TokenProviderException('payload invalid');
        }
    }

    /**
     * @return JWTManager
     */
    protected static function jwtManager()
    {
        return app(JWTManager::class);
    }

    abstract protected static function matchHeaders();

    abstract protected static function needPayloads();
}
