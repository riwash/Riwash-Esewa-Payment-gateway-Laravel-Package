<?php
namespace Riwash\Esewa;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class RiwashEsewa
{
    private $merchant_id;
    private $accessType;
    private $proCode;

    public function __construct()
    {
        $this->merchant_id = config('riwashesewa.secret_key');
        $this->accessType = config('riwashesewa.access_type');
        $this->proCode = config('riwashesewa.prod_code');
    }

    public function esewaCheckout($data)
    {
        if ($this->accessType == "Test") {
            $esewa_url = config('riwashesewa.test_esewa_url');
        } elseif ($this->accessType == "Live") {
            $esewa_url = config('riwashesewa.live_esewa_url');
        } else {
            throw new \Exception("Please write access type (Test or Live)");
        }

        if (!$this->merchant_id) {

            throw new \Exception("Please Enter Merchant Id");
        }

        try {

            $amount = $data['total_amount'];
            $transaction_uuid = $data['transaction_uuid'];
            $message = "total_amount=$amount,transaction_uuid=$transaction_uuid,product_code=$this->proCode";
            $s = hash_hmac('sha256', $message, config('riwashesewa.secret_key'), true);
            $signature = base64_encode($s);
            $data = [
                "amount" => $data['amount'],
                "failure_url" => route('esewa.fail'),
                "product_delivery_charge" => $data['product_delivery_charge'],
                "product_service_charge" => $data['product_service_charge'],
                "product_code" => "EPAYTEST",
                "signed_field_names" => "total_amount,transaction_uuid,product_code",
                "success_url" => route('esewa.success'),
                "tax_amount" => $data['tax_amount'],
                "total_amount" => $data['total_amount'],
                "transaction_uuid" => $data['transaction_uuid'],
                "signature" => $signature,

            ];
            $sendUrl = $esewa_url . http_build_query($data);
            $response = Http::post($sendUrl);

            if ($response->successful()) {
                $redirectUrl = $response->handlerStats()['url'];

                return redirect()->away($redirectUrl);

            } else {

                return $response->body();
            }

        } catch (\Exception $e) {

            return $e;
        }

    }
}
