@extends('layouts.master', ['title' => 'Laporan Transaksi'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/report_transaction.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Laporan</span>
    <span class="breadcrumb-item active">Transaksi</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white header-elements-inline">
                            <h5 class="card-title title-add font-weight-semibold">INFORMASI TRANSAKSI</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="transaction_status">Status Transaksi</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control transaction_status" data-placeholder="Pilih Status" data-fouc>
                                            <option value="0">Semua Status</option>
                                            <option value="1">Booking</option>
                                            <option value="2">On Procces</option>
                                            <option value="3">Finish</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="transaction_month">Bulan Transaksi</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control transaction_month" data-placeholder="Pilih Bulan" data-fouc>
                                            <option value="0">Semua</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>
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
                <table class="table datatable-transaction table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Polisi</th>
                        <th>Unit</th>
                        <th>Bengkel</th>
                        <th>Pelanggan</th>
                        <th>No Hp.</th>
                        <th>Status</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Selesai</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
