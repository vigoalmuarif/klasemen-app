<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Standings;
use App\Models\Versus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VersusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Versus::with('matchHome', 'matchAway')->orderBy('id', 'desc')->get();
        // dd($matches);
        return view('match.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::orderBy('name', 'asc')->get();
        return view('match.create', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //proses validasi data array
        $validator = Validator::make(request()->all(), [
            'klub.*.home' => 'required|distinct|different:klub.*.away|'. Rule::unique('matches', 'home_club_id')->where(function ($query) {
                return $query->where('home_club_id', request('klub.*.home'))->where('away_club_id', request('klub.*.away'));
            }),
            'klub.*.away' => 'required|distinct',
            'klub.*.score-home' => 'required|numeric',
            'klub.*.score-away' => 'required|numeric',
        ], [
            'klub.*.home.unique' => 'Klub sudah pernah bertanding di Home atau di Away atau keduanya',
            'klub.*.home.required' => 'Harap Pilih Klub Home',
            'klub.*.home.distinct' => 'Terdapat Klub Home yang duplikat',
            'klub.*.home.different' => 'Tidak diperbolehkan melawan dengan klubnya Sendiri',
            'klub.*.away.distinct' => 'Terdapat Klub Away yang duplikat',
            'klub.*.away.required' => 'Harap pilih klub Away',
            'klub.*.score-home.required' => 'Harap masukan skor klub Home',
            'klub.*.score-home.numeric' => 'Skor harus berupa angka',
            'klub.*.score-away.numeric' => 'Skor harus berupa angka',
            'klub.*.score-away.required' => 'Harap masukan skor klub Away',
        ]);

        if ($validator->fails()) { //jika validasi gagal
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $data = $request->all(); //mengambil data request
        foreach ($data['klub'] as $item) { //melakukan looping pada data yang ada di request
            $values[] = [
                'home_club_id' => $item['home'],
                'away_club_id' => $item['away'],
                'home_score' => $item['score-home'],
                'away_score' => $item['score-away'],
                'created_at'    => now()
            ];


            //pengkondisian untuk update klasemen pada Klub Home
            if (Standings::where('club_id', $item['home'])->exists()) {  //jika klub sudah pernah bermain
                $standings = Standings::where('club_id', $item['home'])->first(); //maka ambil datanya dari standing/klasemen. setelah itu dikalkulasi dengan penambahan poin terbaru.
                if ($item['score-home'] > $item['score-away']) {    //jika skor home lebih besar dari skor away
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->points = $standings->points + 3;
                    $standings->wins = $standings->wins + 1;
                    $standings->goals_wins = $standings->goals_wins + $item['score-home'];
                    $standings->updated_at = now();
                    $standings->save();
                } elseif ($item['score-home'] == $item['score-away']) { //jika skor home sama dengan skor away
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->points = $standings->points + 1;
                    $standings->draws = $standings->draws + 1;
                    $standings->updated_at = now();
                    $standings->save();
                } else { //jika skor home kurang dari skor away
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->losses = $standings->losses + 1;
                    $standings->goals_losses = $standings->goals_losses + $item['score-home'];
                    $standings->updated_at = now();
                    $standings->save();
                }
            } elseif ($item['score-home'] > $item['score-away']) { //jika klub belum pernah bermain, dan skor home lebih besar dari skor away
                Standings::insert([
                    'club_id' => $item['home'],
                    'playing_games' => 1,
                    'points' => 3,
                    'wins' => 1,
                    'draws' => 0,
                    'losses' => 0,
                    'goals_losses' => 0,
                    'goals_wins' => $item['score-home'],
                    'created_at'    => now()
                ]);
            } elseif ($item['score-home'] == $item['score-away']) { //jika klub belum pernah bermain, dan skor home sama dengan dari skor away
                Standings::insert([
                    'club_id' => $item['home'],
                    'playing_games' => 1,
                    'points' => 1,
                    'wins' => 0,
                    'draws' => 1,
                    'losses' => 0,
                    'goals_losses' => 0,
                    'goals_wins' => 0,
                    'created_at'    => now()
                ]);
            } else {        //jika klub belum pernah bermain, dan skor home lebih kecil dari skor away
                Standings::insert([
                    'club_id' => $item['home'],
                    'playing_games' => 1,
                    'points' => 0,
                    'wins' => 0,
                    'draws' => 0,
                    'losses' => 1,
                    'goals_losses' => $item['score-away'],
                    'goals_wins' => 0,
                    'created_at'    => now()
                ]);
            }


            //pengkondisian untuk update klasemen pada Klub Away
            if (Standings::where('club_id', $item['away'])->exists()) {  //jika klub Away sudah pernah bermain
                $standings = Standings::where('club_id', $item['away'])->first();
                if ($item['score-away'] > $item['score-home']) { //jika skor away lebih besar dari skor home
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->points = $standings->points + 3;
                    $standings->wins = $standings->wins + 1;
                    $standings->goals_wins = $standings->goals_wins + $item['score-home'];
                    $standings->updated_at = now();
                    $standings->save();
                } elseif ($item['score-away'] == $item['score-home']) { //jika skor away sama dengan skor home
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->points = $standings->points + 1;
                    $standings->draws = $standings->draws + 1;
                    $standings->updated_at = now();
                    $standings->save();
                } else {    //jika skor away kurang dari skor home
                    $standings->playing_games = $standings->playing_games + 1;
                    $standings->losses = $standings->losses + 1;
                    $standings->goals_losses = $standings->goals_losses + $item['score-home'];
                    $standings->updated_at = now();
                    $standings->save();
                }
            } elseif ($item['score-away'] > $item['score-home']) { //jika klub belum pernah bermain, dan skor away lebih besar dari skor home
                Standings::insert([
                    'club_id' => $item['away'],
                    'playing_games' => 1,
                    'points' => 3,
                    'wins' => 1,
                    'draws' => 0,
                    'losses' => 0,
                    'goals_losses' => 0,
                    'goals_wins' => $item['score-away'],
                    'created_at'    => now()
                ]);
            } elseif ($item['score-home'] == $item['score-away']) { //jika klub belum pernah bermain, dan skor home sama dengan dari skor away
                Standings::insert([
                    'club_id' => $item['away'],
                    'playing_games' => 1,
                    'points' => 1,
                    'wins' => 0,
                    'draws' => 1,
                    'losses' => 0,
                    'goals_losses' => 0,
                    'goals_wins' => 0,
                    'created_at'  => now()
                ]);
            } else {        //jika klub belum pernah bermain, dan skor away kurang dari skor home
                Standings::insert([
                    'club_id' => $item['away'],
                    'playing_games' => 1,
                    'points' => 0,
                    'wins' => 0,
                    'draws' => 0,
                    'losses' => 1,
                    'goals_losses' => $item['score-home'],
                    'goals_wins' => 0,
                    'created_at'    => now()
                ]);
            }
        }

        Versus::insert($values); //create match

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Versus $versus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Versus $versus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Versus $versus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Versus $versus)
    {
        //
    }
}
