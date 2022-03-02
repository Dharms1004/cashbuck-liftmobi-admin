@extends('bo.layouts.master')
@section('title', "View Participants | PB BO")
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
                     <li class="breadcrumb-item"><a href="{{ route('marketing.contest.index') }}">Marketing </a></li>
                     <li class="breadcrumb-item"><a href="{{ route('marketing.contest.index') }}">Contests </a></li>
                     <li class="breadcrumb-item active">View Participants</li>
                  </ol>
               </div>
               <h4 class="page-title">
                  View Participants
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
                  <form id="userSearchForm" action="#" method="post">
                     @csrf
                     <div class="row  align-items-center">
                        <div class="form-group col-md-6">
                           <label>Contest Name:</label>
                           <select name="contest_name" id="contest_name" class="customselect" data-plugin="customselect">
                              <option data-default-selected="" value="" {{ old('contest_name', $params['contest_name'] ?? '')==""?'selected':'' }}>Select</option>
                              @if($contestDetails)
                              @foreach($contestDetails as $contestName)
                              <option data-default-selected="" value="{{ $contestName->CONTEST_ID }}" {{ old('contest_name', $params['contest_name'] ?? '')==$contestName->CONTEST_ID?'selected':'' }}>{{ $contestName->CONTEST_NAME }}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        <div class="form-group col-md-6">
                           <label>Contest Title:</label>
                           <select name="contest_title" id="contest_title" class="customselect" data-plugin="customselect">
                              <option data-default-selected="" value="" {{ old('contest_title', $params['contest_title'] ?? '')==""?'selected':'' }}>Select</option>
                              @if($contestDetails)
                              @foreach($contestDetails as $contestTitle)
                              <option data-default-selected="" value="{{ $contestTitle->CONTEST_ID }}" {{ old('contest_title', $params['contest_title'] ?? '')==$contestTitle->CONTEST_ID?'selected':'' }}>{{ $contestTitle->CONTEST_TITLE }}</option>
                              @endforeach
                              @endif
                           </select>
                        </div>
                        {{-- <div class="form-group col-md-4">
                           <label>Status: </label>
                           <select name="status" class="customselect" data-plugin="customselect">
                              <option data-default-selected="" value=""{{ old('status', $params['status'] ?? '')==""?'selected':'' }}>Select</option>
                              <option value="1"{{ old('status', $params['status'] ?? '')==1?'selected':'' }}>Active</option>
                              <option value="0"{{ (old('status', $params['status'] ?? '')==0 && old('status', $params['status'] ?? '')!='')?'selected':'' }}>Inactive</option>
                           </select>
                        </div> --}}
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
      @if($viewparticipants)
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header bg-dark text-white">
                  <div class="card-widgets">
                     <a data-toggle="collapse" href="#cardCollpase7" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class=" fas fa-angle-down"></i></a>                                 
                  </div>
                  <h5 class="card-title mb-0 text-white">Contest  Questionnaires</h5>
               </div>
               <div id="cardCollpase7" class="collapse show">
                  <div class="card-body">
                     <div class="row mb-2">
                        <div class="col-sm-7">
                           <h5 class="font-15 mt-0">Total Participants: <span class="text-danger">({{ count($viewparticipants) }}) </span></span>  </h5>
                        </div>
                        @if(count($viewparticipants) > 0)
                        <div class="col-sm-5">
                           <div class="text-sm-right">
                              <a href="{{ route('marketing.contest.getExcelExport')."?contest_name=".$params['contest_name']."&contest_title=".$params['contest_title']."&date_from=".$params['date_from']."&date_to=".$params['date_to'] }}"><button type="button" class="btn btn-light mb-1"><i class="fas fa-file-excel" style="color: #34a853;"></i> Export Excel</button></a>
                           </div>
                        </div>
                        @endif
                     </div>
                     <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>User ID</th>
                              <th>User Name</th>
                              <th>Contest Name</th>
                              <th>Ques. 1</th>
                              <th>Ques. 2</th>
                              <th>Ques. 3</th>
                              <th>Submitted On</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php $count = 1; @endphp
                           @foreach($viewparticipants as $participants)
                           <tr>
                              <td>{{ $count++ }}</td>
                              <td>{{ $participants->USER_ID }}</td>
                              <td><a href="{{ route('user.account.user_profile',encrypt($participants->USER_ID)) }}" target="_blank">{{ getUsernameFromUserId($participants->USER_ID) }}</a></td>
                              <td>{{ $participants->CONTEST_NAME }}</td>
                              <td>{{ $participants->Q1 }}</td>
                              <td>{{ $participants->Q2 }}</td>
                              <td>{{ $participants->Q3 }}</td>
                              <td>{{ date_format($participants->PARTICIPATED_DATE,"d/m/yy") }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     <div class="customPaginationRender mt-2" data-form-id="#userSearchForm"  class="mt-2">
                        <div>More Records</div>
                        <div>
                        </div>
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
@endsection

