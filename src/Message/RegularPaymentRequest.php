<?php

/**
 * PaywayRest Regular Payment Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Regular Payment Request
 *
 * @see \Omnipay\PaywayRest\Gateway
 * @link https://www.payway.com.au/rest-docs/index.html#schedule-regular-payments
 */
class RegularPaymentRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'customerNumber',
            'regularPrincipalAmount'
        );

        $data = array(
            'frequency' => $this->getFrequency(),
            'nextPaymentDate' => $this->getNextPaymentDate(),
            'regularPrincipalAmount' => $this->getRegularPrincipalAmount(),
        );

        if ($this->getNextPrincipalAmount()) {
            $data['nextPrincipalAmount'] = $this->getNextPrincipalAmount();
        }
        if ($this->getNumberOfPaymentsRemaining()) {
            $data['numberOfPaymentsRemaining'] = $this->getNumberOfPaymentsRemaining();
        }
        if ($this->getFinalPrincipalAmount()) {
            $data['finalPrincipalAmount'] = $this->getFinalPrincipalAmount();
        }

        return $data;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/customers/' . $this->getCustomerNumber() . '/schedule';
    }

    public function getHttpMethod(): string
    {
        return 'PUT';
    }

    public function getUseSecretKey(): bool
    {
        return true;
    }
}
