@extends('layout.app')
@section('custom_css')
  <style type="text/css">
    .bootstrap-select{
        width: 100% !important;
    }
  </style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Parts Category </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-4">

            <form class="form-horizontal" action="{{ URL::to('setup/add_category') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Parts Category </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Category Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="category_name" placeholder="Enter Category">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Category Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control category_code" type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" name="category_code" placeholder="Category Code Ex. 08">

                                    <div class="red code_error" hidden>
                                        Category code already exist!!!
                                    </div>

                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Category Details: </label>
                                    <textarea rows="3" class="form-control" name="category_details" placeholder="Enter Parts Category Details"></textarea>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Serial: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose one" tabindex="-1" aria-hidden="true" name="serial">
                                        <option value="Y"> Yes </option>
                                        <option value="N"> No </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Status: <span class="tx-danger">*</span></label>
                                    <div class="row mg-t-10">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" name="status" value="1" type="radio" checked="">
                                                <span> Active </span>
                                            </label>
                                        </div><!-- col-3 -->
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input name="status" name="status" value="0" type="radio">
                                                <span> Inactive </span>
                                            </label>
                                        </div><!-- col-3 -->
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->



                        <div class="form-layout-footer">
                            <button class="btn btn-info category_submit">Submit</button>
                            <button class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>

        <div class="col-md-8">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Category List </h6>

                <table class="table table-bordered table-colored table-info">
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-15p"> Name </th>
                            <th class="wd-15p"> Code </th>
                            <th class="wd-25p"> Details </th>
                            <th class="wd-10p"> Serial </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['category']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['category'] as $category)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{ $category->category_name }} </td>
                            <td> {{ $category->category_code }} </td>
                            <td> {{ $category->category_details }} </td>
                            <td> {{ $category->serial }} </td>
                            <td>
                                @if($category->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $category->id }}" data-name="{{ $category->category_name }}" data-code="{{ $category->category_code }}" data-details="{{ $category->category_details }}" data-serial="{{ $category->serial }}" data-status="{{ $category->status }}" class="btn btn-info btn-icon edit_category_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no category created
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
@include('modal.edit_category')

@endsection

@section('custom_js')
<script type="text/javascript">

    $('.category_code').keyup(function() {
        var code = this.value;

        if(code){
            var url_op = base_url+"/setup/check_category_code";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {code:code, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".category_submit").attr("disabled", true);
                        $(".code_error").removeAttr('hidden');
                    }else{
                        $(".category_submit").attr("disabled", false);
                        $(".code_error").attr("hidden",true);
                    }
                }
            });
        }
    });


    $('.edit_category_code').keyup(function() {
        var code = this.value;

        if(code){
            var url_op = base_url+"/setup/check_category_code";
            $.ajax({
                type: "POST",
                url: url_op,
                dataType: 'json',
                data: {code:code, _token:csrf_token},
                success : function(data){
                    if(data.status){
                        $(".edit_category_submit").attr("disabled", true);
                        $(".edit_code_error").removeAttr('hidden');
                    }else{
                        $(".edit_category_submit").attr("disabled", false);
                        $(".edit_code_error").attr("hidden",true);
                    }
                }
            });
        }
    });

    $(document).on('click', '.edit_category_modal', function(e){
        var category_id = $(this).attr("data-id");
        var category_name = $(this).attr("data-name");
        var category_code = $(this).attr("data-code");
        var category_details = $(this).attr("data-details");
        var category_serial = $(this).attr("data-serial");
        var status = $(this).attr("data-status");
        
        $('#edit_category_modal').modal('show');      
        $('.category_id').val(category_id);
        $('.category_name').val(category_name);
        $('.edit_category_code').val(category_code);
        $('.category_details').val(category_details);
        $('.category_serial option[value='+category_serial+']').prop("selected", true);
        $('.category_status[value='+status+']').prop("checked", true);
    });

</script>
@endsection