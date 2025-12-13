<?php include 'layouts/header.php'; ?>

<?php
// Mock Database
$properties = [
    'nahar-amaryllis' => [
        'title' => 'Nahar Amaryllis',
        'price' => '₹ 1.17 Cr',
        'location' => 'Chandivali, Powai, Mumbai',
        'bhk' => '1 BHK',
        'area' => '366 Sqft',
        'type' => 'Residential',
        'possession' => 'June 2024',
        'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=1000&auto=format&fit=crop',
        'description' => 'Nahar Amaryllis Chandivali is a flagship project by Nahar Group. Situated in the most premium location of Powai, Mumbai, it offers 1, 2 & 3 Bed Apartments. The project features world-class amenities including an Open Air Cafeteria, Multipurpose Court, Gymnasium, Yoga/Meditation Zone, and a lush Landscape Garden.',
        'features' => ['Air Conditioning', 'Gymnasium', 'Landscape Garden', 'Jogging Track', 'Children\'s Play Area', 'High Speed Elevators'],
        'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.645932826362!2d72.8988!3d19.1182!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA3JzA1LjUiTiA3MsKwNTMnNTUuNyJF!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin'
    ],
    'kanakia-silicon-valley' => [
        'title' => 'Kanakia Silicon Valley',
        'price' => '₹ 2.70 Cr',
        'location' => 'Powai, Mumbai',
        'bhk' => '2 BHK',
        'area' => '669 Sqft',
        'type' => 'Residential',
        'possession' => 'June 2024',
        'image' => 'https://images.unsplash.com/photo-1600596542815-6ad4c7213aa8?q=80&w=1000&auto=format&fit=crop',
        'description' => 'Kanakia Silicon Valley is a tremendous advancement in culture, technology, and the environment. Spanning around 8 acres, it launches Go Zero 2 & 3 Bed Lake Facing apartments. Its hilltop location in the center of Mumbai’s most coveted neighborhood, Powai, offers breathtaking views.',
        'features' => ['Lake View', 'Swimming Pool', 'Clubhouse', 'Smart Home Automation', 'Valet Parking', '24/7 Security'],
        'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.3562!2d72.90!3d19.12!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA3JzEyLjAiTiA3MsKwNTQnMDAuMCJF!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin'
    ],
    'godrej-urban-park' => [
        'title' => 'Godrej Urban Park',
        'price' => '₹ 3.25 Cr',
        'location' => 'Chandivali, Mumbai',
        'bhk' => '3 BHK',
        'area' => '975 Sqft',
        'type' => 'Residential',
        'possession' => 'Ready to Move',
        'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=1000&auto=format&fit=crop',
        'description' => 'Godrej Urban Park in Chandivali brings you a home with a 5-point landscape advantage. Experience a life surrounded by greenery with a Miyawaki forest, rooftop gardens, and a vehicle-free podium. It offers a perfect blend of nature and modern luxury living.',
        'features' => ['Miyawaki Forest', 'Rooftop Garden', 'Swimming Pool', 'Squash Court', 'Mini Theatre', 'Co-working Space'],
        'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.5!2d72.9!3d19.115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA2JzU0LjAiTiA3MsKwNTQnMDAuMCJF!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin'
    ]
];

$id = isset($_GET['id']) ? $_GET['id'] : 'nahar-amaryllis'; // Default
$prop = isset($properties[$id]) ? $properties[$id] : $properties['nahar-amaryllis'];
?>

<!-- Hero Section -->

