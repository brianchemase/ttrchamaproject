@extends('dashone.inc.master')


@section('title','TTR || Monthly Contributions')

@section('content')

<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Monthly Contributions </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Monthly Contributions</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Contributions Register</li>
                </ol>
              </nav>
            </div>
            <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Monthly Contributions</h4>
                    <p class="card-description"> Select the member from the dropdown and filter </p>
                    <form class="form-inline" action="{{route('findmembersearch')}}" method="GET" autocomplete="off">
                                            
                      <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Select Member</div>
                        </div>
                          <select class="form-control" class="input-group-text" id="inlineFormInputGroupUsername2" name="q" >
                              @foreach($Members as $member)
                                  <option value="{{ $member->memberno }}">{{ $member->full_name }} - {{ $member->phone_number }}</option>
                              @endforeach
                          </select>


                        <!-- <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username"> -->
                      </div>
                      
                      <button type="submit" class="btn btn-success btn-fw mb-2">Filter Member</button>
                    </form>
                  </div>
                </div>
              </div>

             
              @if(isset($memberData))
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Monthly Contributions Register</h4>
                                   @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                    <p class="card-description"> Capture the member's Contributions </p>
                    <form class="forms-sample" method="POST" action="{{ route('submit-contribution') }}" autocomplete="off">
                      @csrf
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Member Number</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Member Number" name="memberno" value="{{ $memberData->memberno ?? '' }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Member Names</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Names of member" value="{{ $memberData->full_name ?? '' }}" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" name="phone" placeholder="Mobile number" value="{{ $memberData->phone_number ?? '' }}" readonly>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Contribution Payment Date</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" id="exampleInputMobile" name="contributionDate" placeholder="Enter Member Contribution date">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Member Contribution</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="exampleInputMobile" name="contribution" placeholder="Enter Member Contribution">
                        </div>
                      </div>


                      {{-- <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Month Contributing</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" name="contributionMonth" placeholder="Current Month">
                        </div>
                      </div> --}}

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Month Contributing</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="exampleInputMobile" name="contributionMonth" required>
                                <option value="1" {{ date('n') == 1 ? 'selected' : '' }}>January</option>
                                <option value="2" {{ date('n') == 2 ? 'selected' : '' }}>February</option>
                                <option value="3" {{ date('n') == 3 ? 'selected' : '' }}>March</option>
                                <option value="4" {{ date('n') == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ date('n') == 5 ? 'selected' : '' }}>May</option>
                                <option value="6" {{ date('n') == 6 ? 'selected' : '' }}>June</option>
                                <option value="7" {{ date('n') == 7 ? 'selected' : '' }}>July</option>
                                <option value="8" {{ date('n') == 8 ? 'selected' : '' }}>August</option>
                                <option value="9" {{ date('n') == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ date('n') == 10 ? 'selected' : '' }}>October</option>
                                <option value="11" {{ date('n') == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ date('n') == 12 ? 'selected' : '' }}>December</option>
                            </select>
                        </div>
                    </div>
                    
                    
                      
                      <button class="btn btn-outline-danger">Cancel</button>
                      <button type="submit" class="btn btn-success btn-fw me-2">Register Contribution</button>
                      
                    </form>
                  </div>
                </div>
              </div>   
              @endif     
            </div>
          </div>

@endsection