<?php

/**
 * PaywayRest Purchase Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Purchase Request
 *
 * @see \Omnipay\PaywayRest\Gateway
 * @link https://www.payway.com.au/rest-docs/index.html#process-a-payment
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'customerNumber',
            'principalAmount',
            'currency'
        );

        $data = array(
            'customerNumber' => $this->getCustomerNumber(),
            'transactionType' => 'payment',
            'principalAmount' => $this->getPrincipalAmount(),
            'currency' => $this->getCurrency(),
        );

        if ($this->getOrderNumber()) {
            $data['orderNumber'] = $this->getOrderNumber();
        }
        if ($this->getMerchantId()) {
            $data['merchantId'] = $this->getMerchantId();
        }
        if ($this->getBankAccountId()) {
            $data['bankAccountId'] = $this->getBankAccountId();
        }
        if ($this->getSingleUseTokenId()) {
            $data['singleUseTokenId'] = $this->getSingleUseTokenId();
        }

        return $data;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/transactions';
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }

    public function getUseSecretKey(): bool
    {
        return true;
    }
}
