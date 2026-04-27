<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Advocated Admin Studio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

    <style>
        :root{
            --adv-bg:#07111f;
            --adv-bg-soft:#101c2e;
            --adv-panel:#132238;
            --adv-panel-2:#182b45;
            --adv-stroke:rgba(148,163,184,0.16);
            --adv-text:#e8eefc;
            --adv-muted:#8ea0bf;
            --adv-brand:#38bdf8;
            --adv-brand-2:#f97316;
            --adv-success:#10b981;
            --adv-danger:#fb7185;
            --adv-warning:#f59e0b;
        }

        *{
            scrollbar-width:thin;
            scrollbar-color:rgba(56,189,248,0.45) rgba(15,23,42,0.55);
        }

        body{
            font-family:'Manrope', sans-serif;
            min-height:100vh;
            background:
                radial-gradient(circle at top left, rgba(56,189,248,0.18), transparent 32%),
                radial-gradient(circle at 80% 12%, rgba(249,115,22,0.16), transparent 26%),
                linear-gradient(160deg, #05101d 0%, #091525 52%, #0a1830 100%);
            color:var(--adv-text);
        }

        h1,h2,h3,h4,.brand-text{
            font-family:'Playfair Display', serif;
            letter-spacing:0.01em;
        }

        .wrapper{
            background:transparent;
        }

        .main-header.navbar{
            border-bottom:1px solid var(--adv-stroke);
            background:rgba(8,16,30,0.82);
            backdrop-filter:blur(18px);
        }

        .content-wrapper{
            background:transparent;
        }

        .content-header{
            padding:1.5rem 0.5rem 0.25rem;
        }

        .content-header h1{
            font-size:2rem;
            margin:0;
        }

        .main-sidebar{
            background:
                linear-gradient(180deg, rgba(9,18,34,0.98), rgba(10,24,48,0.98)),
                linear-gradient(140deg, rgba(56,189,248,0.12), transparent 45%);
            border-right:1px solid rgba(148,163,184,0.12);
        }

        .brand-link{
            border-bottom:1px solid rgba(148,163,184,0.12) !important;
            padding:1.1rem 1rem;
            background:rgba(255,255,255,0.02);
        }

        .brand-link .brand-text{
            color:#f8fafc;
            font-size:1.25rem;
        }

        .sidebar{
            padding:1rem 0.6rem 1.25rem;
        }

        .card,
        .small-box{
            background:linear-gradient(180deg, rgba(17,29,48,0.98), rgba(15,24,39,0.92));
            border:1px solid rgba(148,163,184,0.14);
            border-radius:22px;
            box-shadow:0 22px 45px rgba(4,10,25,0.28);
            overflow:hidden;
        }

        .card-header{
            background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0));
            border-bottom:1px solid rgba(148,163,184,0.12);
        }

        .small-box{
            padding:0.6rem 0;
            border-radius:20px;
        }

        .small-box>.inner,
        .small-box>.icon{
            color:var(--adv-text);
        }

        .small-box.bg-info,
        .small-box.bg-success,
        .small-box.bg-warning{
            background:linear-gradient(145deg, rgba(19,34,56,0.98), rgba(10,19,33,0.96)) !important;
        }

        .table{
            color:var(--adv-text);
        }

        .table thead th{
            border-bottom-color:rgba(148,163,184,0.18);
            background:rgba(255,255,255,0.03);
        }

        .table td,
        .table th{
            border-top-color:rgba(148,163,184,0.12);
            vertical-align:middle;
        }

        .form-control,
        .custom-select,
        textarea{
            background:rgba(8,17,31,0.86);
            border:1px solid rgba(148,163,184,0.18);
            color:#f8fafc;
            border-radius:14px;
        }

        .form-control:focus,
        .custom-select:focus,
        textarea:focus{
            background:rgba(8,17,31,0.96);
            color:#fff;
            border-color:rgba(56,189,248,0.7);
            box-shadow:0 0 0 0.18rem rgba(56,189,248,0.12);
        }

        .form-control::placeholder,
        textarea::placeholder{
            color:rgba(191,219,254,0.46);
        }

        label{
            color:#dbe7fb;
            font-weight:600;
            font-size:0.92rem;
        }

        .btn{
            border-radius:999px;
            font-weight:700;
            letter-spacing:0.01em;
            transition:transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .btn:hover{
            transform:translateY(-1px);
            box-shadow:0 12px 28px rgba(15,23,42,0.25);
        }

        .btn-primary{
            background:linear-gradient(90deg, var(--adv-brand), #2563eb);
            border-color:transparent;
        }

        .btn-warning{
            color:#0f172a;
            border-color:transparent;
        }

        .btn-outline-light{
            border-color:rgba(226,232,240,0.28);
        }

        .badge{
            border-radius:999px;
            padding:0.55rem 0.8rem;
            font-weight:700;
            letter-spacing:0.02em;
        }

        .alert{
            border:none;
            border-radius:18px;
        }

        .adv-page-shell{
            padding-bottom:2rem;
        }

        .adv-shell-card{
            background:linear-gradient(145deg, rgba(19,34,56,0.92), rgba(10,18,30,0.96));
            border:1px solid rgba(148,163,184,0.14);
            border-radius:24px;
            box-shadow:0 24px 40px rgba(4,10,25,0.2);
        }

        .adv-hero{
            position:relative;
            overflow:hidden;
            padding:1.5rem;
            margin-bottom:1.5rem;
        }

        .adv-hero::before{
            content:"";
            position:absolute;
            inset:0;
            background:
                radial-gradient(circle at top right, rgba(56,189,248,0.2), transparent 32%),
                radial-gradient(circle at left bottom, rgba(249,115,22,0.16), transparent 28%);
            pointer-events:none;
        }

        .adv-hero>*{
            position:relative;
            z-index:1;
        }

        .adv-hero-copy{
            max-width:760px;
        }

        .adv-hero-subtitle{
            color:var(--adv-muted);
            line-height:1.75;
            margin-bottom:0;
        }

        .adv-chip{
            display:inline-flex;
            align-items:center;
            gap:0.5rem;
            padding:0.55rem 0.95rem;
            border-radius:999px;
            background:rgba(56,189,248,0.12);
            border:1px solid rgba(56,189,248,0.22);
            color:#d9f3ff;
            font-weight:700;
            font-size:0.85rem;
        }

        .adv-metric{
            padding:1rem 1.1rem;
            border-radius:18px;
            border:1px solid rgba(148,163,184,0.1);
            background:rgba(255,255,255,0.03);
            min-height:100%;
        }

        .adv-metric small{
            color:var(--adv-muted);
            display:block;
            margin-bottom:0.35rem;
            text-transform:uppercase;
            letter-spacing:0.08em;
            font-weight:700;
            font-size:0.7rem;
        }

        .adv-metric strong{
            font-size:1.4rem;
            font-weight:800;
            color:#fff;
        }

        .adv-pill{
            display:inline-flex;
            align-items:center;
            gap:0.35rem;
            padding:0.35rem 0.75rem;
            border-radius:999px;
            background:rgba(255,255,255,0.06);
            color:#dbeafe;
            font-size:0.8rem;
            font-weight:700;
        }

        .adv-file-preview{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:0.75rem;
            padding:0.85rem 1rem;
            border-radius:16px;
            background:rgba(255,255,255,0.03);
            border:1px solid rgba(148,163,184,0.1);
        }

        .adv-list-reset{
            list-style:none;
            padding:0;
            margin:0;
        }

        .adv-list-reset li + li{
            margin-top:0.65rem;
        }

        .pagination{
            gap:0.35rem;
        }

        .page-link{
            border:none;
            border-radius:12px;
            background:rgba(255,255,255,0.04);
            color:#dbeafe;
        }

        .page-item.active .page-link{
            background:linear-gradient(90deg, var(--adv-brand), #2563eb);
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select{
            margin-left:0.4rem;
        }

        @keyframes pulse{
            0%{transform:scale(1)}
            50%{transform:scale(1.15)}
            100%{transform:scale(1)}
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

@include('admin.layouts.navbar')

@include('admin.layouts.sidebar')

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>@yield('title')</h1>
</div>
</section>

<section class="content">
<div class="container-fluid">

@if(session('success'))
    <div class="alert alert-success shadow-sm">
        <i class="fas fa-circle-check mr-2"></i>{{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger shadow-sm">
        <strong class="d-block mb-2">Please review the form carefully.</strong>
        <ul class="mb-0 pl-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('content')

</div>
</section>

</div>

@include('admin.layouts.footer')

</div>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- Export Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('scripts')

@stack('scripts')

</body>
</html>
