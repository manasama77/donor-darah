@extends('layouts.welcome_template')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-center my-3">
                <img class="logo-donor-darah" src="{{ asset('img/logo-jlm.png') }}" alt="Donor Darah with JLM" />
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
