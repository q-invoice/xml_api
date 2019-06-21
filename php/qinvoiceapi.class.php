<?php
/**
 * @copyright    Copyright (C) 2013-2019 q-invoice.com - All rights reserved.
 * @license        http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @version    2.2
 * @author      Casper Mekel <casper@q-invoice.com>
 */


class QinvoiceApi
{

    private $gateway = 'https://app.q-invoice.com/api/xml/1.2/';
    private $username;
    private $password;
    private $identifier = ''; // Your software ID and or Version


    private $documenttype = 'invoice';
    private $companyname;
    private $contactname;
    private $email;
    private $phone;
    private $address;
    private $address2;
    private $zipcode;
    private $city;
    private $country;
    private $delivery_address;
    private $delivery_address2;
    private $delivery_zipcode;
    private $delivery_city;
    private $delivery_country;
    private $delivery_phone;
    private $delivery_date;
    private $iban;
    private $bic;
    private $vatnumber;
    private $paid;
    private $payment_method;
    private $date;
    private $action = '1';
    private $currency = 'EUR';
    private $saverelation = false;
    private $calculation_method = 'excl';

    private $document_reference;

    private $layout;

    private $tags = array();
    private $items = array();

    /**
     * @param mixed $username
     * @param mixed $password
     * @param mixed $url
     */
    function __construct($username, $password, $gateway = false)
    {
        $this->username = $username;
        $this->password = $password;

        if ($gateway != false) {
            if (substr($gateway, -1) != '/') {
                $gateway .= '/';
            }
            $this->gateway = $gateway;
        }

    }

    /**
     * @param mixed $companyname
     */
    public function setCompanyname($companyname)
    {
        $this->companyname = $companyname;
    }

    /**
     * @param mixed $contactname
     */
    public function setContactname($contactname)
    {
        $this->contactname = $contactname;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }


    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param mixed $delivery_address
     */
    public function setDeliveryAddress($delivery_address)
    {
        $this->delivery_address = $delivery_address;
    }

    /**
     * @param mixed $delivery_address2
     */
    public function setDeliveryAddress2($delivery_address2)
    {
        $this->delivery_address2 = $delivery_address2;
    }

    /**
     * @param mixed $delivery_zipcode
     */
    public function setDeliveryZipcode($delivery_zipcode)
    {
        $this->delivery_zipcode = $delivery_zipcode;
    }

    /**
     * @param mixed $delivery_city
     */
    public function setDeliveryCity($delivery_city)
    {
        $this->delivery_city = $delivery_city;
    }

    /**
     * @param mixed $delivery_country
     */
    public function setDeliveryCountry($delivery_country)
    {
        $this->delivery_country = $delivery_country;
    }

    /**
     * @param mixed $delivery_phone
     */
    public function setDeliveryPhone($delivery_phone)
    {
        $this->delivery_phone = $delivery_phone;
    }

    /**
     * @param mixed $delivery_date
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;
    }

    /**
     * @param mixed $vatnumber
     */
    public function setVatnumber($vatnumber)
    {
        $this->vatnumber = $vatnumber;
    }

    /**
     * @param mixed $remark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    /**
     * @param mixed $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

    /**
     * @param mixed $payment_method
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param bool $saverelation
     */
    public function setSaverelation($saverelation)
    {
        $this->saverelation = $saverelation;
    }

    /**
     * @param mixed $calculation_method
     */
    public function setCalculationMethod($calculation_method)
    {
        $this->calculation_method = $calculation_method;
    }

