<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2/15/16
 * Time: 9:32 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\UserOrder;
use Symfony\Bundle\FrameworkBundle\Routing\Router;


class SkipToCheckout
{
    private $userId;
    private $key;
    private $url;
    private $router;


    function __construct($userId, $key, $url, Router $router)
    {
        $this->userId = $userId;
        $this->key = $key;
        $this->url = $url;
        $this->router = $router;
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
<UrlSuccess>'.$this->router->generate('pay_process', array(), true).'</UrlSuccess>
<UrlFail>'.$this->router->generate('pay_process', array(), true).'</UrlFail>
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

    public function processResponse($result)
    {
        $request = '<ProcessResponse>
<PxPayUserId>'.$this->userId.'</PxPayUserId>
<PxPayKey>'.$this->key.'</PxPayKey>
<Response>'.$result.'</Response>
</ProcessResponse>';
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
        if ($array) {
            return array(
                'success' => $array['Success'],
                'id' => $array['MerchantReference'],
                'username' => $array['TxnData1']
                );
        }
        else {
            return array(
                'success' => 0,
                );
        }
    }
}