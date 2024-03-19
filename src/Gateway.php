<?php

namespace Omnipay\PaywayRest;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\PaywayRest\Message\BankAccountListRequest;
use Omnipay\PaywayRest\Message\CheckNetworkRequest;
use Omnipay\PaywayRest\Message\CreateCustomerRequest;
use Omnipay\PaywayRest\Message\CreateSingleUseBankTokenRequest;
use Omnipay\PaywayRest\Message\CreateSingleUseCardTokenRequest;
use Omnipay\PaywayRest\Message\CustomerDetailRequest;
use Omnipay\PaywayRest\Message\MerchantListRequest;
use Omnipay\PaywayRest\Message\PurchaseRequest;
use Omnipay\PaywayRest\Message\TransactionDetailRequest;
use Omnipay\PaywayRest\Message\UpdateCustomerContactRequest;
use Omnipay\PaywayRest\Message\RegularPaymentRequest;

/**
 * PayWay Credit Card gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Westpac PayWay Credit Card';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKeyPublic' => '',
            'apiKeySecret' => '',
            'merchantId' => '',
            'useSecretKey' => false,
        );
    }

    /**
     * Get API publishable key
     * @return string
     */
    public function getApiKeyPublic()
    {
        return $this->getParameter('apiKeyPublic');
    }

    /**
     * Set API publishable key
     * @param string $value API publishable key
     */
    public function setApiKeyPublic($value)
    {
        return $this->setParameter('apiKeyPublic', $value);
    }

    /**
     * Get API secret key
     * @return string
     */
    public function getApiKeySecret()
    {
        return $this->getParameter('apiKeySecret');
    }

    /**
     * Set API secret key
     * @param string $value API secret key
     */
    public function setApiKeySecret($value)
    {
        return $this->setParameter('apiKeySecret', $value);
    }

    /**
     * Get Merchant
     * @return string Merchant ID
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set Merchant
     * @param string $value Merchant ID
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Set SSL Certificate Path
     * @param string $value SSL Certificate Path
     */
    public function setSSLCertificatePath($value)
    {
        return $this->setParameter('sslCertificatePath', $value);
    }

    /**
     * Get SSL Certificate Path
     * @return string SSL Certificate Path
     */
    public function getSSLCertificatePath()
    {
        return $this->getParameter('sslCertificatePath');
    }

    /**
     * Test the PayWay gateway
     * @param array $parameters Request parameters
     * @return AbstractRequest
     */
    public function testGateway(array $parameters = array())
    {
        return $this->createRequest(
            CheckNetworkRequest::class,
            $parameters
        );
    }

    /**
     * Purchase request
     *
     * @param array $options
     * @return AbstractRequest
     */
    public function purchase(array $options = array())
    {
        /** @todo create customer before payment if none supplied */

        // schedule regular payment
        if (isset($options['frequency']) && $options['frequency'] !== 'once') {
            return $this->createRequest(RegularPaymentRequest::class, $options);
        }

        // process once-off payment
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Create singleUseTokenId with a CreditCard
     *
     * @param array $parameters
     * @return AbstractRequest
     */
    public function createSingleUseCardToken(array $parameters = array())
    {
        return $this->createRequest(CreateSingleUseCardTokenRequest::class, $parameters);
    }

    /**
     * Create singleUseTokenId with a Bank Account
     *
     * @param array $parameters
     * @return AbstractRequest
     */
    public function createSingleUseBankToken(array $parameters = array())
    {
        return $this->createRequest(CreateSingleUseBankTokenRequest::class, $parameters);
    }

    /**
     * Create Customer
     *
     * @param array $parameters
     * @return AbstractRequest
     */
    public function createCustomer(array $parameters = array())
    {
        return $this->createRequest(CreateCustomerRequest::class, $parameters);
    }

    /**
     * Update Customer contact details
     *
     * @param array $parameters
     * @return AbstractRequest
     */
    public function updateCustomerContact(array $parameters = array())
    {
        return $this->createRequest(UpdateCustomerContactRequest::class, $parameters);
    }

    /**
     * Get Customer details
     * @param array $parameters
     * @return AbstractRequest
     */
    public function getCustomerDetails(array $parameters = array())
    {
        return $this->createRequest(CustomerDetailRequest::class, $parameters);

    }

    /**
     * Get Transaction details
     * @param array $parameters
     * @return AbstractRequest
     */
    public function getTransactionDetails(array $parameters = array())
    {
        return $this->createRequest(TransactionDetailRequest::class, $parameters);

    }

    /**
     * Get List of Merchants
     * @param array $parameters
     * @return AbstractRequest
     */
    public function getMerchants(array $parameters = array())
    {
        return $this->createRequest(MerchantListRequest::class, $parameters);
    }

    /**
     * Get List of Bank Accounts
     * @param array $parameters
     * @return AbstractRequest
     */
    public function getBankAccounts(array $parameters = array())
    {
        return $this->createRequest(BankAccountListRequest::class, $parameters);
    }
}
