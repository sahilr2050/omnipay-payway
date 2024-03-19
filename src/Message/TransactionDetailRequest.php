<?php
/**
 * PaywayRest Transaction Detail Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Transaction Detail Request
 *
 * @link https://www.payway.com.au/rest-docs/index.html#get-transaction-details
 */
class TransactionDetailRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'transactionId'
        );

        return array();
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/transactions/' . $this->getTransactionId();
    }

    public function getUseSecretKey(): bool
    {
        return true;
    }
}
