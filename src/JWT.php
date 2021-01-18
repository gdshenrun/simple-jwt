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

/**
 * User: gdshenrun
 * Date: 2018/5/28
 * Time: 下午12:06.
 */
class JWT
{
    /** @var array */
    protected $headers = [
        'typ' => 'jwt',
    ];

    /** @var array */
    protected $payload = [];

    /**
     * @var JWTManager
     */
    protected $manager;

    /**
     * JWT constructor.
     */
    public function __construct(JWTManager $manager, array $headers, array $payload)
    {
        $this->manager = $manager;
        $this->headers = array_merge($this->headers, $headers);
        $this->payload = $payload;
    }

    public function token(): string
    {
        $signatureString = $this->generateSignatureString();

        $signature = $this->manager->getEncoder()->encode(
            $this->manager->getEncrypter()->signature($signatureString)
        );

        return "{$signatureString}.{$signature}";
    }

    public function generateSignatureString(): string
    {
        $headersString = $this->manager->getEncoder()->encode(json_encode($this->headers));
        $payloadString = $this->manager->getEncoder()->encode(json_encode($this->payload));

        return "{$headersString}.{$payloadString}";
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
