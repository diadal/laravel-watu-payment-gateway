# Laravel-watu-payment-gateway
 fast payment gateway in Nigeria


<p align="center">
<!-- <a href="https://travis-ci.com/diadal/laravel-watu-payment-gateway"><img src="https://travis-ci.com/diadal/laravel-watu-payment-gateway.svg?branch=master" alt="Build Status"></a> -->
<a href="https://packagist.org/packages/diadal/laravel-watu-payment-gateway"><img src="https://poser.pugx.org/diadal/laravel-watu-payment-gateway/d/total.svg" alt="Total Downloads"></a>
<!-- <a href="https://packagist.org/packages/diadal/laravel-watu-payment-gateway"><img src="https://poser.pugx.org/diadal/laravel-watu-payment-gateway/v/stable.svg" alt="Latest Stable Version"></a> -->
<a href="https://packagist.org/packages/diadal/laravel-watu-payment-gateway"><img src="https://poser.pugx.org/diadal/laravel-watu-payment-gateway/license.svg" alt="License"></a>
</p>




This package provides a simple way to work with Watu Api. To learn all about it, head over to [Watu documentation](https://docs.watu.global/).

## Installation

### With Composer

```
$ composer require diadal/laravel-watu-payment-gateway
```

```
php artisan vendor:publish --provider="Diadal\Watu\WatuServiceProvider"

```
## Useage
 `.evn`
```php

WATU_PUBLIC_KEY_TEST= WTP-T-PK-******************
WATU_SECRET_KEY_TEST= WTP-T-SK-******************
WATU_ENCRYPTION_KEY_TEST= ******************
WATU_IV_KEY_TEST= ******************

WATU_PUBLIC_KEY= WTP-L-PK-******************
WATU_SECRET_KEY= WTP-L-SK-******************
WATU_ENCRYPTION_KEY= ******************
WATU_IV_KEY= ******************
WATU_URL = https://api.watu.global/v1

```

`Controller`
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Diadal\Watu\Watu;


class InvoiceController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        ...
        $this->watu = new Watu();
    }




```
Examples of what you can do:

```php
// this work with any motheds Api called  mainData is default wata data or payload
public function OtherMethods()
    {

        $data = [];
        $data['mainData'] = [
            "service_type" => 'watu-pay',
            "amount" => '10000',
            "currency" => 'NGN',
            "payment_type" => 'card'
        ];
        $data['keyType'] = 'publicKey';
        $data['requestType'] = 'post';
        $data['path'] = '/payment/fees';
        $data = $data;
        return $this->watu->OtherMethods($data);
    }
```

```php

public function GetBankList()
    {

        $data = 'NG';
        $data = $data;
        return $this->watu->GetBankList($data);
    }

public function Chargex()
    {

        $data = [

            "email" => "info@diadal.com.ng",
            "payment_type" => "ussd",
            "amount" => 1000,
            "country" => "NG",
            "currency" => "NGN",
            "merchant_reference" => Str::random(),
            "service_type" => "watu-pay",
            "public_key" => config('watu.publicKey'),
            "service_type" => "watu-pay",
            "bank_id" => "057",
        ];

        $data = $data;
        logger($data);
        return $this->watu->Charge($data);
    }


public function InitiateInvoice()
    {

        $data = [

            "email" => "info@diadal.com.ng",
            "amount" => 1000,
            "country" => "NG",
            "currency" => "NGN",
            "merchant_reference" => Str::random(),
            "service_type" => "watu-pay",
            "payment_methods" => "card"
        ];

        logger($data);


        return $this->watu->PaymentInitiate($data);
    }
    public function WatuFee()
    {

        $data = [
            "service_type" => 'watu-pay',
            "amount" => '10000',
            "currency" => 'NGN',
            "payment_type" => 'card'
        ];


        return $this->watu->GetFee($data);
    }
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

