@extends('layouts.master', ['title' => 'Data Pengguna'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/master_user.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master</span>
    <span class="breadcrumb-item active">Data Pengguna</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA PENGGUNA</h5>
                </div>
                <table class="table datatable-user table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Pengguna</th>
                        <th>Kata Sandi</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add font-weight-semibold">TAMBAH DATA</h5>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="user_id">
                            <div class="form-group">
                                <label for="user_fullname">Nama Lengkap</label>
                                <input type="text" id="user_fullname" class="form-control" placeholder="Ex. Darmanto">
                            </div>
                            <div class="form-group">
                                <label for="user_name">Nama Pengguna</label>
                                <input type="text" id="user_name" class="form-control" placeholder="Ex. darmanto">
                            </div>
                            <div class="form-group">
                                <label for="user_pass">Kata Sandi</label>
                                <input type="password" id="user_pass" class="form-control" placeholder="Ex. ********">
                            </div>
                            <div class="form-group">
                                <label for="user_pass_re">Ulangi Sandi</label>
                                <input type="password" id="user_pass_re" class="form-control" placeholder="Ex. *********">
                            </div>
                            <div class="form-group">
                                <label for="user_address">Alamat</label>
                                <input type="text" id="user_address" class="form-control" placeholder="Ex. Menganti - Kedung - Jepara">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn bg-info btn-labeled btn-labeled-left btn-sm" id="submit" value="store"><b><i class="icon-floppy-disk"></i></b> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
