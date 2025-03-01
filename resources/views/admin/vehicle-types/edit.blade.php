<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('menus.index') }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                    <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form" action="{{ route('menus.update', ['id' => Crypt::encrypt($menu->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Nama Menu:</label>
                                        <input value="{{ $menu->name }}" type="text" name="menu_name"
                                            class="form-control" placeholder="Masukkan Nama Menu" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>URL:</label>
                                        <input value="{{ $menu->link }}" type="text" class="form-control"
                                            name="link" placeholder="Masukkan URL" />
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Attribute Icon:</label>
                                        <input value="{{ $menu->attribute }}" type="text" name="attribute"
                                            class="form-control" placeholder="Masukkan Attribute Icon" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Kategori:</label>
                                        <select class="form-control" name="category">
                                            <option value="1" {{ $menu->category === 1 ? 'selected' : '' }}>Config
                                                Menu
                                            </option>
                                            <option value="2" {{ $menu->category === 2 ? 'selected' : '' }}>Main
                                                Menu
                                            </option>
                                            <option value="3" {{ $menu->category === 3 ? 'selected' : '' }}>Master
                                                Data
                                                Menu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Posisi Menu:</label>
                                        <input value="{{ $menu->position }}" type="number" name="position"
                                            class="form-control" placeholder="Masukkan Posisi Menu" />
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
