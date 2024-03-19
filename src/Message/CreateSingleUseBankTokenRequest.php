<?php

/**
 * PaywayRest Create Single Use Bank Account Token Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Create Single Use Bank Account Token Request
 *
 * @link https://www.payway.com.au/docs/rest.html#tokenise-a-bank-account
 */
class CreateSingleUseBankTokenRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('bankAccountBsb', 'bankAccountNumber', 'bankAccountName');

        return array(
            'paymentMethod' => 'bankAccount',
            'bsb' => $this->getBankAccountBsb(),
            'accountNumber' => $this->getBankAccountNumber(),
            'accountName' => $this->getBankAccountName(),
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
