<?php
// Keep your existing PHP logic here if your current index.php has any.
// The design below does not change your project logic.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Anti-Ragging Management System</title>

    <meta name="description"
          content="A secure and confidential Anti-Ragging Management System for reporting, tracking and managing ragging complaints.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f7fbff;
            color: #14213d;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 78px;
            z-index: 1000;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 7%;

            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border-bottom: 1px solid rgba(0,0,0,0.06);

            transition: 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;

            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;

            color: white;

            background: linear-gradient(135deg, #0b63ce, #08a878);

            box-shadow: 0 8px 25px rgba(11, 99, 206, 0.25);
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-family: 'Poppins', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: #102a43;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #718096;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            font-size: 14px;
            font-weight: 600;
            color: #52606d;

            transition: 0.25s ease;
        }

        .nav-links a:hover {
            color: #087f5b;
        }

        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-btn {
            padding: 11px 20px;

            border-radius: 10px;

            color: #075985 !important;
            background: #eef8ff;

            font-size: 13px !important;
        }

        .login-btn:hover {
            background: #dff1ff;
        }

        .register-btn {
            padding: 12px 20px;

            border-radius: 10px;

            color: white !important;

            background: linear-gradient(135deg, #0b63ce, #087f5b);

            box-shadow: 0 8px 20px rgba(8, 127, 91, 0.18);
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(8, 127, 91, 0.25);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 100vh;
            padding: 150px 7% 80px;

            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;

            background:
                radial-gradient(circle at 80% 20%, rgba(8,168,120,0.12), transparent 30%),
                radial-gradient(circle at 10% 30%, rgba(11,99,206,0.12), transparent 30%),
                linear-gradient(135deg, #f8fcff 0%, #ffffff 50%, #f1fcf8 100%);
        }

        .hero-content {
            width: 55%;
            position: relative;
            z-index: 5;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;

            border-radius: 30px;

            background: rgba(11,99,206,0.08);
            color: #075985;

            font-size: 12px;
            font-weight: 700;

            margin-bottom: 22px;

            border: 1px solid rgba(11,99,206,0.1);
        }

        .badge-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #08a878;

            box-shadow: 0 0 0 5px rgba(8,168,120,0.1);
        }

        .hero h1 {
            font-family: 'Poppins', sans-serif;

            font-size: clamp(42px, 5vw, 70px);

            line-height: 1.08;

            letter-spacing: -2px;

            color: #102a43;

            margin-bottom: 24px;
        }

        .hero h1 span {
            background: linear-gradient(135deg, #0b63ce, #08a878);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            max-width: 620px;

            font-size: 17px;
            line-height: 1.8;

            color: #627d98;

            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            padding: 15px 25px;

            border-radius: 12px;

            color: white;

            font-size: 14px;
            font-weight: 700;

            background: linear-gradient(135deg, #0b63ce, #087f5b);

            box-shadow: 0 12px 30px rgba(11,99,206,0.2);

            transition: 0.3s ease;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 17px 35px rgba(11,99,206,0.28);
        }

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            padding: 15px 25px;

            border-radius: 12px;

            color: #234e70;

            font-size: 14px;
            font-weight: 700;

            background: white;

            border: 1px solid #d9e7f2;

            transition: 0.3s ease;
        }

        .secondary-btn:hover {
            transform: translateY(-3px);
            border-color: #9fc8e8;
            box-shadow: 0 12px 30px rgba(15,23,42,0.08);
        }

        .trust-line {
            display: flex;
            align-items: center;
            gap: 22px;

            margin-top: 35px;

            color: #718096;
            font-size: 12px;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .trust-icon {
            width: 27px;
            height: 27px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #e7f8f2;
            color: #087f5b;
        }

        /* =========================
           HERO VISUAL
        ========================= */

        .hero-visual {
            width: 45%;

            display: flex;
            justify-content: center;
            align-items: center;

            position: relative;
            z-index: 3;
        }

        .dashboard-card {
            width: 430px;

            padding: 24px;

            border-radius: 25px;

            background: rgba(255,255,255,0.85);

            backdrop-filter: blur(20px);

            border: 1px solid rgba(255,255,255,0.8);

            box-shadow:
                0 35px 80px rgba(24, 72, 110, 0.15),
                0 10px 25px rgba(24,72,110,0.06);

            transform: rotate(2deg);

            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating {
            0%,100% {
                transform: rotate(2deg) translateY(0);
            }

            50% {
                transform: rotate(2deg) translateY(-12px);
            }
        }

        .dashboard-top {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 22px;
        }

        .dashboard-title {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
        }

        .secure-label {
            padding: 6px 10px;

            border-radius: 20px;

            background: #e8f8f3;
            color: #087f5b;

            font-size: 10px;
            font-weight: 700;
        }

        .dashboard-main {
            padding: 22px;

            border-radius: 18px;

            background: linear-gradient(135deg, #eef8ff, #effcf8);

            margin-bottom: 15px;
        }

        .dashboard-main small {
            color: #718096;
            font-size: 11px;
        }

        .complaint-number {
            font-family: 'Poppins', sans-serif;

            font-size: 34px;
            font-weight: 800;

            margin-top: 6px;
        }

        .progress {
            height: 8px;

            background: #dce9f2;

            border-radius: 20px;

            margin-top: 15px;

            overflow: hidden;
        }

        .progress span {
            display: block;

            width: 72%;
            height: 100%;

            border-radius: 20px;

            background: linear-gradient(90deg, #0b63ce, #08a878);
        }

        .status-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .status-card {
            padding: 15px 10px;

            border-radius: 15px;

            background: white;

            border: 1px solid #edf2f7;

            text-align: center;
        }

        .status-card strong {
            display: block;

            font-size: 19px;

            margin-bottom: 4px;
        }

        .status-card span {
            font-size: 9px;
            color: #829ab1;
        }

        .floating-card {
            position: absolute;

            padding: 13px 17px;

            border-radius: 14px;

            background: white;

            box-shadow: 0 18px 40px rgba(15,23,42,0.12);

            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 11px;
            font-weight: 700;
        }

        .floating-card.one {
            left: -35px;
            bottom: 55px;
        }

        .floating-card.two {
            right: -25px;
            top: 55px;
        }

        .floating-icon {
            width: 32px;
            height: 32px;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #e8f8f3;
            color: #087f5b;
        }

        /* =========================
           SHAPES
        ========================= */

        .shape {
            position: absolute;

            border-radius: 50%;

            filter: blur(1px);

            pointer-events: none;
        }

        .shape-one {
            width: 300px;
            height: 300px;

            right: -100px;
            bottom: -100px;

            background: rgba(8,168,120,0.08);
        }

        .shape-two {
            width: 200px;
            height: 200px;

            left: -80px;
            top: 120px;

            background: rgba(11,99,206,0.07);
        }

        /* =========================
           FEATURES
        ========================= */

        .section {
            padding: 100px 7%;
        }

        .section-header {
            text-align: center;

            max-width: 720px;

            margin: 0 auto 55px;
        }

        .section-label {
            display: inline-block;

            color: #087f5b;

            font-size: 12px;
            font-weight: 800;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;

            font-size: clamp(30px, 4vw, 44px);

            line-height: 1.2;

            color: #102a43;

            margin-bottom: 15px;
        }

        .section-description {
            color: #718096;

            line-height: 1.7;

            font-size: 15px;
        }

        .features {
            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 22px;

            max-width: 1150px;

            margin: auto;
        }

        .feature-card {
            padding: 30px;

            border-radius: 20px;

            background: white;

            border: 1px solid #e8f0f5;

            box-shadow: 0 10px 30px rgba(15,23,42,0.04);

            transition: 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);

            box-shadow: 0 25px 50px rgba(15,23,42,0.09);

            border-color: #cfe4f1;
        }

        .feature-icon {
            width: 55px;
            height: 55px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            background: linear-gradient(135deg, #eaf5ff, #e9faf5);

            font-size: 23px;

            margin-bottom: 22px;
        }

        .feature-card h3 {
            font-family: 'Poppins', sans-serif;

            font-size: 18px;

            margin-bottom: 10px;

            color: #102a43;
        }

        .feature-card p {
            color: #718096;

            line-height: 1.7;

            font-size: 13px;
        }

        /* =========================
           HOW IT WORKS
        ========================= */

        .process-section {
            background: #f1f8fc;
        }

        .process {
            max-width: 1050px;

            margin: auto;

            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 20px;
        }

        .process-card {
            position: relative;

            text-align: center;

            padding: 28px 18px;
        }

        .step {
            width: 58px;
            height: 58px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: white;

            font-family: 'Poppins', sans-serif;

            font-weight: 800;

            background: linear-gradient(135deg, #0b63ce, #08a878);

            box-shadow: 0 10px 25px rgba(11,99,206,0.2);
        }

        .process-card h3 {
            font-family: 'Poppins', sans-serif;

            font-size: 16px;

            margin-bottom: 9px;
        }

        .process-card p {
            color: #718096;

            font-size: 12px;

            line-height: 1.6;
        }

        /* =========================
           SAFETY SECTION
        ========================= */

        .safety {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 70px;

            align-items: center;

            max-width: 1150px;

            margin: auto;
        }

        .safety-box {
            padding: 42px;

            border-radius: 25px;

            background:
                linear-gradient(135deg, #0b63ce, #087f5b);

            color: white;

            box-shadow: 0 30px 60px rgba(8,127,91,0.2);

            position: relative;

            overflow: hidden;
        }

        .safety-box::after {
            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            right: -100px;
            top: -100px;

            background: rgba(255,255,255,0.1);
        }

        .shield {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: rgba(255,255,255,0.15);

            font-size: 30px;

            margin-bottom: 25px;
        }

        .safety-box h2 {
            font-family: 'Poppins', sans-serif;

            font-size: 30px;

            margin-bottom: 15px;

            position: relative;
            z-index: 2;
        }

        .safety-box p {
            line-height: 1.8;

            font-size: 14px;

            color: rgba(255,255,255,0.85);

            position: relative;
            z-index: 2;
        }

        .safety-list {
            display: flex;

            flex-direction: column;

            gap: 18px;
        }

        .safety-item {
            display: flex;

            gap: 15px;

            align-items: flex-start;
        }

        .check {
            flex-shrink: 0;

            width: 32px;
            height: 32px;

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #e8f8f3;

            color: #087f5b;

            font-weight: 800;
        }

        .safety-item h4 {
            font-family: 'Poppins', sans-serif;

            font-size: 15px;

            margin-bottom: 4px;
        }

        .safety-item p {
            color: #718096;

            font-size: 12px;

            line-height: 1.6;
        }

        /* =========================
           CTA
        ========================= */

        .cta-section {
            padding: 80px 7%;
        }

        .cta {
            max-width: 1100px;

            margin: auto;

            padding: 65px 50px;

            border-radius: 28px;

            text-align: center;

            background:
                radial-gradient(circle at 10% 20%, rgba(255,255,255,0.12), transparent 25%),
                radial-gradient(circle at 90% 80%, rgba(255,255,255,0.12), transparent 25%),
                linear-gradient(135deg, #102a43, #075985);

            color: white;

            box-shadow: 0 30px 70px rgba(16,42,67,0.2);
        }

        .cta h2 {
            font-family: 'Poppins', sans-serif;

            font-size: clamp(28px, 4vw, 42px);

            margin-bottom: 15px;
        }

        .cta p {
            color: rgba(255,255,255,0.75);

            max-width: 650px;

            margin: 0 auto 28px;

            line-height: 1.7;

            font-size: 14px;
        }

        .cta-button {
            display: inline-flex;

            align-items: center;

            gap: 9px;

            padding: 14px 25px;

            border-radius: 12px;

            background: white;

            color: #075985;

            font-weight: 800;

            font-size: 13px;

            transition: 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-3px);

            box-shadow: 0 12px 25px rgba(0,0,0,0.18);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #0b1f33;

            color: white;

            padding: 55px 7% 25px;
        }

        .footer-content {
            display: grid;

            grid-template-columns: 2fr 1fr 1fr;

            gap: 60px;

            max-width: 1150px;

            margin: auto;
        }

        .footer-brand p {
            max-width: 400px;

            margin-top: 15px;

            color: #9fb3c8;

            font-size: 12px;

            line-height: 1.8;
        }

        .footer-column h4 {
            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            margin-bottom: 18px;
        }

        .footer-column a {
            display: block;

            color: #9fb3c8;

            font-size: 12px;

            margin-bottom: 11px;

            transition: 0.2s ease;
        }

        .footer-column a:hover {
            color: white;
        }

        .footer-bottom {
            max-width: 1150px;

            margin: 45px auto 0;

            padding-top: 20px;

            border-top: 1px solid rgba(255,255,255,0.08);

            display: flex;

            justify-content: space-between;

            gap: 20px;

            color: #718096;

            font-size: 11px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 950px) {

            .nav-links {
                display: none;
            }

            .hero {
                flex-direction: column;

                padding-top: 130px;

                text-align: center;
            }

            .hero-content {
                width: 100%;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .trust-line {
                justify-content: center;
                flex-wrap: wrap;
            }

            .hero-visual {
                width: 100%;

                margin-top: 60px;
            }

            .features {
                grid-template-columns: repeat(2, 1fr);
            }

            .process {
                grid-template-columns: repeat(2, 1fr);
            }

            .safety {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {

            .navbar {
                padding: 0 5%;
            }

            .brand-subtitle {
                display: none;
            }

            .nav-buttons .login-btn {
                display: none;
            }

            .register-btn {
                padding: 10px 14px;
            }

            .hero {
                padding-left: 5%;
                padding-right: 5%;
            }

            .hero h1 {
                font-size: 40px;
                letter-spacing: -1px;
            }

            .hero-description {
                font-size: 14px;
            }

            .dashboard-card {
                width: 100%;

                transform: none;
            }

            .floating-card {
                display: none;
            }

            .features,
            .process {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 75px 5%;
            }

            .safety-box {
                padding: 30px;
            }

            .cta {
                padding: 45px 25px;
            }

            .footer-content {
                grid-template-columns: 1fr;

                gap: 30px;
            }

            .footer-bottom {
                flex-direction: column;

                text-align: center;
            }
        }

        /* =========================
           REVEAL ANIMATION
        ========================= */

        .reveal {
            opacity: 0;

            transform: translateY(30px);

            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;

            transform: translateY(0);
        }

    </style>
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar" id="navbar">

    <a href="index.php" class="brand">

        <div class="brand-icon">
            🛡
        </div>

        <div class="brand-text">
            <div class="brand-title">
                Anti-Ragging
            </div>

            <div class="brand-subtitle">
                Management System
            </div>
        </div>

    </a>

    <div class="nav-links">

        <a href="#home">Home</a>

        <a href="#features">Features</a>

        <a href="#how-it-works">How It Works</a>

        <a href="#safety">Safety</a>

    </div>

    <div class="nav-buttons">

        <a href="login.php" class="login-btn">
            Login
        </a>

        <a href="register.php" class="register-btn">
            Register
        </a>

    </div>

</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero" id="home">

    <div class="shape shape-one"></div>
    <div class="shape shape-two"></div>

    <div class="hero-content">

        <div class="badge">
            <span class="badge-dot"></span>
            Safe Campus • Secure Reporting
        </div>

        <h1>
            Your Safety.
            <br>
            <span>Your Voice.</span>
            <br>
            Our Responsibility.
        </h1>

        <p class="hero-description">

            A secure and confidential platform designed to help students
            report ragging incidents, track complaints and ensure that
            every concern receives proper attention.

        </p>

        <div class="hero-buttons">

            <a href="register.php" class="primary-btn">
                Report an Incident
                <span>→</span>
            </a>

            <a href="#how-it-works" class="secondary-btn">
                Learn How It Works
                <span>↓</span>
            </a>

        </div>

        <div class="trust-line">

            <div class="trust-item">
                <span class="trust-icon">🔒</span>
                Confidential
            </div>

            <div class="trust-item">
                <span class="trust-icon">✓</span>
                Secure
            </div>

            <div class="trust-item">
                <span class="trust-icon">⚡</span>
                Fast Response
            </div>

        </div>

    </div>


    <!-- HERO VISUAL -->

    <div class="hero-visual">

        <div class="dashboard-card">

            <div class="dashboard-top">

                <div class="dashboard-title">
                    Complaint Overview
                </div>

                <div class="secure-label">
                    ● SECURE
                </div>

            </div>

            <div class="dashboard-main">

                <small>
                    Complaint Resolution Progress
                </small>

                <div class="complaint-number">
                    72%
                </div>

                <div class="progress">
                    <span></span>
                </div>

            </div>

            <div class="status-row">

                <div class="status-card">

                    <strong>12</strong>

                    <span>Submitted</span>

                </div>

                <div class="status-card">

                    <strong>05</strong>

                    <span>Under Review</span>

                </div>

                <div class="status-card">

                    <strong>07</strong>

                    <span>Resolved</span>

                </div>

            </div>

        </div>


        <div class="floating-card one">

            <div class="floating-icon">
                ✓
            </div>

            Complaint Submitted

        </div>


        <div class="floating-card two">

            <div class="floating-icon">
                🔐
            </div>

            Data Protected

        </div>

    </div>

</section>


<!-- =========================
     FEATURES
========================= -->

<section class="section" id="features">

    <div class="section-header reveal">

        <span class="section-label">
            Platform Features
        </span>

        <h2 class="section-title">
            Everything You Need to
            Stay Safe
        </h2>

        <p class="section-description">

            A centralized system that makes reporting, monitoring
            and managing ragging complaints simple and transparent.

        </p>

    </div>


    <div class="features">

        <div class="feature-card reveal">

            <div class="feature-icon">
                📝
            </div>

            <h3>
                Easy Complaint Registration
            </h3>

            <p>
                Submit a complaint online through a simple and
                structured reporting form.
            </p>

        </div>


        <div class="feature-card reveal">

            <div class="feature-icon">
                🔒
            </div>

            <h3>
                Confidential Reporting
            </h3>

            <p>
                Student complaints are handled securely with
                privacy and confidentiality in mind.
            </p>

        </div>


        <div class="feature-card reveal">

            <div class="feature-icon">
                📊
            </div>

            <h3>
                Complaint Tracking
            </h3>

            <p>
                Track the current status of your complaint from
                submission through resolution.
            </p>

        </div>


        <div class="feature-card reveal">

            <div class="feature-icon">
                👨‍💼
            </div>

            <h3>
                Admin Management
            </h3>

            <p>
                Administrators can review complaints, investigate
                incidents and update complaint status.
            </p>

        </div>


        <div class="feature-card reveal">

            <div class="feature-icon">
                🔔
            </div>

            <h3>
                Status Notifications
            </h3>

            <p>
                Students can receive updates regarding the progress
                of their submitted complaints.
            </p>

        </div>


        <div class="feature-card reveal">

            <div class="feature-icon">
                📁
            </div>

            <h3>
                Digital Records
            </h3>

            <p>
                Maintain organized complaint records for efficient
                monitoring and institutional management.
            </p>

        </div>

    </div>

</section>


<!-- =========================
     HOW IT WORKS
========================= -->

<section class="section process-section" id="how-it-works">

    <div class="section-header reveal">

        <span class="section-label">
            Simple Process
        </span>

        <h2 class="section-title">
            How It Works
        </h2>

        <p class="section-description">

            Reporting an incident takes only a few simple steps.

        </p>

    </div>


    <div class="process">

        <div class="process-card reveal">

            <div class="step">
                01
            </div>

            <h3>
                Create Account
            </h3>

            <p>
                Register using your student details.
            </p>

        </div>


        <div class="process-card reveal">

            <div class="step">
                02
            </div>

            <h3>
                Submit Complaint
            </h3>

            <p>
                Provide details about the incident.
            </p>

        </div>


        <div class="process-card reveal">

            <div class="step">
                03
            </div>

            <h3>
                Investigation
            </h3>

            <p>
                Administrators review and investigate the complaint.
            </p>

        </div>


        <div class="process-card reveal">

            <div class="step">
                04
            </div>

            <h3>
                Track Resolution
            </h3>

            <p>
                Follow the complaint status until resolution.
            </p>

        </div>

    </div>

</section>


<!-- =========================
     SAFETY
========================= -->

<section class="section" id="safety">

    <div class="safety">

        <div class="safety-box reveal">

            <div class="shield">
                🛡
            </div>

            <h2>
                Your Safety Comes First.
            </h2>

            <p>
                The system provides a structured and confidential
                environment where students can raise concerns
                regarding ragging incidents without unnecessary
                complications.
            </p>

        </div>


        <div class="safety-list">

            <div class="safety-item reveal">

                <div class="check">
                    ✓
                </div>

                <div>

                    <h4>
                        Confidential Complaints
                    </h4>

                    <p>
                        Complaint information is accessible through
                        the authorized management system.
                    </p>

                </div>

            </div>


            <div class="safety-item reveal">

                <div class="check">
                    ✓
                </div>

                <div>

                    <h4>
                        Structured Investigation
                    </h4>

                    <p>
                        Administrators can review and manage each
                        complaint systematically.
                    </p>

                </div>

            </div>


            <div class="safety-item reveal">

                <div class="check">
                    ✓
                </div>

                <div>

                    <h4>
                        Transparent Status
                    </h4>

                    <p>
                        Students can monitor the progress of their
                        complaint after submission.
                    </p>

                </div>

            </div>


            <div class="safety-item reveal">

                <div class="check">
                    ✓
                </div>

                <div>

                    <h4>
                        Organized Records
                    </h4>

                    <p>
                        Digital records help institutions maintain
                        proper complaint management.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     CTA
========================= -->

<section class="cta-section">

    <div class="cta reveal">

        <h2>
            Don't Stay Silent.
        </h2>

        <p>

            If you or someone you know is facing ragging,
            use the system to report the incident and help
            create a safer campus environment.

        </p>

        <a href="register.php" class="cta-button">

            Register & Report

            <span>→</span>

        </a>

    </div>

</section>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="footer-content">

        <div class="footer-brand">

            <div class="brand">

                <div class="brand-icon">
                    🛡
                </div>

                <div class="brand-text">

                    <div class="brand-title" style="color:white;">
                        Anti-Ragging
                    </div>

                    <div class="brand-subtitle">
                        Management System
                    </div>

                </div>

            </div>

            <p>

                A digital platform designed to support safer
                educational environments through secure complaint
                reporting and effective management.

            </p>

        </div>


        <div class="footer-column">

            <h4>
                Platform
            </h4>

            <a href="#home">
                Home
            </a>

            <a href="#features">
                Features
            </a>

            <a href="#how-it-works">
                How It Works
            </a>

            <a href="#safety">
                Safety
            </a>

        </div>


        <div class="footer-column">

            <h4>
                Account
            </h4>

            <a href="login.php">
                Student Login
            </a>

            <a href="register.php">
                Student Registration
            </a>

            <a href="admin/login.php">
                Admin Login
            </a>

        </div>

    </div>


    <div class="footer-bottom">

        <span>
            © <?php echo date("Y"); ?> Anti-Ragging Management System
        </span>

        <span>
            Built for a safer campus environment
        </span>

    </div>

</footer>


<!-- =========================
     JAVASCRIPT
========================= -->

<script>

    /* Navbar shadow */

    window.addEventListener("scroll", function () {

        const navbar = document.getElementById("navbar");

        if (window.scrollY > 20) {

            navbar.classList.add("scrolled");

        } else {

            navbar.classList.remove("scrolled");

        }

    });


    /* Scroll reveal */

    const revealElements =
        document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
        function (entries) {

            entries.forEach(function (entry) {

                if (entry.isIntersecting) {

                    entry.target.classList.add("active");

                }

            });

        },
        {
            threshold: 0.12
        }
    );


    revealElements.forEach(function (element) {

        observer.observe(element);

    });

</script>

</body>
</html>