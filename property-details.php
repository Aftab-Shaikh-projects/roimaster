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
<section class="prop-hero" style="background-image: url('<?php echo $prop['image']; ?>');">
    <div class="hero-overlay"></div>
    <div class="container position-relative z-2 h-100 d-flex flex-column justify-content-end pb-5">
        <div data-aos="fade-up">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 fw-bold text-uppercase">For Sale</span>
            <h1 class="display-3 fw-bold text-white"><?php echo $prop['title']; ?></h1>
            <p class="lead text-white-50"><i class="fa-solid fa-location-dot me-2 text-warning"></i><?php echo $prop['location']; ?></p>
            <h2 class="text-warning fw-bold mt-3"><?php echo $prop['price']; ?></h2>
        </div>
    </div>
</section>

<!-- Overview Bar -->
<div class="bg-white shadow-sm py-4 position-relative z-3" style="margin-top: -40px;">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3 border-end">
                <i class="fa-solid fa-bed text-warning fs-4 mb-2"></i>
                <h5 class="fw-bold mb-0"><?php echo $prop['bhk']; ?></h5>
                <small class="text-muted">Configuration</small>
            </div>
            <div class="col-6 col-md-3 border-end">
                <i class="fa-solid fa-ruler-combined text-warning fs-4 mb-2"></i>
                <h5 class="fw-bold mb-0"><?php echo $prop['area']; ?></h5>
                <small class="text-muted">Super Built-up</small>
            </div>
            <div class="col-6 col-md-3 border-end">
                <i class="fa-solid fa-building text-warning fs-4 mb-2"></i>
                <h5 class="fw-bold mb-0"><?php echo $prop['type']; ?></h5>
                <small class="text-muted">Property Type</small>
            </div>
            <div class="col-6 col-md-3">
                <i class="fa-solid fa-calendar-days text-warning fs-4 mb-2"></i>
                <h5 class="fw-bold mb-0"><?php echo $prop['possession']; ?></h5>
                <small class="text-muted">Possession</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="section-padding">
    <div class="container">
        <div class="row g-5">
            <!-- Left Content -->
            <div class="col-lg-8">
                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep">Description</h3>
                    <p class="text-muted leading-relaxed fs-5"><?php echo $prop['description']; ?></p>
                </div>

                <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep">Amenities & Features</h3>
                    <div class="row g-3">
                        <?php foreach($prop['features'] as $feature): ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center bg-light p-3 rounded">
                                <i class="fa-solid fa-check-circle text-warning me-3"></i>
                                <span class="fw-semibold"><?php echo $feature; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                </div>
                
                 <div class="mb-5" data-aos="fade-up">
                    <h3 class="fw-bold mb-4 text-primary-deep">Location Map</h3>
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
                        <iframe src="<?php echo $prop['map_url']; ?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; border-radius: 15px;">
                    <h4 class="fw-bold mb-4">Interested?</h4>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control py-3" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control py-3" placeholder="Email Address">
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control py-3" placeholder="Phone Number">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-search w-100">Request Call Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .prop-hero {
        height: 70vh;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to bottom, rgba(6, 20, 46, 0.3), rgba(6, 20, 46, 0.9));
    }
    .text-primary-deep { color: var(--primary-deep); }
    .text-warning { color: var(--accent-rich) !important; }
    .bg-warning { background-color: var(--accent-rich) !important; color: white !important; }
</style>

<?php include 'layouts/footer.php'; ?>
