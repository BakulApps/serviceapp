var mastergaragejs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-monitoring').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: false,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ Sampai _END_ Total _TOTAL_ Entri',
                search: '_INPUT_',
                binfo: false,
                orderable: false,
                searchPlaceholder: 'Pencarian...',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;' }
            },
            columnDefs : [
                {className: 'text-center', targets: 0},
                {className: 'text-center', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6},
                {className: 'text-center', targets: 7},
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/monitoring',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var transaction_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/monitoring',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'transaction',
                    'transaction_id': transaction_id,
                },
                success : function (resp) {
                    $('#edit_transaction_id').val(resp.transaction_id)
                    $('#edit_transaction_date_in').val(resp.transaction_date_in)
                    $('#edit_transaction_date_finish').val(resp.transaction_date_finish)
                    $('#edit_transaction_unit').append('<option value="'+resp.transaction_unit.id+'" selected>'+resp.transaction_unit.text+'</option>')
                    $('#edit_transaction_garage').append('<option value="'+resp.transaction_garage.id+'" selected>'+resp.transaction_garage.text+'</option>')
                    $('#edit_transaction_customer').val(resp.transaction_customer)
                    $('#edit_transaction_phone').val(resp.transaction_phone)
                    $('#edit_transaction_desc').text(resp.transaction_desc)
                    $('#edit_transaction_desc_finish').text(resp.transaction_desc_finish)
                    $('#edit_transaction_stiker').val(resp.transaction_stiker).change()
                    $('#edit_transaction_apar').val(resp.transaction_apar).change()
                    $('#edit_transaction_status').val(resp.transaction_status).change()
                    $('#edit_emisi_co').val(resp.transaction_emisi.emisi_co)
                    $('#edit_emisi_hc').val(resp.transaction_emisi.emisi_hc)
                    $('#edit_emisi_co2').val(resp.transaction_emisi.emisi_co2)
                    $('#edit_emisi_o2').val(resp.transaction_emisi.emisi_o2)
                    $('#edit_emisi_lamda').val(resp.transaction_emisi.emisi_lamda)
                   $('#modal-edit').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var transaction_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/monitoring',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'transaction_id': transaction_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-monitoring').DataTable().ajax.reload();
                }
            });
        })
    }
    var _componentSelect = function (){
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.select').select2({
            minimumResultsForSearch: Infinity,
        });
        $('#transaction_unit').select2({
            ajax: {
                headers: csrf_token,
                url: baseurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: function (params){
                    var query = {
                        search: params.term,
                        _type : 'select',
                        _data : 'unit'
                    }
                    return query
                },
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
        });
        $('#transaction_garage').select2({
            ajax: {
                headers: csrf_token,
                url: baseurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: function (params){
                    var query = {
                        search: params.term,
                        _type : 'select',
                        _data : 'garage'
                    }
                    return query
                },
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
        });
        $('#edit_transaction_unit').select2({
            ajax: {
                headers: csrf_token,
                url: baseurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: function (params){
                    var query = {
                        search: params.term,
                        _type : 'select',
                        _data : 'unit'
                    }
                    return query
                },
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
        });
        $('#edit_transaction_garage').select2({
            ajax: {
                headers: csrf_token,
                url: baseurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: function (params){
                    var query = {
                        search: params.term,
                        _type : 'select',
                        _data : 'garage'
                    }
                    return query
                },
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
        });
        $('#transaction_date_in').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        $('#edit_transaction_date_in').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
        $('#edit_transaction_date_finish').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }
    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/monitoring',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'transaction_id': $('#transaction_id').val(),
                    'transaction_date_in': $('#transaction_date_in').val(),
                    'transaction_unit': $('#transaction_unit').val(),
                    'transaction_garage': $('#transaction_garage').val(),
                    'transaction_customer': $('#transaction_customer').val(),
                    'transaction_phone': $('#transaction_phone').val(),
                    'transaction_desc': $('#transaction_desc').val(),
                },
                success : function (resp) {
                    if (resp.class === 'danger'){
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                    }
                    else {
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                        $('.title-add').html('TAMBAH DATA');
                        $('#submit').val('store');
                        $('#transaction_date_in').val('')
                        $('#transaction_unit').val('').trigger('change')
                        $('#transaction_garage').val('').trigger('change')
                        $('#transaction_customer').val('')
                        $('#transaction_phone').val('')
                        $('#transaction_desc').val('')
                        $('.datatable-monitoring').DataTable().ajax.reload();
                    }
                }
            })
        })
        $("#update").click(function () {
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/monitoring',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    'transaction_id' : $('#edit_transaction_id').val(),
                    'transaction_date_in' : $('#edit_transaction_date_in').val(),
                    'transaction_date_finish' : $('#edit_transaction_date_finish').val(),
                    'transaction_unit' : $('#edit_transaction_unit').val(),
                    'transaction_garage' : $('#edit_transaction_garage').val(),
                    'transaction_customer' : $('#edit_transaction_customer').val(),
                    'transaction_phone' : $('#edit_transaction_phone').val(),
                    'transaction_desc' : $('#edit_transaction_desc').val(),
                    'transaction_desc_finish' : $('#edit_transaction_desc_finish').val(),
                    'transaction_stiker' : $('#edit_transaction_stiker').val(),
                    'transaction_apar' : $('#edit_transaction_apar').val(),
                    'transaction_status' : $('#edit_transaction_status').val(),
                    'emisi_co' : $('#edit_emisi_co').val(),
                    'emisi_hc' : $('#edit_emisi_hc').val(),
                    'emisi_co2' : $('#edit_emisi_co2').val(),
                    'emisi_o2' : $('#edit_emisi_o2').val(),
                    'emisi_lamda' : $('#edit_emisi_lamda').val(),
                },
                success : function (resp) {
                    if (resp.class === 'danger'){
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                    }
                    else {
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                        $('#edit_transaction_id').val('')
                        $('#edit_transaction_date_in').val('')
                        $('#edit_transaction_date_finish').val('')
                        $('#edit_transaction_unit').val('').trigger('change')
                        $('#edit_transaction_garage').val('').trigger('change')
                        $('#edit_transaction_customer').val('')
                        $('#edit_transaction_phone').val('')
                        $('#edit_transaction_desc').val('')
                        $('#edit_transaction_desc_finish').val('')
                        $('#edit_transaction_stiker').val('').trigger('change')
                        $('#edit_transaction_apar').val('').trigger('change')
                        $('#edit_transaction_status').val('').trigger('change')
                        $('#edit_emisi_co').val('')
                        $('#edit_emisi_hc').val('')
                        $('#edit_emisi_co2').val('')
                        $('#edit_emisi_o2').val('')
                        $('#edit_emisi_lamda').val('')
                        $('.datatable-monitoring').DataTable().ajax.reload();
                        $('#modal-edit').modal('hide')
                    }
                }
            })
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    mastergaragejs.init();
});
