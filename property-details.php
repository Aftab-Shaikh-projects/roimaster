<?php include 'layouts/header.php'; ?>

<?php
// Database Connection (db_connect.php included in header)

if (isset($_GET['id'])) {
    $enc_id = $_GET['id'];
    $prop_id = dec($enc_id); // Double Base64 Decode
    $prop_id = res($prop_id); // Sanitize

    // Fetch Property
    $sql = "SELECT * FROM `properties` WHERE `id` = '$prop_id' AND `active`='Y'";
    $res = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        $prop = mysqli_fetch_assoc($res);
        
        // Fetch Gallery
        $gal_sql = "SELECT * FROM `property_gallery` WHERE `property_id` = '$prop_id' ORDER BY `id` ASC";
        $gal_res = mysqli_query($conn, $gal_sql);
        $gallery_images = [];
        // Add Main Image First as requested
        if (!empty($prop['image'])) {
            $gallery_images[] = $prop['image'];
        }
        while($g = mysqli_fetch_assoc($gal_res)) {
            $gallery_images[] = $g['image_path'];
        }
        $total_images = count($gallery_images);
        
    } else {
        // Not Found
        echo "<script>window.location.href='properties.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='properties.php';</script>";
    exit;
}
?>

<!-- Hero Section -->

<!-- Ultra Premium Hero Section -->
<?php 
$hero_img = $prop['image'];
$ext = strtolower(pathinfo($hero_img, PATHINFO_EXTENSION));
$hero_is_video = in_array($ext, ['mp4', 'webm']);
?>
<section class="prop-hero d-flex align-items-center justify-content-center" style="position: relative; overflow: hidden; <?php echo !$hero_is_video ? "background-image: url('$hero_img');" : ""; ?>">
    <?php if($hero_is_video): ?>
        <video src="<?= $hero_img ?>" autoplay muted loop playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;"></video>
    <?php endif; ?>
    <div class="hero-overlay" style="z-index: 1;"></div>
    <div class="container position-relative z-2 text-center" data-aos="zoom-in" data-aos-duration="1000">
        <div class="glass-hero-card p-5 d-inline-block mx-auto">
            <span class="badge bg-gold text-dark mb-4 px-4 py-2 fw-bold text-uppercase tracking-wider">For Sale</span>
            <h1 class="display-2 fw-bold text-white mb-2" style="font-family: 'Playfair Display', serif;"><?php echo htmlspecialchars($prop['title']); ?></h1>
            <p class="lead text-white-80 mb-4 fs-4"><i class="fa-solid fa-location-dot me-2 text-gold"></i><?php echo htmlspecialchars(ucwords($prop['sub_location']) . ', ' . ucwords($prop['city'])); ?></p>
            <h2 class="text-gold fw-bold display-4">
                <?php echo format_price_indian($prop['price']); ?>
                <?php echo (isset($prop['price_high']) && $prop['price_high'] > 0) ? ' - ' . format_price_indian($prop['price_high']) : ''; ?>
            </h2>
            
            <div class="d-flex justify-content-center gap-4 mt-5 text-white">
                <?php if (!empty($prop['bhk'])): ?>
                <div class="stat-bubble">
                    <i class="fa-solid fa-bed fs-4 mb-1"></i>
                    <span class="d-block fw-bold"><?php echo $prop['bhk']; ?></span>
                </div>
                <div class="vert-line"></div>
                <?php endif; ?>
                <div class="stat-bubble">
                    <i class="fa-solid fa-ruler-combined fs-4 mb-1"></i>
                    <span class="d-block fw-bold"><?php echo $prop['area']; ?></span>
                </div>
                <div class="vert-line"></div>
                <div class="stat-bubble">
                    <i class="fa-solid fa-calendar-days fs-4 mb-1"></i>
                    <span class="d-block fw-bold"><?php echo $prop['possession']; ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Down Indicator -->
    <a href="#details" class="scroll-down-btn">
        <i class="fa-solid fa-chevron-down"></i>
    </a>
</section>



<!-- Removing old Overview Bar logic as it's now integrated in Hero -->


