<?php include 'layouts/header.php'; ?>

<style>
    /* --- Scoped Variables --- */
    :root {
        --primary-deep: #06142e;
        --accent-rich: #C5A47E;
        --accent-light: #DAC0A3;
        --bg-offwhite: #f4f7f6;
        --text-dark: #333333;
        --text-muted: #666666;
    }

    /* --- Global Fixes --- */
    body { overflow-x: hidden; }
    .font-heading { font-family: 'Montserrat', sans-serif; }
    .text-gold { color: var(--accent-rich); }
    
    /* --- Hero Section --- */
    .team-hero {
        height: 50vh;
        min-height: 400px;
        background: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat fixed;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0;
    }
    .team-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(6, 20, 46, 0.9), rgba(6, 20, 46, 0.8));
    }
    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
    }

    /* --- LEADERSHIP DESIGN (LIGHT THEME) --- */
    .leadership-section {
       
        padding: 100px 0;
        position: relative;
        color: var(--text-dark);
    }

    /* Decorative center line (Grey now, not white) */
    .leadership-section::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background: rgba(0, 0, 0, 0.05); /* Subtle dark line */
        transform: translateX(-50%);
        z-index: 1;
    }

    .leader-row {
        margin-bottom: 120px;
        position: relative;
        z-index: 2;
    }
    .leader-row:last-child { margin-bottom: 0; }

    .leader-image-container { position: relative; }

    .leader-img {
        width: 100%;
        max-width: 450px;
        height: 550px; /* Taller editorial look */
        object-fit: cover;
        border-radius: 2px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15); /* Soft shadow */
        /* filter: grayscale(100%);  <-- REMOVED THIS LINE */
        transition: 0.5s ease;
    }
    
    .leader-row:hover .leader-img {
        /* filter: grayscale(0%); <-- REMOVED THIS LINE */
        transform: scale(1.02);
    }

    /* Gold Frame Effect */
    .leader-image-container::after {
        content: '';
        position: absolute;
        top: 20px;
        width: 100%;
        max-width: 450px;
        height: 550px;
        border: 1px solid var(--accent-rich);
        z-index: -1;
        opacity: 1; /* More visible on white */
        transition: 0.5s;
    }
    
    .img-left .leader-image-container::after { left: -20px; }
    .img-right .leader-image-container::after { right: -20px; }
    
    .leader-image-container:hover::after { top: 10px; left: 10px; }
    .img-right .leader-image-container:hover::after { right: 10px; left: auto; }

    .leader-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        padding: 20px;
    }

    .leader-title {
        color: var(--accent-rich);
        font-size: 0.85rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .leader-name {
        font-size: 3.5rem; /* Larger font */
        font-weight: 700;
        margin-bottom: 30px;
        font-family: 'Montserrat', sans-serif;
        color: var(--primary-deep); /* Navy Text */
    }

    .leader-bio {
        font-size: 1.1rem;
        color: var(--text-muted); /* Dark Grey Text */
        line-height: 1.9;
        font-weight: 400;
        margin-bottom: 35px;
    }
    
    /* Signature style for light background */
    .signature-img {
        height: 45px;
        opacity: 0.8;
        /* No invert filter needed for white background */
    }

    /* --- Team Grid Section --- */
    .team-grid-section {
        background-color: var(--bg-offwhite);
        padding: 100px 0;
    }

    .team-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: 0.4s ease;
        border: none;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .member-img-box {
        position: relative;
        overflow: hidden;
        height: 320px; 
    }

    .member-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }
    .team-card:hover .member-img-box img { transform: scale(1.1); }

    .member-info { padding: 25px; text-align: center; }
    
    .member-role {
        color: var(--accent-rich);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .member-name {
        color: var(--primary-deep);
        font-weight: 700;
        margin-top: 5px;
    }

    /* --- Testimonials --- */
    .testimonial-section {
        background: #fff;
        padding: 100px 0;
        border-top: 1px solid #eee;
    }
    .testimonial-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--primary-deep);
        font-style: italic;
    }

    /* Mobile Fixes */
    @media (max-width: 991px) {
        .leadership-section::before { display: none; }
        .leader-img { height: 400px; width: 100%; }
        .leader-image-container::after { display: none; }
        .leader-row { margin-bottom: 80px; }
        .leader-name { font-size: 2.2rem; }
        .leader-content { padding: 30px 0 0 0; }
        .order-mobile-1 { order: 1; }
        .order-mobile-2 { order: 2; }
    }
</style>

<section class="team-hero">
    <div class="hero-content container" data-aos="zoom-in">
        <h5 class="text-gold text-uppercase letter-spacing-2 mb-3">Meet The Experts</h5>
        <h1 class="display-3 font-heading fw-bold">The Minds Behind<br>The Masterpiece</h1>
    </div>
</section>

<section class="leadership-section">
    <div class="container">
        
        <div class="row align-items-center leader-row">
            <div class="col-lg-6 mb-4 mb-lg-0 img-left" data-aos="fade-right">
                <div class="leader-image-container">
                    <img src="assets\photo\verma.jpeg" class="leader-img" alt="Sameer Khan">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left">
                <div class="leader-content">
                    <span class="leader-title">FOUNDER & CEO</span>
                    <h2 class="leader-name">Mr. Brajesh Verma</h2>
                    <p class="leader-bio">
                        Holding 15+ Year of Experience into Hospitality, Real Estate & Corporate Sales. Brajesh Verma has already developed 2 Successfull venturs. Getting his Simple Vision into Reality that "Everyone Can Invest in Real Estate". Simplifying & Making Your Real Estate Investments Super Easy, hassle free with all Legal Clarity so that Everyone Can Get an Excellent ROI with the safest Investment on the Earth.
                    </p>
                    
                </div>
            </div>
        </div>

        <div class="row align-items-center leader-row">
            <div class="col-lg-6 pe-lg-5 order-2 order-lg-1" data-aos="fade-right">
                <div class="leader-content text-lg-end text-start">
                    <span class="leader-title">CO-FOUNDER & MD</span>
                    <h2 class="leader-name">Mrs. Monalisa Verma</h2>
                    <p class="leader-bio">
                        An Electronic Engineer & A Hospitality Professional, Holding Excellent Experience with one of the Top Airline in the world. Already developed a successful brand Called "Lilac- Nail Studio By Monalisa", Aiming for making it no.1 Brand in India soon. She Takes care of Operations & Training Make ROI Master more Powerful brand into Real Estate.
                    </p>
                   
                </div>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0 img-right order-1 order-lg-2" data-aos="fade-left">
                <div class="leader-image-container d-flex justify-content-lg-end justify-content-start">
                    <img src="assets\photo\photo3.jpg" class="leader-img" alt="Priya Sharma">
                </div>
            </div>
        </div>

    </div>
</section>

<?php include 'components/ourimpact.php'; ?>




<?php include 'layouts/footer.php'; ?>