    /**
     * @param mixed $document_reference
     */
    public function setDocumentReference($document_reference)
    {
        $this->document_reference = $document_reference;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param mixed $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @param mixed $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @param mixed $tag
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @param mixed $type
     */
    public function setDocumentType($type)
    {
        if (!in_array($type, array('invoice', 'quote', 'orderconfirmation', 'proforma'))) {
            $type = 'invoice';
        }
        $this->documenttype = $type;
    }

    /**
     * @param array $params
     */
    public function addItem($params)
    {
        $item = new StdClass();

        $item->code = $params['code'];
        $item->unit = $params['unit'];
        $item->description = $params['description'];
        $item->price = $params['price'];
        $item->price_incl = $params['price_incl'];
        $item->price_vat = $params['price_vat'];
        $item->vatpercentage = $params['vatpercentage'];
        $item->discount = $params['discount'];
        $item->quantity = $params['quantity'];
        $item->categories = $params['categories'];
        $item->ledgeraccount = $params['ledgeraccount'];
        $this->items[] = $item;
    }


    public function sendRequest()
    {
        $xml = $this->buildXML();
         echo $xml;
         return;
        $content = "<?xml version='1.0' encoding='UTF-8'?>";
        $content .= $xml;

        $headers = array("Content-type: application/atom+xml");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->gateway);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            print curl_error($ch);
        } else {
            curl_close($ch);
        }
        if ($data == 1 || (is_int($data) && $data > 0)) {
            return true;
        } else {
            return false;
        }

    }

    private function buildXML()
    {

        $request = new SimpleXMLElement('<request/>');


        $login = $request->addChild('login');
        $login->addAttribute('mode', 'new'.ucfirst($this->documenttype));
        $login->addChild('username', $this->username);
        $login->addChild('password', $this->password);
        $login->addChild('identifier', $this->identifier);

        $document = $request->addChild($this->documenttype);

        $document->addChild('companyname', $this->companyname);
        $document->addChild('firstname', $this->firstname);
        $document->addChild('lastname', $this->lastname);
        $document->addChild('address', $this->address);
        $document->addChild('address2', $this->address2);
        $document->addChild('email', $this->email);
        $document->addChild('phone', $this->phone);
        $document->addChild('zipcode', $this->zipcode);
        $document->addChild('city', $this->city);
        $document->addChild('country', $this->country);

        $document->addChild('delivery_companyname', $this->delivery_companyname);
        $document->addChild('delivery_firstname', $this->delivery_firstname);
        $document->addChild('delivery_lastname', $this->delivery_lastname);
        $document->addChild('delivery_address', $this->delivery_address);
        $document->addChild('delivery_address2', $this->delivery_address2);
        $document->addChild('delivery_email', $this->delivery_email);
        $document->addChild('delivery_phone', $this->delivery_phone);
        $document->addChild('delivery_zipcode', $this->delivery_zipcode);
        $document->addChild('delivery_city', $this->delivery_city);
        $document->addChild('delivery_country', $this->delivery_country);

        $document->addChild('vat', $this->vat);
        $document->addChild('iban', $this->iban);
        $document->addChild('bic', $this->bic);
        $document->addChild('remark', $this->remark);
        $document->addChild('layout', $this->layout);
        $document->addChild('date', $this->date);
        $document->addChild('paid', $this->paid)->addAttribute('method', $this->payment_method);
        $document->addChild('currency', $this->companyname);
        $document->addChild('action', $this->action);
        $document->addChild('saverelation', $this->saverelation);
        $document->addChild('calculation_method', $this->calculation_method);
        $document->addChild('document_reference', $this->document_reference);

        $tags = $document->addChild('tags');
        foreach ($this->tags as $tag) {
            $tags->addChild('tag', $tag);
        }


        $items = $document->addChild('items');
        foreach ($this->items as $item) {
            $_item = $items->addChild('item');
            $_item->addChild('code', $item->code);
            $_item->addChild('quantity', $item->quantity);
            $_item->addChild('description', $item->description);
            $_item->addChild('price', $item->price);
            $_item->addChild('price_incl', $item->price_incl);
            $_item->addChild('price_vat', $item->price_vat);
            $_item->addChild('vatpercentage', $item->vatpercentage);
            $_item->addChild('discount', $item->discount);
            $_item->addChild('ledgeraccount', $item->ledgeraccount);
        }


        return $request->asXML();
    }
}
