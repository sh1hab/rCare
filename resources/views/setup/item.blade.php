@extends('layout.app')
@section('custom_css')
<style type="text/css">
    .table-info > tbody > tr > th, .table-info > tbody > tr > td{

    }
</style>
@endsection
@section('content')

<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add Item </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-5">
            <form class="form-horizontal" action="{{ URL::to('setup/add_item') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Item </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group mg-b-0">
                                    <label> Item Name : <span class="tx-danger">*</span></label>
                                    <input type="text" name="item_name" class="form-control" placeholder="Enter Item Name" required="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Item Description: </label>
                                    <textarea rows="3" class="form-control" name="item_description" placeholder="Enter Item Description"></textarea>
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
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->
                    </div>
                </div><!-- form-layout -->
            </form>
        </div>

        <div class="col-md-7">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Item List </h6>           

                <table class="table table-bordered table-colored table-info data-table" id="sample_1">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Name </th>
                            <th class="wd-35p"> Description </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($data['items']) > 0)
                        @php
                        $i =1;
                        @endphp
                        @foreach($data['items'] as $item)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td> {{ $item->item_name }} </td>
                            <td> {{ $item->item_description }} </td>
                            <td>
                                @if($item->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $item->id }}" data-name="{{ $item->item_name }}" data-description="{{ $item->item_description }}" data-status="{{ $item->status }}" class="btn btn-info btn-icon edit_item_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no item created
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

@include('modal.edit_item')

@endsection

@section('custom_js')
<script type="text/javascript">

    $('#sample_1').DataTable({
        "iDisplayLength": 10,
        "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "all"]
        ]
    });

    $(document).on('click', '.edit_item_modal', function(e){
        e.preventDefault();
        jQuery.noConflict();
        var item_id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var description = $(this).attr("data-description");
        var status = $(this).attr("data-status");

        $('#edit_item_modal').modal('show');      
        $('.item_id').val(item_id);
        $('.item_name').val(name);
        $('.item_description').val(description);
        $('.status[value='+status+']').prop("checked",true);
    });


</script>
@endsection