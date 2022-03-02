@extends('bo.layouts.master')
@section('title', "Manage Questions | PB BO")
@section('pre_css')
@endsection
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="page-title-box">
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="{{ route('index') }}">Contest </a></li>
                     <li class="breadcrumb-item active">Manage Questions</li>
                  </ol>
               </div>
               <h4 class="page-title">
                  Manage Questions
               </h4>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="row mb-2">
                     <div class="col-lg-8">
                        <h5 class="font-18"> </h5>
                     </div>
                     <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0"><a href="{{ route('marketing.contest.create_questions') }}" class="btn btn-success waves-effect waves-light"><i class="fa fa-plus mr-1"></i>Create Questions</a></div>
                     </div>
                  </div>
                  <form action="#" name="search_question_form" id="search_question_form" method="post">
                     @csrf
                     <div class="row  align-items-center">
                        <div class="form-group col-md-4">
                           <label>Contest Name:</label>
                           <input type="text" name="contest_name"  class="form-control"  placeholder="Search by Contest Name" value="{{ old('contest_name', $params['contest_name'] ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                           <label>Contest Question:</label>
                           <input type="text" class="form-control" name="question_name"  placeholder="Search by Contest Question" value="{{ old('question_name', $params['question_name'] ?? '') }}">
                        </div>
                        <div class="form-group col-md-4">
                           <label>Status: </label>
                           <select name="status" class="customselect" data-plugin="customselect">
                              <option data-default-selected="" value="" {{ old('status', $params['status'] ?? '')==""?'selected':'' }}>Select</option>
                              <option value="1" {{ old('status', $params['status'] ?? '')==1?'selected':'' }}>Active</option>
                              <option value="0" {{ (old('status', $params['status'] ?? '')==0 && old('status', $params['status'] ?? '')!='')?'selected':'' }}>Inactive</option>
                           </select>
                        </div>
                     </div>
                     <div class="row  customDatePickerWrapper">
                        <div class="form-group col-md-4">
                           <label>From: </label>
                           <input name="date_from" id="date_from" type="text" class="form-control customDatePicker from flatpickr-input" placeholder="Select From Date" value="{{ old('date_from', $params['date_from'] ?? '') }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                           <label>To: </label>
                           <input name="date_to" id="date_to" type="text" class="form-control customDatePicker to flatpickr-input" placeholder="Select To Date" value="{{ old('date_to', $params['date_to'] ?? '') }}" readonly="readonly">
                        </div>
                        <div class="form-group col-md-4">
                           <label>Date Range: </label>
                           <select name="date_range" id="date_range"  class="formatedDateRange customselect" data-plugin="customselect" >
                              <option data-default-selected="" value="" {{ !empty($params) ? $params['date_range'] == "" ? "selected" : '' :  'selected'  }}>Select Date Range</option>
                              <option value="1" {{ !empty($params) ? $params['date_range'] == 1 ? "selected" : ''  : ''  }}>Today</option>
                              <option value="2" {{ !empty($params) ? $params['date_range'] == 2 ? "selected" : ''  : ''  }}>Yesterday</option>
                              <option value="3" {{ !empty($params) ? $params['date_range'] == 3 ? "selected" : ''  : ''  }}>This Week</option>
                              <option value="4" {{ !empty($params) ? $params['date_range'] == 4 ? "selected" : ''  : ''  }}>Last Week</option>
                              <option value="5" {{ !empty($params) ? $params['date_range'] == 5 ? "selected" : ''  : ''  }}>This Month</option>
                              <option value="6" {{ !empty($params) ? $params['date_range'] == 6 ? "selected" : ''  : ''  }}>Last Month</option>
                           </select>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fas fa-search mr-1"></i> Search</button>
                     <a href="" class="btn btn-secondary waves-effect waves-light ml-1"><i class="mdi mdi-replay mr-1"></i> Reset</a>
                  </form>
               </div>
               <!-- end card-body-->
            </div>
         </div>
         <!-- end col -->
      </div>
      @if($search_question)
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header bg-dark text-white">
                  <div class="card-widgets">
                     <a data-toggle="collapse" href="#cardCollpase7" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class=" fas fa-angle-down"></i></a>
                  </div>
                  <h5 class="card-title mb-0 text-white">Contest  Questionnaire</h5>
               </div>
               <div id="cardCollpase7" class="collapse show">
                  <div class="card-body">
                     <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Contest Name</th>
                              <th>Questions</th>
                              <th>Options</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $count = 1; @endphp
                           @foreach($search_question as $question)
                           <tr>
                              <td>{{$count++}}</td>
                              <td>{{ $question['CONTEST_NAME'] }}</td>
                              <td>{{ $question['QUESTION'] }}</td>
                              <td>{{ $question['OPTION_A'] .' '.$question['OPTION_B'].' '.$question['OPTION_C'].' '.$question['OPTION_D']}}</td>
                              <td><label class="switches"><input type="checkbox" id="changestatus" name="changestatus" onclick="return changeStatus({{ $question['QUESTION_ID'] }},{{ $question['QUESTION_STATUS'] }},{{  $question['CONTEST_ID'] }});" {{ $question['QUESTION_STATUS']==1?'checked':'' }}><span class="slider round"></span></label></td>
                              <td>
                                 <a href="#"  class="action-icon font-18 tooltips" data-toggle="modal" data-target="#setuserflagpopup" onclick="checkContest({{$question['QUESTION_ID']}});"><i class="fa-eye fa"></i> <span class="tooltiptext">View</span></a>

                                 <a href="#" data-toggle="modal" data-target="#editfrompopup"  class="action-icon font-18 tooltips" onclick="editQuestion({{$question['QUESTION_ID']}});"><i class="fa-edit fa"></i> <span class="tooltiptext">Edit</span></a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <div class="customPaginationRender mt-2" data-form-id="#userSearchForm"  class="mt-2">
                     </div>
                  </div>
               </div>
               <!-- end card body-->
            </div>
            <!-- end card -->
         </div>
         <!-- end col-->
      </div>
      @endif
   </div>
