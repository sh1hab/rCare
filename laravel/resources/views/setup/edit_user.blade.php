@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> User </a>
        <span class="breadcrumb-item active"> Edit User </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form class="form-horizontal" action="{{ URL::to('setup/post_edit_user') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Edit User </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="user_name" placeholder="Enter Full Name" value="{{ $data['user']->name }}" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Designation: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="designation" placeholder="Enter User Designation" value="{{ $data['user']->designation }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Contact Number 1: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="Enter Contact Number" required="" value="{{ $data['user']->contact_no }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Contact Number 2: </label>
                                    <input class="form-control" type="text" name="contact_no_1" placeholder="Enter Contact Number" required="" value="{{ $data['user']->contact_no_1 }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> RS ID: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="rs_id" placeholder="Enter RS ID" required="" value="{{ $data['user']->rs_id }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Email: </label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter Email Address" required="" value="{{ $data['user']->email }}">
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> User Role: <span class="tx-danger">*</span></label>
                                    <select class="form-control js-example-basic-single" data-live-search="true" title="Select Role" data-placeholder="" tabindex="-1" aria-hidden="true" name="role_id" required="">
                                        @foreach ($data['role'] as $role)
                                            <option value="{{ $role->id }}" {{ ($role->id == $data['user']->user_role_id)?'class="selected"':'' }}> {{ $role->role_name }} </option>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label"> User Location: <span class="tx-danger">*</span></label>
                                        <select class="form-control js-example-basic-single" data-live-search="true" title="Select Location Name" data-placeholder="" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                            @foreach ($data['location'] as $location)
                                                <option data-subtext="{{$location->location_short_name}}" value="{{ $location->id }}" {{ ($location->id == $data['user']->location_id)?'class="selected"':'' }}> {{ $location->location_name }} </option>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"> Username: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="username" placeholder="Enter username" required="" value="{{$data['user']->username}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"> Password: <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="password" name="password" placeholder="Enter Password" value="" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file">User Image:</label>
                                            <input type="file" class="form-control-file" name="file" id="file">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                            <div class="row mg-t-10">
                                                <div class="col-lg-4">
                                                    <label class="rdiobox">
                                                        <input name="status" value="1" type="radio" checked="">
                                                        <span> Active </span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label class="rdiobox">
                                                        <input name="status" value="0" type="radio">
                                                        <span> Inactive </span>
                                                    </label>
                                                </div>
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
        </div>

        @include('modal.edit_role')
        @include('modal.edit_location')

        @endsection

        @section('custom_js')
        <script type="text/javascript">

            $(document).on('click', '.edit_role', function(e){
                e.preventDefault();
                jQuery.noConflict();
                $('#edit_role_modal').modal('show'); 
            });

            $(document).on('click', '.edit_location', function(e){
                e.preventDefault();
                jQuery.noConflict();
                $('#edit_location_modal').modal('show'); 
            });

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
        @endsection