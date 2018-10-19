<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
   public function index (Request $request) {
     $user_ip = '192.168.43.1';
     $apikey = env('API_KEY');

     // // Get city name from ip request
     // $details = json_decode(file_get_contents("https://ipinfo.io/{$user_ip}/json"));
     // $city_name = $details->city;
     $city_name = 'hanoi';

     // Get city key
     $loc_details = json_decode(file_get_contents("http://dataservice.accuweather.com/locations/v1/cities/search?q={$city_name}&apikey={$apikey}"));
     $loc_key = $loc_details[0]->Key;
     $weather_details = json_decode(file_get_contents("http://dataservice.accuweather.com/forecasts/v1/daily/5day/{$loc_key}?apikey={$apikey}"))->DailyForecasts;
     $weather_forecasts = array_map(function ($detail) {
       $minTemp = $this->convertFtoC($detail->Temperature->Minimum->Value);
       $maxTemp = $this->convertFtoC($detail->Temperature->Maximum->Value);
       return [
        'date' => $this->dateFormat($detail->Date),
        'min' => $minTemp,
        'max' => $maxTemp,
        'average' => round(($maxTemp + $minTemp) / 2),
        'day'=> $detail->Day->IconPhrase,
        'icon' => $detail->Day->Icon
       ];
     }, $weather_details);
     return view('index', compact('weather_forecasts'));
   }

   private function convertFtoC ($degreeInF) {
     return round(($degreeInF - 32) * 5 / 9);
   }

   private function dateFormat ($date) {
     return Carbon::parse($date)->format('l') . '<br>' . Carbon::parse($date)->format('d/m');
   }
}
