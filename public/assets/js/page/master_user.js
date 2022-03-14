var masteruserjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-user').DataTable({
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
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/master/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var user_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'user',
                    'user_id': user_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#user_id').val(resp.user_id);
                    $('#user_fullname').val(resp.user_fullname);
                    $('#user_name').val(resp.user_name);
                    $('#user_address').val(resp.user_address);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var user_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'user_id': user_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-user').DataTable().ajax.reload();
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
                url : adminurl + '/master/pengguna',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'user_id': $('#user_id').val(),
                    'user_fullname': $('#user_fullname').val(),
                    'user_name': $('#user_name').val(),
                    'user_pass': $('#user_pass').val(),
                    'user_pass_re': $('#user_pass_re').val(),
                    'user_address': $('#user_address').val(),
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
                        $('#user_id').val('')
                        $('#user_fullname').val('')
                        $('#user_name').val('')
                        $('#user_pass').val('')
                        $('#user_pass_re').val('')
                        $('#user_address').val('')
                        $('.datatable-user').DataTable().ajax.reload();
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
    masteruserjs.init();
});
