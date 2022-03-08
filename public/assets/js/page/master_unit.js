var masterunitjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-unit').DataTable({
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
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/master/unit',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
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
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var unit_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/unit',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'unit_id': unit_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-unit').DataTable().ajax.reload();
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
    }
    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/unit',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'unit_id': $('#unit_id').val(),
                    'unit_nopol': $('#unit_nopol').val(),
                    'unit_type': $('#unit_type').val(),
                    'unit_merk': $('#unit_merk').val(),
                    'unit_year': $('#unit_year').val(),
                    'unit_region': $('#unit_region').val(),
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
                        $('#unit_id').val('')
                        $('#unit_nopol').val('')
                        $('#unit_type').val('')
                        $('#unit_merk').val('')
                        $('#unit_year').val('')
                        $('#unit_region').val('')
                        $('.datatable-unit').DataTable().ajax.reload();
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
    masterunitjs.init();
});
