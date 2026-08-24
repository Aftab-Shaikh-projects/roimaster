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
                            <li class="breadcrumb-item active" aria-current="page">Properties</li>
                        </ol>
                    </nav>
                        </ol>
                    </nav>
                    <button type="button" class="btn btn-premium-filter shadow-lg" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <i class="fa-solid fa-filter me-2"></i>Filter Projects
                    </button>
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

    /* --- Premium Filter Button --- */
    .btn-premium-filter {
        background: var(--primary-deep);
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px 30px;
        border: 1px solid var(--accent-rich);
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-top: 30px;
        display: inline-block;
    }
    .btn-premium-filter:hover {
        background: var(--accent-rich);
        color: var(--primary-deep);
        transform: translateY(-2px);
    }

    /* --- Light Theme Modal --- */
    .modal-premium-content {
        background: #fff;
        border: none;
        box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        color: var(--primary-deep);
    }
    .modal-premium-header {
        background: var(--primary-deep);
        color: #fff;
        border-bottom: 2px solid var(--accent-rich);
    }
    .modal-premium-header .btn-close {
        filter: invert(1);
    }
    .modal-premium-body {
        padding: 30px;
    }
    .modal-premium-body label {
        color: var(--primary-deep);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modal-premium-body .form-select,
    .modal-premium-body .form-control {
        background: #f8f9fa;
        border: 1px solid #ddd;
        color: var(--primary-deep);
        padding: 10px 15px;
    }
    .modal-premium-body .form-select:focus,
    .modal-premium-body .form-control:focus {
        background: #fff;
        border-color: var(--accent-rich);
        box-shadow: none;
    }
    .modal-premium-body option {
        background: #fff;
        color: #000;
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
                     $where[] = "`type` = 'Residential'"; 
                     if(isset($_GET['bhk_config']) && !empty($_GET['bhk_config'])) {
                         $bhk = mysqli_real_escape_string($conn, $_GET['bhk_config']);
                         $where[] = "`bhk` LIKE '%$bhk%'";
                     }
                } 
                elseif($type == 'villa') {
                     $where[] = "`type` = 'Villa'"; 
                     if(isset($_GET['bhk_config']) && !empty($_GET['bhk_config'])) {
                         $bhk = mysqli_real_escape_string($conn, $_GET['bhk_config']);
                         $where[] = "`bhk` LIKE '%$bhk%'";
                     }
                }
                elseif($type == 'plot') {
                     $where[] = "`type` = 'Plot'"; 
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
                                <?php 
                                $ext = strtolower(pathinfo($img_src, PATHINFO_EXTENSION));
                                if(in_array($ext, ['mp4', 'webm'])): 
                                ?>
                                <video src="<?= $img_src ?>" class="card-img-top object-fit-cover" autoplay muted loop playsinline></video>
                                <?php else: ?>
                                <img src="<?= $img_src ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                                <?php endif; ?>
                                <div class="card-overlay-info">
                                    <span><i class="fa-solid fa-expand me-2"></i>View Details</span>
                                </div>
                            </a>
                            <div class="card-body-modern">
                                <?php if (!empty($row['roi'])): ?>
                                    <span class="roi-badge-floating">
                                        Expected ROI : <?= htmlspecialchars($row['roi']) ?><?= strpos($row['roi'], '%') === false ? '%' : '' ?>
                                    </span>
                                <?php endif; ?>
                                <span class="price-tag-modern">
                                    <?= format_price_indian($row['price']) ?>
                                    <?= (isset($row['price_high']) && $row['price_high'] > 0) ? ' - ' . format_price_indian($row['price_high']) : '' ?>
                                </span>
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                        style="color: var(--accent-rich);"></i><?= htmlspecialchars(ucwords($row['sub_location']) . ', ' . ucwords($row['city'])) ?></p>

                                <div class="prop-features-modern">
                                    <?php if (!empty($row['bhk'])): ?>
                                        <span><i class="fa-solid fa-bed me-2"></i> <?= htmlspecialchars($row['bhk']) ?></span>
                                    <?php endif; ?>
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

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-premium-content">
            <div class="modal-header modal-premium-header text-white">
                <h5 class="modal-title" id="filterModalLabel"><i class="fa-solid fa-sliders me-2 text-white"></i>Filter Properties</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-premium-body">
                <form action="properties.php" method="GET">
                    <div class="row g-3">
                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <select class="form-select" name="city">
                                <option value="">All Cities</option>
                                <?php
                                $c_sql = "SELECT * FROM `city_master` WHERE `active`='Y' ORDER BY `name` ASC";
                                $c_res = mysqli_query($conn, $c_sql);
                                $curr_city = isset($_GET['city']) ? strtolower($_GET['city']) : '';
                                while($row = mysqli_fetch_assoc($c_res)) {
                                    $sel = (strtolower($row['name']) == $curr_city) ? 'selected' : '';
                                    echo '<option value="'.$row['name'].'" '.$sel.'>'.ucwords($row['name']).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <!-- Sub Location -->
                        <div class="col-md-6">
                            <label class="form-label">Sub Location</label>
                             <input type="text" class="form-control" name="sub_location" 
                                    value="<?= isset($_GET['sub_location']) ? htmlspecialchars($_GET['sub_location']) : '' ?>" 
                                    placeholder="e.g. Bandra">
                        </div>

                        <!-- Budget -->
                        <div class="col-md-6">
                            <label class="form-label">Budget</label>
                            <select class="form-select" name="budget">
                                <option value="" selected>Any Budget</option>
                                <option value="50l" <?= (isset($_GET['budget']) && $_GET['budget'] == '50l') ? 'selected' : '' ?>>Up to 50 Lacs</option>
                                <option value="1cr" <?= (isset($_GET['budget']) && $_GET['budget'] == '1cr') ? 'selected' : '' ?>>Up to 1 Cr</option>
                                <option value="5cr" <?= (isset($_GET['budget']) && $_GET['budget'] == '5cr') ? 'selected' : '' ?>>Up to 5 Cr</option>
                                <option value="10cr+" <?= (isset($_GET['budget']) && $_GET['budget'] == '10cr+') ? 'selected' : '' ?>>10 Cr+</option>
                            </select>
                        </div>

                        <!-- ROI -->
                        <div class="col-md-6">
                            <label class="form-label">Target ROI</label>
                            <input type="text" class="form-control" name="roi" 
                                   value="<?= isset($_GET['roi']) ? htmlspecialchars($_GET['roi']) : '' ?>" 
                                   placeholder="e.g. 6%">
                        </div>

                        <!-- Type -->
                         <div class="col-md-6">
                            <label class="form-label">Asset Type</label>
                            <select class="form-select" id="propertyTypeById" name="type" onchange="toggleConfigById()">
                                <option value="residential" <?= (isset($_GET['type']) && $_GET['type'] == 'residential') ? 'selected' : '' ?>>Residential</option>
                                <option value="villa" <?= (isset($_GET['type']) && $_GET['type'] == 'villa') ? 'selected' : '' ?>>Villa</option>
                                <option value="commercial" <?= (isset($_GET['type']) && $_GET['type'] == 'commercial') ? 'selected' : '' ?>>Commercial</option>
                                <option value="plot" <?= (isset($_GET['type']) && $_GET['type'] == 'plot') ? 'selected' : '' ?>>Plots</option>
                            </select>
                        </div>

                        <!-- Configuration -->
                         <div class="col-md-6">
                            <label class="form-label">Configuration</label>
                            
                             <div id="residentialOptionsById">
                                <select class="form-select" name="bhk_config">
                                    <option value="">Any BHK</option>
                                    <?php $sel_bhk = isset($_GET['bhk_config']) ? $_GET['bhk_config'] : ''; ?>
                                    <option value="1" <?= $sel_bhk == '1' ? 'selected' : '' ?>>1 BHK</option>
                                    <option value="2" <?= $sel_bhk == '2' ? 'selected' : '' ?>>2 BHK</option>
                                    <option value="3" <?= $sel_bhk == '3' ? 'selected' : '' ?>>3 BHK</option>
                                    <option value="4" <?= $sel_bhk == '4' ? 'selected' : '' ?>>4 BHK</option>
                                    <option value="5" <?= $sel_bhk == '5' ? 'selected' : '' ?>>5 BHK</option>
                                </select>
                             </div>

                             <div id="commercialOptionsById" style="display: none;">
                                <select class="form-select" name="comm_config">
                                    <option value="">Any Type</option>
                                    <?php $sel_comm = isset($_GET['comm_config']) ? $_GET['comm_config'] : ''; ?>
                                    <option value="office" <?= $sel_comm == 'office' ? 'selected' : '' ?>>Grade A Office Space</option>
                                    <option value="shop" <?= $sel_comm == 'shop' ? 'selected' : '' ?>>High Street Retail</option>
                                </select>
                             </div>
                        </div>

                        <div class="col-12 text-end mt-4">
                             <a href="properties.php" class="btn btn-outline-light me-2">Reset</a>
                             <button type="submit" class="btn btn-premium-filter px-5">Search Results</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleConfigById() {
        const type = document.getElementById('propertyTypeById').value;
        const resOpts = document.getElementById('residentialOptionsById');
        const commOpts = document.getElementById('commercialOptionsById');

        if(type === 'commercial') {
            resOpts.style.display = 'none';
            commOpts.style.display = 'block';
        } else if (type === 'plot') {
            resOpts.style.display = 'none';
            commOpts.style.display = 'none';
        } else {
            // Residential or Villa or Default
            resOpts.style.display = 'block';
            commOpts.style.display = 'none';
        }
    }
    // Run on load to set correct state
    window.addEventListener('load', toggleConfigById);
</script>

<?php include 'layouts/footer.php'; ?>
