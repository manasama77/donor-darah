@extends('layouts.welcome_template')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-center my-3">
                <img class="logo-poundfit" src="{{ asset('img/poundfit-with-bnetfit-logo.png') }}"
                    alt="Poundfit with Bnetfit" />
            </div>
        </div>

        @if (!$poundfit_event)
            <div class="row mb-3" style="min-height: 48vh;">
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        <h4 class="mb-0">
                            <strong>Peringatan!</strong><br />
                            Acara Poundfit dengan Bnetfit belum dijadwalkan
                        </h4>
                    </div>
                </div>
            </div>
        @else
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <div class="d-flex flex-column justify-content-between h-100 p-4">
                                        <div style="min-height: 200px;">
                                            <h3><strong>Detail Acara</strong></h3>
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Hari/Tanggal</strong></td>
                                                        <td>{{ $poundfit_event->event_date_ind }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Waktu</strong></td>
                                                        <td>{{ $poundfit_event->event_time_ind }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Lokasi</strong></td>
                                                        <td>
                                                            {{ $poundfit_event->location->name }}<br />
                                                            {{ $poundfit_event->location->address }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-start text-md-center">
                                            <p class="mb-1">
                                                <strong><i class="fas fa-info-circle"></i> Informasi lebih
                                                    lanjut:</strong>
                                            </p>
                                            <a href="https://wa.me/6282210069526" class="btn btn-primary">
                                                <i class="fab fa-whatsapp"></i> 082210069526
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-7">
                                    {!! $poundfit_event->location->gmap_embed_url !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-md-8 mx-auto">
                    <form id="form" action="{{ route('welcome.store') }}" method="post" class="mb-0">
                        @csrf
                        <div class="card">
                            <div class="card-header bg-primary h5 text-center text-white">
                                <strong>Form Registrasi</strong>
                            </div>
                            <div class="card-body row">

                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Masukkan Nama..." value="{{ old('name') }}" required />
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="gender" id="gender" required>
                                        <option @selected(old('gender') == 'female') value="female">Perempuan</option>
                                        <option @selected(old('gender') == 'male') value="male">Laki-Laki</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required
                                        placeholder="Masukkan Email..." value="{{ old('email') }}" autocomplete="email">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="phone" class="form-label">No WhatsApp</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" required
                                        placeholder="Masukkan No WhatsApp..." value="{{ old('phone') }}">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="city" class="form-label">Kota Domisili</label>
                                    <input type="text" class="form-control" name="city" id="city" required
                                        placeholder="Masukkan Kota Domisili..." value="{{ old('city') }}">
                                </div>

                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="phone_emergency" class="form-label">No Kontak Darurat</label>
                                    <input type="tel" class="form-control" name="phone_emergency" id="phone_emergency"
                                        required placeholder="Masukkan No Kontak Darurat..."
                                        value="{{ old('phone_emergency') }}">
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="name_emergency" class="form-label">Nama Kontak Darurat</label>
                                    <input type="text" class="form-control" name="name_emergency" id="name_emergency"
                                        required placeholder="Masukkan Nama Kontak Darurat..."
                                        value="{{ old('name_emergency') }}">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="bring_ripstix" class="form-label">Membawa Ripstix Pribadi?</label>
                                    <select class="form-select" name="bring_ripstix" id="bring_ripstix" required>
                                        <option @selected(old('bring_ripstix') == '0') value="0">Tidak</option>
                                        <option @selected(old('bring_ripstix') == '1') value="1">Ya</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="poundfit_info" class="form-label">Mendapatkan informasi Poundfit
                                        dari?</label>
                                    <select class="form-select" name="poundfit_info" id="poundfit_info" required>
                                        <option @selected(old('poundfit_info') == 'Sosial Media') value="Sosial Media">Sosial Media</option>
                                        <option @selected(old('poundfit_info') == 'Radio') value="Radio">Radio</option>
                                        <option @selected(old('poundfit_info') == 'Website') value="Website">Website</option>
                                        <option @selected(old('poundfit_info') == 'Teman / Keluarga') value="Teman / Keluarga">Teman/Keluarga
                                        </option>
                                        <option @selected(old('poundfit_info') == 'MyBnetfit') value="MyBnetfit">MyBnetfit</option>
                                        <option @selected(old('poundfit_info') == 'Poster') value="Poster">Poster</option>
                                        <option @selected(old('poundfit_info') == 'Email') value="Email">Email</option>
                                        <option @selected(old('poundfit_info') == 'Lain-lain') value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                @php
                                    $poundfit_info_etc = old('poundfit_info_etc');
                                    $style = 'display: none;';

                                    if ($poundfit_info_etc) {
                                        $style = '';
                                    }
                                @endphp
                                <div id="group_poundfit_info_etc" class="col-sm-12 col-md-12 col-lg-6 mb-3"
                                    style="{{ $style }}">
                                    <label for="poundfit_info_etc" class="form-label">Informasi Poundfit
                                        Lainnya</label>
                                    <input type="text" class="form-control" name="poundfit_info_etc"
                                        id="poundfit_info_etc" placeholder="Masukkan Informasi Poundfit Lainnya..."
                                        value="{{ $poundfit_info_etc }}">
                                </div>

                                <div class="col-12">
                                    <div class="alert alert-info mb-0 text-center">
                                        <h4 class="mb-0">
                                            <strong>
                                                <i class="fas fa-info-circle"></i> Jangan lupa membawa KTP dan
                                                Matras
                                                Olahraga mu yaa!
                                            </strong>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Daftar Sekarang
                                </button>
                                <a href="#" class="btn btn-warning w-100 mt-2" role="button">
                                    <i class="fas fa-search"></i> Cek Status Pembayaran
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <script>
        let poundfitInfo = document.getElementById('poundfit_info');
        let group_poundfit_info_etc = document.getElementById('group_poundfit_info_etc');
        let poundfitInfoEtc = document.getElementById('poundfit_info_etc');
        let form = document.getElementById('form');
        let submitButton = form.querySelector('[type=submit]');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitButton.disabled = true;
            setTimeout(function() {
                submitButton.disabled = false;
            }, 3000);
            form.submit();
        });

        poundfitInfo.addEventListener('change', function() {
            if (this.value == 'Lain-lain') {
                group_poundfit_info_etc.style.display = 'block';
                poundfitInfoEtc.required = true;
            } else {
                group_poundfit_info_etc.style.display = 'none';
                poundfitInfoEtc.required = false;
            }
        });
    </script>
@endpush
