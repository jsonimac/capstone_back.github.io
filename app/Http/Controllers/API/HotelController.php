<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'hotel'=>'required|max:191|unique:hotels,name',
            'address'=>'required|max:191',
            'phone'=>'required|max:16',
            'lat'=>'required|max:9',
            'lang'=>'required|max:9',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $hotel = new Hotel;
            $hotel->name = $request->input('hotel');
            $hotel->address = $request->input('address');
            $hotel->contact = $request->input('phone');
            $hotel->latitude = $request->input('lat');
            $hotel->longitude = $request->input('lang');
            $hotel->description = $request->input('description');
            $hotel->save();
            return response()->json([
                'status' => 200,
                'message' => 'Registered Successfully'
            ]);

        }
    }
    public function index(){
        $hotel = Hotel::all();
        return response()->json([
            'status' => 200,
            'hotel' => $hotel
        ]);
    }
}
