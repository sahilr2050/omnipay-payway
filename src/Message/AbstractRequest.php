<?php
/**
 * PaywayRest Abstract Request.
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\PaywayRest\Helper\Uuid;

/**
 * PayWay REST API Abstract Request.
 *
 * This is the parent class for all PayWay requests.
 *
 * @todo Add usage documentation, including live and test details
 *
 * @see \Omnipay\PaywayRest\Gateway
 * @link https://www.payway.com.au/rest-docs/index.html
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var string Endpoint URL */
    protected string $endpoint = 'https://api.payway.com.au/rest/v1';

    /**
     * Set API publishable key
     * @param string $value API publishable key
     */
    public function setApiKeyPublic(string $value): AbstractRequest
    {
        return $this->setParameter('apiKeyPublic', $value);
    }

    /**
     * Set API secret key
     * @param string $value API secret key
     */
    public function setApiKeySecret(string $value): AbstractRequest
    {
        return $this->setParameter('apiKeySecret', $value);
    }

    /**
     * Get Merchant
     * @return string Merchant ID
     */
    public function getMerchantId(): string
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set Merchant
     * @param string $value Merchant ID
     */
    public function setMerchantId(string $value): AbstractRequest
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     * Set Use Secret Key setting
     * @param string $value Flag to use secret key
     */
    public function setUseSecretKey(string $value): AbstractRequest
    {
        return $this->setParameter('useSecretKey', $value);
    }

    /**
     * Get single-use token
     * @return string Token key
     */
    public function getSingleUseTokenId(): string
    {
        return $this->getParameter('singleUseTokenId');
    }

    /**
     * Set single-use token
     * @param string $value Token Key
     */
    public function setSingleUseTokenId(string $value): AbstractRequest
    {
        return $this->setParameter('singleUseTokenId', $value);
    }

    /**
     * Set Idempotency Key
     * @param string $value Idempotency Key
     */
    public function setIdempotencyKey(string $value): AbstractRequest
    {
        return $this->setParameter('idempotencyKey', $value);
    }

    public function getCustomerNumber()
    {
        return $this->getParameter('customerNumber');
    }

    public function setCustomerNumber($value): AbstractRequest
    {
        return $this->setParameter('customerNumber', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value): AbstractRequest
    {
        return $this->setParameter('amount', $value);
    }

    public function getPrincipalAmount()
    {
        return $this->getParameter('principalAmount');
    }

    public function setPrincipalAmount($value): AbstractRequest
    {
        return $this->setParameter('principalAmount', $value);
    }

    public function getCurrency(): ?string
    {
        // PayWay expects lowercase currency values
        return ($this->getParameter('currency'))
            ? strtolower($this->getParameter('currency'))
            : null;
    }

    public function setCurrency($value): AbstractRequest
    {
        return $this->setParameter('currency', $value);
    }

    public function getOrderNumber()
    {
        return $this->getParameter('orderNumber');
    }

    public function setOrderNumber($value): AbstractRequest
    {
        return $this->setParameter('orderNumber', $value);
    }

    public function getBankAccountId()
    {
        return $this->getParameter('bankAccountId');
    }

    public function setBankAccountId($value): AbstractRequest
    {
        return $this->setParameter('bankAccountId', $value);
    }

    public function getBankAccountBsb()
    {
        return $this->getParameter('bankAccountBsb');
    }

    public function setBankAccountBsb($value): AbstractRequest
    {
        return $this->setParameter('bankAccountBsb', $value);
    }

    public function getBankAccountNumber()
    {
        return $this->getParameter('bankAccountNumber');
    }

    public function setBankAccountNumber($value): AbstractRequest
    {
        return $this->setParameter('bankAccountNumber', $value);
    }

    public function getBankAccountName()
    {
        return $this->getParameter('bankAccountName');
    }

    public function setBankAccountName($value): AbstractRequest
    {
        return $this->setParameter('bankAccountName', $value);
    }

    public function getCustomerName()
    {
        return $this->getParameter('customerName');
    }

    public function setCustomerName($value): AbstractRequest
    {
        return $this->setParameter('customerName', $value);
    }

    public function getEmailAddress()
    {
        return $this->getParameter('emailAddress');
    }

    public function setEmailAddress($value): AbstractRequest
    {
        return $this->setParameter('emailAddress', $value);
    }

    public function getSendEmailReceipts()
    {
        return $this->getParameter('sendEmailReceipts');
    }

    public function setSendEmailReceipts($value): AbstractRequest
    {
        return $this->setParameter('sendEmailReceipts', $value);
    }

    public function getPhoneNumber()
    {
        return $this->getParameter('phoneNumber');
    }

    public function setPhoneNumber($value): AbstractRequest
    {
        return $this->setParameter('phoneNumber', $value);
    }

    public function getStreet1()
    {
        return $this->getParameter('street1');
    }

    public function setStreet1($value): AbstractRequest
    {
        return $this->setParameter('street1', $value);
    }

    public function getStreet2()
    {
        return $this->getParameter('street2');
    }

    public function setStreet2($value): AbstractRequest
    {
        return $this->setParameter('street2', $value);
    }

    public function getCityName()
    {
        return $this->getParameter('cityName');
    }

    public function setCityName($value): AbstractRequest
    {
        return $this->setParameter('cityName', $value);
    }

    public function getState()
    {
        return $this->getParameter('state');
    }

    public function setState($value): AbstractRequest
    {
        return $this->setParameter('state', $value);
    }

    public function getPostalCode()
    {
        return $this->getParameter('postalCode');
    }

    public function setPostalCode($value): AbstractRequest
    {
        return $this->setParameter('postalCode', $value);
    }

    public function getFrequency()
    {
        return $this->getParameter('frequency') ?: 'once';
    }

    public function setFrequency($value): AbstractRequest
    {
        return $this->setParameter('frequency', $value);
    }

    public function getNextPaymentDate()
    {
        // default to today's date
        return $this->getParameter('nextPaymentDate') ?: date('j M Y');
    }

    public function setNextPaymentDate($value): AbstractRequest
    {
        return $this->setParameter('nextPaymentDate', $value);
    }

    public function getRegularPrincipalAmount()
    {
        return $this->getParameter('regularPrincipalAmount');
    }

    public function setRegularPrincipalAmount($value): AbstractRequest
    {
        return $this->setParameter('regularPrincipalAmount', $value);
    }

    public function getNextPrincipalAmount()
    {
        return $this->getParameter('nextPrincipalAmount');
    }

    public function setNextPrincipalAmount($value): AbstractRequest
    {
        return $this->setParameter('nextPrincipalAmount', $value);
    }

    public function getNumberOfPaymentsRemaining()
    {
        return $this->getParameter('numberOfPaymentsRemaining');
    }

    public function setNumberOfPaymentsRemaining($value): AbstractRequest
    {
        return $this->setParameter('numberOfPaymentsRemaining', $value);
    }

    public function getFinalPrincipalAmount()
    {
        return $this->getParameter('finalPrincipalAmount');
    }

    public function setFinalPrincipalAmount($value): AbstractRequest
    {
        return $this->setParameter('finalPrincipalAmount', $value);
    }

    public function setSSLCertificatePath($value): AbstractRequest
    {
        return $this->setParameter('sslCertificatePath', $value);
    }

    /**
     * Send data request
     * @param  [type] $data [description]
     * @return ResponseInterface|Response [type]       [description]
     */
    public function sendData($data): ResponseInterface|Response
    {
        // enforce TLS >= v1.2 (https://www.payway.com.au/rest-docs/index.html#basics)
        $config = $this->httpClient->getConfig();
        $curlOptions = $config->get('curl.options');
        $curlOptions[CURLOPT_SSLVERSION] = 6;
        $config->set('curl.options', $curlOptions);
        $this->httpClient->setConfig($config);

        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        if ($this->getSSLCertificatePath()) {
            $this->httpClient->setSslVerification($this->getSSLCertificatePath());
        }

        $request = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->getRequestHeaders(),
            $data
        );

        // get the appropriate API key
        $apikey = ($this->getUseSecretKey()) ? $this->getApiKeySecret() : $this->getApiKeyPublic();
        $request->setHeader('Authorization', 'Basic ' . base64_encode($apikey . ':'));

        // send the request
        $response = $request->send();

        $this->response = new Response($this, $response->json());

        // save additional info
        $this->response->setHttpResponseCode($response->getStatusCode());
        $this->response->setTransactionType($this->getTransactionType());

        return $this->response;
    }

    public function getSSLCertificatePath()
    {
        return $this->getParameter('sslCertificatePath');
    }

    /**
     * Get HTTP method
     * @return string HTTP method (GET, PUT, etc.)
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * Get request headers
     * @return array Request headers
     */
    public function getRequestHeaders(): array
    {
        // common headers
        $headers = array(
            'Accept' => 'application/json',
        );

        // set content type
        if ($this->getHttpMethod() !== 'GET') {
            $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        // prevent duplicate POSTs
        if ($this->getHttpMethod() === 'POST') {
            $headers['Idempotency-Key'] = $this->getIdempotencyKey();
        }

        return $headers;
    }

    /**
     * Get Idempotency Key
     * @return string Idempotency Key
     */
    public function getIdempotencyKey(): string
    {
        return $this->getParameter('idempotencyKey') ?: Uuid::create();
    }

    /**
     * Get Use Secret Key setting
     * @return bool Use secret API key if true
     */
    public function getUseSecretKey(): bool
    {
        return $this->getParameter('useSecretKey');
    }

    /**
     * Get API secret key
     * @return string
     */
    public function getApiKeySecret(): string
    {
        return $this->getParameter('apiKeySecret');
    }

    /**
     * Get API publishable key
     * @return string
     */
    public function getApiKeyPublic(): string
    {
        return $this->getParameter('apiKeyPublic');
    }

    public function setTransactionType($value): AbstractRequest
    {
        return $this->setParameter('transactionType', $value);
    }

    public function getTransactionType()
    {
        return $this->getParameter('transactionType');
    }

    /**
     * Add multiple parameters to data
     * @param array $data Data array
     * @param array $params Parameters to add to data
     */
    public function addToData(array $data = array(), array $params = array()): array
    {
        foreach ($params as $param) {
            $getter = 'get' . ucfirst($param);
            if (method_exists($this, $getter) && $this->$getter()) {
                $data[$param] = $this->$getter();
            }
        }

        return $data;
    }
}
