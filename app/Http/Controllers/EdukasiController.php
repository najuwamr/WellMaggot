<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function CancelOrder($request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-sandbox.collaborator.komerce.id/order/api/v1/orders/cancel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
  "order_no": "KOM20230607178649"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ENV.'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
