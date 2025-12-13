<?php include 'layouts/header.php'; ?>


<!-- Page Title & Breadcrumb -->
<section class="page-title-section">
    <div class="bg-abstract"></div>
    <div class="container position-relative z-1">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
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
</section>

<style>
    /* Page Title Section Style */
    .page-title-section {
        background-color: var(--primary-deep);
        padding: 160px 0 80px; /* Top padding accounts for fixed navbar */
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .page-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        color: #fff;
        font-family: 'Montserrat', sans-serif;
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
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: 0.3s;
    }

    .breadcrumb-item a:hover {
        color: var(--accent-rich);
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--accent-rich);
        content: "\f105"; /* FontAwesome angle-right */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 0.9rem;
        padding-top: 4px;
    }

    .breadcrumb-item.active {
        color: var(--accent-rich);
    }

    /* Reuse abstract background if available, else style simple */
    .page-title-section .bg-abstract {
        background-image: radial-gradient(circle at 20% 50%, rgba(15, 44, 89, 0.4) 0%, transparent 50%), 
                          radial-gradient(circle at 80% 50%, rgba(197, 164, 126, 0.2) 0%, transparent 50%);
    }
</style>



<!-- Property Listing Section -->
<section class="section-padding bg-offwhite">
    <div class="container">
        <?php include 'components/property_grid.php'; ?>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>
