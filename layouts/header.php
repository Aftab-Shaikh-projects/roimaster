<?php
include __DIR__ . '/../includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ROIMaster | The Art of Profitable Living</title>
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Poppins:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link href="assets/css/lib/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/lib/fancybox.css" />
    <!-- SweetAlert2 is JS only, removed from header if it was just script src. Moved to footer/global location if needed, but here it is a script. --> 
    <!-- Actually, SweetAlert2 script should be local too. -->
    <script src="assets/js/lib/sweetalert2.all.min.js"></script>

    <!-- Three.js only in head -->
    <script src="assets/js/lib/three.min.js"></script>

    <style>
        :root {
            --primary-deep: #06142e;
            /* Darker Navy */
            --primary-color: #0F2C59;
            /* Royal Blue */
            --accent-rich: #C5A47E;
            /* Rich Gold/Bronze */
            --accent-light: #DAC0A3;
            /* Champagne */
            --bg-offwhite: #f4f7f6;
            --text-dark: #1a1a1a;
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fcfcfc;
            /* Slightly off-white for contrast */
            color: var(--text-dark);
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
        }

        /* --- PRELOADER --- */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-deep);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loader-logo {
            font-size: 3rem;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            opacity: 0;
            transform: translateY(20px);
        }

        .loader-logo span {
            color: var(--accent-rich);
        }

        .loader-line {
            width: 0%;
            height: 2px;
            background: var(--accent-rich);
            margin-top: 10px;
        }

        /* --- SCROLL ELEVATOR --- */
        .elevator-container {
            position: fixed;
            top: 20%;
            bottom: 20%;
            right: 20px;
            width: 4px;
            background: rgba(197, 164, 126, 0.2);
            z-index: 1000;
            border-radius: 2px;
            cursor: pointer;
            /* Clickable */
        }

        .elevator-cabin {
            position: absolute;
            top: 0;
            left: -13px;
            /* Center horizontally relative to line */
            width: 30px;
            height: 40px;
            background: var(--primary-deep);
            border: 2px solid var(--accent-rich);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-rich);
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: top 0.1s linear;
            cursor: grab;
            /* Draggable */
        }

        .elevator-cabin:active {
            cursor: grabbing;
        }

        /* --- PARALLAX LAYERS --- */
        .parallax-layer {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            opacity: 0.15;
            will-change: transform;
        }

        .blueprint-lines {
            background-image:
                linear-gradient(var(--accent-rich) 1px, transparent 1px),
                linear-gradient(90deg, var(--accent-rich) 1px, transparent 1px);
            background-size: 100px 100px;
            width: 200%;
            /* Wider to allow parallax movement */
            height: 200%;
        }

        /* --- HERO SLIDESHOW --- */
        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            /* Behind canvas */
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .slide.active {
            opacity: 1;
            animation: zoomEffect 8s infinite alternate;
        }

        @keyframes zoomEffect {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        /* canvas z-index fix */
        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.8;
            pointer-events: none;
        }


        /* --- TILE BACKGROUND --- */
        #tile-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            /* Changed from -1 to 0 to sit on top of body bg */
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            grid-template-rows: repeat(10, 1fr);
            pointer-events: none;
        }

        .tile {
            width: 100%;
            height: 100%;
            background: var(--accent-rich);
            /* Visible color */
            opacity: 0;
            /* Hidden initially */
            border: 1px solid rgba(255, 255, 255, 0.5);
            transform: scale(0.5);
            transition: opacity 0.3s;
        }

        /* --- Advanced Navbar --- */
        .navbar {
            padding: 20px 0;
            transition: all 0.4s ease;
            background: transparent;
        }

        /* State when scrolled */
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 28px;
            color: #fff;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .navbar.scrolled .navbar-brand {
            color: var(--primary-deep);
        }

        .navbar-brand span {
            color: var(--accent-rich);
        }

        .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9) !important;
            margin-left: 25px;
            position: relative;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .navbar.scrolled .nav-link {
            color: var(--primary-deep) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 5px;
            left: 0;
            background-color: var(--accent-rich);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-contact {
            background: linear-gradient(45deg, var(--accent-rich), var(--accent-light));
            color: var(--primary-deep) !important;
            border-radius: 0;
            padding: 10px 30px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .btn-contact::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--primary-deep);
            transition: 0.4s;
            z-index: -1;
        }

        .btn-contact:hover::before {
            width: 100%;
        }

        .btn-contact:hover {
            color: #fff !important;
        }

        /* --- Parallax Hero Section & Premium Filter --- */
        /* --- Parallax Hero Section & Premium Filter --- */
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
            background: #06142e;
            /* Fallback color */
        }

        .hero-section .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* Lighter Gradient */
            background: linear-gradient(135deg, rgba(6, 20, 46, 0.85) 0%, rgba(15, 44, 89, 0.8) 100%);
            z-index: 2;
            /* Above canvas (1) & slideshow (0) */
        }

        .hero-section .hero-content {
            position: relative;
            z-index: 3;
            /* Top */
            padding: 0 20px;
        }

        .hero-title {
            color: #fff;
            font-weight: 800;
            font-size: 4rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero-subtitle {
            color: var(--accent-light);
            font-size: 1.2rem;
            margin-bottom: 50px;
            font-weight: 300;
        }

        /* --- Premium Glass Filter Form --- */
        .filter-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            position: relative;
        }

        /* Subtle shine effect on glass */
        .filter-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: skewX(-25deg);
            pointer-events: none;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.85rem;
            color: var(--accent-light);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .form-select,
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 15px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary-deep);
            transition: 0.3s;
        }

        .form-select:focus,
        .form-control:focus {
            background: #fff;
            border-color: var(--accent-rich);
            box-shadow: 0 0 15px rgba(197, 164, 126, 0.3);
        }

        .btn-search {
            background: linear-gradient(135deg, var(--accent-rich) 0%, var(--accent-light) 100%);
            color: var(--primary-deep);
            width: 100%;
            height: 55px;
            /* Match input height roughly */
            border-radius: 8px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: 0.3s;
            border: none;
            box-shadow: 0 10px 20px -10px rgba(197, 164, 126, 0.5);
        }

        .btn-search:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -10px rgba(197, 164, 126, 0.7);
            color: var(--primary-deep);
        }

        /* --- Section Styling --- */
        .section-padding {
            padding: 120px 0;
            position: relative;
            overflow: hidden;
            z-index: 1;
            /* Ensure content sits above tiles */
        }

        /* Abstract background graphic */
        .bg-abstract {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image: radial-gradient(circle at 20% 50%, var(--primary-color) 0%, transparent 50%), radial-gradient(circle at 80% 50%, var(--accent-rich) 0%, transparent 50%);
            pointer-events: none;
        }

        .section-header {
            margin-bottom: 70px;
        }

        .section-title {
            font-weight: 800;
            color: var(--primary-deep);
            font-size: 2.5rem;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        /* Decorative underline */
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--accent-rich);
            margin-top: 10px;
        }

        .section-subtitle {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
        }

        /* --- Modern Property Card --- */
        .property-card-modern {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #fff;
            height: 100%;
            position: relative;
        }

        .property-card-modern:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
        }

        .card-img-wrapper {
            height: 300px;
            position: relative;
            overflow: hidden;
        }

        .card-img-top {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: 0.8s ease;
        }

        .property-card-modern:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-overlay-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            opacity: 0;
            /* Hidden by default */
            transition: 0.5s ease;
            transform: translateY(20px);
        }

        .property-card-modern:hover .card-overlay-info {
            opacity: 1;
            transform: translateY(0);
        }

        .card-body-modern {
            padding: 30px;
            position: relative;
        }

        .roi-badge-floating {
            position: absolute;
            top: -20px;
            right: 30px;
            background: var(--accent-rich);
            color: #fff;
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(197, 164, 126, 0.4);
            z-index: 2;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.35rem;
            color: var(--primary-deep);
        }

        .price-tag-modern {
            color: var(--accent-rich);
            font-weight: 800;
            font-size: 1.5rem;
            display: block;
            margin-bottom: 15px;
        }

        .prop-features-modern {
            display: flex;
            gap: 20px;
            color: #777;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* --- About Section Redesign --- */
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .feature-box {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            border-bottom: 3px solid transparent;
        }

        .feature-box:hover {
            border-bottom: 3px solid var(--accent-rich);
            transform: translateY(-10px);
        }

        .feature-icon {
            color: var(--accent-rich);
            margin-bottom: 25px;
            font-size: 3rem;
        }

        .feature-box h4 {
            font-weight: 700;
            color: var(--primary-deep);
        }

        /* --- Footer --- */
        footer {
            background-color: var(--primary-deep);
            color: #fff;
            padding: 80px 0 30px;
            position: relative;
            overflow: hidden;
        }

        /* Subtle footer graphic */
        footer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTEwMCAwTDUwIDUwTDAgMTAwTDUwIDE1MEwxMDAgMjAwTDE1MCAxNTBMMjAwIDEwMEwxNTAgNTBMMTAwIDBaIiBmaWxsPSIjZmZmIi8+PC9zdmc+');
            opacity: 0.1;
            pointer-events: none;
        }

        footer h4 span {
            color: var(--accent-rich);
        }

        footer a {
            color: #aaa;
            text-decoration: none;
            transition: 0.3s;
        }

        footer a:hover {
            color: var(--accent-rich);
            padding-left: 5px;
        }

        .footer-contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #aaa;
        }

        .footer-contact-item i {
            color: var(--accent-rich);
            margin-right: 15px;
            font-size: 1.2rem;
        }

        /* Mobile Fixes */
        @media (max-width: 991px) {
            .navbar {
                background: var(--primary-deep);
                padding: 10px 0;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .filter-container {
                padding: 25px;
            }

            .btn-search {
                margin-top: 20px;
            }
        }

        /* --- WhatsApp Floating Button --- */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
            animation: pulse-green 2s infinite;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            color: #fff;
            transform: scale(1.1);
        }

        @keyframes pulse-green {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* --- Scroll Down Indicator REMOVED --- */

        /* --- Abstract Background Shapes --- */
        .shape-blob {
            position: absolute;
            filter: blur(50px);
            z-index: 0;
            opacity: 0.4;
            animation: float-shape 10s ease-in-out infinite alternate;
        }

        .shape-1 {
            top: 10%;
            right: -5%;
            width: 300px;
            height: 300px;
            background: rgba(197, 164, 126, 0.3);
            /* Accent color */
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }

        .shape-2 {
            bottom: 10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: rgba(15, 44, 89, 0.15);
            /* Primary color */
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation-duration: 15s;
        }

        @keyframes float-shape {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(20px, 40px) rotate(10deg);
            }
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 768px) {
            .hero-section {
                height: auto !important;
                min-height: 100vh;
                padding-top: 120px;
                padding-bottom: 60px;
                display: block;
                /* Stack content naturally */
            }

            .hero-content {
                max-width: 100%;
                padding: 0 20px;
            }

            .hero-title {
                font-size: 2.5rem !important;
                margin-top: 20px;
            }

            .hero-subtitle {
                font-size: 1rem !important;
                margin-bottom: 30px;
            }

            /* Solid Card Filter for Visibility */
            .filter-container {
                background: #ffffff !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
                margin-top: 40px;
                padding: 25px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
                border: none !important;
                border-radius: 12px;
            }

            /* Remove glass shine on mobile */
            .filter-container::before {
                display: none;
            }

            /* Dark Text for inputs/labels on white bg */
            .form-label {
                color: var(--text-dark) !important;
                font-weight: 600;
            }

            .form-control,
            .form-select {
                background-color: #f8f9fa !important;
                border: 1px solid #ddd !important;
                color: #333 !important;
            }

            .section-padding {
                padding: 60px 0 !important;
            }

            .elevator-container {
                display: none !important;
            }

            .navbar {
                padding: 10px 0;
                background: rgba(6, 20, 46, 0.95);
                /* Ensure nav is visible */
            }

            .whatsapp-float {
                width: 50px;
                height: 50px;
                font-size: 24px;
                bottom: 20px;
                right: 20px;
            }

            /* Fix Mobile Nav Spacing */
            .nav-link {
                margin-left: 0 !important;
                padding: 10px 0;
            }

            .btn-contact {
                margin-left: 0 !important;
                margin-top: 15px;
                display: block;
                width: 100%;
                text-align: center;
            }
        }

        /* Remove Brand Hover Effect */
        .navbar-brand:hover {
            color: #fff !important;
        }
        .navbar.scrolled .navbar-brand:hover {
            color: var(--primary-deep) !important;
        }

        /* Fix Burger Icon Visibility on White Background */
        .navbar.scrolled .navbar-toggler-icon {
            filter: invert(1);
        }
    </style>
