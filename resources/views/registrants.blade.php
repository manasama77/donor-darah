@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-3 text-center"><strong>{{ __('Registrants') }}</strong></h3>

        <div class="row">

            <div class="col-12">
                <div class="table-responsive">
                    <table id="table" class="table-bordered table-dark table">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-cogs"></i></th>
                                <th>Barcode</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Email</th>
                                <th>No WA</th>
                                <th>Kota</th>
                                <th>No Kontak Darurat</th>
                                <th>Nama Kontak Darurat</th>
                                <th class="text-center">Donor < 3bln</th>
                                <th>Info Donor Darah</th>
                                <th>Info Donor Darah Lainnya</th>
                                <th class="text-center">Kehadiran</th>
                                <th>Lokasi Acara</th>
                                <th>Tanggal Acara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registrants as $registrant)
                                <tr>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning">
                                            <i class="fas fa-file-download"></i>
                                        </a>
                                    </td>
                                    <td>{{ $registrant->barcode }}</td>
                                    <td>{{ $registrant->name }}</td>
                                    <td>{{ $registrant->gender }}</td>
                                    <td>
                                        {{ $registrant->dob }} ({{ $registrant->age }} thn)
                                    </td>
                                    <td>{{ $registrant->email }}</td>
                                    <td>{{ $registrant->phone }}</td>
                                    <td>{{ $registrant->city }}</td>
                                    <td>{{ $registrant->phone_emergency }}</td>
                                    <td>{{ $registrant->name_emergency }}</td>
                                    <td class="text-center">{!! $registrant->previous_donation_badge !!}</td>
                                    <td>{{ $registrant->donor_darah_info }}</td>
                                    <td>{{ $registrant->donor_darah_info_etc }}</td>
                                    <td class="text-center">{!! $registrant->attending_badge !!}</td>
                                    <td>{{ $registrant->donor_darah_event->location->name }}</td>
                                    <td>{{ $registrant->donor_darah_event->event_datetime }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.css"
        rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.js">
    </script>

    <script>
        let tables = new DataTable('#table', {
            "scrollX": true,
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
            "order": [
                [1, "desc"]
            ]
        });
    </script>
@endpush
