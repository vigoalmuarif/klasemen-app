<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    
    public function provinces()
    {
        if (request()->ajax()) {
            $params = request()->q;
            $req =  Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            $collect = collect(json_decode($req, true));
            $data = $collect->filter(function ($item) use ($params) {
                return stripos($item['name'], $params) !== false;
            });
            
            return response()->json($data);
        }
    }

    public function regencies()
    {
        
        if (request()->ajax()) {
            $params = request()->query('search');
            $id = request()->query('id');
            $req =  Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/regencies/' . $id . '.json');
            $collect = collect(json_decode($req, true));
            $data = $collect->filter(function ($item) use ($params) {
                return stripos($item['name'], $params) !== false;
            });
            
            return response()->json($data);
        }
    }

   
}
