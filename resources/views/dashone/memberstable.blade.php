@extends('dashone.inc.master')


@section('title','Dashboard one || Dashboard Table')

@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Registered Members </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Responsive tables</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Responsive Table</h4>
                    <p class="card-description"> Add class <code>.table</code>
                    </p>
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
                                        <td>{{ $member['memberno'] }}</td>
                                        <td>{{ $member['full_name'] }}</td>
                                        <td>{{ $member['id_number'] }}</td>
                                        <td>{{ $member['phone_number'] }}</td>
                                       
                                        <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded" data-toggle="modal" data-target="#viewModal{{ $member['memberno'] }}"> <i class="mdi mdi-file-check btn-icon-prepend"></i> View
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="viewModal{{ $member['memberno'] }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Member Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Full Name:</strong> {{ $member['full_name'] }}</p>
                                        <p><strong>ID Number:</strong> {{ $member['id_number'] }}</p>
                                        <p><strong>Phone Number:</strong> {{ $member['phone_number'] }}</p>
                                        <p><strong>Email:</strong> {{ $member['email'] }}</p>
                                        <p><strong>Birthday:</strong> {{ $member['birthday'] }}</p>
                                        <p><strong>Residence:</strong> {{ $member['residence'] }}</p>
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