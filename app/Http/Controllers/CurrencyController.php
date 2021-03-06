<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use carbon\Carbon;

class CurrencyController extends Controller
{

    public function index() {

     return view('currency');
    }

    public function exchangeCurrency(Request $request) {

      $amount = ($request->amount)?($request->amount):(1);

      $apikey = '5a8cbd94a33eef4fbb20';

      $from_Currency = urlencode($request->from_currency);
      $to_Currency = urlencode($request->to_currency);
      $query =  "{$from_Currency}_{$to_Currency}";

      $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

      $obj = json_decode($json, true);

      $val = $obj["$query"];

      $formatValue = number_format($val, 2, '.', '');

      $data = "$amount $from_Currency = $to_Currency $formatValue";

      echo $data; die;

   }

}
