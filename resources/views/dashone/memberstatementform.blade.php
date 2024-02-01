@extends('dashone.inc.master')


@section('title','TTR || Member Statement')

@section('content')

<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Generate Contribution Statement  </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Contributions Statement</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Statement Summary</li>
                </ol>
              </nav>
            </div>
            <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Contributions Summary</h4>
                    <p class="card-description"> Select the member from the dropdown and filter </p>
                    <form class="form-inline" action="{{route('mystatement')}}" method="POST" autocomplete="off" target="_blank">
                      @csrf
                                            
                      <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                      <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Select Member</div>
                        </div>
                          <select class="form-control" class="input-group-text" id="inlineFormInputGroupUsername2" name="memberno" >
                              @foreach($Members as $member)
                                  <option value="{{ $member->memberno }}">{{ $member->full_name }} - {{ $member->phone_number }}</option>
                              @endforeach
                          </select>
                      </div>
                      
                      <button type="submit" class="btn btn-success btn-fw mb-2">Generate Statement</button>
                    </form>
                  </div>
                </div>
              </div>

             
            </div>
          </div>

@endsection