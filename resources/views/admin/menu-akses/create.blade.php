
<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('menu_access.index', ['role_id' => Crypt::encrypt($role->id)]) }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                     <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form" action="{{ route('menu_access.store', ['role_id' => Crypt::encrypt($role->id)]) }}"
                            method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Nama Menu:</label>

                                        @if ($menu->count() > 0)
                                            <select class="form-control" name="menu_id">
                                                @foreach ($menu as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->menu_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select class="form-control">
                                                <option>
                                                    Tidak Ada Menu Yang Bisa di Tambah
                                                </option>
                                            </select>
                                        @endif

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Create:</label>
                                        <select class="form-control " name="create">
                                            <option value="1">
                                                YES
                                            </option>
                                            <option value="0">
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-lg-6">
                                        <label>Read:</label>
                                        <select class="form-control " name="read">
                                            <option value="1">
                                                YES
                                            </option>
                                            <option value="0">
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Update:</label>
                                        <select class="form-control " name="update">
                                            <option value="1">
                                                YES
                                            </option>
                                            <option value="0">
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-lg-6">
                                        <label>Delete:</label>
                                        <select class="form-control " name="delete">
                                            <option value="1">
                                                YES
                                            </option>
                                            <option value="0">
                                                NO
                                            </option>
                                        </select>
                                    </div>

                                </div>


                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" id="kt_notify_btn"
                                                class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Batal</button>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <a href="{{ url(Request::segment(1) . '/' . Request::segment(2) . '/' . Request::segment(3) . '/' . Crypt::encrypt($role->id)) }}"
                                                class="btn btn-warning">Kembali</a>
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