<!-- Main Content -->
<section class="section-padding" id="details">
    <div class="container">
        <div class="row g-5">
            <!-- Left Content -->
            <div class="col-lg-8">
                <!-- Gallery Section (Refined) -->
                <?php if ($total_images > 0): ?>
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Property Gallery</h3>
                    
                        <?php 
                        function render_gallery_item($src, $class="img-fluid rounded-3 h-100 w-100 object-fit-cover") {
                            $ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
                            if (in_array($ext, ['mp4', 'webm'])) {
                                echo '<video src="'.$src.'" class="'.$class.'" autoplay muted loop playsinline></video>';
                            } else {
                                echo '<img src="'.$src.'" class="'.$class.'" alt="Property Image">';
                            }
                        }
                        ?>

                        <?php if ($total_images >= 3): ?>
                            <!-- Creative Grid (1 Big, 2 Small) -->
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <a href="<?= $gallery_images[0] ?>" data-fancybox="gallery" class="gallery-item h-100 d-block">
                                        <?php render_gallery_item($gallery_images[0]); ?>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex flex-column gap-3 h-100">
                                        <!-- Image 2 -->
                                        <a href="<?= $gallery_images[1] ?>" data-fancybox="gallery" class="gallery-item h-50 d-block">
                                            <?php render_gallery_item($gallery_images[1]); ?>
                                        </a>
                                        
                                        <!-- Image 3 (With possible overlay) -->
                                        <?php 
                                            $remaining = $total_images - 3; 
                                            $has_more = $remaining > 0;
                                        ?>
                                        <a href="<?= $gallery_images[2] ?>" data-fancybox="gallery" class="gallery-item h-50 d-block position-relative">
                                            <?php render_gallery_item($gallery_images[2]); ?>
                                            <?php if ($has_more): ?>
                                            <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                                <span class="fw-bold text-white fs-5">+<?= $remaining ?> Photos</span>
                                            </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hidden links for remaining images to show in Fancybox -->
                            <?php for($i = 3; $i < $total_images; $i++): ?>
                                <a href="<?= $gallery_images[$i] ?>" data-fancybox="gallery" class="d-none"></a>
                            <?php endfor; ?>

                        <?php else: ?>
                            <!-- Simple Grid (< 3 images) -->
                            <div class="row g-3">
                                <?php foreach($gallery_images as $img): ?>
                                <div class="col-md-6">
                                    <a href="<?= $img ?>" data-fancybox="gallery" class="gallery-item h-100 d-block">
                                        <?php render_gallery_item($img); ?>
                                    <img src="<?= $img ?>" class="img-fluid rounded-3 w-100 object-fit-cover" style="height: 300px;" alt="Gallery">
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($prop['description'])): ?>
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">About the Property</h3>
                    <div class="p-4 bg-light-gold rounded-4 border-gold-light">
                        <p class="text-muted leading-relaxed fs-5 mb-0" style="text-align: justify;"><?php echo htmlspecialchars($prop['description']); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php 
                $has_features = false;
                if (!empty($prop['features'])) {
                   $feats_check = explode(',', $prop['features']);
                   foreach($feats_check as $f) {
                       if(!empty(trim($f))) { $has_features = true; break; }
                   }
                }
                
                if ($has_features): ?>
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Premium Amenities</h3>
                    <div class="row g-3">
                        <?php 
                        $feats = explode(',', $prop['features']);
                        foreach($feats as $feature): 
                            $feature = trim($feature);
                            if(empty($feature)) continue;
                        ?>
                        <div class="col-md-4 col-6">
                            <div class="amenity-card-premium text-center p-4">
                                <div class="icon-circle mb-3 mx-auto">
                                    <i class="fa-solid fa-star text-gold"></i>
                                </div>
                                <span class="fw-bold text-dark small text-uppercase"><?php echo htmlspecialchars($feature); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($prop['map_url'])): ?>
                 <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Location</h3>
                    <div class="map-frame p-2 bg-white shadow-sm rounded-4">
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                            <iframe src="<?php echo $prop['map_url']; ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- Sidebar -->
           <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px; z-index: 10;">
                    <style>
    /* Add these variables if they aren't already in your :root */
:root {
    --primary-deep: #06142E; /* Your Dark Navy Brand Color */
    --gold-primary: #C5A47E; /* Your Gold Brand Color */
}

