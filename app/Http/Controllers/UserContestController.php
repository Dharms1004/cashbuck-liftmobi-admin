<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\ContestQuestions;
use Auth;
use Carbon\Carbon;

class UserContestController extends Controller
{

    function index(request $request){
        $Data['contest'] = [];
        $result = Contest::query();
        $Data['contestDatas'] = $result->orderBy('CONTEST_ID','desc')->get();

        return view('contest.manage-contest',$Data);
    }

    function createcontest(request $request){
        if($request->all()){
            $activeContest = $this->getContestWhere($where=['CONTEST_STATUS' => 1]);
            if(!$activeContest){
                $des = $request->validate([
                    'contest_name' => 'required|max:100',
                    'contest_title' => 'required|max:100',
                    'contest_description' => 'max:250',
                    "contest_image_link"	=> 'required|mimes:jpeg,JPEG,jpg,png,PNG'
                ]);

                if (!empty($request->contest_image_link)) {
                    $imageName = time() . 'contest.' . $request->contest_image_link->extension();
                    $request->contest_image_link->move(public_path('images/contest'), $imageName);
                    $path =  $imageName;
                }

                $data = [
                    'CONTEST_NAME' => $request->contest_name,
                    'CONTEST_TITLE' => $request->contest_title,
                    'CONTEST_DESCRIPTION' => $request->contest_description,
                    'CONTEST_IMAGE_LINK' => $path,
                    'CONTEST_TERMS_CONDITIONS' => $request->contest_terms_conditions,
                    'CONTEST_STATUS' =>'1',
                    'CREATED_BY' => "Admin"
                ];
                $result = $this->insertContest($data);
                if($result){
                    return back()->with('success','Contest  added successfully');
                } else {
                    return back()->with('error','Contest  added failed');
                }
            }else{
                return back()->with('error','Please make sure all contests inactive')->withInput();
            }
        }
        return view('contest.create-contest');
    }

    function getS3BucketImage($request){
        if($request->hasFile('contest_image_link')){
            $file = $request->file('contest_image_link');
            $filePath = 'pb-contests/';
            $hasFile = $request->hasFile('contest_image_link');
            $allowedFormats = array("Jpeg", "jpeg", "JPEG", "JPG", "jpg", "png", "PNG");
            $fileUploadUrl = $this->s3FileUpload($file,$filePath,$allowedFormats,$hasFile);
            if($fileUploadUrl){
                return $fileUploadUrl->url;
            }
        }
    }

    function edit_contest(request $request){
        if($request->route('id')){
            $result['contestData'] = $this->getContestWhere($where = ['CONTEST_ID'=>$request->route('id')]);
        };
        return view('contest.edit-contest',$result);
    }

    function update_contest(request $request,$id){
        try{
            if($id){
                $request->validate([
                    'contest_name' => 'required|max:100',
                    'contest_title' => 'required|max:100',
                    'contest_description' => 'max:250',
                ]);
                $imageurl = $this->getS3BucketImage($request);
                $data = [
                    'CONTEST_NAME' => $request->contest_name,
                    'CONTEST_TITLE' => $request->contest_title,
                    'CONTEST_DESCRIPTION' => $request->contest_description,
                    'CONTEST_VIDEO_URL' => $request->contest_video_url,
                    'CONTEST_VIDEO_DESCRIPTION' => $request->contest_video_description,
                    'CONTEST_TERMS_CONDITIONS' => $request->contest_terms_conditions,
                    'CONTEST_STATUS' => $request->contest_status,
                    'UPDATED_BY' => "Admin"
                ];
                if($imageurl){
                    $data['CONTEST_IMAGE_LINK'] = $imageurl;
                }
                $this->updateCommon($id, $data);
                return back()->with('success','Contest updated successfully');
            }
        }catch(\Exception $e){
            dd($e);
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    function updateCommon($contest_id, $edit_data){
        return Contest::where('CONTEST_ID',$contest_id)
		->update($edit_data);
    }

    function insertContest($data){
        $data = new Contest($data);
        return $data->save();
    }

    function getContestWhere($where){
        return Contest::where($where)->first();
    }

    function getimageUrl($where){
        return Contest::select('CONTEST_IMAGE_LINK')->where($where)->first();
    }

    function getContestModelData(request $request){
        $result = $this->getContestWhere($where = ['CONTEST_ID' => $request->CONTEST_ID]);
        return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
    }

    function updateStatus(request $request){
        if($request->CONTEST_ID){
            $activeContest = $this->getContestWhere($where=['CONTEST_STATUS' => 1]);
            $admin_username = "Admin";
            if($request->STATUS == 1){
                if(!$activeContest){
                    $result = $this->updateCommon($request->CONTEST_ID, $edit_data=['CONTEST_STATUS'=>$request->STATUS,'UPDATED_BY' => $admin_username]);
                    $this->updateContestQuestion($request->CONTEST_ID, $edit_data=['QUESTION_STATUS'=>$request->STATUS,'UPDATED_BY' => $admin_username]);
                    return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
                }else{
                    return response()->json(['status'=>302, 'message'=>'Only one contest active at time', 'data'=>'']);
                }
            } else{
                $result = $this->updateCommon($request->CONTEST_ID, $edit_data=['CONTEST_STATUS'=>$request->STATUS,'UPDATED_BY' => $admin_username]);
                $this->updateContestQuestion($request->CONTEST_ID, $edit_data=['QUESTION_STATUS'=>$request->STATUS,'UPDATED_BY' => $admin_username]);
                return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
            }
        }
    }

    function updateContestQuestion($contest_id, $edit_data){
        return ContestQuestions::where('CONTEST_ID',$contest_id)->update($edit_data);
    }
}
