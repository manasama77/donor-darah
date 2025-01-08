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
                <img class="logo-jlm" src="{{ asset('img/logo-jlm.png') }}" alt="JLM Logo" />
            </div>
            <div class="col-12 d-flex justify-content-center my-3">
                <img class="logo-donordarah" src="{{ asset('img/logo-donor-darah.png') }}" alt="Logo Donor Darah" />
            </div>
        </div>

        @if (!$dondar_event)
            <div class="row mb-3" style="min-height: 48vh;">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="alert alert-danger text-center">
                        <h4 class="mb-0">
                            <strong>Peringatan!</strong><br />
                            Acara Donor Darah with JLM belum dijadwalkan
                        </h4>
                    </div>
                </div>
            </div>
        @elseif($exceed === true)
            <div class="row mb-3" style="min-height: 48vh;">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="alert alert-danger text-center">
                        <h4 class="mb-0">
                            <strong>Peringatan!</strong><br />
                            Kuota Pendaftaran untuk Acara Donor Darah with JLM sudah terpenuhi.<br />Silakan coba lagi di
                            lain
                            waktu.
                        </h4>
                    </div>
                </div>
            </div>
        @elseif($closed === true)
            <div class="row mb-3" style="min-height: 48vh;">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="alert alert-danger text-center">
                        <h4 class="mb-0">
                            <strong>Peringatan!</strong><br />
                            Acara Donor Darah with JLM sudah ditutup.<br />Silakan coba lagi di lain waktu.
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
                                                        <td>{{ $dondar_event->event_date_ind }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Waktu</strong></td>
                                                        <td>{{ $dondar_event->event_time_ind }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Lokasi</strong></td>
                                                        <td>
                                                            {{ $dondar_event->location->name }}<br />
                                                            {{ $dondar_event->location->address }}
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
                                    {!! $dondar_event->location->gmap_embed_url !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary fs-5 fw-bold text-center text-white">
                            SYARAT & KETENTUAN
                        </div>
                        <div class="card-body">
                            <ol>
                                <li>Sehat jasmani dan rohani.</li>
                                <li>Usia 17 sampai dengan 60 tahun.</li>
                                <li>Berat badan minimal 48 kg. (untuk pertama kali donor darah).</li>
                                <li>
                                    Tekanan darah :
                                    <ul>
                                        <li>Sistole 100 - 170.</li>
                                        <li>Diastole 70 - 100.</li>
                                    </ul>
                                </li>
                                <li>Kadar Haemoglobin 12,5g% s/d 17,0g%.</li>
                                <li>Interval donor minimal 12 minggu atau 3 bulan sejak donor darah sebelumnya (maksimal 5
                                    kali
                                    dalam 2 tahun).</li>
                                <li>Wanita yang sedang berhalangan (haid) tidak boleh melakukan donor darah minimal seminggu
                                    setelah bersih dari haid.</li>
                                <li>Ibu yang sedang hamil atau menyusui dilarang donor darah.</li>
                                <li>3 hari 3 malam sebelum donor darah, pendonor tidak boleh konsumsi obat,jamu,vitamin atau
                                    suplemen apapun kecuali vitamin C.</li>
                                <li>Namun, harus diingat, demi menjaga kesehatan dan keamanan darah, individu yang antara
                                    lain memiliki kondisi seperti alkoholik, penyakit hepatitis, diabetes militus, epilepsi,
                                    atau kelompok masyarakat risiko tinggi mendapatkan AIDS serta mengalami sakit seperti
                                    demam atau influensa; baru saja dicabut giginya kurang dari tiga hari; pernah menerima
                                    transfusi kurang dari setahun; begitu juga untuk yang belum setahun menato, menindik,
                                    atau akupunktur; hamil; atau sedang menyusui untuk sementara waktu tidak dapat menjadi
                                    donor.
                                </li>
                                <li>Suhu tubuh 36,6-37,5 derajat Celcius.</li>
                            </ol>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger fs-6 fw-bold text-center text-white">
                                            JANGAN MENDONORKAN DARAH JIKA
                                        </div>
                                        <div class="card-body">
                                            <ol>
                                                <li>Mempunyai penyakit jantung dan paru paru.</li>
                                                <li>Menderita kanker.</li>
                                                <li>Menderita tekanan darah tinggi (hipertensi).</li>
                                                <li>Menderita kencing manis (diabetes militus).</li>
                                                <li>Memiliki kecenderungan perdarahan abnormal atau kelainan darah lainnya.
                                                </li>
                                                <li>Menderita epilepsi dan sering kejang.</li>
                                                <li>Menderita atau pernah menderita Hepatitis B atau C.</li>
                                                <li>Mengidap sifilis.</li>
                                                <li>Ketergantungan Narkoba.</li>
                                                <li>Kecanduan Minuman Beralkohol.</li>
                                                <li>Mengidap atau beresiko tinggi terhadap HIV/AIDS.</li>
                                                <li>Dokter menyarankan untuk tidak menyumbangkan darah karena alasan
                                                    kesehatan.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success fs-6 fw-bold text-center text-white">
                                            PANDUAN MENJAGA KESEHATAN MENJELANG DONOR DARAH
                                        </div>
                                        <div class="card-body">
                                            <ol>
                                                <li>Tidur minimal 4 jam sebelum donor</li>
                                                <li>Makanlah 3 - 4 jam sebelum menyumbangkan darah. jangan menyumbangkan
                                                    darah dengan perut
                                                    kosong</li>
                                                <li>Minum lebih banyak dari biasanya pada hari mendonorkan darah (paling
                                                    sedikit 3 gelas
                                                </li>
                                                <li>Setelah proses donor selesai, beristirahat paling sedikit 10 menit
                                                    sambil menikmati
                                                    makanan yang
                                                    disediakan panitia,
                                                    sebelum kembali beraktifitas</li>
                                                <li>Kembali bekerja setelah donor darah tidak berbahaya untuk kesehatan</li>
                                                <li>Untuk menghindari bengkak di lokasi bekas jarum, hindari mengangkat
                                                    benda berat selama
                                                    12 jam</li>
                                                <li>Banyak minum sampai 72 jam ke depan untuk mengembalikan stamina</li>
                                            </ol>
                                        </div>
                                    </div>
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
                                    <label for="dob" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="dob" id="dob"
                                        value="{{ old('dob') }}" required />
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
                                    <input type="tel" class="form-control" name="phone_emergency"
                                        id="phone_emergency" required placeholder="Masukkan No Kontak Darurat..."
                                        value="{{ old('phone_emergency') }}">
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="name_emergency" class="form-label">Nama Kontak Darurat</label>
                                    <input type="text" class="form-control" name="name_emergency" id="name_emergency"
                                        required placeholder="Masukkan Nama Kontak Darurat..."
                                        value="{{ old('name_emergency') }}">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                    <div class="input-group">
                                        <select class="form-select" name="golongan_darah" id="golongan_darah" required>
                                            <option @selected(old('golongan_darah') == 'a') value="a">A</option>
                                            <option @selected(old('golongan_darah') == 'b') value="b">B</option>
                                            <option @selected(old('golongan_darah') == 'ab') value="ab">AB</option>
                                            <option @selected(old('golongan_darah') == 'o') value="o">O</option>
                                        </select>
                                        <span class="input-group-text">Rh</span>
                                        <select class="form-select" name="rhesus" id="rhesus" required>
                                            <option @selected(old('rhesus') == 'positive') value="positive">Positif (+)</option>
                                            <option @selected(old('rhesus') == 'negative') value="negative">Negatif (-)</option>
                                            <option @selected(old('rhesus') == 'unknown') value="unknown">Tidak tahu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="weight" class="form-label">Berat Badan</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="weight" id="weight"
                                            required placeholder="Masukkan Berat Badan..." value="{{ old('weight') }}">
                                        <span class="input-group-text">Kg</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="previous_donation" class="form-label">Pernah mengikuti donor darah dalam 3
                                        bulan terakhir ?</label>
                                    <select class="form-select" name="previous_donation" id="previous_donation" required>
                                        <option @selected(old('previous_donation') == '0') value="0">Tidak</option>
                                        <option @selected(old('previous_donation') == '1') value="1">Ya</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                                    <label for="donor_darah_info" class="form-label">Mendapatkan informasi Donor Darah
                                        dari?</label>
                                    <select class="form-select" name="donor_darah_info" id="donor_darah_info" required>
                                        <option @selected(old('donor_darah_info') == 'Sosial Media') value="Sosial Media">Sosial Media</option>
                                        <option @selected(old('donor_darah_info') == 'Radio') value="Radio">Radio</option>
                                        <option @selected(old('donor_darah_info') == 'Website') value="Website">Website</option>
                                        <option @selected(old('donor_darah_info') == 'Teman / Keluarga') value="Teman / Keluarga">Teman/Keluarga
                                        </option>
                                        <option @selected(old('donor_darah_info') == 'MyBnetfit') value="MyBnetfit">MyBnetfit</option>
                                        <option @selected(old('donor_darah_info') == 'Poster') value="Poster">Poster</option>
                                        <option @selected(old('donor_darah_info') == 'Email') value="Email">Email</option>
                                        <option @selected(old('donor_darah_info') == 'Lain-lain') value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                @php
                                    $donor_darah_info_etc = old('donor_darah_info_etc');
                                    $style = 'display: none;';

                                    if ($donor_darah_info_etc) {
                                        $style = '';
                                    }
                                @endphp
                                <div id="group_donor_darah_info_etc" class="col-sm-12 col-md-12 mb-3"
                                    style="{{ $style }}">
                                    <label for="donor_darah_info_etc" class="form-label">Informasi Donor Darah
                                        Lainnya</label>
                                    <input type="text" class="form-control" name="donor_darah_info_etc"
                                        id="donor_darah_info_etc" placeholder="Masukkan Informasi Donor Darah Lainnya..."
                                        value="{{ $donor_darah_info_etc }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane"></i> Daftar Sekarang
                                </button>
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
        let donorDarahInfo = document.getElementById('donor_darah_info');
        let group_donor_darah_info_etc = document.getElementById('group_donor_darah_info_etc');
        let donorDarahInfoEtc = document.getElementById('donor_darah_info_etc');
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

        donorDarahInfo.addEventListener('change', function() {
            if (this.value == 'Lain-lain') {
                group_donor_darah_info_etc.style.display = 'block';
                donorDarahInfoEtc.required = true;
            } else {
                group_donor_darah_info_etc.style.display = 'none';
                donorDarahInfoEtc.required = false;
            }
        });
    </script>
@endpush
