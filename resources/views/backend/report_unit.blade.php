@extends('layouts.master', ['title' => 'Laporan Unit'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/report_unit.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Laporan</span>
    <span class="breadcrumb-item active">Unit</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add font-weight-semibold">INFORMASI UNIT</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="unit_nopol">Cari Unit</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control transaction_unit" data-placeholder="Pilih Unit" data-fouc>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="unit_nopol">Nomor Polosi</label>
                                <input type="text" id="unit_nopol" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="unit_merk">Merk</label>
                                <input type="text" id="unit_merk" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="unit_type">Tipe</label>
                                <input type="text" id="unit_type" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="unit_year">Tahun</label>
                                <input type="text" id="unit_year" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="unit_region">Wilayah</label>
                                <input type="text" id="unit_region" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">TRANSAKSI</h5>
                </div>
                <table class="table datatable-monitoring table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
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
@endsection
