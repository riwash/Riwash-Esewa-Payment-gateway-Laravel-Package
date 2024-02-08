<?php
namespace Riwash\Esewa;

use Illuminate\Support\Facades\Config;

class RiwashEsewa
{
    private $merchant_id;
    private $accessType;

    public function __construct()
    {
        $this->merchant_id = config('riwashesewa.secret_key');
        $this->accessType = config('riwashesewa.access_type');
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

        $data['tAmt'] = $data['amt'] + $data['pdc'] + $data['psc'] + $data['txAmt'];

        $data['scd'] = $this->merchant_id;

        try {

            $url = $esewa_url . http_build_query($data);

            return $url;

        } catch (\Exception $e) {

            throw new \Exception('Oops something is happen !');
        }

    }
}