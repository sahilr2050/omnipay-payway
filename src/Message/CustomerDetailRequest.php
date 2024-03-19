<?php
/**
 * PaywayRest Customer Detail Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Customer Detail Request
 *
 * @link https://www.payway.com.au/rest-docs/index.html#get-customer-details
 */
class CustomerDetailRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'customerNumber'
        );

        return array();
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/customers/' . $this->getCustomerNumber();
    }

    public function getUseSecretKey(): bool
    {
        return true;
    }
}
