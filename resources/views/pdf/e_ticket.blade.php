<style>
    @font-face {
        font-family: 'Poppins';
        src: url("{{ storage_path('fonts/poppins/Poppins-Regular.ttf') }}") format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url("{{ storage_path('fonts/poppins/Poppins-Medium.ttf') }}") format('truetype');
        font-weight: 500;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url("{{ storage_path('fonts/poppins/Poppins-SemiBold.ttf') }}") format('truetype');
        font-weight: 600;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url("{{ storage_path('fonts/poppins/Poppins-Bold.ttf') }}") format('truetype');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url("{{ storage_path('fonts/poppins/Poppins-Black.ttf') }}") format('truetype');
        font-weight: 900;
        font-style: normal;
    }

    * {
        font-family: 'Poppins', sans-serif !important;
        font-size: 12px;
    }

    @page {
        margin: 0px;
    }

    body {
        background: url("{{ public_path('img/etiket_bg_vertical.webp') }}") center no-repeat;
        background-size: cover;
        font-family: 'Poppins', sans-serif;
    }

    .container {
        width: 100%;
        display: flex;
        position: relative;
        justify-content: center;
        text-align: center;
    }

    .nama_peserta_wrapper {
        position: absolute;
        top: 0px;
        left: 0;
        width: 100%;
        height: 50px;
        margin: 0;
        padding: 0;
    }

    .text_nama_peserta {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        font-size: 14px;
        z-index: 1;
        color: #fff;
        font-weight: 500;
        margin: 0;
        padding: 0;
        width: 100%;
        font-family: 'Poppins', sans-serif;
    }

    .nama_peserta {
        position: absolute;
        bottom: 0px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 15px;
        color: #fff;
        font-weight: 700;
        z-index: 1;
        margin: 0;
        padding: 0;
        width: 300px;
        inline-size: 300px;
        overflow-wrap: break-word;
        line-height: normal;
    }

    .tanggal_acara_wrapper {
        position: absolute;
        top: 43;
        left: 0;
        width: 100%;
        height: 50px;
        margin: 0;
        padding: 0;
    }

    .text_tanggal_acara {
        position: absolute;
        top: 0;
        left: 0%;
        font-size: 14px;
        z-index: 1;
        color: #fff;
        font-weight: 500;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .tanggal_acara {
        position: absolute;
        bottom: 0;
        left: 0%;
        font-size: 15px;
        z-index: 1;
        color: #fff;
        font-weight: 700;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .tempat_acara_wrapper {
        position: absolute;
        top: 86;
        left: 0%;
        width: 100%;
        height: 50px;
        margin: 0;
        padding: 0;
    }

    .text_tempat_acara {
        position: absolute;
        top: 0;
        left: 0%;
        font-size: 14px;
        z-index: 1;
        color: #fff;
        font-weight: 500;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .tempat_acara {
        position: absolute;
        bottom: 0;
        left: 0%;
        font-size: 15px;
        z-index: 1;
        color: #fff;
        font-weight: 700;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .jam_acara_wrapper {
        position: absolute;
        top: 129;
        left: 0;
        width: 100%;
        height: 50px;
        margin: 0;
        padding: 0;
    }

    .text_jam_acara {
        position: absolute;
        top: 0;
        left: 0;
        font-size: 14px;
        z-index: 1;
        color: #fff;
        font-weight: 500;
        margin: 0;
        padding: 0;
        width: 100%;
        text-align: center;
    }

    .jam_acara {
        position: absolute;
        bottom: 0;
        left: 0;
        font-size: 15px;
        z-index: 1;
        color: #fff;
        font-weight: 700;
        margin: 0;
        padding: 0;
        text-align: center;
        width: 100%;
    }

    .info-wrapper {
        position: absolute;
        top: 193px;
        left: 50%;
        transform: translateX(-50%);
        width: 490px;
        height: 100%;
    }

    .barcode {
        position: absolute;
        text-align: center;
        top: 10;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
        color: #000;
        margin: 0;
    }

    .text_barcode {
        font-family: 'Poppins', sans-serif;
        position: absolute;
        text-align: left;
        bottom: 1;
        left: 53%;
        transform: translateX(-50%);
        font-size: 16px;
        z-index: 1;
        color: #000;
        font-weight: 700;
        letter-spacing: 5px;
        margin: 0;
    }

    .barcode-bg {
        position: absolute;
        bottom: 7;
        left: 50%;
        transform: translateX(-57%);
        background-color: white;
        width: 100px;
        height: 110px;
        border: 1px solid rgb(0, 0, 0);
        border-radius: 5%;
        padding: 7px;
    }

    .background {
        width: 100%;
        height: 100%;
    }

    .img-wrapper {
        position: absolute;
        top: 30px;
        left: 50%;
        width: 100vw;
        transform: translateX(-50%);
    }

    .img-wrapper .img-logo-jlm {
        width: 150px;
    }

    .img-wrapper .img-logo {
        width: 180px;
        margin-top: -20px;
    }
</style>

<body style="position: relative;">
    <div class="container">
        <div class="img-wrapper">
            <img src="{{ public_path('img/poundfit-with-bnetfit-logo.png') }}" alt="Logo Poundfit with Bnetfit"
                class="img-logo" />
        </div>

        <div class="info-wrapper">
            <div class="nama_peserta_wrapper">
                <p class="text_nama_peserta">Nama</p>
                <p class="nama_peserta">{{ strtoupper($nama_lengkap) }}</p>
            </div>

            <div class="tanggal_acara_wrapper">
                <p class="text_tanggal_acara">Hari & Tanggal</p>
                <p class="tanggal_acara">{{ $tanggal_event }}</p>
            </div>

            <div class="tempat_acara_wrapper">
                <p class="text_tempat_acara">Tempat</p>
                <p class="tempat_acara">{{ $tempat }}</p>
            </div>

            <div class="jam_acara_wrapper">
                <p class="text_jam_acara">Waktu</p>
                <p class="jam_acara">{{ $jam_event }} - Selesai</p>
            </div>
        </div>


        <div class="barcode-bg">
            <p class="text_barcode">
                {{ $random_number }}
            </p>
            <p class="barcode">
                {!! $qrcode !!}
            </p>
        </div>
    </div>
</body>

</html>
