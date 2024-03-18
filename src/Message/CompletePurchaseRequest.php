<?php

namespace Omnipay\PayWay\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * PayWay Complete Purchase Request
 *
 * This class represents a request to complete a purchase with PayWay, typically after a customer
 * has been redirected back to your site with some sort of transaction reference.
 */
class CompletePurchaseRequest extends AbstractRequest
{
    /**
     * Get the raw data array for this message. The format of this array should be
     * compatible with PayWay's expected parameters for completing a purchase.
     *
     * @return mixed
     */
    public function getData()
    {
        // Prepare data for completing the purchase. This often includes transaction references,
        // tokens, or any other data returned by PayWay that is needed to verify the transaction.
        return [
            'transactionReference' => $this->getTransactionReference(),
            // Include any other necessary parameters required by PayWay.
        ];
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        // Send the data to PayWay and capture the response.
        // This is a placeholder for how you might send data. Replace it with actual code to
        // send data to PayWay and receive a response.
        $httpResponse = $this->httpClient->post($this->getEndpoint(), [], json_encode($data))->send();

        // Interpret the HTTP response received from PayWay.
        // Instantiate and return an appropriate Omnipay response object.
        return $this->response = new CompletePurchaseResponse($this, $httpResponse->json());
    }

    /**
     * Get the endpoint URL for the request.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        // Return the appropriate PayWay API endpoint for completing purchases.
        return $this->getParameter('testMode') ? 'https://api.test.payway.com/complete' : 'https://api.payway.com/complete';
    }

    /**
     * Get the transaction reference.
     *
     * @return string
     */
    public function getTransactionReference()
    {
        return $this->getParameter('transactionReference');
    }

    /**
     * Set the transaction reference.
     *
     * @param string $value
     * @return $this
     */
    public function setTransactionReference($value)
    {
        return $this->setParameter('transactionReference', $value);
    }

    // Add any additional methods or properties required by the PayWay API for completing a purchase.
}
