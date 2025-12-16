<style>
    .stats-modern {
        padding: 80px 0;
        background: linear-gradient(rgba(6, 20, 46, 0.95), rgba(6, 20, 46, 0.9)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-attachment: fixed;
        color: #fff;
    }

    .stat-glass-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 40px 20px;
        text-align: center;
        transition: 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    /* Subtle glow on hover */
    .stat-glass-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent-rich);
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.2);
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .stat-glass-card:hover .stat-icon {
        color: var(--accent-rich);
        transform: scale(1.1);
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--accent-rich);
        font-family: 'Montserrat', sans-serif;
        line-height: 1;
        margin-bottom: 10px;
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        opacity: 0.7;
        font-weight: 500;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .image-frame-decor { border: none; padding: 0; }
        .image-frame-decor img { transform: none; }
        .hero-text-box { padding: 20px; width: 90%; }
        .stat-glass-card { margin-bottom: 15px; }
    }
</style>

<section class="stats-modern">
    <div class="container">
        <div class="row">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-glass-card">
                    <i class="fa-solid fa-people-roof stat-icon"></i>
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Happy Families</span>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-glass-card">
                    <i class="fa-solid fa-handshake-simple stat-icon"></i>
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Client Retention</span>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-glass-card">
                    <i class="fa-solid fa-map-location-dot stat-icon"></i>
                    <span class="stat-number">2</span>
                    <span class="stat-label">Major Cities</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5 pt-4">
            <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="400">
                <i class="fa-solid fa-quote-left text-gold fa-2x mb-3"></i>
                <p class="lead fst-italic text-white fw-light">
                    "The overwhelmingly positive feedback from our loyal clients is a clear indication of our growth, success, and dedication to providing the best possible service."
                </p>
                <div class="mt-3 text-gold fw-bold">— The ROIMaster Team</div>
            </div>
        </div>
    </div>
</section>