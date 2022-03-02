<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\ContestQuestions;
use App\Models\ContestParticipants;
use Carbon\Carbon;
use Session;
// use Maatwebsite\Excel\Exporter;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\CollectionExport;
// use Validator;
// use Redirect;
use Auth;
use DB;

class ManageQuestionController extends Controller
{
    function index(request $request){
        $result = ContestQuestions::query();
        $data['search_questions'] = $result->leftJoin('contest', 'contest.CONTEST_ID', '=', 'contest_questions.CONTEST_ID')->orderBy('contest_questions.QUESTION_ID','desc')->get();

        return view('contest.manage-questions',$data);
    }


    function create_questions(){
        $result['contestname'] = $this->getContest();
        return view('contest.create-question',$result);
    }

    function getContest(){
        return Contest::select('CONTEST_ID','CONTEST_NAME')->where('CONTEST_STATUS',1)->get();
    }

    function getContestTitle(request $request){
        $result = Contest::select('CONTEST_TITLE')->where('CONTEST_ID',$request->CONTEST_ID)->first();
        return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);

    }

    function matchQuestionContestId($where){
        return ContestQuestions::where($where)->first();
    }

    function insert_ques(request $request){
        $this->validate($request, [
            'contest_name' => 'required',
            'contest_title' => 'required',
            'ques1.*' => 'required',
            'ques2.*' => 'required',
            'ques3.*' => 'required',
        ]);
        $ques1['CONTEST_ID'] = $request->contest_name;
        $ques2['CONTEST_ID'] =$request->contest_name;
        $ques3['CONTEST_ID'] =$request->contest_name;

        $insertdata = array(array_merge($ques1,$request->ques1),array_merge($ques2,$request->ques2),array_merge($ques3,$request->ques3));
        $matchContestId = $this->matchQuestionContestId($where=['CONTEST_ID'=>$request->contest_name]);
        if(!$matchContestId){
            foreach($insertdata as $quesData){
                $data = $quesData;
                $data['QUESTION_STATUS'] = 1;
                $data['CREATED_BY'] = "Admin";
                $data['CREATED_ON'] = date('Y-m-d H:i:s');
                $quesdata[] = $data;
            }
            $result = ContestQuestions::insert($quesdata);
            if($result){
                return back()->with('success','Question Insert Successfully!');
            }else{
                return back()->with('error','Question Insertion Failed')->withInput();
            }
        }else{
            return back()->with('error','This Contest is already exist')->withInput();
        }

    }


    function updateQuesStatus(request $request){
        if($request->QUESTION_ID){
            $result = $this->updateCommon($request->QUESTION_ID, $edit_data=['QUESTION_STATUS'=>$request->status,'UPDATED_BY' => Auth::user()->username]);
            if($result){
                return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
            } else {
                return response()->json(['status'=>201, 'message'=>'error', 'data'=>'']);
            }
        }
    }

    function updateCommon($QUESTION_ID, $edit_data){
        return ContestQuestions::where('QUESTION_ID',$QUESTION_ID)
		->update($edit_data);
    }

    function getQuestionModelData(request $request){
        $result = $this->getQuestionWhere($where = ['QUESTION_ID' => $request->QUESTION_ID]);
        return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
    }

    function getQuestionWhere($where){
        return ContestQuestions::select('contest_questions.QUESTION_ID','contest_questions.QUESTION','contest_questions.OPTION_A','contest_questions.OPTION_B','contest_questions.OPTION_C','contest_questions.OPTION_D','contest_questions.QUESTION_STATUS','contest_questions.CREATED_BY','contest_questions.UPDATED_BY','contest_questions.CREATED_ON','contest_questions.UPDATE_ON','contest.CONTEST_NAME','contest.CONTEST_TITLE')->where($where)->leftJoin('contest', 'contest.CONTEST_ID', '=', 'contest_questions.CONTEST_ID')->first();
    }

    function updatequestion(request $request){
        $result = $this->updateCommon($QUESTION_ID=$request->edit_question_id, $edit_data=[
            'QUESTION' => $request->question_edit,
            'OPTION_A' => $request->option_a_edit,
            'OPTION_B' => $request->option_b_edit,
            'OPTION_C' => $request->option_c_edit,
            'OPTION_D' => $request->option_d_edit,
            'UPDATED_BY' => "Admin"
        ]);
        if($result){
            return response()->json(['status'=>200, 'message'=>'success', 'data'=>$result]);
        } else {
            return response()->json(['status'=>201, 'message'=>'error', 'data'=>'']);
        }
    }

    function viewparticipants(request $request){
        $data['viewparticipants'] = [];
        if($request->all()){
            $result = ContestParticipants::query();
            if (!empty($request->contest_name)) {
                $result = $result->where('contest_participants.CONTEST_ID', $request->contest_name);
            }
            if (!empty($request->contest_title)) {
               $result = $result->where('contest_participants.CONTEST_ID', $request->contest_title);
            }
            if (!empty($request->date_from)) {
                $date_from = Carbon::parse($request->date_from);
                $result = $result->whereDate('contest_participants.PARTICIPATED_DATE', ">=", $date_from);
            }
            if (!empty($request->date_to)) {
                $date_to = Carbon::parse($request->date_to);
                $result = $result->whereDate('contest_participants.PARTICIPATED_DATE', "<=", $date_to);
            }
            $data['viewparticipants'] = $result->select('contest_participants.*','contest.CONTEST_NAME')->join('contest', 'contest.CONTEST_ID', '=', 'contest_participants.CONTEST_ID')->orderBy('contest_participants.PARTICIPATION_ID','desc')->get();

        }
        $data['contestDetails'] = $this->getContestForParticipant();
        $data['params'] = $request->all();
        return view('bo.views.marketing.contest.viewparticipants',$data);
    }

    function getContestForParticipant(){
        return Contest::select('CONTEST_ID','CONTEST_NAME','CONTEST_TITLE')->orderBy('CONTEST_ID','desc')->get();
    }

    function ExcelExport(request $request){
        $ViewParticipantsData = $this->conditionalData($request);
        foreach($ViewParticipantsData as $ParticipantsData){
            $data_array[] = array(
                'Username' => getUsernameFromUserId($ParticipantsData['USER_ID']),
                'Contest_name' =>$ParticipantsData['CONTEST_NAME'],
                'Ques1' => $ParticipantsData['Q1'],
                'Ques2' => $ParticipantsData['Q2'],
                'Ques3' => $ParticipantsData['Q3'],
                'Submitted_date' => Carbon::parse($ParticipantsData['PARTICIPATED_DATE'])
            );
        }
        $headingofsheetArray = array('username','Contest Name', 'Ques1', 'Ques2', 'Ques3', 'submitted On');
        $fileName = urlencode("View_Participants" . date('d-m-Y') . ".xlsx");
        return Excel::download(new CollectionExport($data_array, $headingofsheetArray), $fileName);
    }

    public function conditionalData($request){
        if($request){
            $result = ContestParticipants::query();
            if (!empty($request->contest_name)) {
                $result = $result->where('contest_participants.CONTEST_ID', $request->contest_name);
            }
            if (!empty($request->contest_title)) {
               $result = $result->where('contest_participants.CONTEST_ID', $request->contest_title);
            }
            if (!empty($request->date_from)) {
                $date_from = Carbon::parse($request->date_from);
                $result = $result->whereDate('contest_participants.PARTICIPATED_DATE', ">=", $date_from);
            }
            if (!empty($request->date_to)) {
                $date_to = Carbon::parse($request->date_to);
                $result = $result->whereDate('contest_participants.PARTICIPATED_DATE', "<=", $date_to);
            }
            return $result->select('contest_participants.*','contest.CONTEST_NAME')->join('contest', 'contest.CONTEST_ID', '=', 'contest_participants.CONTEST_ID')->orderBy('contest_participants.PARTICIPATION_ID','desc')->get();

        }
    }
}
