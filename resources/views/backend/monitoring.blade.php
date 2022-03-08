@extends('layouts.master', ['title' => 'Monitoring'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/ui/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/pickers/daterangepicker.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/monitoring.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item active">Monitoring</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA TRANSAKSI</h5>
                </div>
                <table class="table datatable-monitoring table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Unit</th>
                        <th>Bengkel</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Masuk</th>
                        <th>Status</th>
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
                            <div class="form-group">
                                <label for="transaction_date_in">Tanggal Masuk</label>
                                <input type="text" id="transaction_date_in" class="form-control" placeholder="Ex. 082229366506">
                            </div>
                            <div class="form-group">
                                <label for="transaction_unit">Unit</label>
                                <select id="transaction_unit" data-placeholder="Pilih Unit" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transaction_garage">Bengkel</label>
                                <select id="transaction_garage" data-placeholder="Pilih Bengkel" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transaction_customer">Nama Pelanggan</label>
                                <input type="text" id="transaction_customer" class="form-control" placeholder="Ex. Arif Muntaha">
                            </div>
                            <div class="form-group">
                                <label for="transaction_phone">Nomor Telepon</label>
                                <input type="text" id="transaction_phone" class="form-control" placeholder="Ex. 082229366506">
                            </div>
                            <div class="form-group">
                                <label for="transaction_desc">Keterangan</label>
                                <textarea id="transaction_desc" class="form-control" placeholder="Ex. Service & Ganti Oli"></textarea>
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
@section('modal')
    <div id="modal-edit" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-semibold">UBAH TRANSAKSI</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_transaction_id">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edit_transaction_date_in">Tanggal Masuk</label>
                                <input type="text" id="edit_transaction_date_in" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="edit_transaction_date_finish">Tanggal Selesai</label>
                                <input type="text" id="edit_transaction_date_finish" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="edit_transaction_unit">Unit</label>
                                <select id="edit_transaction_unit" data-placeholder="Pilih Unit" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="edit_transaction_garage">Bengkel</label>
                                <select id="edit_transaction_garage" data-placeholder="Pilih Bengkel" class="form-control select2">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edit_transaction_customer">Nama Pelanggan</label>
                                <input type="text" id="edit_transaction_customer" class="form-control" placeholder="Ex. Arif Muntaha">
                            </div>
                            <div class="col-sm-6">
                                <label for="edit_transaction_phone">Nomor Telepon</label>
                                <input type="text" id="edit_transaction_phone" class="form-control" placeholder="Ex. 082229366506">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="edit_transaction_desc">Keterangan</label>
                                <textarea id="edit_transaction_desc" class="form-control" placeholder="Ex. Service & Ganti Oli"></textarea>
                            </div>

                            <div class="col-sm-6">
                                <label for="edit_transaction_desc_finish">Keterangan Selesai</label>
                                <textarea id="edit_transaction_desc_finish" class="form-control" placeholder="Ex. Service & Ganti Oli"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="edit_transaction_stiker">Stiker</label>
                                <select id="edit_transaction_stiker" data-placeholder="Pilih Status" class="form-control select">
                                    <option></option>
                                    <option value="1">Ada</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="edit_transaction_apar">Apar</label>
                                <select id="edit_transaction_apar" data-placeholder="Pilih Status" class="form-control select">
                                    <option></option>
                                    <option value="1">Ada</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="edit_transaction_status">Status</label>
                                <select id="edit_transaction_status" data-placeholder="Pilih Status" class="form-control select">
                                    <option></option>
                                    <option value="1">Booking</option>
                                    <option value="2">On Procces</option>
                                    <option value="3">Finished</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h5 class="font-weight-semibold">EMISI</h5>
                    <hr/>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="edit_transaction_co">CO</label>
                                <input type="text" id="edit_emisi_co" class="form-control" placeholder="Ex. 20">
                            </div>
                            <div class="col-sm-2">
                                <label for="edit_emisi_hc">HC</label>
                                <input type="text" id="edit_emisi_hc" class="form-control" placeholder="Ex. 21">
                            </div>
                            <div class="col-sm-2">
                                <label for="edit_emisi_co2">CO<sup>2</sup></label>
                                <input type="text" id="edit_emisi_co2" class="form-control" placeholder="Ex. 24">
                            </div>
                            <div class="col-sm-2">
                                <label for="edit_emisi_o2">O<sup>2</sup></label>
                                <input type="text" id="edit_emisi_o2" class="form-control" placeholder="Ex. 25">
                            </div>
                            <div class="col-sm-2">
                                <label for="edit_emisi_lamda">Lamda</label>
                                <input type="text" id="edit_emisi_lamda" class="form-control" placeholder="Ex. 34">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-300" data-dismiss="modal">Keluar</button>
                    <button type="submit" id="update" class="btn bg-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
