@extends('layouts.master', ['title' => 'Data Bengkel'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/master_garage.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master</span>
    <span class="breadcrumb-item active">Data Bengkel</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA BENGKEL</h5>
                </div>
                <table class="table datatable-garage table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bengkel</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
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
                            <input type="hidden" id="garage_id">
                            <div class="form-group">
                                <label for="garage_name">Nama Bengkel</label>
                                <input type="text" id="garage_name" class="form-control" placeholder="Ex. Astra Daihatsu Pekalongan">
                            </div>
                            <div class="form-group">
                                <label for="garage_address">Merk</label>
                                <input type="text" id="garage_address" class="form-control" placeholder="Ex. Jl. Pattimura No. 4 Semarang">
                            </div>
                            <div class="form-group">
                                <label for="garage_phone">Nomor Telepon</label>
                                <input type="text" id="garage_phone" class="form-control" placeholder="Ex. 082229366506">
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
