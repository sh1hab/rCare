@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add User </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form class="form-horizontal" action="{{ URL::to('setup/add_user') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add User </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="user_name" placeholder="Enter Full Name">
                                </div>
                            </div>
                        {{-- </div>

                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Designation: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="designation" placeholder="Enter User Designation">
                                </div>
                            </div>
                        {{-- </div>


                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Contact Number: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="Enter Contact Number">
                                </div>
                            </div>
                        {{-- </div>


                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> RS ID: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="rs_id" placeholder="Enter RS ID">
                                </div>
                            </div>
                        {{-- </div>


                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> User Role: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Role" data-placeholder="-------- Select |Role ---------" tabindex="-1" aria-hidden="true" name="role_id">
                                        @foreach ($data['role'] as $role)
                                            <option value="{{ $role->id }}"> {{ $role->role_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label></label>
                                    <span class="input-group-btn mg-t-8">
                                        <button class="btn btn-info edit_role" type="button">
                                            <i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        {{-- </div>


                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> User Location: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Location Name" data-placeholder="-------- Select Location ---------" tabindex="-1" aria-hidden="true" name="location_id">
                                        @foreach ($data['location'] as $location)
                                            <option data-subtext="{{$location->location_short_name}}" value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label></label>
                                    <span class="input-group-btn mg-t-8">
                                        <button class="btn btn-info edit_location" type="button">
                                            <i class="fa fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        {{-- </div>
                        

                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Username: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" placeholder="Enter username">
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                        {{-- </div>

                        <div class="row"> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div><!-- col-3 -->
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div><!-- col-3 -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Bank List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-15p"> Name </th>
                            <th class="wd-30p"> Full Name </th>
                            <th class="wd-20p"> Balance </th>
                            <th class="wd-35p"> Remarks </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-20p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if(count($data['bank']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['users'] as $user)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td>  </td>
                            <td>  </td>
                            <td>  <span>৳</span> </td>
                            <td>  </td>
                            <td>
                                @if($user->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $user->id }}" data-short="{{ $user->short_name }}" data-full="{{ $user->full_name }}" data-opening="{{ $user->opening_balance }}" data-status="{{ $user->status }}" data-remarks="{{ $user->remarks }}" class="btn btn-info btn-icon edit_bank_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no bank created
                            </td>
                        </tr>
                        @endif --}}

                    </tbody>
                </table>

            </div>
        </div>
    </div>

        <br>

        <div class="row">

        </div><!-- br-section-wrapper -->

    </div>


    @include('modal.edit_role')
    @include('modal.edit_location')
    @include('modal.edit_user')

    @endsection

    @section('custom_js')
    <script type="text/javascript">

        $(document).on('click', '.edit_role', function(e){            
            $('#edit_role_modal').modal('show'); 
        });

        $(document).on('click', '.edit_location', function(e){            
            $('#edit_location_modal').modal('show'); 
        });

        $(document).on('click', '.edit_bank_modal', function(e){
            var bank_id = $(this).attr("data-id");
            var short = $(this).attr("data-short");
            var full = $(this).attr("data-full");
            var opening = $(this).attr("data-opening");
            var remarks = $(this).attr("data-remarks");
            var status = $(this).attr("data-status");
            
            $('#edit_bank_modal').modal('show');      
            $('.bank_id').val(bank_id);
            $('.short').val(short);
            $('.full').val(full);
            $('.opening').val(opening);
            $('.remarks').val(remarks);
            $('.status[value='+status+']').prop("checked",true);
        });

    </script>
    @endsection