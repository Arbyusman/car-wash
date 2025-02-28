
<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('submenu_access.index', ['role_id' => Crypt::encrypt($role->id), 'menu_id' => Crypt::encrypt($menu->id)]) }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                     <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form"
                            action="{{ route('submenu_access.update', ['role_id' => Crypt::encrypt($role->id), 'menu_id' => Crypt::encrypt($menu->id), 'id' => Crypt::encrypt($sub_menu_access->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{ __('Nama Group') }}</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Nama Group"
                                                name="group_name" value="{{ $role->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{ __('Nama Menu') }}</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Nama Menu"
                                                name="menu_name" value="{{ $menu->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('sub_menu_id')) has-error @endif">
                                        <label class="col-sm-2 control-label">{{ __('Sub Menu') }} <span class="required"
                                                style="color: #dd4b39;">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('sub_menu_id'))
                                                <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i>
                                                    {{ $errors->first('sub_menu_id') }}</label>
                                            @endif
                                            <select class="form-control" name="sub_menu_id">
                                                <option value="">- Pilih Sub Menu -</option>
                                                @foreach ($sub_menu as $v)
                                                    <option value="{{ $v->id }}"
                                                        @if ($sub_menu_access->sub_menu_id == $v->id) selected @endif>
                                                        {{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('create')) has-error @endif">
                                        <label class="col-sm-2 control-label">{{ __('Create') }} <span class="required"
                                                style="color: #dd4b39;">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('create'))
                                                <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i>
                                                    {{ $errors->first('create') }}</label>
                                            @endif
                                            <select class="form-control" name="create">
                                                <option value="">- Pilih -</option>
                                                <option value="1" @if ($sub_menu_access->create == '1') selected @endif>
                                                    Aktif</option>
                                                <option value="0" @if ($sub_menu_access->create == '0') selected @endif>
                                                    Tidak Aktif</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('read')) has-error @endif">
                                        <label class="col-sm-2 control-label">{{ __('Read') }} <span class="required"
                                                style="color: #dd4b39;">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('read'))
                                                <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i>
                                                    {{ $errors->first('read') }}</label>
                                            @endif
                                            <select class="form-control" name="read">
                                                <option value="">- Pilih -</option>
                                                <option value="1" @if ($sub_menu_access->read == '1') selected @endif>
                                                    Aktif</option>
                                                <option value="0" @if ($sub_menu_access->read == '0') selected @endif>
                                                    Tidak Aktif</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('update')) has-error @endif">
                                        <label class="col-sm-2 control-label">{{ __('Update') }} <span class="required"
                                                style="color: #dd4b39;">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('update'))
                                                <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i>
                                                    {{ $errors->first('update') }}</label>
                                            @endif
                                            <select class="form-control" name="update">
                                                <option value="">- Pilih -</option>
                                                <option value="1" @if ($sub_menu_access->update == '1') selected @endif>
                                                    Aktif</option>
                                                <option value="0" @if ($sub_menu_access->update == '0') selected @endif>
                                                    Tidak Aktif</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group @if ($errors->has('delete')) has-error @endif">
                                        <label class="col-sm-2 control-label">{{ __('Delete') }} <span class="required"
                                                style="color: #dd4b39;">*</span></label>
                                        <div class="col-sm-12">
                                            @if ($errors->has('delete'))
                                                <label class="control-label" for="inputError"><i
                                                        class="fa fa-times-circle-o"></i>
                                                    {{ $errors->first('delete') }}</label>
                                            @endif
                                            <select class="form-control" name="delete">
                                                <option value="">- Pilih -</option>
                                                <option value="1" @if ($sub_menu_access->delete == '1') selected @endif>
                                                    Aktif</option>
                                                <option value="0" @if ($sub_menu_access->delete == '0') selected @endif>
                                                    Tidak Aktif</option>
                                            </select>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-flat btn-sm"
                                                title="Simpan Data"> Simpan</button>
                                            <button type="reset" class="btn btn-danger btn-flat btn-sm"
                                                title="Reset Data"> Reset</button>
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
