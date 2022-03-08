var reportunitjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-monitoring').DataTable({
            bprocessing: true,
            bserverSide: true,
            ajax:({
                headers: csrf_token,
                url: adminurl + '/laporan/unit',
                type: 'post',
                dataType: 'json',
                data: function (d) {
                    d._type = 'data';
                    d._data = 'all';
                    d.unit_id = $('.transaction_unit').val();
                },
            }),
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
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
            ],
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var unit_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/unit',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'unit',
                    'unit_id': unit_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#unit_id').val(resp.unit_id);
                    $('#unit_nopol').val(resp.unit_nopol);
                    $('#unit_merk').val(resp.unit_merk);
                    $('#unit_type').val(resp.unit_type);
                    $('#unit_year').val(resp.unit_year);
                    $('#unit_region').val(resp.unit_region);
                }
            });
        });
    }

    var _componentSelect = function (){
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.transaction_unit').select2({
            ajax: {
                headers: csrf_token,
                url: baseurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: function (params){
                    return {
                        search: params.term,
                        _type: 'select',
                        _data: 'unit'
                    }
                },
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumInputLength: 4
        }).on('change', function (){
            var unit_id = $(this).val();
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/laporan/unit',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'unit',
                    'unit_id' : unit_id
                },
                success : function (resp) {
                    $('#unit_nopol').val(resp.unit_nopol)
                    $('#unit_type').val(resp.unit_type)
                    $('#unit_merk').val(resp.unit_merk)
                    $('#unit_year').val(resp.unit_year)
                    $('#unit_region').val(resp.unit_region)
                }
            })
            $('.datatable-monitoring').DataTable().ajax.reload()
        });
    }

    return {
        init: function() {
            _componetnDataTable()
            _componentSelect();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    reportunitjs.init();
});
