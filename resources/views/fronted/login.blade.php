<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" content="{{csrf_token()}}">

    <title>@if(isset($title)) {{$title}} - {{$setting->value('app_name')}} @else Limitless - Responsive Web Application Kit by Eugene Kopyov @endif</title>

    {{--    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="{{asset('assets/font/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/core/blockui.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/styling/uniform.min.js')}}"></script>

    <script src=" {{asset('assets/js/page/app.js')}}"></script>
    <script src=" {{asset('assets/js/page/login.js')}}"></script>

</head>

<body>
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{route('admin.home')}}" class="d-inline-block">
            <img src="{{$setting->value('app_logo') == null ? asset('assets/image/logo_light.png') : asset('storage/image/'. $setting->value('app_logo'))}}" alt="">
        </a>
    </div>
</div>
<div class="page-content">
    <div class="content-wrapper">
        <div class="content d-flex justify-content-center align-items-center">
            <form class="login-form" method="post" action="{{route('login')}}">
                @csrf
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">Halaman Adminsitrator</h5>
                            <span class="d-block text-muted">Silahkan memasukkan akun anda</span>
                        </div>
                        @if(session('msg'))
                            @php($msg = session('msg'))
                            <div class="alert alert-{{$msg['class']}} alert-dismissible">
                                <span class="font-weight-semibold">{{$msg['text']}}</span>
                            </div>
                        @endif
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="text" class="form-control" name="user_name" placeholder="Nama Pengguna">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" class="form-control" name="user_pass" placeholder="Kata Sandi">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <input type="checkbox" name="remember" class="form-check-input-styled-primary" checked data-fouc>
                            </div>
                            <div class="col-md-8">
                                <label>Ingat Saya ?</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Masuk <i class="icon-circle-right2 ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2021. <a href="#">{{$setting->value('app_name')}}</a> by <a href="http://limitasi.my.id" target="_blank">Limitless</a>
					</span>
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
