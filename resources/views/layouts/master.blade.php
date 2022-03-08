<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
<script type="text/javascript">
    var baseurl = "{{route('home')}}"
    var adminurl = "{{route('admin.home')}}"
</script>
@include('layouts.navbar')
<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="{{auth('admin')->user()->user_image == null ? asset('assets/image/placeholders/placeholder.jpg') : asset('storage/image/placeholders/'. auth('admin')->user()->user_image)}}" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>
                        <div class="media-body">
                            <div class="media-title font-weight-semibold">{{auth('admin')->user()->user_fullname}}</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;{{auth('admin')->user()->user_address}}
                            </div>
                        </div>

                        <div class="ml-3 align-self-center">
                            <a href="{{route('admin.setting')}}" class="text-white"><i class="icon-cog3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.mainmenu')
        </div>
    </div>
    <div class="content-wrapper">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{$title}}</span> - {{$setting->value('app_name')}}</h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="{{route('admin.home')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Root</a>
                        @yield('breadcrumb')
                    </div>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
        @yield('modal')
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
