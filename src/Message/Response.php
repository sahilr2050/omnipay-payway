<?php
/**
 * PayWayRest Response
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * PaywayRest Response
 *
 * Response class for all PaywayRest requests
 * @see \Omnipay\PaywayRest\Gateway
 */
class Response extends AbstractResponse
{
    /** @var string|null Request ID */
    protected ?string $requestId = null;
    /** @var string|null HTTP response code */
    protected ?string $httpResponseCode = null;
    /** @var string|null Transaction type */
    protected ?string $transactionType = null;

    /**
     * Get Transaction ID
     * @return array|string|null
     */
    public function getTransactionId(): array|string|null
    {
        return $this->getData('transactionId');
    }

    /**
     * Get response data, optionally by key
     * @param null $key Data array key
     * @return array|string|null Response data item or all data if no key specified
     */
    public function getData($key = null): array|string|null
    {
        if ($key) {
            return $this->data[$key] ?? null;
        }
        return $this->data;
    }

    /**
     * Get Transaction reference
     * @return array|string|null Payway transaction reference
     */
    public function getTransactionReference(): array|string|null
    {
        return $this->getData('receiptNumber');
    }

    /**
     * Get Customer Number
     * @return array|string|null
     */
    public function getCustomerNumber(): array|string|null
    {
        return $this->getData('customerNumber');
    }

    /**
     * Get Contact details
     * @return array|string|null Customer contact
     */
    public function getContact(): array|string|null
    {
        return $this->getData('contact');
    }

    /**
     * Get error message from the response
     * @return string|null Error message or null if successful
     */
    public function getMessage(): ?string
    {
        if ($this->getErrorMessage()) {
            return $this->getErrorMessage() . ' (' . $this->getErrorFieldName() . ')';
        }

        if ($this->isSuccessful()) {
            return ($this->getStatus()) ? ucfirst($this->getStatus()) : 'Successful';
        }
        // default to unsuccessful message
        return 'The transaction was unsuccessful.';
    }

    /**
     * Get error message from the response
     * @return array|string|null Error message or null if successful
     */
    public function getErrorMessage(): array|string|null
    {
        return $this->getErrorData('message');
    }

    /**
     * Get error data from response
     * @param null $key Optional data key
     * @return array|string|null Response error item or all data if no key
     */
    public function getErrorData($key = null): array|string|null
    {
        if ($this->isSuccessful()) {
            return null;
        }
        // get error data (array in data)
        $data = $this->getData('data')[0] ?? null;
        if ($key) {
            return $data[$key] ?? null;
        }
        return $data;
    }

    /**
     * Is the transaction successful?
     * @return boolean True if successful
     */
    public function isSuccessful(): bool
    {
        // get response code
        $code = $this->getHttpResponseCode();

        if ($code === 200) {  // OK
            return true;
        }

        if ($code === 201) {   // Created
            if ($this->getTransactionType() === 'payment') {
                return $this->isApproved();
            }
            return true;
        }

        if ($code === 202 && $this->isPending()) {   // Accepted
            return true;
        }

        return false;
    }

    /**
     * Get HTTP Response Code
     * @return string|null
     */
    public function getHttpResponseCode(): ?string
    {
        return $this->httpResponseCode;
    }

    /**
     * Set HTTP Response Code
     * @parm string Response Code
     */
    public function setHttpResponseCode($value): void
    {
        $this->httpResponseCode = $value;
    }

    /**
     * Get transaction type
     * @return array|string|null Transaction type
     */
    public function getTransactionType(): array|string|null
    {
        return $this->getData('transactionType');
    }

    /**
     * Set Transaction Type
     * @return string|null Transaction type
     */
    public function setTransactionType($value): ?string
    {
        return $this->transactionType = $value;
    }

    /**
     * Is the transaction approved?
     * @return boolean True if approved
     */
    public function isApproved(): bool
    {
        return in_array($this->getStatus(), array(
            'approved',
            'approved*',
        ));
    }

    /**
     * Get status
     * @return array|string|null Returned status
     */
    public function getStatus(): array|string|null
    {
        return $this->getData('status');
    }

    /**
     * Is the transaction pending?
     * @return boolean True if pending
     */
    public function isPending(): bool
    {
        return (
            $this->getTransactionType() === 'payment'
            && $this->getStatus() === 'pending'
        );
    }

    /**
     * Get field name in error from the response
     * @return array|string|null Error message or null if successful
     */
    public function getErrorFieldName(): array|string|null
    {
        return $this->getErrorData('fieldName');
    }

    /**
     * Get code
     * @return string|null Error message or null if successful
     */
    public function getCode(): ?string
    {
        return implode(' ', array(
            $this->getResponseCode(),
            $this->getResponseText(),
            '(' . $this->getHttpResponseCode(),
            $this->getHttpResponseCodeText() . ')',
        ));
    }

    /**
     * Get Payway Response Code
     * @return array|string|null Returned response code
     */
    public function getResponseCode(): array|string|null
    {
        return $this->getData('responseCode');
    }

    /**
     * Get Payway Response Text
     * @return array|string|null Returned response Text
     */
    public function getResponseText(): array|string|null
    {
        return $this->getData('responseText');
    }

    /**
     * Get HTTP Response code text
     * @return string|null
     */
    public function getHttpResponseCodeText(): ?string
    {
        $code = $this->getHttpResponseCode();
        $statusTexts = \Symfony\Component\HttpFoundation\Response::$statusTexts;

        return $statusTexts[$code] ?? null;
    }

    /**
     * Get field value in error from the response
     * @return array|string|null Error message or null if successful
     */
    public function getErrorFieldValue(): array|string|null
    {
        return $this->getErrorData('fieldValue');
    }

    /**
     * @return string|null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Set request id
     * @return void provides a fluent interface.
     */
    public function setRequestId($requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * Get payment method
     * @return array|string|null Payment method
     */
    public function getPaymentMethod(): array|string|null
    {
        return $this->getData('paymentMethod');
    }

    /**
     * Get credit card information
     * @return array|string|null Transaction credit card details
     */
    public function getCreditCard(): array|string|null
    {
        return $this->getData('creditCard');
    }

    /**
     * Get bank account information
     * @return array|string|null Transaction bank account details
     */
    public function getBankAccount(): array|string|null
    {
        return $this->getData('bankAccount');
    }
}
