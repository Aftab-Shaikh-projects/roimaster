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
        <!-- Property Grid with Filters -->
        <div class="row g-5" id="property-grid">
            <?php
            // --- FILTER LOGIC ---
            $where = ["`active`='Y'"];
            
            // 1. City (Exact Match)
            if(isset($_GET['city']) && !empty($_GET['city'])) {
                $city = mysqli_real_escape_string($conn, strtolower($_GET['city']));
                $where[] = "LOWER(`city`) = '$city'";
            }

            // 2. Sub Location (Partial Match)
            if(isset($_GET['sub_location']) && !empty($_GET['sub_location'])) {
                $sub = mysqli_real_escape_string($conn, $_GET['sub_location']);
                $where[] = "`sub_location` LIKE '%$sub%'";
            }

            // 3. ROI (Partial Match)
            if(isset($_GET['roi']) && !empty($_GET['roi'])) {
                 $roi = mysqli_real_escape_string($conn, $_GET['roi']);
                 $where[] = "`roi` LIKE '%$roi%'";
            }

            // 4. Budget Logic
            if(isset($_GET['budget']) && !empty($_GET['budget'])) {
                $budget = $_GET['budget'];
                if($budget == '50l') {
                    $where[] = "`price` <= 5000000";
                } elseif($budget == '1cr') {
                    $where[] = "`price` <= 10000000";
                } elseif($budget == '5cr') {
                    $where[] = "`price` <= 50000000";
                } elseif($budget == '10cr+') {
                    $where[] = "`price` >= 100000000";
                }
            }
            
            // 5. Asset Type & Config
            if(isset($_GET['type']) && !empty($_GET['type'])) {
                $type = mysqli_real_escape_string($conn, $_GET['type']);
                
                if($type == 'residential') {
                     $where[] = "(`type` = 'Residential' OR `type` = 'Villa' OR `type` = 'Plot')"; 
                     if(isset($_GET['bhk_config']) && !empty($_GET['bhk_config'])) {
                         $bhk = mysqli_real_escape_string($conn, $_GET['bhk_config']);
                         $where[] = "`bhk` LIKE '%$bhk%'";
                     }
                } 
                elseif($type == 'commercial') {
                    $where[] = "`type` = 'Commercial'";
                    if(isset($_GET['comm_config']) && !empty($_GET['comm_config'])) {
                         $comm = mysqli_real_escape_string($conn, $_GET['comm_config']);
                         $where[] = "`comm_type` = '$comm'";
                     }
                }
            }

            // Construct Query
            $sql = "SELECT * FROM `properties`";
            if(count($where) > 0) {
                $sql .= " WHERE " . implode(" AND ", $where);
            }
            $sql .= " ORDER BY `id` DESC";
            
            $prop_res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($prop_res) > 0):
                while ($row = mysqli_fetch_assoc($prop_res)): 
                    $img_src = $row['image'];
                    ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="property-card-modern">
                            <a href="property-details.php?id=<?= enc($row['id']) ?>" class="card-img-wrapper d-block">
                                <img src="<?= $img_src ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                                <div class="card-overlay-info">
                                    <span><i class="fa-solid fa-expand me-2"></i>View Details</span>
                                </div>
                            </a>
                            <div class="card-body-modern">
                                <span class="roi-badge-floating">Premium</span>
                                <span class="price-tag-modern"><?= format_price_indian($row['price']) ?></span>
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                        style="color: var(--accent-rich);"></i><?= htmlspecialchars($row['location']) ?></p>

                                <div class="prop-features-modern">
                                    <span><i class="fa-solid fa-bed me-2"></i> <?= htmlspecialchars($row['bhk']) ?></span>
                                    <span><i class="fa-solid fa-ruler-combined me-2"></i> <?= htmlspecialchars($row['area']) ?></span>
                                </div>
                                <hr class="opacity-25 my-3">
                                <div class="d-flex justify-content-between align-items-center text-muted small">
                                    <span><i class="fa-solid fa-hotel me-2"></i><?= htmlspecialchars($row['type']) ?></span>
                                    <span><i class="fa-solid fa-calendar-check me-2"></i><?= htmlspecialchars($row['possession']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; 
            else: ?>
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No Properties Found</h3>
                    <p>Try adjusting your filters to see more results.</p>
                    <a href="properties.php" class="btn btn-outline-primary mt-3">Clear Filters</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>
