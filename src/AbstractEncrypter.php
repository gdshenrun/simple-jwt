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
namespace Gdshenrun\SimpleJwt;

use Gdshenrun\SimpleJwt\Interfaces\Encrypter;

abstract class AbstractEncrypter implements Encrypter
{
    /** @var string */
    protected $secret;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function check(string $signatureString, string $signature): bool
    {
        return $this->signature($signatureString) === $signature;
    }
}
