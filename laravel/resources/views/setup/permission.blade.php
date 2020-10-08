@extends('layout.app')
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> Setup </a>
        <span class="breadcrumb-item active"> Permissions </span>
    </nav>
</div>
<div class="br-pagebody">

    {{-- <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ URL::to('setup/add_bank') }}" id="" role="form" method="post" data-parsley-validate>
                @csrf

                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"> Permissions </h6>
                    <div class="form-layout form-layout-1">

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div><!-- form-layout-footer -->

                    </div>
                </div><!-- form-layout -->
            </form>
        </div>        
    </div>

        <br>

        <div class="row">

        </div><!-- br-section-wrapper -->

    </div>


    @include('modal.edit_bank')

    @endsection

    @section('custom_js')
    <script type="text/javascript">

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