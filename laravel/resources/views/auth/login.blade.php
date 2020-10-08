@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ URL::to('/login') }}" id="" role="form" method="post" data-parsley-validate>
    @csrf
    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
            <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
                <a href="" style="margin: 0px auto;"><img style="height: 35px" src="{{asset('admin/img/ryanscare.png')}}" alt="Ryans Computers Logo"></a>
            </div>
            <br><br>
            {{-- <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div> --}}

            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Enter your username" required="" value="{{old('username')}}" autocomplete="off">                
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required="">
                
                @foreach ($errors->all() as $message)
                    <span class="invalid-feedback" role="alert" <?php echo ($message)?'style="display: block"':'' ?> >
                        <strong>{{ $message }}</strong>
                    </span>                       
                @endforeach
                <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div>
            <button type="submit" class="btn btn-info btn-block">Sign In</button>

            <div class="mg-t-60 tx-center">Not yet a member? <a href="" class="tx-info">Sign Up</a></div>
        </div>
    </div>
</form>

@endsection
