@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start justify-content-md-between mb-3">
            <h3 class="text-center"><strong>{{ __('Locations') }}</strong></h3>
            <a href="{{ route('locations.create') }}" class="btn btn-primary mb-0">
                <i class="fas fa-plus"></i>
                Create New Location
            </a>
        </div>

        <div class="row">

            <div class="col-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="table" class="table-bordered table-dark table">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-cogs"></i></th>
                                <th>Nama Lokasi</th>
                                <th>Alamat</th>
                                <th>Google Map</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info">
                                                <i class="fas fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-danger" onclick="confirmDelete({{ $location->id }});">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <form id="delete-{{ $location->id }}"
                                            action="{{ route('locations.destroy', $location->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" style="display: none;">
                                        </form>
                                    </td>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->address }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="modalGmap('{{ $location->gmap_embed_url }}')">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modal_map">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Google Maps</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        let myModal;
        let modal_map = document.getElementById('modal_map');

        document.addEventListener('DOMContentLoaded', function() {
            myModal = new bootstrap.Modal(modal_map, {
                keyboard: false,
                backdrop: 'static',
                focus: true
            });
        });

        let tables = new DataTable('#table', {
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],
            "order": [
                [1, "asc"]
            ]
        });

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this location?')) {
                document.getElementById('delete-' + id).submit();
            }
        }

        function modalGmap(url) {
            myModal.show();
            modal_map.querySelector('.modal-body').innerHTML = url;
        }
    </script>
@endpush
