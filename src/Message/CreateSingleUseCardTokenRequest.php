<?php

/**
 * PaywayRest Create Single Use Card Token Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidCreditCardException;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Create Single Use Card Token Request
 *
 * @link https://www.payway.com.au/docs/rest.html#tokenise-a-credit-card
 */
class CreateSingleUseCardTokenRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     * @throws InvalidCreditCardException
     */
    public function getData(): array
    {
        $this->getCard()->validate();

        // PayWay requires two digit expiry month.
        $expiryDateMonth = str_pad($this->getCard()->getExpiryMonth(), 2, 0, STR_PAD_LEFT);

        return array(
            'paymentMethod' => 'creditCard',
            'cardNumber' => $this->getCard()->getNumber(),
            'cardholderName' => $this->getCard()->getName(),
            'cvn' => $this->getCard()->getCvv(),
            'expiryDateMonth' => $expiryDateMonth,
            'expiryDateYear' => $this->getCard()->getExpiryYear(),
        );
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint . '/single-use-tokens';
    }

    public function getHttpMethod(): string
    {
        return 'POST';
    }
}
