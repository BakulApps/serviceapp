var reporttransaction = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-transaction').DataTable({
            bprocessing: true,
            bserverSide: true,
            ajax:({
                headers: csrf_token,
                url: adminurl + '/laporan/transaksi',
                type: 'post',
                dataType: 'json',
                data: function (d) {
                    d._type = 'data';
                    d._data = 'all';
                    d.transaction_status = $('.transaction_status').val();
                    d.transaction_month = $('.transaction_month').val();
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
                {className: 'text-center', targets: 7},
                {className: 'text-center', targets: 8},
            ],
        });
    }

    var _componentSelect = function (){
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });

        $('.transaction_status').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
        }).on('change', function (){
            $('.datatable-transaction').DataTable().ajax.reload()
        });

        $('.transaction_month').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
        }).on('change', function (){
            $('.datatable-transaction').DataTable().ajax.reload()

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
    reporttransaction.init();
});
