<?php

namespace EolabsIo\AmazonMwsClient\Support;

use GuzzleHttp\Psr7\Query;
use EolabsIo\AmazonMwsClient\Support\UrlSignerException;

class UrlSigner
{

    /** @var array */
    private $parameters;

    /** @var string */
    private $url;

    /** @var string */
    private $method = 'POST';


    public function with(array $options = [])
    {
        $this->method = data_get($options, 'method', $this->method);
        $this->url = data_get($options, 'url', $this->url);

        return $this;
    }

    public function signParameters(string $secret, array $parameters = []): array
    {
        $signature = $this->setParameters($parameters)
                          ->signRequest($secret);

        return array_merge($parameters, ['Signature' => $signature]);
    }

    private function signRequest(string $secret): string
    {
        $key = $secret;
        $algorithm = $this->getAlgorithm();
        $stringToSign = $this->getStringToSign();

        return $this->sign($stringToSign, $key, $algorithm);
    }

    private function getAlgorithm(): string
    {
        $signatureMethod = data_get($this->getParameters(), 'SignatureMethod', null);
        throw_if(
            ! filled($signatureMethod),
            UrlSignerException::class,
            'Parameters must have a SignatureMethod key and value'
        );

        return $signatureMethod;
    }

    private function getStringToSign() : string
    {
        $method = $this->getMethod();
        $host = $this->getHost();
        $path = $this->getPath();
        $parameters = $this->getSortedParameterString();

        return "{$method}\n{$host}\n{$path}\n{$parameters}";
    }

    private function getSortedParameterString() : string
    {
        $parameters = $this->getParameters();
        uksort($parameters, 'strcmp');

        return Query::build($parameters);
    }

    private function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    private function getParameters() : array
    {
        return $this->parameters;
    }

    /**
     * Runs the hash, copied from Amazon
     * @param string $data
     * @param string $key
     * @param string $algorithm 'HmacSHA1' or 'HmacSHA256'
     * @return string
     * @throws Exception
     */
    private function sign($data, $key, $algorithm) : string
    {
        $hash = 'sha256';

        if ($algorithm === 'HmacSHA1') {
            $hash = 'sha1';
        }

        return base64_encode(
            hash_hmac($hash, $data, $key, true)
        );
    }

    private function getMethod(): string
    {
        return $this->method;
    }

    private function getHost(): string
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

    private function getPath(): string
    {
        return parse_url($this->url, PHP_URL_PATH);
    }
}
