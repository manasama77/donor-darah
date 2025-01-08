@extends('layouts.welcome_template')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-center my-3">
                <a href="{{ route('welcome') }}">
                    <img class="logo-jlm" src="{{ asset('img/logo-jlm.png') }}" alt="JLM Logo" />
                </a>
            </div>
            <div class="col-12 d-flex justify-content-center my-3">
                <img class="logo-donordarah" src="{{ asset('img/logo-donor-darah.png') }}" alt="Logo Donor Darah" />
            </div>
        </div>

        <div class="row mb-3" style="min-height: 48vh;">
            <div class="col-12 col-md-4 mx-auto">
                <div class="alert alert-danger text-center">
                    <h4 class="mb-0">
                        <strong>Peringatan!</strong><br />
                        Data Pendaftar Tidak Ditemukan
                    </h4>
                </div>
            </div>
        </div>

    </div>
@endsection
