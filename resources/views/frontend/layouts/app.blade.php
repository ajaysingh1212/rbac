<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Advocated')</title>
    <meta name="description" content="@yield('meta_description', config('advocated_site.brand.tagline'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --sand:#f6efe7;
            --sand-2:#efe0d0;
            --white:#fffdf9;
            --ink:#172235;
            --muted:#5f6876;
            --line:rgba(23,34,53,0.1);
            --gold:#b56d42;
            --gold-dark:#965432;
            --navy:#173553;
            --olive:#45635b;
            --shadow:0 24px 50px rgba(23,34,53,0.09);
            --radius-xl:34px;
            --radius-lg:24px;
            --radius-md:18px;
        }

        *{
            box-sizing:border-box;
        }

        html{
            scroll-behavior:smooth;
        }

        body{
            margin:0;
            color:var(--ink);
            font-family:'Manrope',sans-serif;
            overflow-x:hidden;
            background:
                radial-gradient(circle at top left, rgba(181,109,66,0.16), transparent 25%),
                radial-gradient(circle at 86% 10%, rgba(23,53,83,0.08), transparent 18%),
                linear-gradient(180deg, #fbf6f0 0%, #f1e5d8 100%);
        }

        a{
            color:inherit;
            text-decoration:none;
        }

        img{
            display:block;
            max-width:100%;
        }

        button,
        input,
        textarea{
            font:inherit;
        }

        .site-shell{
            min-height:100vh;
        }

        .container{
            width:min(1220px, calc(100% - 32px));
            margin:0 auto;
        }

        .top-strip{
            background:#13293f;
            color:#f7efe6;
            font-size:0.9rem;
        }

        .top-strip__inner{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:18px;
            flex-wrap:wrap;
            padding:10px 0;
        }

        .top-strip__meta{
            display:flex;
            gap:18px;
            flex-wrap:wrap;
            color:rgba(247,239,230,0.84);
        }

        .top-strip__motto{
            font-weight:700;
            letter-spacing:0.03em;
        }

        .masthead{
            position:sticky;
            top:0;
            z-index:40;
            backdrop-filter:blur(16px);
            background:rgba(251,246,240,0.86);
            border-bottom:1px solid rgba(23,34,53,0.08);
        }

        .masthead__inner{
            display:grid;
            grid-template-columns:auto 1fr;
            align-items:center;
            gap:24px;
            padding:18px 0;
        }

        .nav-shell{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:22px;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .brand-mark{
            width:54px;
            height:54px;
            border-radius:18px;
            background:
                radial-gradient(circle at 30% 25%, rgba(255,255,255,0.26), transparent 40%),
                linear-gradient(135deg, var(--gold), var(--gold-dark));
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff6ec;
            font-family:'Cormorant Garamond',serif;
            font-size:1.55rem;
            font-weight:700;
            box-shadow:0 14px 25px rgba(181,109,66,0.28);
        }

        .brand-copy{
            display:flex;
            flex-direction:column;
            gap:4px;
        }

        .brand-name{
            font-family:'Cormorant Garamond',serif;
            font-size:1.95rem;
            line-height:1;
            font-weight:700;
        }

        .brand-tag{
            font-size:0.8rem;
            letter-spacing:0.14em;
            text-transform:uppercase;
            color:var(--muted);
            font-weight:800;
        }

        .nav{
            display:flex;
            justify-content:center;
            align-items:center;
            gap:8px;
            flex-wrap:wrap;
        }

        .nav-toggle{
            display:none;
            align-items:center;
            justify-content:center;
            padding:12px 16px;
            border-radius:999px;
            border:1px solid rgba(23,34,53,0.12);
            background:rgba(255,255,255,0.72);
            color:var(--ink);
            font-weight:800;
            cursor:pointer;
        }

        .nav-link,
        .nav-drop__button{
            position:relative;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            padding:12px 16px;
            border-radius:999px;
            color:var(--muted);
            font-weight:700;
            transition:0.2s ease;
        }

        .nav-link:hover,
        .nav-link.is-active,
        .nav-drop:hover .nav-drop__button,
        .nav-drop__button.is-active{
            color:var(--ink);
            background:rgba(23,34,53,0.05);
        }

        .nav-drop{
            position:relative;
        }

        .nav-drop__menu{
            position:absolute;
            top:calc(100% + 12px);
            left:0;
            min-width:220px;
            padding:12px;
            border-radius:20px;
            background:rgba(255,252,247,0.98);
            border:1px solid rgba(23,34,53,0.08);
            box-shadow:var(--shadow);
            opacity:0;
            pointer-events:none;
            transform:translateY(8px);
            transition:0.2s ease;
        }

        .nav-drop:hover .nav-drop__menu{
            opacity:1;
            pointer-events:auto;
            transform:translateY(0);
        }

        .nav-drop__menu a{
            display:block;
            padding:12px 14px;
            border-radius:14px;
            color:var(--muted);
            font-weight:700;
        }

        .nav-drop__menu a:hover{
            background:rgba(23,34,53,0.04);
            color:var(--ink);
        }

        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            padding:14px 22px;
            border:none;
            border-radius:999px;
            font-weight:800;
            cursor:pointer;
            transition:transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .btn:hover{
            transform:translateY(-1px);
            box-shadow:0 16px 28px rgba(23,34,53,0.14);
        }

        .btn-primary{
            background:linear-gradient(135deg, var(--gold), var(--gold-dark));
            color:#fff7f0;
        }

        .btn-secondary{
            background:var(--navy);
            color:#f7efe7;
        }

        .btn-soft,
        .btn-ghost{
            background:rgba(23,34,53,0.05);
            color:var(--ink);
        }

        .flash{
            margin-top:20px;
            padding:16px 20px;
            border-radius:18px;
            background:rgba(69,99,91,0.14);
            border:1px solid rgba(69,99,91,0.2);
            color:#315048;
            font-weight:700;
        }

        .page-wrap{
            padding-bottom:52px;
        }

        .hero-shell,
        .hero-panel,
        .content-shell,
        .content-panel,
        .story-shell,
        .sidebar-shell,
        .testimonial-shell{
            position:relative;
            overflow:hidden;
            background:linear-gradient(180deg, rgba(255,253,249,0.95), rgba(248,239,229,0.92));
            border:1px solid rgba(23,34,53,0.08);
            border-radius:var(--radius-xl);
            box-shadow:var(--shadow);
        }

        .hero-shell,
        .hero-panel{
            padding:34px;
            margin:30px 0 26px;
        }

        .hero-shell::before,
        .hero-panel::before,
        .content-shell::before,
        .content-panel::before,
        .story-shell::before,
        .sidebar-shell::before,
        .testimonial-shell::before{
            content:"";
            position:absolute;
            inset:auto -60px -80px auto;
            width:240px;
            height:240px;
            background:radial-gradient(circle, rgba(181,109,66,0.16), transparent 70%);
            pointer-events:none;
        }

        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:8px;
            margin-bottom:18px;
            padding:8px 14px;
            border-radius:999px;
            background:rgba(181,109,66,0.12);
            color:var(--gold-dark);
            text-transform:uppercase;
            letter-spacing:0.12em;
            font-size:0.78rem;
            font-weight:800;
        }

        .hero-grid{
            display:grid;
            grid-template-columns:1.08fr 0.92fr;
            gap:28px;
            align-items:center;
        }

        .hero-title,
        .section-title,
        .story-title,
        .detail-title{
            font-family:'Cormorant Garamond',serif;
            line-height:0.96;
            letter-spacing:-0.02em;
            margin:0 0 14px;
        }

        .hero-title{
            font-size:clamp(2.9rem, 5vw, 5.2rem);
        }

        .section-title,
        .story-title{
            font-size:clamp(2rem, 4vw, 3.2rem);
        }

        .detail-title{
            font-size:clamp(2.2rem, 4vw, 3.4rem);
        }

        .hero-copy,
        .section-copy,
        .story-copy,
        .detail-copy,
        .detail-rich,
        .list-copy{
            color:var(--muted);
            line-height:1.85;
        }

        .hero-actions{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:24px;
        }

        .hero-metrics{
            display:grid;
            grid-template-columns:repeat(2, minmax(0, 1fr));
            gap:14px;
        }

        .hero-stat-grid{
            display:grid;
            grid-template-columns:repeat(2, minmax(0, 1fr));
            gap:14px;
            margin-top:24px;
        }

        .stat-card,
        .metric-card,
        .feature-card,
        .listing-card,
        .story-card,
        .detail-card,
        .sidebar-card,
        .contact-card,
        .gallery-card,
        .testimonial-card{
            background:rgba(255,255,255,0.72);
            border:1px solid rgba(23,34,53,0.08);
            border-radius:24px;
            box-shadow:0 18px 30px rgba(23,34,53,0.05);
        }

        .stat-card,
        .metric-card{
            padding:18px 20px;
        }

        .stat-card span,
        .metric-card span{
            display:block;
            margin-bottom:8px;
            color:var(--muted);
            text-transform:uppercase;
            letter-spacing:0.12em;
            font-size:0.74rem;
            font-weight:800;
        }

        .stat-card strong,
        .metric-card strong{
            font-size:1.9rem;
            font-weight:800;
        }

        .hero-side{
            display:grid;
            gap:16px;
        }

        .feature-card{
            padding:20px;
        }

        .feature-card__media{
            height:180px;
            border-radius:20px;
            margin-bottom:18px;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 30%),
                linear-gradient(135deg, #26425d 0%, #142435 100%);
            position:relative;
            overflow:hidden;
        }

        .feature-card__media--warm{
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 32%),
                linear-gradient(135deg, #c18255 0%, #7a4426 100%);
        }

        .feature-card__media::before{
            content:"";
            position:absolute;
            inset:18px;
            border-radius:18px;
            border:1px solid rgba(255,255,255,0.18);
        }

        .feature-card__media::after{
            content:"";
            position:absolute;
            inset:auto 24px 24px auto;
            width:110px;
            height:110px;
            border-radius:26px;
            background:rgba(255,255,255,0.08);
            transform:rotate(14deg);
        }

        .feature-card h3,
        .listing-title,
        .story-card h3,
        .sidebar-card h3,
        .contact-card h3,
        .testimonial-card h3{
            margin:0 0 10px;
            font-family:'Cormorant Garamond',serif;
            font-size:1.7rem;
            line-height:1.05;
        }

        .section-block{
            padding:14px 0 44px;
        }

        .section-head{
            display:flex;
            justify-content:space-between;
            align-items:flex-end;
            gap:20px;
            margin-bottom:24px;
            flex-wrap:wrap;
        }

        .grid{
            display:grid;
            gap:22px;
        }

        .grid-2{
            grid-template-columns:repeat(2, minmax(0, 1fr));
        }

        .grid-3{
            grid-template-columns:repeat(3, minmax(0, 1fr));
        }

        .grid-4{
            grid-template-columns:repeat(4, minmax(0, 1fr));
        }

        .content-shell,
        .story-shell,
        .sidebar-shell,
        .testimonial-shell{
            padding:28px;
        }

        .listing-card{
            overflow:hidden;
        }

        .listing-media{
            height:235px;
            background:linear-gradient(135deg, #d1a17f, #ae6c47);
        }

        .listing-media img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .listing-media__fallback{
            height:100%;
            padding:28px;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            gap:12px;
            color:#fff7f0;
            background:
                radial-gradient(circle at top right, rgba(255,255,255,0.18), transparent 25%),
                linear-gradient(135deg, #24405c 0%, #9f603c 100%);
        }

        .listing-media__fallback span{
            display:inline-flex;
            align-self:flex-start;
            padding:8px 12px;
            border-radius:999px;
            background:rgba(255,255,255,0.12);
            font-size:0.78rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:0.08em;
        }

        .listing-media__fallback strong{
            font-family:'Cormorant Garamond',serif;
            font-size:2rem;
            line-height:1;
        }

        .listing-body{
            padding:22px;
        }

        .tag-row{
            display:flex;
            gap:8px;
            flex-wrap:wrap;
            margin-bottom:14px;
        }

        .tag{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:7px 12px;
            border-radius:999px;
            background:rgba(23,34,53,0.05);
            color:var(--muted);
            font-size:0.75rem;
            font-weight:800;
            text-transform:uppercase;
            letter-spacing:0.08em;
        }

        .listing-copy{
            color:var(--muted);
            line-height:1.8;
            margin:0 0 16px;
        }

        .listing-meta{
            display:flex;
            justify-content:space-between;
            gap:12px;
            flex-wrap:wrap;
            color:var(--muted);
            font-size:0.9rem;
            margin-bottom:16px;
        }

        .story-grid,
        .detail-shell{
            display:grid;
            grid-template-columns:1.2fr 0.8fr;
            gap:24px;
            margin:28px 0 40px;
        }

        .story-card,
        .detail-card,
        .sidebar-card{
            padding:26px;
        }

        .story-visual,
        .detail-visual{
            min-height:360px;
            border-radius:26px;
            overflow:hidden;
            margin-bottom:22px;
            background:linear-gradient(135deg, #d3b49a, #b97a51);
        }

        .story-visual img,
        .gallery-card img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .detail-rich{
            white-space:pre-line;
        }

        .bullet-list{
            list-style:none;
            padding:0;
            margin:0;
        }

        .bullet-list li{
            padding:12px 0;
            border-bottom:1px solid var(--line);
            color:var(--muted);
            line-height:1.7;
        }

        .bullet-list li:last-child{
            border-bottom:none;
        }

        .timeline{
            display:grid;
            gap:18px;
            margin-top:18px;
        }

        .timeline-item{
            padding:24px;
            border-radius:24px;
            background:rgba(255,255,255,0.72);
            border:1px solid rgba(23,34,53,0.08);
        }

        .timeline-item h3{
            margin:0 0 10px;
            font-family:'Cormorant Garamond',serif;
            font-size:1.85rem;
        }

        .testimonial-card{
            padding:24px;
        }

        .testimonial-quote{
            color:var(--ink);
            font-size:1rem;
            line-height:1.85;
            margin-bottom:16px;
        }

        .testimonial-meta{
            color:var(--muted);
            font-weight:700;
        }

        .office-grid{
            display:grid;
            grid-template-columns:0.95fr 1.05fr;
            gap:24px;
            margin-top:24px;
        }

        .contact-grid{
            display:grid;
            grid-template-columns:repeat(3, minmax(0, 1fr));
            gap:22px;
        }

        .contact-card p{
            margin:0 0 8px;
            color:var(--muted);
            line-height:1.8;
        }

        .step-list{
            counter-reset:step;
            display:grid;
            gap:14px;
            margin-top:18px;
        }

        .step-item{
            display:flex;
            align-items:flex-start;
            gap:14px;
            padding:18px;
            border-radius:20px;
            background:rgba(255,255,255,0.72);
            border:1px solid rgba(23,34,53,0.08);
        }

        .step-item::before{
            counter-increment:step;
            content:counter(step);
            width:36px;
            height:36px;
            border-radius:12px;
            flex:0 0 36px;
            background:linear-gradient(135deg, var(--gold), var(--gold-dark));
            color:#fff6ef;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:800;
        }

        .gallery-grid{
            display:grid;
            grid-template-columns:repeat(5, minmax(0, 1fr));
            gap:18px;
        }

        .gallery-card{
            min-height:240px;
            overflow:hidden;
        }

        .gallery-card img{
            transition:transform 0.35s ease;
        }

        .gallery-card:hover img{
            transform:scale(1.04);
        }

        .form-grid{
            display:grid;
            grid-template-columns:repeat(2, minmax(0, 1fr));
            gap:14px;
        }

        .field-group{
            display:grid;
            gap:8px;
        }

        .field-label{
            color:var(--ink);
            font-size:0.92rem;
            font-weight:800;
        }

        .field,
        .textarea{
            width:100%;
            padding:15px 18px;
            border:1px solid rgba(23,34,53,0.12);
            border-radius:18px;
            background:rgba(255,255,255,0.78);
            color:var(--ink);
            transition:border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .field:focus,
        .textarea:focus{
            outline:none;
            border-color:rgba(181,109,66,0.7);
            box-shadow:0 0 0 4px rgba(181,109,66,0.14);
        }

        .textarea{
            min-height:180px;
            resize:vertical;
        }

        .field-note,
        .inline-note{
            color:var(--muted);
            font-size:0.88rem;
            line-height:1.7;
        }

        .error-list{
            margin:16px 0 0;
            padding-left:18px;
            color:#8f2b2b;
            line-height:1.7;
        }

        .empty-state{
            padding:28px;
            text-align:center;
            border-radius:24px;
            background:rgba(255,255,255,0.68);
            border:1px dashed rgba(23,34,53,0.16);
            color:var(--muted);
            line-height:1.8;
        }

        .video-frame{
            width:100%;
            min-height:420px;
            border:0;
        }

        .footer{
            padding:38px 0 48px;
            color:var(--muted);
        }

        .footer-shell{
            display:grid;
            grid-template-columns:1.1fr 0.9fr 0.9fr 1fr;
            gap:22px;
            padding-top:28px;
            border-top:1px solid rgba(23,34,53,0.08);
        }

        .footer-shell h4{
            margin:0 0 14px;
            color:var(--ink);
            font-size:1rem;
            font-weight:800;
            letter-spacing:0.04em;
            text-transform:uppercase;
        }

        .footer-links{
            display:grid;
            gap:10px;
        }

        .footer-note{
            margin-top:24px;
            font-size:0.88rem;
            color:var(--muted);
        }

        .dialog-backdrop{
            position:fixed;
            inset:0;
            background:rgba(8,18,29,0.74);
            display:none;
            align-items:center;
            justify-content:center;
            padding:24px;
            z-index:80;
        }

        .dialog-backdrop.is-visible{
            display:flex;
        }

        .dialog{
            width:min(760px, 100%);
            background:linear-gradient(180deg, rgba(255,252,247,0.98), rgba(247,239,229,0.96));
            border:1px solid rgba(23,34,53,0.1);
            border-radius:28px;
            box-shadow:0 28px 60px rgba(8,18,29,0.24);
            padding:28px;
        }

        .dialog h2{
            margin:0 0 12px;
            font-family:'Cormorant Garamond',serif;
            font-size:2.4rem;
        }

        .dialog p{
            color:var(--muted);
            line-height:1.85;
        }

        .dialog-actions{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:20px;
        }

        @media (max-width: 1100px){
            .hero-grid,
            .story-grid,
            .detail-shell,
            .office-grid,
            .contact-grid,
            .footer-shell{
                grid-template-columns:1fr;
            }

            .masthead__inner{
                grid-template-columns:1fr auto;
            }

            .nav-toggle{
                display:inline-flex;
            }

            .nav-shell{
                display:none;
                grid-column:1 / -1;
                flex-direction:column;
                align-items:stretch;
                gap:16px;
                padding:20px;
                border-radius:24px;
                background:rgba(255,252,247,0.98);
                border:1px solid rgba(23,34,53,0.08);
                box-shadow:var(--shadow);
            }

            .masthead__inner.is-open .nav-shell{
                display:flex;
            }

            .nav{
                justify-content:flex-start;
                flex-direction:column;
                align-items:stretch;
            }

            .nav-link,
            .nav-drop__button{
                width:100%;
                justify-content:space-between;
            }

            .nav-drop__menu{
                position:static;
                top:auto;
                left:auto;
                min-width:0;
                padding:10px 0 0;
                border:none;
                box-shadow:none;
                background:transparent;
                opacity:1;
                pointer-events:auto;
                transform:none;
            }

            .masthead__cta{
                width:100%;
            }

            .gallery-grid{
                grid-template-columns:repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px){
            .grid-4,
            .grid-3,
            .grid-2,
            .hero-stat-grid,
            .hero-metrics,
            .form-grid{
                grid-template-columns:1fr;
            }

            .gallery-grid{
                grid-template-columns:repeat(2, minmax(0, 1fr));
            }

            .hero-shell,
            .hero-panel,
            .content-shell,
            .content-panel,
            .story-shell,
            .sidebar-shell,
            .testimonial-shell,
            .story-card,
            .detail-card,
            .sidebar-card{
                padding:22px;
            }
        }

        @media (max-width: 560px){
            .container{
                width:min(100% - 24px, 1220px);
            }

            .gallery-grid{
                grid-template-columns:1fr;
            }

            .brand-name{
                font-size:1.7rem;
            }

            .top-strip__inner{
                justify-content:center;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    @php
        $site = config('advocated_site');
        $brand = $site['brand'];
        $practiceAreas = $site['practice_areas'];
        $aboutActive = request()->routeIs('about.*') || request()->routeIs('team.*');
    @endphp

    <div class="dialog-backdrop" id="disclaimerModal" aria-hidden="true">
        <div class="dialog">
            <span class="eyebrow">Disclaimer</span>
            <h2>Important Visitor Notice</h2>
            <p>
                This website is provided for general informational purposes. By continuing, you acknowledge that the material here does not create an advocate-client relationship and should not be treated as a substitute for matter-specific legal advice.
            </p>
            <p>
                If you wish to discuss a real legal issue, please use the contact channels provided on the website so the Advocated team can respond in a formal and appropriate manner.
            </p>
            <div class="dialog-actions">
                <button type="button" class="btn btn-primary" id="acceptDisclaimer">Agree</button>
                <a href="https://www.google.com" class="btn btn-soft">Disagree</a>
            </div>
        </div>
    </div>

    <div class="site-shell">
        <div class="top-strip">
            <div class="container top-strip__inner">
                <div class="top-strip__meta">
                    <span>{{ $brand['phone'] }}</span>
                    <span>{{ $brand['email'] }}</span>
                </div>
                <div class="top-strip__motto">{{ $brand['motto'] }}</div>
            </div>
        </div>

        <header class="masthead">
            <div class="container masthead__inner">
                <a href="{{ route('home') }}" class="brand">
                    <div class="brand-mark">A</div>
                    <div class="brand-copy">
                        <span class="brand-name">{{ $brand['short_name'] }}</span>
                        <span class="brand-tag">Legal Chambers</span>
                    </div>
                </a>

                <button type="button" class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="siteNav">
                    Menu
                </button>

                <div class="nav-shell" id="siteNav">
                    <nav class="nav">
                        <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>

                        <div class="nav-drop">
                            <a href="{{ route('about.story') }}" class="nav-drop__button {{ $aboutActive ? 'is-active' : '' }}">
                                About Us
                            </a>
                            <div class="nav-drop__menu">
                                <a href="{{ route('about.story') }}">Our Story</a>
                                <a href="{{ route('team.index') }}">Team</a>
                                <a href="{{ route('contact.index') }}">Contact</a>
                            </div>
                        </div>

                        <a class="nav-link {{ request()->routeIs('services.*') ? 'is-active' : '' }}" href="{{ route('services.index') }}">Services</a>
                        <a class="nav-link {{ request()->routeIs('careers.*') ? 'is-active' : '' }}" href="{{ route('careers.index') }}">Careers</a>
                        <a class="nav-link {{ request()->routeIs('pro-bono.*') ? 'is-active' : '' }}" href="{{ route('pro-bono.index') }}">Pro Bono</a>
                        <a class="nav-link {{ request()->routeIs('blogs.*') ? 'is-active' : '' }}" href="{{ route('blogs.index') }}">Blog</a>
                        <a class="nav-link {{ request()->routeIs('videos.*') ? 'is-active' : '' }}" href="{{ route('videos.index') }}">Video</a>
                        <a class="nav-link {{ request()->routeIs('gallery.*') ? 'is-active' : '' }}" href="{{ route('gallery.index') }}">Gallery</a>
                        <a class="nav-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}" href="{{ route('contact.index') }}">Contact</a>
                    </nav>

                    <a class="btn btn-primary masthead__cta" href="{{ route('consult.index') }}">Consult Here</a>
                </div>
            </div>
        </header>

        <main class="container page-wrap">
            @if(session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer-shell">
                    <div>
                        <h4>{{ $brand['short_name'] }}</h4>
                        <p class="list-copy">{{ $brand['tagline'] }}</p>
                        <p class="list-copy">Providing thoughtful legal support with disciplined preparation and responsive client care since {{ $brand['founded'] }}.</p>
                    </div>

                    <div>
                        <h4>Quick Links</h4>
                        <div class="footer-links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="{{ route('about.story') }}">About Us</a>
                            <a href="{{ route('services.index') }}">Services</a>
                            <a href="{{ route('pro-bono.index') }}">Pro Bono</a>
                            <a href="{{ route('careers.index') }}">Careers</a>
                            <a href="{{ route('contact.index') }}">Contact</a>
                        </div>
                    </div>

                    <div>
                        <h4>Practice Areas</h4>
                        <div class="footer-links">
                            @foreach(array_slice($practiceAreas, 0, 4) as $practice)
                                <span>{{ $practice['title'] }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4>Contact Us</h4>
                        <div class="footer-links">
                            <span>{{ $brand['address'] }}</span>
                            <span>{{ $brand['phone'] }}</span>
                            <span>{{ $brand['email'] }}</span>
                            <span>{{ $brand['hours'] }}</span>
                        </div>
                    </div>
                </div>

                <div class="footer-note">
                    Copyright {{ now()->year }} {{ $brand['short_name'] }}. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('disclaimerModal');
            const accept = document.getElementById('acceptDisclaimer');
            const navToggle = document.getElementById('navToggle');
            const siteNav = document.getElementById('siteNav');
            const mastheadInner = navToggle ? navToggle.closest('.masthead__inner') : null;

            if (!modal || !accept) {
                return;
            }

            const accepted = window.localStorage.getItem('advocated-disclaimer-accepted');

            if (!accepted) {
                modal.classList.add('is-visible');
                modal.setAttribute('aria-hidden', 'false');
            }

            accept.addEventListener('click', function () {
                window.localStorage.setItem('advocated-disclaimer-accepted', 'yes');
                modal.classList.remove('is-visible');
                modal.setAttribute('aria-hidden', 'true');
            });

            if (navToggle && siteNav && mastheadInner) {
                navToggle.addEventListener('click', function () {
                    const isOpen = mastheadInner.classList.toggle('is-open');
                    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
