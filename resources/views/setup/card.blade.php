@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Add Card </span>
    </nav>
</div>
<div class="br-pagebody">

    <div class="row">
        <div class="col-md-5">

            <form class="form-horizontal" action="{{ URL::to('setup/add_card') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Add Card </h6>
                    <div class="form-layout form-layout-1">

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-control-label"> Card Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="card_name" placeholder="Enter Bank Card Name" required="">
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

        <div class="col-md-7">
            <div class="br-section-wrapper">          
                <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All Employee Role List </h6>

                <table class="table table-bordered table-colored table-info data-table">
                    <thead>
                        <tr>
                            <th class="wd-35p"> Name </th>
                            <th class="wd-10p"> Status </th>
                            <th class="wd-10p"> Action </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($data['card']) > 0)
                        @foreach($data['card'] as $card)
                        <tr>
                            <td> {{ $card->card_name }} </td>
                            <td>
                                @if($card->status == 1)
                                Active
                                @else
                                Inactive
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0);" id="" data-id="{{ $card->id }}" data-name="{{ $card->card_name }}" data-status="{{ $card->status }}" class="btn btn-info btn-icon edit_card_modal">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                There is no card name created
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

@include('modal.edit_card')

@endsection

@section('custom_js')
<script type="text/javascript"> 
    $(document).on('click', '.edit_card_modal', function(e){
        var card_id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var status = $(this).attr("data-status");

        $('#edit_card_modal').modal('show');      
        $('.card_id').val(card_id);
        $('.card_name').val(name);
        $('.status[value='+status+']').prop("checked",true);
    });
</script>
@endsection