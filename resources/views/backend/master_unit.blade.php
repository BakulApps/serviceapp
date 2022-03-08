@extends('layouts.master', ['title' => 'Data Unit'])
@section('jsplugin')
    <script src="{{asset('assets/js/plugin/table/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/form/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugin/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/js/page/master_unit.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Master</span>
    <span class="breadcrumb-item active">Data Unit</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white header-elements-sm-inline">
                    <h5 class="card-title font-weight-semibold">DATA UNIT</h5>
                </div>
                <table class="table datatable-unit table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Polisi</th>
                        <th>Merek</th>
                        <th>Tipe</th>
                        <th>Tahun</th>
                        <th>Wilayah</th>
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
                            <input type="hidden" id="unit_id">
                            <div class="form-group">
                                <label for="unit_nopol">Nomor Polisi</label>
                                <input type="text" id="unit_nopol" class="form-control" placeholder="Ex. K-4636-ARC">
                            </div>
                            <div class="form-group">
                                <label for="unit_merk">Merk</label>
                                <input type="text" id="unit_merk" class="form-control" placeholder="Ex. Toyota">
                            </div>
                            <div class="form-group">
                                <label for="unit_type">Tipe</label>
                                <input type="text" id="unit_type" class="form-control" placeholder="Ex. GRAN MAX BLIND VAN AC 1.3 M/T">
                            </div>
                            <div class="form-group">
                                <label for="unit_year">Tahun</label>
                                <input type="text" id="unit_year" class="form-control" placeholder="Ex. 2014">
                            </div>
                            <div class="form-group">
                                <label for="unit_region">Wilayah</label>
                                <input type="text" id="unit_region" class="form-control" placeholder="Ex. JEPARA">
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
