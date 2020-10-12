@extends('layout.app')
@section('custom_css')
    <style type="text/css">
        
    </style>
@endsection
@section('content')
<div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href=" {{URL::to('/dashboard')}} "> Dashboard </a>
        <a class="breadcrumb-item" href=""> User </a>
        <span class="breadcrumb-item active"> User List </span>
    </nav>
</div>
<div class="br-pagebody">
   
    <div class="row">        
        <div class="col-md-12">
            <div class="br-section-wrapper" style="overflow-x:auto;">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-b-10"> All User List </h6>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
                

                <table class="table table-striped table-info" id="sample_1"><!-- table2 -->
                    <thead>
                        <tr>
                            <th class="wd-5p"> SL </th>
                            <th class="wd-10p"> Name </th>
                            <th class="wd-5p"> Username </th>
                            <th class="wd-5p"> Email </th>
                            <th class="wd-5p"> Designation </th>
                            <th class="wd-10p"> Contact No. 1 </th>
                            <th class="wd-10p"> Contact No. 2 </th>
                            <th class="wd-5p"> RS ID </th>
                            <th class="wd-5p"> Role </th>
                            <th class="wd-5p"> Location </th>
                            <th class="wd-5p"> Status </th>
                            <th class="wd-5p"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data['users']) > 0)

                        @php
                            $i =1;
                        @endphp

                        @foreach($data['users'] as $user)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->username}} </td>
                            <td> {{$user->email}} </td>
                            <td> {{$user->designation}} </td>
                            <td> {{$user->contact_no}} </td>
                            <td> {{$user->contact_no_1}} </td>
                            <td> {{$user->rs_id}} </td>
                            <td> {{$user->role->role_name}} </td>
                            <td> {{$user->location->location_short_name}} </td>
                            <td>
                                @if($user->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('edit-user', ['id'=>$user->id]) }}" class="btn btn-info btn-icon">
                                    <div><i class="fa fa-edit" title="Edit"></i></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="11" class="text-center"> There is no user created </td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
                            <td style="display: none"></td>
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



    @endsection

    @section('custom_js')
    <script type="text/javascript">
        $('#sample_1').DataTable({
            "scrollX": true,
            "iDisplayLength": 10,
            "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "all"]
            ]
        });
    </script>
    @endsection