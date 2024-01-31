@extends('dashone.inc.master')


@section('title','Dashboard one || Dashboard Form Table')

@section('content')

<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> TTR Membership Registration </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Registration</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Member Registration</li>
                                
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!-- member registration form -->
                    <h4 class="card-title">TTR Member Registration Form</h4>
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
                    <p class="card-description"> Capture Member details </p>
                    <form class="forms-sample" method="POST" action="{{ route('StoreMemberData') }}" autocomplete="off">
                        @csrf <!-- Add this line to include the CSRF token -->

                        <div class="form-group">
                            <label for="exampleInputMemberNo">Member Number</label>
                            <input type="text" class="form-control" id="exampleInputMemberNo" name="memberno" placeholder="Member Number">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFullName">Full Name</label>
                            <input type="text" class="form-control" id="exampleInputFullName" name="full_name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputIdNumber">ID Number</label>
                            <input type="number" class="form-control" id="exampleInputIdNumber" name="id_number" placeholder="ID Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputGender">Gender</label>
                            <select class="form-control" id="exampleInputGender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPhoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="exampleInputPhoneNumber" name="phone_number" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputBirthday">Birthday</label>
                            <input type="date" class="form-control" id="exampleInputBirthday" name="birthday">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputResidence">Residence</label>
                            <input type="text" class="form-control" id="exampleInputResidence" name="residence" placeholder="Residence">
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>

                  </div>
                </div>
              </div>


              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Registered Members</h4>
                    <p class="card-description"> Members Details   </p>
                      <table id="example" class="table table-striped" style="width:100%">
                          <thead>
                              <tr>
                                    <th>Member No</th>
                                    <th>Full Name</th>
                                    <th>ID Number</th>
                                    <th>Phone Number</th>
                                    
                                    <th>Action</th>
                                   
                                    
                              </tr>
                          </thead>
                            <tbody>
                                @foreach($Members as $member)
                                    <tr>
                                        <td>{{ $member->memberno }}</td>
                                        <td>{{ $member->full_name }}</td>
                                        <td>{{ $member->id_number }}</td>
                                        <td>{{ $member->phone_number }}</td>
                                       
                                        <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewModal{{ $member->memberno }}">
                            View
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="viewModal{{ $member->memberno }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Member Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Member No:</strong> {{ $member->memberno }}</p>
                                        <p><strong>Full Name:</strong> {{ $member->full_name }}</p>
                                        <p><strong>ID Number:</strong> {{ $member->id_number }}</p>
                                        <p><strong>Phone Number:</strong> {{ $member->phone_number }}</p>
                                        <p><strong>Email:</strong> {{ $member->email }}</p>
                                        <p><strong>Birthday:</strong> {{ $member->birthday }}</p>
                                        <p><strong>Residence:</strong> {{ $member->residence }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                         </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                          <tfoot>
                              <tr>
                                    <th>Member No</th>
                                    <th>Full Name</th>
                                    <th>ID Number</th>
                                    <th>Phone Number</th>
                                    
                                    <th>Action</th>
                                    
                              </tr>
                          </tfoot>
                      </table>
                  </div>
                </div>
              </div>
              
              
            </div>
          </div>

@endsection