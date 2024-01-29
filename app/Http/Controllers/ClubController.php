<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clubs = Club::orderBy('created_at', 'desc')->get();
        return view('club.index', compact('clubs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (request()->ajax()) {
            $req = request();
            $validator  = Validator::make(
                request()->all(),
                [
                    'name' =>  [
                        'required', Rule::unique('clubs', 'name')->where(function ($q) use ($req) {
                            return $q->where('regency_id', $req->kota);
                        }),
                    ],
                    'provinsi' =>  'required',
                    'kota' =>  'required'

                ],
                [
                    'name.required' => 'Harap isi nama klub',
                    'name.unique' => 'Nama klub sudah terdaftar pada kota tersebut.',
                    'provinsi.required' => 'Harap pilih provinsi',
                    'kota.required' => 'Harap pilih kota/Kabupaten',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'data' => $validator->errors()
                ]);
            }

            $data = Club::create([
                'name' => $request->name,
                'province_id' => $request->provinsi,
                'regency_id' => $request->kota,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => [
                    'name' => $data->name,
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Club $club)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Club $club)
    {
        //
    }
}