</head>

<body>

    <!-- Elevator Scroll -->
    <div class="elevator-container">
        <div class="elevator-cabin" id="elevatorCabin">
            <i class="fa-solid fa-arrows-up-down"></i>
        </div>
    </div>

    <!-- Parallax Background -->
    <div class="parallax-layer blueprint-lines" id="parallaxBg"></div>

    <!-- Tile Background -->
    <div id="tile-container"></div>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-logo">ROI<span>MASTER</span></div>
        <div class="loader-line"></div>
    </div>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" data-aos="fade-down">
                <i class="fa-solid fa-building-columns me-2"></i>ROI<span>MASTER</span>
            </a>
            <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item" data-aos="fade-down" data-aos-delay="100"><a class="nav-link" href="index">Home</a>
                    </li>
                    <li class="nav-item" data-aos="fade-down" data-aos-delay="200"><a class="nav-link" href="about">About
                            Us</a></li>
                            <li class="nav-item" data-aos="fade-down" data-aos-delay="200"><a class="nav-link" href="team">Our Team</a></li>
                            
                    <li class="nav-item" data-aos="fade-down" data-aos-delay="300"><a class="nav-link"
                            href="properties">Properties</a></li>
                    <li class="nav-item" data-aos="fade-down" data-aos-delay="400">
                        <a class="btn btn-contact ms-3" href="contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>