</div>
<div class="modal fade" id="setuserflagpopup">
   <div class="modal-dialog modal-lg">
      <div class="modal-content bg-transparent shadow-none">
         <div class="card">
            <div class="card-header bg-dark py-3 text-white">
               <div class="card-widgets">
                  <a href="#" data-dismiss="modal">
                  <i class="mdi mdi-close"></i>
                  </a>
               </div>
               <h5 class="card-title mb-0 text-white font-18">View Contest Name's Question #</h5>
            </div>
            <div class="card-body">
               <div id="managecontestdata" class="loader d-flex justify-content-center hv_center">
                  <div class="spinner-border" role="status"></div>
               </div>
               <div class="row mb-1">
                  <div class="col-md-6 mb-1"><strong class="font-15">Contest Title:</strong> <span id="contest_title_view"></span></div>
                  <div class="col-md-6 mb-1"><strong class="font-15">Contest Name:</strong> <span id="contest_name_view"></span></div>
               </div>
               <div class="row mb-1">
                  <div class="col-md-12 mb-1">
                     <strong class="font-15 d-block">Questions:</strong>
                     <p class="mb-0" id="question"></p>
                  </div>
                  <div class="col-md-6 mb-1"><strong class="font-15">Option A:</strong> <span id="option_a"></span></div>
                  <div class="col-md-6 mb-1"><strong class="font-15">Option B:</strong> <span id="option_b"></span></div>
                  <div class="col-md-6 mb-1"><strong class="font-15">Option C:</strong> <span id="option_c"></span></div>
                  <div class="col-md-6 mb-1"><strong class="font-15">Option D:</strong> <span id="option_d"></span></div>
               </div>
               <div class="row mb-1">
                  <div class="col-md-4 mb-1"><strong class="font-15">Status:</strong> <span id="ques_status"></span></div>
                  <div class="col-md-4 mb-1"><strong class="font-15">Added By:</strong> <span id="added_by"></span></div>
                  <div class="col-md-4 mb-1"><strong class="font-15">On:</strong> <span id="created_date"></span></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="editfrompopup">
   <div class="modal-dialog modal-lg">
      <div class="modal-content bg-transparent shadow-none">
         <div class="card">
            <div class="card-header bg-dark py-3 text-white">
               <div class="card-widgets">
                  <a href="#" data-dismiss="modal">
                  <i class="mdi mdi-close"></i>
                  </a>
               </div>
               <h5 class="card-title mb-0 text-white font-18">Edit Questions</h5>
            </div>
            <div class="card-body">
               <form name="edit_question" id="edit_question" method="post">
                  <div id="managecontestdata" class="loader d-flex justify-content-center hv_center">
                     <div class="spinner-border" role="status"></div>
                  </div>
                  <input type="hidden" name="edit_question_id" id="edit_question_id" value="">
                  <div class="row mb-1">
                     <div class="col-md-6 mb-1"><strong class="font-15">Contest Title:</strong> <span id="contest_title_edit"></span></div>
                     <div class="col-md-6 mb-1"><strong class="font-15">Contest Name:</strong> <span id="contest_name_edit"></span></div>
                  </div>
                  <div class="row mb-1">
                     <div class="form-group col-md-12">
                        <label>Question: <span class="text-danger">*</span></label>
                        <textarea class="form-control"  placeholder="Question 2" name="question_edit" id="question_edit"></textarea>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Option A: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="option_a_edit" id="option_a_edit" placeholder="Option A" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Option B: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="option_b_edit" id="option_b_edit"  placeholder="Option B" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Option C: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="option_c_edit" id="option_c_edit" placeholder="Option C" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Option D: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="option_d_edit" id="option_d_edit" placeholder="Option D" value="">
                     </div>
                  </div>
                  <button type="submit" id="update_question" onclick="updateQuestion();" class="btn btn-warning waves-effect waves-light"><i class="far fa-edit mr-1"></i> Update</button>
                  <button type="reset" id="reset_edit_form" class="btn btn-dark waves-effect waves-light ml-1"
                  ><i class="mdi mdi-replay mr-1"></i>Reset</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('post_js')
<script src="{{ asset('js/bo/manage_questions.js') }}"></script>
@endsection
