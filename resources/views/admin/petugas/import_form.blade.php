<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg" id="import_petugas">
    <x-slot name="title">
        Import Petugas
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-lg-12">
            <li>
                Menu ini digunakan untuk mengisi data petugas dalam bentuk excel dengan Format xlsx
            </li>
            <li>
                Pastikan dalam Excel hanya ada 1 worksheet yang berisi Data Petugas
            </li>
            <li>
                Upload berulang tidak menjadi masalah, Program Otomatis akan melakukan Proses Insert pada data yang
                belum ada saja
            </li>
            <li>
                Berikut contoh file unggahan , silahkan <a download="contoh_format_upload_petugas.xlsx"
                    href="{{ asset('download/contoh_format_upload_petugas.xlsx') }}"
                    class="btn btn-sm btn-success">download disini</a>
            </li>
            <li>
                Silahkan Koreksi Data Excelnya Sesuai dengan Data Asli Apabila ada yang belum tepat, dan pastikan
                menggunakan format unggahan yang telah disediakan.
            </li>
        </div>
    </div>

    <div class="form-group mt-2">
        <label for="petugas">File Upload</label>
        <input type="file" name="excel_file" id="excel_file" class="form-control">
    </div>

    <x-slot name="footer">
        <button type="button" data-dismiss="modal" class="btn btn-sm btn-default">
            Close
        </button>
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            {{-- <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> --}}
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>

</x-modal>
