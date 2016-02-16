<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2/15/16
 * Time: 9:32 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\UserOrder;


class SkipToCheckout
{
    private $userId;
    private $key;

    function __construct($userId, $key, $url)
    {
        $this->userId = $userId;
        $this->key = $key;
        $this->url = $url;
    }

    public function checkout(UserOrder $userOrder, $sum)
    {
        $request = '<GenerateRequest>
<PxPayUserId>'.$this->userId.'</PxPayUserId>
<PxPayKey>'.$this->key.'</PxPayKey>
<MerchantReference>'.$userOrder->getOrderId().'</MerchantReference>
<TxnType>Purchase</TxnType>
<AmountInput>'.number_format($sum, 2).'</AmountInput>
<CurrencyInput>NZD</CurrencyInput>
<TxnData1>'.$userOrder->getUser()->getUsername().'</TxnData1>
<TxnData2></TxnData2>
<TxnData3></TxnData3>
<EmailAddress>'.$userOrder->getUser()->getEmail().'</EmailAddress>
<TxnId></TxnId>
<UrlSuccess>https://www.dpsdemo.com/SandboxSuccess.aspx</UrlSuccess>
<UrlFail>https://www.dpsdemo.com/SandboxSuccess.aspx</UrlFail>
</GenerateRequest>';
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $response = curl_exec($ch);
        curl_close ($ch);

        $temp = simplexml_load_string($response);
        $json = json_encode($temp);
        $array = json_decode($json, TRUE);

        return isset($array['URI']) ? $array['URI'] : false;
    }
}