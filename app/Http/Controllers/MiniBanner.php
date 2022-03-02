<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Promotions;
use App\Models\Banner;
use App\Models\Heading;
use DB;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MiniBanner extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bannerList(Request $request){
        $page = request()->page;
        $banners = DB::table('mini_banner')->orderBy('id', 'desc');
        // dd($promotion);
        $bannerdata = $banners->simplePaginate(1000, ['*'], 'page', $page);
        $params = $request->all();
        $params['page'] = $page;

        return view('bannerList', ['bannerDatas' => $bannerdata, 'params' => $params]);
    }

    public function updateGameStatus(Request $request){

        $gameData = DB::table('mini_banner')->where('id', $request->id)->orderBy('id', 'desc')->first();
        if($gameData->status==1){
            $status=2;
        }else if($gameData->status==2){
            $status=1;
        }else{
            $status=3;
        }

        $updateOffer = Banner::where('id', $request->id)->update(['status' =>$status]);
        return $updateOffer;
    }

    public function createBanner(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),  [
                'name' => 'required',
                // 'image' => 'required',
                'url' => 'required',
            ]);

            if ($validator->fails()) {
                if (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") {
                    return redirect()->to('createBanner?type=edit&id=' . $request->id . '')
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect('createBanner')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            File::ensureDirectoryExists(public_path('images/banners'));

            if (!empty($request->image)) {
                $imageName = time() . 'banners.' . $request->image->extension();
                $request->image->move(public_path('images/banners'), $imageName);
                $path =  $imageName;
            }

            if (!empty($request->editType) && $request->editType == "edit") {
                $gameData = DB::table('mini_banner')->where('id', $request->id)->orderBy('id', 'desc')->first();

                if(empty($path)){
                    $path = $gameData->THUMBNAIL;
                }

                $gameData = [
                    'HEADING' => $request->name,
                    'THUMBNAIL' => $path ?? "",
                    'ACTION_URL' => $request->url,
                    'STATUS' => 1,
                    'CREATED_ON' => date('Y-m-d H:i:s'),
                ];
            } else {
                $gameData = [
                    'HEADING' => $request->name,
                    'THUMBNAIL' => $path ?? "",
                    'ACTION_URL' => $request->url,
                    'STATUS' => 1,
                    'CREATED_ON' => date('Y-m-d H:i:s'),
                ];
            }


            if (empty($request->editType)) {
                $creteOffer = Banner::create($gameData);
                if ($creteOffer) {
                    return redirect()->back()->withSuccess('Successfully Created !');
                } else {
                    return view('createBanner');
                }
            } elseif (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") { //edit section
                $updateOffer = Banner::where('id', $request->id)->update($gameData);
                if ($updateOffer) {
                    return redirect()->back()->withSuccess('Successfully Update !');
                } else {
                    return view('createBanner');
                }
            }
        } else {
            if (!empty($request->type) && $request->type == "edit") {
                $gameData = DB::table('mini_banner')->where('id', $request->id)->orderBy('id', 'desc')->first();
                return view('createBanner', ['gameData' => $gameData, 'type' => $request->type]);
            } else {
                return view('createBanner');
            }
        }
    }
    public function createPopup(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),  [
                'name' => 'required',
                'message' => 'required',
                'url' => 'required',
            ]);

            if ($validator->fails()) {
                if (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") {
                    return redirect()->to('createBanner?type=edit&id=' . $request->id . '')
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect('createBanner')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            File::ensureDirectoryExists(public_path('images/popup'));
           
            if (!empty($request->image)) {
                $imageName = time() . 'popup.' . $request->image->extension();
                $request->image->move(public_path('images/popup'), $imageName);
                $path =  $imageName;
            }

            $gameData = DB::table('headings')->where('id', $request->id)->first();

            if(empty($path)){
                $path = $gameData->THUMBNAIL;
            }
            
            $gameData = [
                'HEADING' => $request->name,
                'MESSAGE' => $request->message,
                'THUMBNAIL' => $path ?? "",
                'ACTION_URL' => $request->url,
                'STATUS' => $request->status,
                'IS_BUTTON' => $request->is_botton,
                'CREATED_ON' => date('Y-m-d H:i:s'),
            ];

            if (empty($request->editType)) {
                $creteOffer = Heading::create($gameData);
                if ($creteOffer) {
                    return redirect()->back()->withSuccess('Successfully Created !');
                } else {
                    return view('createPopup');
                }
            } elseif (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") { //edit section
                $updateOffer = Heading::where('id', $request->id)->update($gameData);
                if ($updateOffer) {
                    return redirect()->back()->withSuccess('Successfully Update !');
                } else {
                    return view('createPopup');
                }
            }
        } else {
            $gameData = DB::table('headings')->first();
            $paramData['gameData'] = $gameData;
            // dd($paramData);
            if(!empty($gameData)){
                $paramData['type'] = 'edit';
            }

            return view('createPopup', $paramData);
            
        }
    }
}
