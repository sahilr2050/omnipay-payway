<?php
/**
 * PaywayRest Update Customer Contact Request
 */

namespace Omnipay\PaywayRest\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PaywayRest Update Customer Contact Request
 *
 * @link https://www.payway.com.au/rest-docs/index.html#update-contact-details
 */
class UpdateCustomerContactRequest extends AbstractRequest
{
    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate(
            'customerNumber'
        );

        return $this->addToData(array(), array(
            'customerName',
            'emailAddress',
            'sendEmailReceipts',
            'phoneNumber',
            'street1',
            'street2',
            'cityName',
            'state',
            'postalCode',
        ));
    }

    public function getEndpoint(): string
    {
        return $this->endpoint . '/customers/' . $this->getCustomerNumber() . '/contact';
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
