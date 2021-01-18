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
namespace Gdshenrun\SimpleJwt\Encoders;

use Gdshenrun\SimpleJwt\Interfaces\Encoder;

class Base64UrlSafeEncoder implements Encoder
{
    public function encode(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    public function decode(string $string): string
    {
        return base64_decode(strtr($string, '-_', '+/'));
    }
}
