@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-3 text-center"><strong>{{ __('Dashboard') }}</strong></h3>

        <div class="row justify-content-center">

            <div class="col-sm-12 col-md-3">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <div class="card-count">
                                <h3>
                                    <strong>{{ $registrants->count() }}</strong>
                                </h3>
                            </div>
                            <div>
                                <h4 class="mb-0">Total Pendaftar</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <div class="card-count">
                                <h3>
                                    <strong>{{ $registrants->where('are_attending', true)->count() }}</strong>
                                </h3>
                            </div>
                            <div>
                                <h4 class="mb-0">Peserta Hadir</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <div class="card-count">
                                <h3>
                                    <strong>{{ $registrants->where('are_attending', false)->count() }}</strong>
                                </h3>
                            </div>
                            <div>
                                <h4 class="mb-0">Peserta Tidak Hadir</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
