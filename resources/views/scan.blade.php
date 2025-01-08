@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-3 text-center"><strong>{{ __('Scan Peserta') }}</strong></h3>

        <div class="row justify-content-center">
            <div class="col-12 col-md-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" placeholder="Barcode" />
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $('#barcode').on('change', function() {
                    console.log("Adam")
                    $.ajax({
                        url: `{{ route('scan.proses') }}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            barcode: $(this).val()
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                $('#barcode').val('');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#barcode').val('');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseText,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#barcode').val('');
                        }
                    });
                });
            </script>
        @endpush
    @endsection
