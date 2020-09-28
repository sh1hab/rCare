@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Location </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-4">

            <form class="form-horizontal" action="{{ URL::to('setup/add_location') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Location </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Location Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="location_name" placeholder="Enter Location" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Location Short Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="location_short_name" placeholder="Enter Short Name" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Location Details: </label>
                                    <textarea rows="3" class="form-control" placeholder="Enter Location Details" name="location_details"></textarea>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Location Type: </label>
                                    <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="location_type">
                                        <option value="1">Regular</option>
                                        <option value="2">Irregular</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Opening Balance: </label>
                                    <div class="input-group">
                                        <span class="input-group-addon tx-size-sm lh-2">৳</span>
                                        <input type="number" class="form-control" name="location_opening_balance" value="0">
                                        <span class="input-group-addon tx-size-sm lh-2">.00</span>
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="location_status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div><!-- col-3 -->
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="location_status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div><!-- col-3 -->
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->



                        <div class="form-layout-footer">
                            <button class="btn btn-info">Submit</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>

        </div>

        <div class="col-md-8">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Location List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-25p"> Name </th>
                            <th class="wd-20p"> Short Name </th>
                            <th class="wd-35p"> Details </th>
                            <th class="wd-35p"> Opening Balance </th>
                            <th class="wd-35p"> Type </th>
                            <th class="wd-35p"> Status </th>
                            <th class="wd-20p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['location']) > 0)
                        @php
                            $i =1;
                        @endphp
                        @foreach($data['location'] as $location)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $location->location_name }} </td>
                            <td> {{ $location->location_short_name }} </td>
                            <td> {{ $location->location_details }} </td>
                            <td> {{ $location->Location_opening_balance }} <span>৳</span> </td>
                            <td>
                                @if($location->location_type == 1)
                                    Regular
                                @elseif($location->location_type == 2)
                                    Irregular
                                @endif
                            </td>
                            <td>
                                @if($location->location_status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $location->id }}" data-full="{{ $location->location_name }}" data-short="{{ $location->location_short_name }}" data-details="{{ $location->location_details }}" data-opening="{{ $location->Location_opening_balance }}" data-status="{{ $location->location_status }}" data-type="{{ $location->location_type }}" class="btn btn-info btn-icon edit_location_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no location created
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>                    

            </div>
        </div>
    </div>

    <br>

    <div class="row">

    </div><!-- br-section-wrapper -->

</div>

@include('modal.edit_location')

@endsection

@section('custom_js')
    <script type="text/javascript">

        $(document).on('click', '.edit_location_modal', function(e){
            var location_id = $(this).attr("data-id");
            var short = $(this).attr("data-short");
            var full = $(this).attr("data-full");
            var opening = $(this).attr("data-opening");
            var details = $(this).attr("data-details");
            var type = $(this).attr("data-type");
            var status = $(this).attr("data-status");
            
            $('#edit_location_modal').modal('show');      
            $('.location_id').val(location_id);
            $('.short').val(short);
            $('.full').val(full);
            $('.opening').val(opening);
            $('.details').val(details);
            $('.location_type option[value='+type+']').prop("selected",true);
            $('.status[value='+status+']').prop("checked",true);
        });

    </script>
@endsection