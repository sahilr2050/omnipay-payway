<?php

namespace Omnipay\PayWay;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayWay\Message\CompletePurchaseRequest;
use Omnipay\PayWay\Message\PurchaseRequest;

class PayWayGateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayWay';
    }

    public function getDefaultParameters()
    {
        return [
            'apiKey' => '',
            'apiSecret' => '',
            'testMode' => false,
        ];
    }

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getApiSecret()
    {
        return $this->getParameter('apiSecret');
    }

    public function setApiSecret($value)
    {
        return $this->setParameter('apiSecret', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    // Add other necessary methods here
}
