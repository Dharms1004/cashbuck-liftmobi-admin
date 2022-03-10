<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Promotions;
use App\Models\Game;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class Games extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gameList(Request $request){
        $page = request()->page;
        $games = DB::table('games')->orderBy('id', 'desc');
    
        $gamedata = $games->simplePaginate(1000, ['*'], 'page', $page);
        $params = $request->all();
        $params['page'] = $page;

        return view('gameList', ['gamedata' => $gamedata, 'params' => $params]);
    }

    public function updateGameStatus(Request $request){

        $gameData = DB::table('games')->where('id', $request->id)->orderBy('id', 'desc')->first();
        if($gameData->status==1){
            $status=2;
        }else if($gameData->status==2){
            $status=1;
        }else{
            $status=3;
        }

        $updateOffer = Game::where('id', $request->id)->update(['status' =>$status]);
        return $updateOffer;
    }

    public function makeReccomendedGame(Request $request){

        $gameData = DB::table('games')->where('id', $request->id)->first();
        if($gameData->is_reccomended==1){
            $status=0;
        }else if($gameData->is_reccomended==0){
            $status=1;
        }

        $updateOffer = Game::where('id', $request->id)->update(['is_reccomended' =>$status]);
        return $updateOffer;
    }

    public function  createGame(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),  [
                'name' => 'required',
                // 'image' => 'required',
                'url' => 'required',
            ]);

            if ($validator->fails()) {
                if (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") {
                    return redirect()->to('createGame?type=edit&id=' . $request->id . '')
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect('createGame')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            if (!empty($request->image)) {
                $imageName = time() . 'game.' . $request->image->extension();
                $request->image->move(public_path('images/games'), $imageName);
                $path =  $imageName;
            }

            if (!empty($request->editType) && $request->editType == "edit") {
                $gameData = DB::table('games')->where('id', $request->id)->orderBy('id', 'desc')->first();

                if(empty($path)){
                    $path = $gameData->image;
                }

                $gameData = [
                    'name' => $request->name,
                    'image' => $path ?? "",
                    'url' => $request->url,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            } else {
                $gameData = [
                    'name' => $request->name,
                    'image' => $path ?? "",
                    'url' => $request->url,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }


            if (empty($request->editType)) {
                $creteOffer = Game::create($gameData);
                if ($creteOffer) {
                    return redirect()->back()->withSuccess('Successfully Created !');
                } else {
                    return view('createGames');
                }
            } elseif (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") { //edit section
                $updateOffer = Game::where('id', $request->id)->update($gameData);
                if ($updateOffer) {
                    return redirect()->back()->withSuccess('Successfully Update !');
                } else {
                    return view('createGames');
                }
            }
        } else {
            if (!empty($request->type) && $request->type == "edit") {
                $gameData = DB::table('games')->where('id', $request->id)->orderBy('id', 'desc')->first();
                return view('createGames', ['gameData' => $gameData, 'type' => $request->type]);
            } else {
                return view('createGames');
            }
        }
    }
}
