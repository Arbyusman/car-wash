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

                        <form class="form"
                            action="{{ route('menu_access.update', ['role_id' => Crypt::encrypt($menuAccesess->id), 'id' => Crypt::encrypt($role->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Nama Menu:</label>

                                        <select class="form-control" name="menu_id">
                                            @foreach ($menu as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id === $menuAccesess->menu_id) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>


                                    </div>
                                    <div class="col-lg-6">
                                        <label>Create:</label>
                                        <select class="form-control " name="create">
                                            <option value="1" @if ($menuAccesess->create === 1) selected @endif>
                                                YES
                                            </option>
                                            <option value="0" @if ($menuAccesess->create === 0) selected @endif>
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-lg-6">
                                        <label>Read:</label>
                                        <select class="form-control " name="read">
                                            <option value="1" @if ($menuAccesess->read === 1) selected @endif>
                                                YES
                                            </option>
                                            <option value="0" @if ($menuAccesess->read === 0) selected @endif>
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Update:</label>
                                        <select class="form-control " name="update">
                                            <option value="1" @if ($menuAccesess->update === 1) selected @endif>
                                                YES
                                            </option>
                                            <option value="0" @if ($menuAccesess->update === 0) selected @endif>
                                                NO
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-lg-6">
                                        <label>Delete:</label>
                                        <select class="form-control " name="delete">
                                            <option value="1" @if ($menuAccesess->delete === 1) selected @endif>
                                                YES
                                            </option>
                                            <option value="0" @if ($menuAccesess->delete === 0) selected @endif>
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
