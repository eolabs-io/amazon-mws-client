<?php

namespace EolabsIo\AmazonMwsClient\Tests;

use EolabsIo\AmazonMwsClient\Facades\UrlSigner;
use EolabsIo\AmazonMwsClient\Support\UrlSignerException;
use EolabsIo\AmazonMwsClient\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class UrlSignerTest extends TestCase
{
	/** @var array */
	private $options = [];

	/** @var string */
    private $secret = '';

	/** @var array */
    private $parameters = [];


    public function setUp(): void
    {
        parent::setUp();

    	$this->options = ['url' => 'https://mws.amazonservices.com/endpoint/version'];
    	$this->secret = 'testSECRET';
    	$this->parameters = ['SignatureMethod' => 'HmacSHA256'];
    }

	/** @test */
	public function it_throws_exception_when_missing_signature_method()
	{
		$this->expectException(UrlSignerException::class);

    	$this->parameters = [];
    	$parameters = UrlSigner::with($this->options)->signParameters($this->secret, $this->parameters);
	}	

   /** @test */
    public function it_can_sign_parameters()
    {
    	$expectedSignature = 'um4NTkon8DGlNl70OHvNMnvzPbck+p+wMbFwx2/uXgU=';
    	$parameters = UrlSigner::with($this->options)->signParameters($this->secret, $this->parameters);

        $this->assertArrayHasKey('Signature', $parameters);
        $this->assertEquals($expectedSignature, $parameters['Signature']);
    }
    
}