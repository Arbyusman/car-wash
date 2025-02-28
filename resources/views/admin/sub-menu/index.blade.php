<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0  pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{ $title }}
                            <span class="text-muted pt-2 font-size-sm d-block">{{ $description }}</span>
                        </h3>

                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('menus.index') }}"
                            class="btn btn-light-primary font-weight-bolder me-2">
                            <i class="ki-duotone ki-double-left fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Kembali</a>

                        <a title="Refresh" href="{{ route('submenus.index', ['menu_id' => Crypt::encrypt($menu->id)]) }}"
                            class="btn btn-success font-weight-bold me-2">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>
                        <a title="Tambah"
                            href="{{ route('submenus.create', ['menu_id' => Crypt::encrypt($menu->id)]) }}"
                            class="btn btn-primary font-weight-bolder">
                            <i class="ki-duotone ki-plus fs-1 ">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Tambah
                        </a>

                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable"
                        style="margin-top: 13px !important">
                        <thead>
                            <tr>
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">Nama Sub Menu</th>
                                <th style="width: 20%">URL</th>
                                <th style="width: 25%">Atribute</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($subMenus as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name ?? 'N/A' }}</td>
                                    <td>{{ $item->link ?? 'N/A' }}</td>
                                    <td>{{ $item->attribute ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('submenus.edit', ['menu_id' => Crypt::encrypt($menu->id), 'id' => Crypt::encrypt($item->id)]) }}"
                                            title="Edit menu" class="btn btn-icon btn-success">
                                            <i class="fas far fa-edit"></i>
                                        </a>

                                        <button title="Hapus Menu" type="button" class="btn btn-icon btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>


                                        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitle{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <form
                                                    action="{{ route('submenus.delete', ['menu_id' => Crypt::encrypt($menu->id), 'id' => Crypt::encrypt($item->id)]) }}"
                                                    method="POST" class="modal-content">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" value="{{ Crypt::encrypt($item->id) }}"
                                                        name="id">
                                                    <div class="modal-body justify-content-center d-flex">
                                                        <div class="row col-12 pt-8">
                                                            <div
                                                                class="row text-center justify-content-center align-items-center">
                                                                <h2>Menghapus Data SubMenu</h2>
                                                                <span class="text-muted"> Setelah dihapus, data SubMenu
                                                                    tidak
                                                                    dapat di
                                                                    kembalikan, yakin ingin menghapus?</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pb-12 justify-content-center  d-flex">
                                                        <button type="button" class="m-2 btn btn-primary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="m-2 btn btn-danger">YA</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-default-layout>