<!-- Ultra Premium Hero Section -->
<section class="prop-hero d-flex align-items-center justify-content-center" style="background-image: url('<?php echo $prop['image']; ?>');">
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2 text-center" data-aos="zoom-in" data-aos-duration="1000">
        <div class="glass-hero-card p-5 d-inline-block mx-auto">
            <span class="badge bg-gold text-dark mb-4 px-4 py-2 fw-bold text-uppercase tracking-wider">For Sale</span>
            <h1 class="display-2 fw-bold text-white mb-2" style="font-family: 'Playfair Display', serif;"><?php echo $prop['title']; ?></h1>
            <p class="lead text-white-80 mb-4 fs-4"><i class="fa-solid fa-location-dot me-2 text-gold"></i><?php echo $prop['location']; ?></p>
            <h2 class="text-gold fw-bold display-4"><?php echo $prop['price']; ?></h2>
            
            <div class="d-flex justify-content-center gap-4 mt-5 text-white">
                <div class="stat-bubble">
                    <i class="fa-solid fa-bed fs-4 mb-1"></i>
                    <span class="d-block fw-bold"><?php echo $prop['bhk']; ?></span>
                </div>
                <div class="vert-line"></div>
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
                <!-- Gallery Section (New) -->
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Property Gallery</h3>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="gallery-item h-100">
                                <img src="<?php echo $prop['image']; ?>" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="Main View">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex flex-column gap-3 h-100">
                                <div class="gallery-item h-50">
                                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="Interior">
                                </div>
                                <div class="gallery-item h-50 position-relative">
                                    <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-3 h-100 w-100 object-fit-cover" alt="Detail">
                                    <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                        <span class="fw-bold text-white">+5 Photos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">About the Property</h3>
                    <div class="p-4 bg-light-gold rounded-4 border-gold-light">
                        <p class="text-muted leading-relaxed fs-5 mb-0" style="text-align: justify;"><?php echo $prop['description']; ?></p>
                    </div>
                </div>

                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Premium Amenities</h3>
                    <div class="row g-3">
                        <?php foreach($prop['features'] as $feature): ?>
                        <div class="col-md-4 col-6">
                            <div class="amenity-card-premium text-center p-4">
                                <div class="icon-circle mb-3 mx-auto">
                                    <i class="fa-solid fa-star text-gold"></i>
                                </div>
                                <span class="fw-bold text-dark small text-uppercase"><?php echo $feature; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                 <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep section-heading">Location</h3>
                    <div class="map-frame p-2 bg-white shadow-sm rounded-4">
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                            <iframe src="<?php echo $prop['map_url']; ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="contact-card sticky-top" style="top: 100px;">
                    <div class="contact-header">
                        <h4 class="fw-bold mb-1" style="font-family: 'Playfair Display', serif;">VIP Inquiry</h4>
                        <p class="mb-0 small opacity-75">Direct access to sales team</p>
                    </div>
                    <div class="contact-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingName" placeholder="Name">
                                <label for="floatingName">Your Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                                <label for="floatingEmail">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="floatingPhone" placeholder="Phone">
                                <label for="floatingPhone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingText" style="height: 100px"></textarea>
                                <label for="floatingText">Message</label>
                            </div>
                            <button type="submit" class="btn btn-gold w-100 py-3 fw-bold shadow-lg">
                                <i class="fa-solid fa-paper-plane me-2"></i> Schedule Viewing
                            </button>
                        </form>
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
        height: 90vh; /* Full screen impact */
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

    /* Contact Card */
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
        background: #fff;
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
            min-height: 80vh;
            padding: 100px 0;
        }
        .display-2 {
            font-size: 3rem;
        }
        .glass-hero-card {
            padding: 2rem !important;
            margin: 0 1rem;
        }
        .contact-card.sticky-top {
            position: relative !important;
            top: 0 !important;
            margin-top: 3rem;
            z-index: 1;
        }
    }

    @media (max-width: 768px) {
        .stat-bubble i { font-size: 1.2rem !important; }
        .stat-bubble span { font-size: 0.9rem; }
        .vert-line { height: 25px; }
        
        .gallery-item.h-50 {
            height: 200px !important;
        }
        .col-md-4 .d-flex.flex-column {
            flex-direction: row !important;
        }
    }

    @media (max-width: 576px) {
        .display-2 { font-size: 2.2rem; }
        .display-4 { font-size: 1.8rem; }
        .lead { font-size: 1rem !important; }
        
        /* Stack stats vertically on very small screens */
        .glass-hero-card .d-flex.justify-content-center.gap-4 {
            flex-wrap: wrap;
            gap: 1rem !important;
        }
        .vert-line { display: none; }
        .stat-bubble {
            width: 45%;
            margin-bottom: 10px;
        }
        
        /* Gallery Adjustments due to stacking */
        .col-md-4 .d-flex.flex-column {
            flex-direction: column !important;
        }
    }
</style>

<?php include 'layouts/footer.php'; ?>
