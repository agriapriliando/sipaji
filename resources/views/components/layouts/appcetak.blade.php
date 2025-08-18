<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Primary Meta Tags -->
    <title>Surat Pembatalan</title>
    <meta name="title" content="Validasi PIN IAKNPKY" />
    <meta name="description" content="Layanan Penerbitan Surat Validasi PIN Calon Lulusan IAKN Palangka Raya. Dikelola Oleh UPT TIPD IAKN Palangka Raya" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Validasi PIN IAKNPKY" />
    <meta property="og:description" content="Layanan Penerbitan Surat Validasi PIN Calon Lulusan IAKN Palangka Raya. Dikelola Oleh UPT TIPD IAKN Palangka Raya" />
    <meta property="og:image" content="https://iaknpky.ac.id/wp-content/uploads/2025/04/iakn_icon.png" />
    <meta property="og:image:width" content="72" />
    <meta property="og:image:height" content="72" />
    <meta property="og:image:type" content="image/png" />

    <!-- X (Twitter) -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="Validasi PIN IAKNPKY" />
    <meta property="twitter:description" content="Layanan Penerbitan Surat Validasi PIN Calon Lulusan IAKN Palangka Raya. Dikelola Oleh UPT TIPD IAKN Palangka Raya" />

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <script src="https://kit.fontawesome.com/b2dad3da2e.js" crossorigin="anonymous"></script>

    <!-- Set page size here: A5, A4 or A3
        -->
    <!-- Set also "landscape" if you need -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }

        @page {
            size: A4
        }

        @import url('https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&display=swap');

        * {
            font-family: "Arimo", sans-serif;
        }

        .watermark-draft {
            font-size: 50px;
            display: block;
            position: fixed;
            z-index: 1;
            background: white;
            opacity: 0.1;
            top: 10%;
            left: 34%;
            transform: translate(-50%, -50%);
            transform: rotate(-40deg);
        }

        @media print {
            .noprint {
                visibility: hidden;
            }
        }

        table.customTable {
            width: 100%;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 0;
            border-color: #0a0a0a;
            border-style: solid;
            color: #000000;
        }

        table.customTable td,
        table.customTable th {
            border-width: 0;
            border-color: #0a0a0a;
            border-style: solid;
            padding: 3px 0;
        }

        table.customTable thead {
            background-color: #b8b8b8;
        }

        .responsive {
            width: 100%;
            height: auto;
        }

        /* CSS */
        .button-87 {
            margin: 10px;
            padding: 10px 20px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border-radius: 10px;
            display: block;
            border: 0px;
            font-weight: 400;
            box-shadow: 0px 0px 14px -7px #f019f0;
            background-image: linear-gradient(45deg, #d92fff 0%, #5619f0 51%, #d92fff 100%);
            /* cursor: pointer; */
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-87:hover {
            background-position: right center;
            /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
        }

        .button-87:active {
            transform: scale(0.35);
        }

        .absolute {
            position: fixed;
            top: 14px
        }

        .btnedit {
            text-decoration: underline;
            cursor: pointer;
        }

        .btn-print {
            background-color: #127c32;
            /* Green */
            border: none;
            border-radius: 3px;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }

        .d-none {
            display: none;
        }

        .d-input {
            width: 320px;
        }

        ol {
            list-style-type: decimal;
            /* pastikan pakai angka */
            padding-left: 20px;
            /* beri ruang untuk angka */
        }

        table ol {
            margin: 0;
            /* biar rapi di dalam tabel */
        }

        .bold {
            font-weight: bold;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">
    {{ $slot }}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>
