@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Asset </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" action="{{ URL::to('setup/asset_type') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Asset Type </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Asset Type: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="asset_type" placeholder="Enter Asset Type Name" required="">
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

        <div class="col-md-6">
            <form class="form-horizontal" action="{{ URL::to('setup/asset_head') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Asset Head </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Asset Type: </label>
                                    <select class="form-control selectpicker" data-live-search="true" title="Select Asset Type" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="asset_type_id">
                                        @foreach ($data['asset_type'] as $asset_type)
                                            <option value="{{ $asset_type->id }}">{{$asset_type->asset_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Asset Head: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="asset_head" placeholder="Enter Asset Head Name">
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
    </div>

    <br>
    <div class="row">
        <div class="col-md-6"> 
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> Asset Type List </h6>

                <table class="table table-bordered table-colored table-info data-table">
                    <thead>
                        <tr>
                            <th class="wd-35p"> Type </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($data['asset_type']) > 0)
                        @foreach($data['asset_type'] as $asset_type)
                        <tr>
                            <td> {{ $asset_type->asset_type }} </td>
                            <td>
                                @if($asset_type->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $asset_type->id }}" data-name="{{ $asset_type->asset_type }}" data-status="{{ $asset_type->status }}" class="btn btn-info btn-icon edit_asset_type">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no asset type created
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-md-6">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> Asset Head List </h6>

                <table class="table table-bordered table-colored table-info data-table">
                    <thead>
                        <tr>
                            <th class="wd-35p"> Type </th>
                            <th class="wd-35p"> Head </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($data['asset_head']) > 0)
                        @foreach($data['asset_head'] as $asset_head)
                        <tr>
                            <td> {{ $asset_head->type->asset_type }} </td>
                            <td> {{ $asset_head->asset_head }} </td>
                            <td>
                                @if($asset_head->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $asset_head->id }}" data-type="{{ $asset_head->asset_type_id }}" data-head="{{ $asset_head->asset_head }}" data-status="{{ $asset_head->status }}" class="btn btn-info btn-icon edit_asset_head">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no asset head created
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

@include('modal.edit_asset_type')
@include('modal.edit_asset_head')

@endsection

@section('custom_js')
<script type="text/javascript">

    $(document).on('click', '.edit_asset_type', function(e){
        var asset_type_id = $(this).attr("data-id");
        var asset_type = $(this).attr("data-name");
        var status = $(this).attr("data-status");

        $('#edit_asset_type_modal').modal('show');      
        $('.asset_type_id').val(asset_type_id);
        $('.asset_type').val(asset_type);
        $('.status[value='+status+']').prop("checked",true);
    });

    $(document).on('click', '.edit_asset_head', function(e){
        var asset_head_id = $(this).attr("data-id");
        var type = $(this).attr("data-type");
        var head = $(this).attr("data-head");
        var status = $(this).attr("data-status");

        $('#edit_asset_head_modal').modal('show');      
        $('.asset_head_id').val(asset_head_id);
        $('.head').val(head);
        $('.asset_type option[value='+type+']').prop("selected",true);
        $('.status[value='+status+']').prop("checked",true);
    });

</script>
@endsection