<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalculateController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function save(Request $request)
    {
        $p_name = $request->product;
        $quantity = $request->quantity;
        $price = $request->price;
        $total_value = $quantity * $price;
        $date = date('d M Y H:i:s');
        try {
            $productInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];

            $data = ['product_name'=>$p_name, 'quantity'=>$quantity, 'price'=>$price, 'total_value' =>$total_value];

            $data['datetime_submitted'] = $date;

            array_push($productInfo,$data);

            Storage::disk('local')->put('data.json', json_encode($productInfo));

            $newdata = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
            $allvalue = 0;
            foreach ($newdata as $item){
                $allvalue = $allvalue + $item->total_value;
            }
            $data = [$allvalue, $newdata];
            return $data;

        } catch(\Exception $e) {

            return ['error' => true, 'message' => $e->getMessage()];

        }

    }

    public function get()
    {
        try {
            $newdata = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
            $allvalue = 0;
            foreach ($newdata as $item){
                $allvalue = $allvalue + $item->total_value;
            }
            $data = [$allvalue, $newdata];
            return $data;

        } catch(\Exception $e) {

            return ['error' => true, 'message' => $e->getMessage()];

        }

    }
}
