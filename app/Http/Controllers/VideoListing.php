<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Promotions;
use App\Models\VideoList;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class VideoListing extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function videoList(Request $request){
        $page = request()->page;
        $videos = DB::table('video_listing')->orderBy('id', 'desc');
        // dd($promotion);
        $videoData = $videos->simplePaginate(1000, ['*'], 'page', $page);
        $params = $request->all();
        $params['page'] = $page;

        return view('videoList', ['videoDatas' => $videoData, 'params' => $params]);
    }

    public function updateVideoStatus(Request $request){

        $gameData = DB::table('video_listing')->where('id', $request->id)->orderBy('id', 'desc')->first();
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

    public function  createVideo(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(),  [
                'title' => 'required',
                // 'image' => 'required',
                'url' => 'required',
                'video_url' => 'required',
            ]);
            
            if ($validator->fails()) {
                if (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") {
                    return redirect()->to('createVideo?type=edit&id=' . $request->id . '')
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect('createVideo')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            File::ensureDirectoryExists(public_path('images/video'));

            if (!empty($request->image)) {
                $imageName = time() . 'video.' . $request->image->extension();
                $request->image->move(public_path('images/video'), $imageName);
                $path =  $imageName;
            }

            if (!empty($request->editType) && $request->editType == "edit") {
                $videoData = DB::table('video_listing')->where('id', $request->id)->orderBy('id', 'desc')->first();

                if(empty($path)){
                    $path = $videoData->banner;
                }

                $videoData = [
                    'title' => $request->title,
                    'desc' => $request->desc,
                    'banner' => $path ?? "",
                    'url' => $request->url,
                    'video_url' => $request->video_url,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            } else {
                $videoData = [
                    'title' => $request->title,
                    'desc' => $request->desc,
                    'banner' => $path ?? "",
                    'url' => $request->url,
                    'video_url' => $request->video_url,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }


            if (empty($request->editType)) {
                $creteVideo = VideoList::create($videoData);
                if ($creteVideo) {
                    return redirect()->back()->withSuccess('Successfully Created !');
                } else {
                    return view('addVideo');
                }
            } elseif (!empty($request->editType) && !empty($request->id) && $request->editType == "edit") { //edit section
                $updateVideo = VideoList::where('id', $request->id)->update($videoData);
                if ($updateVideo) {
                    return redirect()->back()->withSuccess('Successfully Update !');
                } else {
                    return view('addVideo');
                }
            }
        } else {
            if (!empty($request->type) && $request->type == "edit") {
                $videoData = DB::table('video_listing')->where('id', $request->id)->orderBy('id', 'desc')->first();
                return view('addVideo', ['videoData' => $videoData, 'type' => $request->type]);
            } else {
                return view('addVideo');
            }
        }
    }
}
