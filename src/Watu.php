<?php

namespace Diadal\Watu;

use Illuminate\Support\Facades\Http;

class Watu
{
    /**
     * Undocumented variable
     *
     * @var [mixed]
     */
    protected $data;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->publicKey =  config('watu.publicKey');
        $this->secretKey =  config('watu.secretKey');
        $this->encryptKey =  config('watu.encryptKey');
        $this->ivKey =  config('watu.ivKey');
        $this->url =  config('watu.url');
    }

    /**
     * Undocumented function
     *
     * @param [string] $data
     * @param object $cry
     * @return string
     */
    private function Encrypt($data, $cry = [])
    {
        $method = "AES-256-CBC";
        $key = $cry['encryption'] ?? $this->encryptKey;
        $iv = $cry['iv'] ??  $this->ivKey;
        $ciphertext = openssl_encrypt($data, $method, $key, 0, $iv);
        return $ciphertext;
    }



    /**
     * Undocumented function
     *
     * @param array $data
     * @return Object
     */
    public function GetBankList($data)
    {

        $tranx = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->publicKey,
            'Content-Type' => 'application/json',
        ])->get($this->url . '/country/' . $data . '/financial-institutions');
        $collection = $tranx->json();
        return $collection;
    }

    /**
     * Undocumented function
     *
     * @param object $data
     * @param array $cry
     * @param string $has
     * @return void
     */
    public function Charge($data, $cry = [], $has = '')
    {
        $encdata = $this->Encrypt(json_encode($data), $cry);
        if ($encdata) {
            $postData = $has ? ['payload' => $encdata, 'alg' => $has] : ['payload' => $encdata];
            $tranx = Http::withHeaders([
                'Authorization' =>  'Bearer ' . ($cry['public_key'] ?? $this->publicKey),
                'Content-Type' => 'application/json',
            ])->post($this->url . '/payment/charge', $postData);
            $collection = $tranx->json();
            return $collection;
        }
        return ['Error' => 'unknow'];
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function PaymentInitiate($data)
    {

        $tranx = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->publicKey,
            'Content-Type' => 'application/json',
        ])->post($this->url . '/payment/initiate', $data);
        $collection = $tranx->json();
        return $collection;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function GetFee($data)
    {

        $tranx = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->publicKey,
            'Content-Type' => 'application/json',
        ])->post($this->url . '/payment/fees', $data);
        $collection = $tranx->json();
        return $collection;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param object $cry
     * @return void
     */
    public function OtherMethods($data)
    {
        $keyType0 = $data['keyType'] ?? null;
        $keyType = $this->$keyType0  ?? null;
        $rtype = $data['requestType']  ?? null;
        $path = $data['path'];
        $mainData = $data['mainData']  ?? null;
        $otherheader = $data['header']  ?? null;
        $beaRer = $data['beaRer']  ?? null;
        $tranx = Http::withHeaders([
            'Authorization' => $beaRer ?? 'Bearer ' . $keyType,
            'Content-Type' => 'application/json',
            $otherheader
        ])->$rtype($this->url . $path, $mainData);
        $collection = $tranx->json();
        return $collection;
    }
}