/* Talk to Expert Button Styling */
.btn-expert {
    background-color: var(--primary-deep); /* Uses your site's dark blue */
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px; /* Matches your other inputs */
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-expert:hover {
    background-color: #0a1f45; /* Slightly lighter navy on hover */
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(6, 20, 46, 0.2);
}

/* Helper classes for colors inside the button */
.text-primary-deep {
    color: var(--primary-deep) !important;
}
.text-gold {
    color: var(--gold-primary) !important;
}

/* Pulse Animation (Gold Glow) */
@keyframes pulse-gold {
    0% { box-shadow: 0 0 0 0 rgba(197, 164, 126, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(197, 164, 126, 0); }
    100% { box-shadow: 0 0 0 0 rgba(197, 164, 126, 0); }
}

.pulse-effect {
    animation: pulse-gold 2s infinite;
}
</style>

<div class="talk-to-expert-container mb-4">
    <a href="tel:+917208565700" class="btn btn-expert w-100 d-flex align-items-center justify-content-between p-3 shadow-sm pulse-effect">
        <div class="d-flex align-items-center">
            <div class="icon-box bg-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                <i class="fa-solid fa-phone text-primary-deep"></i>
            </div>
            <div class="text-start">
                <span class="d-block small text-white-50 text-uppercase">Have Questions?</span>
                <span class="fw-bold text-white fs-5">Talk to Our Experts</span>
            </div>
        </div>
        <i class="fa-solid fa-chevron-right text-gold"></i>
    </a>
</div>
                    
                    <div class="contact-card mb-4" style="border: 2px solid var(--gold-primary);">
                        <div class="contact-header ">
                            <h4 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif;">Schedule a Site Visit</h4>
                            <p class="mb-0 small opacity-75">Book a physical tour</p>
                        </div>
                        <div class="contact-body">
                            <?php if(isset($_SESSION['msg'])): ?>
                                <div class="alert alert-<?= $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['msg']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php unset($_SESSION['msg']); unset($_SESSION['msg_type']); ?>
                            <?php endif; ?>

                            <form action="forms/submit_enquiry.php" method="POST">
                                <input type="hidden" name="property_id" value="<?= htmlspecialchars($prop_id) ?>">
                                
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="floatingName" placeholder="Name" required>
                                    <label for="floatingName">Your Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com" required>
                                    <label for="floatingEmail">Email Address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" name="phone" id="floatingPhone" placeholder="Phone" required>
                                    <label for="floatingPhone">Phone</label>
                                </div>
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="Date" id="Date" required min="<?= date('Y-m-d'); ?>">
                                            <label for="Date">Date</label>
                                        </div>
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" name="message" placeholder="Leave a comment here" id="floatingText" style="height: 100px"></textarea>
                                    <label for="floatingText">Message</label>
                                </div>
                                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold shadow-lg">
                                    <i class="fa-solid fa-calendar-check me-2"></i> Schedule Visit
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="contact-card mb-4" style="border: 2px solid var(--gold-primary);">
                        <div class="contact-header bg-white  border-bottom">
                            <h4 class="fw-bold mb-1 " style="font-family: 'Playfair Display', serif;">
                                <i class="fa-solid fa-video  me-2"></i>Video Presentation
                            </h4>
                            <p class="mb-0 small">Request a live virtual tour</p>
                        </div>
                        <div class="contact-body bg-light">
                            
                            <form action="forms/video_enquiry.php" method="POST">
                                <input type="hidden" name="property_id" value="<?= htmlspecialchars($prop_id) ?>">
                                <input type="hidden" name="enc_id" value="<?= htmlspecialchars($enc_id) ?>">
                                
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" id="vcName" placeholder="Name" required>
                                    <label for="vcName">Full Name</label>
                                </div>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" name="mobile" id="vcMobile" placeholder="Mobile" required>
                                            <label for="vcMobile">Mobile No</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" id="vcEmail" placeholder="Email">
                                            <label for="vcEmail">Email Id</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" name="vc_date" id="vcDate" required min="<?= date('Y-m-d'); ?>">
                                            <label for="vcDate">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="time" class="form-control" name="vc_time" id="vcTime" required>
                                            <label for="vcTime">Time</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="remark" id="vcRemark" placeholder="Remark" style="height: 80px"></textarea>
                                    <label for="vcRemark">Remark / Questions</label>
                                </div>

                                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold shadow-lg">
                                    Request Video Call
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            
        </div>
    </div>
</section>


<style>
    /* Variables */
    :root {
        --gold-primary: #C5A47E;
        --gold-light: #fof4eb;
    }

    /* Hero Section */
    .prop-hero {
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle, rgba(6, 20, 46, 0.4) 0%, rgba(6, 20, 46, 0.9) 80%);
    }

    /* Glass Card */
    .glass-hero-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        max-width: 800px;
        width: 100%;
        margin-top: 100px;
        margin-bottom: 100px;
    }

    .badge.bg-gold {
        background-color: var(--gold-primary);
        color: #06142E !important;
    }
    .text-gold { color: var(--gold-primary) !important; }
    .text-white-80 { color: rgba(255,255,255,0.8); }
    
    .vert-line {
        width: 1px;
        height: 40px;
        background: rgba(255,255,255,0.3);
    }
    
    .scroll-down-btn {
        position: absolute;
        bottom: 30px;
        color: white;
        font-size: 2rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
        40% {transform: translateY(-10px);}
        60% {transform: translateY(-5px);}
    }

    /* Section Headings */
    .section-heading {
        font-family: 'Playfair Display', serif;
        position: relative;
        display: inline-block;
    }
    .section-heading::after {
        content: '';
        display: block;
        width: 40px;
        height: 3px;
        background: var(--gold-primary);
        margin-top: 10px;
    }

    /* Amenities Premium */
    .amenity-card-premium {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
        border: 1px solid transparent;
    }
    .amenity-card-premium:hover {
        transform: translateY(-5px);
        border-color: var(--gold-primary);
        box-shadow: 0 10px 30px rgba(197, 164, 126, 0.2);
    }
    .icon-circle {
        width: 50px; height: 50px;
        background: rgba(197, 164, 126, 0.1);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
    }

    /* Contact Card */x
    .contact-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: none;
    }
    .contact-header {
        background: var(--primary-deep); /* Uses theme variable */
        padding: 40px 30px;
        color: white;
        text-align: center;
        background-image: linear-gradient(135deg, var(--primary-deep) 0%, #1a3a6c 100%);
    }
    .contact-body {
        padding: 30px;
        background: #f6f4f4;
    }
    .btn-gold {
        background: var(--gold-primary);
        color: #06142E;
        border: none;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background: #b08d66;
        color: #fff;
    }
    
    /* Form Floating override */
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: var(--gold-primary);
    }
    .form-control:focus {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 0.25rem rgba(197, 164, 126, 0.25);
    }
    
    /* Gallery */
    .gallery-item {
        overflow: hidden;
        border-radius: 1rem;
        cursor: pointer;
    }
    .gallery-item img {
        transition: transform 0.5s ease;
    }
    .gallery-item:hover img {
        transform: scale(1.05);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        border-radius: 1rem;
    }

    /* RESPONSIVE ADJUSTMENTS */
    @media (max-width: 991px) {
        .prop-hero {
            height: auto;
            min-height: 100vh; /* Allow growth */
            padding: 120px 0 80px 0;
            display: flex;
            align-items: center;
        }
        .display-2 {
            font-size: 3.5rem; /* Smaller than desktop */
        }
        .glass-hero-card {
            padding: 2.5rem !important;
            margin: 0 15px;
            max-width: 100%;
        }
        .contact-card.sticky-top {
            position: relative !important;
            top: 0 !important;
            margin-top: 3rem;
            z-index: 1;
        }
    }

    @media (max-width: 768px) {
        .display-2 { font-size: 2.5rem; }
        .display-4 { font-size: 2rem; }
        
        .stat-bubble i { font-size: 1.2rem !important; }
        .stat-bubble span { font-size: 0.9rem; }
        .vert-line { height: 25px; display: none; } /* Hide lines on mobile */
        
        /* Stack stats in a 2x2 grid or similar */
        .glass-hero-card .d-flex.justify-content-center.gap-4 {
            flex-wrap: wrap;
            gap: 1.5rem !important;
            justify-content: center;
        }
        .stat-bubble {
            width: 40%; /* 2 per row */
            margin-bottom: 0;
        }

        .gallery-item.h-50 {
            height: 200px !important;
        }
        .col-md-4 .d-flex.flex-column {
            flex-direction: row !important;
        }
    }

    @media (max-width: 576px) {
        .glass-hero-card {
            padding: 1.5rem !important;
        }
        .display-2 { 
            font-size: 2rem; 
            word-wrap: break-word; /* Prevent overflow */
        }
        .display-4 { font-size: 1.5rem; }
        .lead { font-size: 0.95rem !important; }
        
        .badge.bg-gold {
            font-size: 0.7rem;
            padding: 6px 12px;
        }

        /* Stats: 3 per row is too tight, 2 per row is better, or stack */
         .stat-bubble {
            width: 100%; /* Stack vertically for clarity */
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .stat-bubble i { margin-bottom: 0 !important; }
        
        /* Gallery Adjustments due to stacking */
        .col-md-4 .d-flex.flex-column {
            flex-direction: column !important;
        }
    }
</style>

<?php include 'layouts/footer.php'; ?>
