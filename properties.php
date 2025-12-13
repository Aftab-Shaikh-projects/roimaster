<?php include 'layouts/header.php'; ?>


<!-- Page Title & Breadcrumb -->
<!-- Page Title & Breadcrumb -->
<section class="page-title-section">
    <div class="bg-abstract"></div>
    <div class="container position-relative z-1">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="hero-text-box" data-aos="zoom-in">
                    <h1 class="page-title">Premium Properties</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Properties</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* --- Scoped Variables for Consistency (Matches About Us) --- */
    :root {
        --primary-deep: #06142e;
        --accent-rich: #C5A47E;
        /* Redefined to ensure availability in this scope */
    }

    /* Page Title Section Style - EXACT match to About Us Style */
    .page-title-section {
        background: url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop') center/cover no-repeat fixed;
        padding: 160px 0 80px;
        position: relative;
        overflow: hidden;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60vh; /* Matches About Us height */
    }

    /* Dark Overlay */
    .page-title-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(6,20,46,0.8), rgba(6,20,46,0.6));
        z-index: 0;
    }

    /* Glass Box Style from About Page */
    .hero-text-box {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        border: 1px solid rgba(197, 164, 126, 0.3);
        padding: 40px 60px;
        backdrop-filter: blur(5px);
        background: rgba(6, 20, 46, 0.4);
        display: inline-block;
        width: 100%;
        max-width: 700px;
    }

    .page-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 1.1rem;
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: 0.3s;
    }

    .breadcrumb-item a:hover {
        color: var(--accent-rich);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--accent-rich);
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 0.9rem;
        padding-top: 4px;
    }

    .breadcrumb-item.active {
        color: var(--accent-rich);
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .hero-text-box { padding: 30px 20px; }
        .page-title { font-size: 2.5rem; }
        .page-title-section { min-height: 50vh; }
    }
</style>



<!-- Property Listing Section -->
<section class="section-padding bg-offwhite">
    <div class="container">
        <?php include 'components/property_grid.php'; ?>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>
