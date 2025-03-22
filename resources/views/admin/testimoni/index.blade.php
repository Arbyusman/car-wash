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
                        <a title="Refresh" href="{{ route('testimonis.index') }}"
                            class="btn btn-success font-weight-bold me-2">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>

                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 5%">NO</th>
                                <th style="width: 10%">Name</th>
                                <th style="width: 10%">Email</th>
                                <th style="width: 60%">Description</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($testimonis->isEmpty())
                                <x-no-data-row colspan="4" message="Data tidak ditemukan" />
                            @else
                                @foreach ($testimonis as $testimoni)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $testimoni->name ?? 'N/A' }}</td>
                                        <td>{{ $testimoni->email ?? 'N/A' }}</td>
                                        <td>{{ $testimoni->description ?? 'N/A' }}</td>
                                        <td>
                                            <button title="Detail Testimoni" type="button"
                                                class="btn btn-icon btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#detail-testimoni{{ $testimoni->id }}">
                                                <i class="fas far fa-eye"></i>
                                            </button>

                                            <x-modal id="detail-testimoni{{ $testimoni->id }}" class="mw-650px">
                                                <x-slot name="title">Detail Testimoni</x-slot>
                                                <x-slot name="body">
                                                    <div class="fv-row mb-4">
                                                        <x-label class="mb-2 fs-6 fw-semibold" value="Name" />
                                                        <x-input type="text" id="name{{ $testimoni?->id }}"
                                                            name="name" placeholder="name"
                                                            value="{{ $testimoni?->name }}"  readonly/>
                                                    </div>
                                                    <div class="fv-row mb-4">
                                                        <x-label class="mb-2 fs-6 fw-semibold" value="Email" />
                                                        <x-input type="text" id="email{{ $testimoni?->id }}"
                                                            name="email" placeholder="email"
                                                            value="{{ $testimoni?->email }}"  readonly/>
                                                    </div>

                                                    <div class="fv-row mb-4">
                                                        <x-label class="mb-2 fs-6 fw-semibold" value="Description" />
                                                        <textarea rows="5" name="description" id="description{{ $testimoni?->id }}"
                                                            class="form-control form-control-solid" placeholder="description" readonly>
                                                                    {{ $testimoni?->description ?? 'N/A' }}
                                                                </textarea>

                                                    </div>

                                                </x-slot>
                                            </x-modal>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    {{ $testimonis->links() }}

                </div>


            </div>
        </div>
    </div>



</x-default-layout>
