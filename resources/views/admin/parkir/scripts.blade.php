@push('scripts')
    <script>
        let modal = '#modal-form';
        let modal2 = '#import_petugas';
        let modalDetail = '#modal-detail';
        let button = '#submitBtn';
        let table;

        $(function() {
            $('#spinner-border').hide();
        });

        table = $('#table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('report.data', compact('start', 'end')) }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'status'
                },
                {
                    data: 'petugas'
                },
                {
                    data: 'jammasuk'
                },
                {
                    data: 'jamkeluar'
                },

            ],
            paginate: false,
            searching: false,
            bInfo: false,
            order: []
        });

        $('#filter_status').change(function() {
            table.ajax.reload();
            $('#filter_petugas').val('');
        });

        $('#filter_petugas').change(function() {
            table.ajax.reload();
        });

        function resetFilter() {
            $('#filter_status').val('');
            $('#filter_petugas').val('');
            table.ajax.reload();
        }

        function addForm(url, title = 'Tambah Daftar Petugas') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('POST');
            $('#spinner-border').hide();
            $(button).prop('disabled', false);
            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Daftar Petugas') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('PUT');
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    resetForm(`${modal} form`);
                    loopForm(response.data);
                })
                .fail(errors => {
                    Swall.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                });
        }

        function detailForm(url, title = 'Detail Petugas') {
            $.get(url)
                .done(response => {
                    $(modalDetail).modal('show');
                    $(`${modalDetail} .modal-title`).text(title);

                    $('.name').text(response.data.name)
                    $('.email').text(response.data.email)
                    $('.password').text(response.data.pass)
                })

        }

        function submitForm(originalForm) {
            $(button).prop('disabled', true);
            $('#spinner-border').show();
            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                    $(button).prop('disabled', false);
                    $('#spinner-border').hide();
                    table.ajax.reload();
                })
                .fail(errors => {
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide()
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
        }

        function deleteData(url, name) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menghapus parkir ' + name +
                    ' !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Iya, Hapus!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                            '_method': 'delete'
                        })
                        .done(response => {
                            if (response.status = 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                                table.ajax.reload();
                            }
                        })
                        .fail(errors => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps! Gagal!',
                                text: errors.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            table.ajax.reload();
                        });
                }
            })
        }
    </script>
@endpush
