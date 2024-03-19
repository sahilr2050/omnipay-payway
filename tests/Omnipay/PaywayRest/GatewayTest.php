<?php

namespace Omnipay\PaywayRest\Tests;

use Omnipay\PaywayRest\Gateway;
use Omnipay\PaywayRest\Message\BankAccountListRequest;
use Omnipay\PaywayRest\Message\CheckNetworkRequest;
use Omnipay\PaywayRest\Message\CreateCustomerRequest;
use Omnipay\PaywayRest\Message\CreateSingleUseBankTokenRequest;
use Omnipay\PaywayRest\Message\CreateSingleUseCardTokenRequest;
use Omnipay\PaywayRest\Message\CustomerDetailRequest;
use Omnipay\PaywayRest\Message\MerchantListRequest;
use Omnipay\PaywayRest\Message\PurchaseRequest;
use Omnipay\PaywayRest\Message\RegularPaymentRequest;
use Omnipay\PaywayRest\Message\TransactionDetailRequest;
use Omnipay\PaywayRest\Message\UpdateCustomerContactRequest;
use Omnipay\Tests\TestCase;

class GatewayTest extends TestCase
{
    private Gateway $gateway;

    public function setUp(): void
    {
        parent::setUp(); // Call the parent setUp if the base test class has its own setup.
        $this->gateway = new Gateway();
    }

    public function testGetName()
    {
        $this->assertEquals('Westpac PayWay Credit Card', $this->gateway->getName());
    }

    public function testGetDefaultParameters()
    {
        $defaultParameters = $this->gateway->getDefaultParameters();
        $this->assertArrayHasKey('apiKeyPublic', $defaultParameters);
        $this->assertArrayHasKey('apiKeySecret', $defaultParameters);
        $this->assertArrayHasKey('merchantId', $defaultParameters);
        $this->assertArrayHasKey('useSecretKey', $defaultParameters);
    }

    public function testSetGetApiKeyPublic()
    {
        $apiKeyPublic = 'test_public_key';
        $this->gateway->setApiKeyPublic($apiKeyPublic);
        $this->assertEquals($apiKeyPublic, $this->gateway->getApiKeyPublic());
    }

    public function testSetGetApiKeySecret()
    {
        $apiKeySecret = 'test_secret_key';
        $this->gateway->setApiKeySecret($apiKeySecret);
        $this->assertEquals($apiKeySecret, $this->gateway->getApiKeySecret());
    }

    public function testSetGetMerchantId()
    {
        $merchantId = 'test_merchant_id';
        $this->gateway->setMerchantId($merchantId);
        $this->assertEquals($merchantId, $this->gateway->getMerchantId());
    }

    public function testSetGetSSLCertificatePath()
    {
        $sslCertificatePath = '/path/to/certificate';
        $this->gateway->setSSLCertificatePath($sslCertificatePath);
        $this->assertEquals($sslCertificatePath, $this->gateway->getSSLCertificatePath());
    }

    public function testTestGateway()
    {
        $request = $this->gateway->testGateway();
        $this->assertInstanceOf(CheckNetworkRequest::class, $request);
    }

    public function testPurchaseOnce()
    {
        $request = $this->gateway->purchase(['frequency' => 'once']);
        $this->assertInstanceOf(PurchaseRequest::class, $request);
    }

    public function testPurchaseRegular()
    {
        $request = $this->gateway->purchase(['frequency' => 'monthly']);
        $this->assertInstanceOf(RegularPaymentRequest::class, $request);
    }

    public function testCreateSingleUseCardToken()
    {
        $request = $this->gateway->createSingleUseCardToken();
        $this->assertInstanceOf(CreateSingleUseCardTokenRequest::class, $request);
    }

    public function testCreateSingleUseBankToken()
    {
        $request = $this->gateway->createSingleUseBankToken();
        $this->assertInstanceOf(CreateSingleUseBankTokenRequest::class, $request);
    }

    public function testCreateCustomer()
    {
        $request = $this->gateway->createCustomer();
        $this->assertInstanceOf(CreateCustomerRequest::class, $request);
    }

    public function testUpdateCustomerContact()
    {
        $request = $this->gateway->updateCustomerContact();
        $this->assertInstanceOf(UpdateCustomerContactRequest::class, $request);
    }

    public function testGetCustomerDetails()
    {
        $request = $this->gateway->getCustomerDetails();
        $this->assertInstanceOf(CustomerDetailRequest::class, $request);
    }

    public function testGetTransactionDetails()
    {
        $request = $this->gateway->getTransactionDetails();
        $this->assertInstanceOf(TransactionDetailRequest::class, $request);
    }

    public function testGetMerchants()
    {
        $request = $this->gateway->getMerchants();
        $this->assertInstanceOf(MerchantListRequest::class, $request);
    }

    public function testGetBankAccounts()
    {
        $request = $this->gateway->getBankAccounts();
        $this->assertInstanceOf(BankAccountListRequest::class, $request);
    }
}
