
<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('roles.index') }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                     <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form" action="{{ route('roles.update', ['id' => Crypt::encrypt($role->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>Nama Group:</label>
                                        <input type="text" name="name" class="form-control" value="{{ $role->name }}"
                                            placeholder="Masukkan Nama Menu" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Role ID:</label>
                                        <input type="text" name="role_id" class="form-control"
                                            value="{{ $lastRole }}" placeholder="Masukkan Nama Menu" readonly />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Status:</label>
                                        <select type="text" class="form-control" name="status"
                                            placeholder="Masukkan URL">
                                            <option value="1" {{ $role->status === 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0" {{ $role->status === 0 ? 'selected' : '' }}>Tidak Aktif
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
