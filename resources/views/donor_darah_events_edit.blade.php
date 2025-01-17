@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start justify-content-md-between mb-3">
            <h3 class="text-center"><strong>{{ __('Edit Donor Darah Event') }}</strong></h3>
            <a href="{{ route('donor-darah-events') }}" class="btn btn-dark mb-0">
                <i class="fas fa-backward"></i>
                Back
            </a>
        </div>

        <div class="row">

            <div class="col-12 col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">{{ __('Form') }}</div>
                    <div class="card-body">
                        <form action="{{ route('donor-darah-events.update', $donor_darah_event->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="location_id" class="form-label">Lokasi</label>
                                <select id="location_id" name="location_id" class="form-select" required>
                                    <option value="">Pilih Lokasi</option>
                                    @foreach ($locations as $location)
                                        <option @selected($donor_darah_event->location_id == $location->id) value="{{ $location->id }}">
                                            {{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="event_date" class="form-label">Tanggal Acara</label>
                                <div class="input-group">
                                    <span class="input-group-text">Tanggal</span>
                                    <input type="date" id="event_date" name="event_date" class="form-control"
                                        value="{{ old('event_date') ?? $donor_darah_event->event_date_only }}" required />
                                    <span class="input-group-text">Jam</span>
                                    <input type="time" id="event_time" name="event_time" class="form-control"
                                        value="{{ old('event_time') ?? $donor_darah_event->event_time_only }}" required />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pic_whatsapp" class="form-label">WA PIC</label>
                                <input type="tel" id="pic_whatsapp" name="pic_whatsapp" class="form-control"
                                    placeholder="Masukan WA PIC"
                                    value="{{ old('pic_whatsapp') ?? $donor_darah_event->pic_whatsapp }}" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="is_published" class="form-label">Status</label>
                                <select id="is_published" name="is_published" class="form-select" required>
                                    <option @selected($donor_darah_event->is_published) value="1">Aktif</option>
                                    <option @selected(!$donor_darah_event->is_published) value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="registrant_limit" class="form-label">Limit Peserta</label>
                                <input type="number" id="registrant_limit" name="registrant_limit" class="form-control"
                                    placeholder="Masukan Limit Peserta"
                                    value="{{ old('registrant_limit') ?? $donor_darah_event->registrant_limit }}"
                                    min="0" required />
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
