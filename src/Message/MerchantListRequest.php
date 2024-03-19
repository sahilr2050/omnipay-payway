<?php
/**
 * PaywayRest Transaction Detail Request
 */

namespace Omnipay\PaywayRest\Message;

/**
 * PaywayRest Merchant ListRequest
 *
 * @link https://www.payway.com.au/docs/rest.html#list-merchants
 */
class MerchantListRequest extends AbstractRequest
{
    public function getData(): array
    {
        return array();
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/merchants';
    }

    public function getUseSecretKey(): bool
    {
        return true;
    }
}
