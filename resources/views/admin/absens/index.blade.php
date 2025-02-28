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
                        <a href="{{ route('absen.index') }}" class="btn btn-success font-weight-bold  me-5">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>

                    </div>

                </div>
                <div class="table-responsive">
                    <table id="user" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">Nama Lengkap</th>
                                <th style="width: 10%">Role</th>
                                <th style="width: 10%">Absen Masuk</th>
                                {{-- <th style="width: 10%">Status Absen Masuk</th> --}}
                                {{-- <th style="width: 20%">Absen Pulang</th> --}}
                                {{-- <th style="width: 10%">Status Absen Pulang</th> --}}
                                {{-- <th style="width: 20%">Waktu Kerja</th> --}}
                                {{-- <th style="width: 20%">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->user->role->name ?? 'N/A' }}</td>
                                    <td>{{ $item->check_in ?? 'N/A' }}</td>
                                    {{-- <td>{{ $item->status_check_in ?? 'N/A' }}</td> --}}
                                    {{-- <td>{{ $item->check_out ?? 'N/A' }}</td> --}}
                                    {{-- <td>{{ $item->status_check_out ?? 'N/A' }}</td> --}}
                                    {{-- <td>{{ $item->total_work_time ?? 'N/A' }}</td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const endpoint = '/fingerprint/data';

        function getFingerprintData() {
            $.ajax({
                url: endpoint,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    console.log('Fingerprint data:', data);
                    if (data.status === 'success') {
                        window.location.href = '/admin/users/create?finger_id=' + data.data;
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching fingerprint data:', error);
                }
            });
        }

        getFingerprintData();
        setInterval(getFingerprintData, 1500);
    </script>


    <script>
        $("#user").DataTable({
            scrollY: true,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                left: 2
            }
        });
    </script>
</x-default-layout>
