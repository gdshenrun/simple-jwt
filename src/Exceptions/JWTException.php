<?php

declare(strict_types=1);
/**
 * This file is part of gdshenrun/simple-jwt.
 *
 * @link     https://github.com/gdshenrun/simple-jwt
 * @document https://github.com/gdshenrun/simple-jwt/blob/master/README.md
 * @contact  appledady@foxmail.com
 * @license  https://github.com/gdshenrun/simple-jwt/blob/master/LICENSE
 */
namespace Gdshenrun\SimpleJwt\Exceptions;

use Exception;
use Gdshenrun\SimpleJwt\JWT;

class JWTException extends Exception
{
    /** @var JWT */
    protected $jwt;

    /**
     * @return static
     */
    public function setJwt(JWT $jwt)
    {
        $this->jwt = $jwt;

        return $this;
    }

    public function getJwt(): JWT
    {
        return $this->jwt;
    }
}
