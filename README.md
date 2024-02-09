# This is Riwash Esewa V2 Payment Integration Package For Laravel

## This package allow you to use esewa v2 for payment gateway

**Note:Deffine this thing in env file**

- ESEWA_ACCESS_TYPE = Live ** select one Live or Test **
- ESEWA_MERCHANT_ID = your secret key
- ESEWA_PROD_CODE = your production code
- ESEWA_SUCCESS_URL = after payment success call back url
- ESEWA_FAIL_URL = if payment is failed call back url

**After That**

### Make Controller

use Riwash\Esewa\RiwashEsewa;

```

  <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Riwash\Esewa\RiwashEsewa;
use Illuminate\Support\Facades\Http;

class PaymentTestController extends Controller
{
    public function esewa()
    {
        $tuid = now()->timestamp;
        $data = [
            "amount" => "100",
            "product_delivery_charge" => "0",
            "product_service_charge" => "0",
            "product_code" => "EPAYTEST",
            "tax_amount" => "10",
            "total_amount" => "110",
            "transaction_uuid" => $tuid
        ];

        $payment = new RiwashEsewa();

        return $payment->esewaCheckout($data);

    }
    public function success(Request $request)
    {
        //write your after payment success  code here
        dd($request->all());
    }

    public function fail(Request $request)
    {
        // write if payment failed response here
        dd($request->all());

    }

}
```

This much
**If you get any issue or bug then create issue from here [https://github.com/riwash/Riwash-Esewa-Payment-gateway-Laravel-Package/issues](https://github.com/riwash/Riwash-Esewa-Payment-gateway-Laravel-Package/issues)**
