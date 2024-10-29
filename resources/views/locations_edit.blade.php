@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start justify-content-md-between mb-3">
            <h3 class="text-center"><strong>{{ __('Edit Locations') }}</strong></h3>
            <a href="{{ route('locations') }}" class="btn btn-dark mb-0">
                <i class="fas fa-backward"></i>
                Back
            </a>
        </div>

        <div class="row">

            <div class="col-12 col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">{{ __('Form') }}</div>
                    <div class="card-body">
                        <form action="{{ route('locations.update', $location->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Location Name" value="{{ old('name') ?? $location->name }}" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control" placeholder="Location Address" required>{{ old('address') ?? $location->address }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gmap_embed_url" class="form-label">Google Map Embed URL</label>
                                <textarea id="gmap_embed_url" name="gmap_embed_url" rows="12" class="form-control"
                                    placeholder="Location Google Maps URL" required>{{ old('gmap_embed_url') ?? $location->gmap_embed_url }}</textarea>
                            </div>

                            <div class="accordion">
                                <div class="accordion-item">
                                    <h2 class="acacordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#how-to-get-gmaps-url" aria-expanded="true"
                                            aria-controls="how-to-get-gmaps-url">
                                            How to get Google Maps Embed URL
                                        </button>
                                    </h2>
                                    <div id="how-to-get-gmaps-url" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <ul>
                                                <li>
                                                    Buka halaman <a href="https://maps.google.com"
                                                        target="_blank">maps.google.com</a>
                                                </li>
                                                <li>Klik Button Share</li>
                                                <img src="{{ asset('img/how-to-get-gmaps-url-1.png') }}"
                                                    alt="How To Get GMAPS URL 1" class="img-fluid" />
                                                <li>Pada pop-up Share, klik tab <strong>Embed a map</strong> . Dilanjutkan
                                                    dengan
                                                    menekan tombol <strong>COPY HTML</strong></li>
                                                <img src="{{ asset('img/how-to-get-gmaps-url-2.png') }}"
                                                    alt="How To Get GMAPS URL 2" class="img-fluid" />
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.css"
        rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.js">
    </script>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this location?')) {
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
@endpush
