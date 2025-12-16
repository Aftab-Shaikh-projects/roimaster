<?php include 'layouts/header.php'; ?>

<style>
    /* --- Scoped Variables for Consistency --- */
    :root {
        --primary-deep: #06142e;
        --accent-rich: #C5A47E;
        --accent-light: #DAC0A3;
        --text-grey: #6c757d;
    }

    /* --- Typography & Utilities --- */
    .font-heading { font-family: 'Montserrat', sans-serif; }
    .text-gold { color: var(--accent-rich); }
    .bg-navy { background-color: var(--primary-deep); }
    
    /* --- Page Hero --- */
    .about-hero {
        height: 60vh;
        min-height: 400px;
        background: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop') center/cover no-repeat fixed;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(6,20,46,0.8), rgba(6,20,46,0.6));
    }
    .hero-text-box {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        border: 1px solid rgba(197, 164, 126, 0.3);
        padding: 40px 60px;
        backdrop-filter: blur(5px);
        background: rgba(6, 20, 46, 0.4);
    }

    /* --- Overlapping Image Section (Philosophy) --- */
    .overlap-section { padding: 100px 0; overflow: hidden; }
    
    .image-frame-decor {
        position: relative;
        padding: 20px;
        border: 1px solid var(--accent-rich);
    }
    .image-frame-decor img {
        display: block;
        width: 100%;
        transform: translate(-40px, -40px); /* Pull image out of border */
        transition: transform 0.5s ease;
    }
    .image-frame-decor:hover img {
        transform: translate(-20px, -20px);
    }

    .signature-text {
        font-family: 'Playfair Display', serif; /* Optional serif font */
        font-style: italic;
        font-size: 1.5rem;
        color: var(--accent-rich);
        margin-top: 20px;
    }

    /* --- Territory Cards (Mumbai) --- */
    .territory-card {
        background: #fff;
        padding: 40px 30px;
        border-bottom: 3px solid transparent;
        transition: all 0.4s ease;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .territory-card:hover {
        border-bottom: 3px solid var(--accent-rich);
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    .territory-icon {
        width: 70px;
        height: 70px;
        background: rgba(197, 164, 126, 0.1);
        color: var(--accent-rich);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.5rem;
        margin-bottom: 25px;
        transition: 0.4s;
    }
    .territory-card:hover .territory-icon {
        background: var(--accent-rich);
        color: #fff;
    }

    /* --- Lucknow Expansion (Dark Section) --- */
    .lucknow-section {
        background-color: var(--primary-deep);
        color: white;
        position: relative;
        padding: 100px 0;
        overflow: hidden;
    }
    .lucknow-section::after {
        content: '';
        position: absolute;
        top: 0; right: 0; width: 60%; height: 100%;
        background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 50px);
        pointer-events: none;
    }
    .lucknow-img-box {
        position: relative;
        z-index: 2;
    }
    .lucknow-img-box img {
        border-radius: 4px;
        box-shadow: -20px 20px 0px rgba(197, 164, 126, 0.2);
    }

    /* --- REDESIGNED STATS SECTION --- */
    
</style>

<section class="about-hero">
    <div class="container">
        <div class="hero-text-box" data-aos="zoom-in">
            <h5 class="text-gold text-uppercase letter-spacing-2 mb-3">About ROIMaster</h5>
            <h1 class="display-4 font-heading fw-bold mb-0">Crafting Legacies,<br>Not Just Homes</h1>
        </div>
    </div>
</section>

<section class="overlap-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 pe-lg-5" data-aos="fade-right">
                <h6 class="text-uppercase text-gold fw-bold mb-3"><i class="fa-solid fa-gem me-2"></i>Our Philosophy</h6>
                <h2 class="font-heading fw-bold text-dark mb-4 display-6">Compromise is <br>Never an Option.</h2>
                <p class="text-grey lead">
                    Finding your dream home is a profound and consequential decision. It is the cornerstone of your family's future.
                </p>
                <p class="text-grey">
                    At <strong>ROIMaster</strong>, we don't just facilitate transactions; we guide transformations. We work tirelessly to fulfill every nuanced requirement you possess. With our expert team by your side, you won't need anyone else to navigate the complex landscape of luxury real estate.
                </p>
                <div class="signature-text">
                    "We turn your aspirations into addresses."
                </div>
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0 ps-lg-5" data-aos="fade-left">
                <div class="image-frame-decor">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1932&auto=format&fit=crop" alt="Premium Meeting" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="font-heading fw-bold text-dark">The Mumbai Dominance</h2>
            <p class="text-grey mx-auto" style="max-width: 600px;">We hold exclusive inventory and deep market intelligence across the city's most coveted corridors.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="territory-card">
                    <div class="territory-icon"><i class="fa-solid fa-building"></i></div>
                    <h4 class="font-heading fw-bold">Central Mumbai</h4>
                    <p class="text-grey small mb-0">The heartbeat of connectivity. From Dadar to Parel, access high-rise luxury with seamless access to the business districts.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="territory-card">
                    <div class="territory-icon"><i class="fa-solid fa-champagne-glasses"></i></div>
                    <h4 class="font-heading fw-bold">Western Suburbs</h4>
                    <p class="text-grey small mb-0">The lifestyle capital. We curate exclusive sea-facing apartments and villas from Bandra to Andheri's elite pockets.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="territory-card">
                    <div class="territory-icon"><i class="fa-solid fa-water"></i></div>
                    <h4 class="font-heading fw-bold">Powai</h4>
                    <p class="text-grey small mb-0">The modern township. Experience the perfect synthesis of corporate energy and serene lakeside living.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="lucknow-section">
    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <div class="col-lg-5 order-lg-2 mb-5 mb-lg-0" data-aos="fade-left">
                <div class="lucknow-img-box">
                    <img src="https://images.unsplash.com/photo-1588411929949-6f3b723f05b0?q=80&w=2000&auto=format&fit=crop" class="img-fluid" alt="Lucknow Architecture">
                </div>
            </div>
            <div class="col-lg-7 order-lg-1" data-aos="fade-right">
                <span class="badge bg-white text-dark px-3 py-2 mb-3 fw-bold">NEW EXPANSION</span>
                <h2 class="display-5 font-heading fw-bold mb-4">Embracing the Royal Heritage:<br> <span class="text-gold">Hello, Lucknow.</span></h2>
                <p class="lead opacity-75 mb-4">
                    We have expanded our footprint to the City of Nawabs. 
                </p>
                <p class="opacity-75 mb-4" style="max-width: 90%;">
                    Lucknow is rapidly evolving into a smart city while retaining its royal soul. We bring our Mumbai-standard professionalism to this diverse market, offering you the best plots, villas, and commercial spaces in Uttar Pradesh's capital.
                </p>
                <a href="#" class="btn btn-outline-light rounded-0 px-4 py-2">View Lucknow Projects</a>
            </div>
        </div>
    </div>
</section> -->

<?php include 'components/ourimpact.php'; ?>

<?php include 'layouts/footer.php'; ?>