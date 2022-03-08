var mastergaragejs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-garage').DataTable({
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
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/master/bengkel',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var garage_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/bengkel',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'garage',
                    'garage_id': garage_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#garage_id').val(resp.garage_id);
                    $('#garage_name').val(resp.garage_name);
                    $('#garage_address').val(resp.garage_address);
                    $('#garage_phone').val(resp.garage_phone);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var garage_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/bengkel',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'garage_id': garage_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-garage').DataTable().ajax.reload();
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
                url : adminurl + '/master/bengkel',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'garage_id': $('#garage_id').val(),
                    'garage_name': $('#garage_name').val(),
                    'garage_address': $('#garage_address').val(),
                    'garage_phone': $('#garage_phone').val(),
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
                        $('#garage_id').val('')
                        $('#garage_name').val('')
                        $('#garage_address').val('')
                        $('#garage_phone').val('')
                        $('.datatable-garage').DataTable().ajax.reload();
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
