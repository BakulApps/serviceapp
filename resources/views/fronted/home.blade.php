<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>@if(isset($title)) {{$title}} - {{$setting->value('app_name')}} @else Limitless - Responsive Web Application
        Kit by Eugene Kopyov @endif</title>

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
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>

    <script src=" {{asset('assets/js/page/app.js')}}"></script>
    <script src=" {{asset('assets/js/page/home.js')}}"></script>

</head>

<body>
<script type="text/javascript">
    var baseurl = "{{route('home')}}"
    var adminurl = "{{route('admin.home')}}"
</script>
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{route('admin.home')}}" class="d-inline-block">
            <img
                src="{{$setting->value('app_logo') == null ? asset('assets/image/logo_light.png') : asset('storage/image/'. $setting->value('app_logo'))}}"
                alt="">
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="page-content">
    <div class="content-wrapper">
        <div class="content">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <div class="card border-primary">
                        <div class="card-header">
                            <h3 class="card-title text-center font-weight-bold">CARI KENDARAAN</h3>
                            <div class="header-elements">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-right-0 unit_nopol" placeholder="Ketikkan No. Polisi">
                                        <span class="input-group-append">
                                            <button class="btn btn bg-info btn-labeled btn-labeled-left" type="submit" id="submit"><b><i class="icon-search4"></i></b>Cari</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row table-transaction">
                <div class="offset-md-2 col-md-8">
                    <div class="card">
                        <div class="card-header bg-white header-elements-sm-inline">
                            <h5 class="card-title font-weight-semibold">DATA TRANSAKSI</h5>
                        </div>
                        <input type="hidden" id="unit_nopol">
                        <table class="table datatable-transaction table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Polisi</th>
                                <th>Unit</th>
                                <th>Bengkel</th>
                                <th>Pelanggan</th>
                                <th>Keterangan</th>
                                <th>Masuk</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a
                            href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
					</span>

                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i
                                class="icon-lifebuoy mr-2"></i> Support</a></li>
                    <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link"
                                            target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
                    <li class="nav-item"><a
                            href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov"
                            class="navbar-nav-link font-weight-semibold"><span class="text-pink-400"><i
                                    class="icon-cart2 mr-2"></i> Purchase</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="modal-unit" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-semibold">Data Unit</h4>
            </div>
            <table class="table datatable-unit table-bordered ">
                <thead>
                <tr>
                    <th>No</th>
                    <th>No. Polisi</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Wilayah</th>
                    <th>Aksi</th>
                </tr>
                </thead>
            </table>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
