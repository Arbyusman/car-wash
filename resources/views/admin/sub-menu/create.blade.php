<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('submenus.index', ['menu_id' => Crypt::encrypt($menu->id)]) }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                    <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form"
                            action="{{ route('submenus.store', ['menu_id' => Crypt::encrypt($menu->id)]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Nama Sub Menu:</label>
                                        <input type="text" name="sub_menu_name" class="form-control"
                                            placeholder="Masukkan Nama Sub Menu" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>URL:</label>
                                        <input type="text" class="form-control" name="link"
                                            placeholder="Masukkan URL" />
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Posisi Menu:</label>
                                        <input type="number" name="position" class="form-control"
                                            placeholder="Masukkan Posisi Menu" />
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label>Atribute:</label>
                                        <input type="text" name="attribute" class="form-control"
                                            placeholder="Masukkan Posisi Menu" />
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" id="kt_notify_btn"
                                                class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-default-layout>
