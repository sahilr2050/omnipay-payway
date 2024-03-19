<?php

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Tests\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AbstractRequestTest extends TestCase
{
    protected AbstractRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        // Assuming AbstractRequest can be instantiated directly or through a mock.
        // If AbstractRequest is abstract, you should mock it instead.
        $httpClient = $this->createMock(ClientInterface::class);
        $httpRequest = $this->createMock(Request::class);
        $this->request = $this->getMockForAbstractClass(AbstractRequest::class, [$httpClient, $httpRequest]);
    }

    public function testGetOrderNumber()
    {
        $this->request->setOrderNumber('123456');
        $this->assertEquals('123456', $this->request->getOrderNumber());
    }

    public function testSetSendEmailReceipts()
    {
        $this->request->setSendEmailReceipts(true);
        $this->assertTrue($this->request->getSendEmailReceipts());
    }

    public function testSetStreet2()
    {
        $street2 = 'Apt 101';
        $this->request->setStreet2($street2);
        $this->assertEquals($street2, $this->request->getStreet2());
    }

    public function testGetBankAccountNumber()
    {
        $bankAccountNumber = '123456789';
        $this->request->setBankAccountNumber($bankAccountNumber);
        $this->assertEquals($bankAccountNumber, $this->request->getBankAccountNumber());
    }

    public function testSetBankAccountNumber()
    {
        $bankAccountNumber = '987654321';
        $this->request->setBankAccountNumber($bankAccountNumber);
        $this->assertEquals($bankAccountNumber, $this->request->getBankAccountNumber());
    }

    public function testSetCustomerName()
    {
        $name = "John Doe";
        $this->request->setCustomerName($name);
        $this->assertEquals($name, $this->request->getCustomerName());
    }

    public function testGetApiKeySecret()
    {
        $apiKeySecret = "secret_key";
        $this->request->setApiKeySecret($apiKeySecret);
        $this->assertEquals($apiKeySecret, $this->request->getApiKeySecret());
    }

    public function testSetNextPaymentDate()
    {
        $date = "2023-01-01";
        $this->request->setNextPaymentDate($date);
        $this->assertEquals($date, $this->request->getNextPaymentDate());
    }

    public function testGetFinalPrincipalAmount()
    {
        $amount = 100.50;
        $this->request->setFinalPrincipalAmount($amount);
        $this->assertEquals($amount, $this->request->getFinalPrincipalAmount());
    }

    public function testGetStreet1()
    {
        $street1 = "123 Main St";
        $this->request->setStreet1($street1);
        $this->assertEquals($street1, $this->request->getStreet1());
    }

    public function testGetRequestHeaders()
    {
        $headers = ['Accept' => 'application/json'];
        $this->assertEquals($headers, $this->request->getRequestHeaders());
    }

    public function testSetApiKeyPublic()
    {
        $apiKeyPublic = "public_key";
        $this->request->setApiKeyPublic($apiKeyPublic);
        $this->assertEquals($apiKeyPublic, $this->request->getApiKeyPublic());
    }

    public function testGetHttpMethod()
    {
        $method = "GET";
        $this->assertEquals($method, $this->request->getHttpMethod());
    }

    public function testSetCurrency()
    {
        $currency = "usd";
        $this->request->setCurrency($currency);
        $this->assertEquals($currency, $this->request->getCurrency());
    }

    public function testGetCurrency()
    {
        $currency = "eur";
        $this->request->setCurrency($currency);
        $this->assertEquals($currency, $this->request->getCurrency());
    }

    public function testGetStreet2()
    {
        $street2 = "Suite 200";
        $this->request->setStreet2($street2);
        $this->assertEquals($street2, $this->request->getStreet2());
    }

    public function testGetMerchantId()
    {
        $merchantId = "merchant_12345";
        $this->request->setMerchantId($merchantId);
        $this->assertEquals($merchantId, $this->request->getMerchantId());
    }

    public function testGetUseSecretKey()
    {
        $useSecretKey = true;
        $this->request->setUseSecretKey($useSecretKey);
        $this->assertEquals($useSecretKey, $this->request->getUseSecretKey());
    }

    public function testSetCityName()
    {
        $cityName = "Springfield";
        $this->request->setCityName($cityName);
        $this->assertEquals($cityName, $this->request->getCityName());
    }

    public function testSetMerchantId()
    {
        $merchantId = "new_merchant_123";
        $this->request->setMerchantId($merchantId);
        $this->assertEquals($merchantId, $this->request->getMerchantId());
    }

    public function testSetBankAccountBsb()
    {
        $bsb = "123456";
        $this->request->setBankAccountBsb($bsb);
        $this->assertEquals($bsb, $this->request->getBankAccountBsb());
    }

    public function testSetFinalPrincipalAmount()
    {
        $finalPrincipalAmount = 200.00;
        $this->request->setFinalPrincipalAmount($finalPrincipalAmount);
        $this->assertEquals($finalPrincipalAmount, $this->request->getFinalPrincipalAmount());
    }

    public function testGetPostalCode()
    {
        $postalCode = "12345";
        $this->request->setPostalCode($postalCode);
        $this->assertEquals($postalCode, $this->request->getPostalCode());
    }

    public function testSetUseSecretKey()
    {
        $useSecretKey = false;
        $this->request->setUseSecretKey($useSecretKey);
        $this->assertEquals($useSecretKey, $this->request->getUseSecretKey());
    }

    public function testGetNumberOfPaymentsRemaining()
    {
        $numberOfPayments = 5;
        $this->request->setNumberOfPaymentsRemaining($numberOfPayments);
        $this->assertEquals($numberOfPayments, $this->request->getNumberOfPaymentsRemaining());
    }

    public function testGetSSLCertificatePath()
    {
        $sslCertificatePath = "/path/to/cert.pem";
        $this->request->setSSLCertificatePath($sslCertificatePath);
        $this->assertEquals($sslCertificatePath, $this->request->getSSLCertificatePath());
    }

    public function testSetOrderNumber()
    {
        $orderNumber = "ORD123456789";
        $this->request->setOrderNumber($orderNumber);
        $this->assertEquals($orderNumber, $this->request->getOrderNumber());
    }

    public function testSetPostalCode()
    {
        $postalCode = "54321";
        $this->request->setPostalCode($postalCode);
        $this->assertEquals($postalCode, $this->request->getPostalCode());
    }

    public function testSetBankAccountName()
    {
        $bankAccountName = "John Doe's Account";
        $this->request->setBankAccountName($bankAccountName);
        $this->assertEquals($bankAccountName, $this->request->getBankAccountName());
    }

    public function testSetFrequency()
    {
        $frequency = "weekly";
        $this->request->setFrequency($frequency);
        $this->assertEquals($frequency, $this->request->getFrequency());
    }

    public function testSetAmount()
    {
        $amount = 150.75;
        $this->request->setAmount($amount);
        $this->assertEquals($amount, $this->request->getAmount());
    }

    public function testSetEmailAddress()
    {
        $email = "test@example.com";
        $this->request->setEmailAddress($email);
        $this->assertEquals($email, $this->request->getEmailAddress());
    }
}
