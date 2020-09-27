@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Purchase </a>
        <span class="breadcrumb-item active"> Entry </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <form class="form-horizontal" action="{{ URL::to('setup/add_user') }}" id="" role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Purchase Entry </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> User Location: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Location Name" data-placeholder="-------- Select Location ---------" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                        @foreach ($data['location'] as $location)
                                        <option data-subtext="{{$location->location_short_name}}" value="{{ $location->id }}"> {{ $location->location_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Parts: <span class="tx-danger">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Location Name" data-placeholder="-------- Select Location ---------" tabindex="-1" aria-hidden="true" name="location_id" required="">
                                        @foreach ($data['parts'] as $part)
                                        <option data-tokens="{{$part->full_code}}" data-subtext="{{$part->full_code}}" value="{{ $part->id }}"> {{ $part->parts_name }} </option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="user_name" placeholder="Enter Full Name" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Designation: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="designation" placeholder="Enter User Designation">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Contact Number: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="contact_no" placeholder="Enter Contact Number" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Email: </label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter Email Address" required="">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Username: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" placeholder="Enter username" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label"> Password: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter Password" required="">
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
        <div class="col-md-2"></div>
    </div>
</div>

<br>


@endsection

@section('custom_js')
<script type="text/javascript">


</script>
@endsection