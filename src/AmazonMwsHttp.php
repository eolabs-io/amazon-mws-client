<?php

namespace EolabsIo\AmazonMwsClient;

use EolabsIo\AmazonMwsClient\Facades\UrlSigner;
use EolabsIo\AmazonMwsClient\Models\Store;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AmazonMwsHttp
{

	/** @var EolabsIo\AmazonMwsClient\Models\Store */
	private $store;


    public function __construct()
    {

    }

    public function withStore(Store $store): self
    {
    	$this->setStore($store);

    	return $this;
    }

    private function setStore($store): self
    {
    	$this->store = $store;

    	return $this;
    }

    public function fetch(string $endpoint, array $parameters)
    {
		$url = $this->getFullyQualifiedUrl($endpoint);
		$signedParameters = $this->signParameters($url, $parameters);

    	return Http::asForm()->post($url, $signedParameters);
    }

    public function getFullyQualifiedUrl(string $endpoint): string
    {
    	$baseUri = $this->getBaseUri();
    	$endpoint = Str::start($endpoint, '/');
    	
    	return $baseUri . $endpoint; 
    }

    public function getBaseUri(): string
    {
    	return $this->store->amazon_service_url;
    }

    public function signParameters(string $url, array $parameters): array
    {
    	$options = ['url' => $url];
    	$secret = $this->getSecret();

    	return UrlSigner::with($options)->signParameters($secret, $parameters);
    }

    public function getSecret(): string
    {
    	return $this->store->secret_key;
    }
}