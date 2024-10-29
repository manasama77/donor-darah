@extends('layouts.welcome_template')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-center my-3">
                <img class="logo-poundfit" src="{{ asset('img/poundfit-with-bnetfit-logo.png') }}"
                    alt="Poundfit with Bnetfit" />
            </div>
        </div>

        @if (!$registrant)
            <div class="row mb-3">
                <div class="col-12 col-md-4 mx-auto">
                    <div class="alert alert-danger text-center">
                        <h4 class="mb-0">
                            <strong>Peringatan!</strong><br />
                            Data Pendaftar Tidak Ditemukan
                        </h4>
                    </div>
                </div>
            </div>
        @else
            <div class="row mb-3" style="min-height: 48vh;">
                <div class="col-12 col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>Hi, <strong>{{ $registrant->name }}</strong>,</h5>
                            <p>
                                Terima kasih telah mendaftar di Poundfit with Bnetfit.
                            </p>
                            <p>
                                Acara akan dilakukan pada<br />
                                {{ $poundfit_event->event_date_ind }} pukul {{ $poundfit_event->event_time_ind }} di
                                {{ $poundfit_event->location->name }}.
                            </p>

                            <a href="{{ route('welcome.download', $hash_id) }}" class="btn btn-warning" target="_blank">
                                Download E-ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
