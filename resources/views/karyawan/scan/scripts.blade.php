@push('scripts_vendor')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
@endpush

@push('scripts')
    <script>
        function dataQrCode(qrcode) {
            $.ajax({
                type: "GET",
                url: "/karyawan/scan/data/" + qrcode,
                success: function(response) {
                    $('#wajah').attr('src', response.data.foto_wajah);
                    $('#plat').attr('src', response.data.foto_plat);
                    $('#waktumasuk').text(response.data.waktumasuk);
                    $('#waktukeluar').text(response.data.waktukeluar);
                    $('#status').text(response.data.status);
                },
                error: function(response) {
                    $('#wajah').attr('src', "");
                    $('#plat').attr('src', "");
                    $('#waktumasuk').text("");
                    $('#waktukeluar').text("");
                    $('#status').text("");
                }
            });
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);

            $('#code_qr').text(decodedText);

            let qrcode = decodedText;

            html5QrcodeScanner.clear();

            csrf_token = $('meta[name="csrf-token"]').attr('content');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true,
            })
            swalWithBootstrapButtons.fire({
                title: 'Sistem Parkir PHB',
                text: 'No parkir ' + qrcode +
                    ' valid',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Oke!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('scan.validasi_qrcode') }}",
                        data: {
                            '_token': csrf_token,
                            'qrcode': qrcode
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Opps! Gagal!',
                                text: response.responseJSON.message,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    });
                    dataQrCode(qrcode);
                    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                    $('#wajah').attr('src', "");
                    $('#plat').attr('src', "");
                    $('#waktumasuk').text("");
                    $('#waktukeluar').text("");
                    $('#status').text("");
                }
            })

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);

        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endpush
