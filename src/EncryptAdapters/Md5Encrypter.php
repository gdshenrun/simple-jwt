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
namespace Gdshenrun\SimpleJwt\EncryptAdapters;

use Gdshenrun\SimpleJwt\AbstractEncrypter;

class Md5Encrypter extends AbstractEncrypter
{
    public function signature(string $signatureString): string
    {
        return hash('md5', $signatureString . $this->getSecret());
    }

    public static function alg(): string
    {
        return 'md5';
    }
}
