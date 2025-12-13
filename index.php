<?php include 'layouts/header.php'; ?>
<header class="hero-section">

    <!-- Background Slideshow -->
    <div class="hero-slideshow">
        <!-- Image 1: Modern Skyline -->
        <div class="slide active"
            style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop');">
        </div>
        <!-- Image 2: Structural Glass -->
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1449824913929-4bdd42b00adf?q=80&w=2070&auto=format&fit=crop');">
        </div>
        <!-- Image 3: Abstract Building Detail -->
        <div class="slide"
            style="background-image: url('https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?q=80&w=2076&auto=format&fit=crop');">
        </div>
    </div>

    <div id="canvas-container"></div> <!-- 3D Canvas -->
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="text-center" data-aos="zoom-out-up">
            <h1 class="hero-title gs-reveal">Curating Wealth Through<br>Real Estate</h1>
            <p class="hero-subtitle gs-reveal">Exclusive properties vetted for exceptional Return on Investment.</p>
        </div>

        <div class="filter-container gs-reveal">
            <form action="#" method="GET">
                <div class="row g-4">

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Location</label>
                        <select class="form-select" name="location">
                            <option selected disabled>Select City</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="pune">Pune</option>
                            <option value="delhi">Delhi</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-regular fa-map me-2"></i>Sub Location</label>
                        <select class="form-select" name="sub_location">
                            <option selected disabled>Area</option>
                            <option value="bandra">Bandra West</option>
                            <option value="andheri">Andheri East</option>
                            <option value="vashi">Vashi</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-solid fa-indian-rupee-sign me-2"></i>Budget</label>
                        <select class="form-select" name="budget">
                            <option selected disabled>Max Price</option>
                            <option value="50l">Up to 50 Lacs</option>
                            <option value="1cr">Up to 1 Cr</option>
                            <option value="5cr">Up to 5 Cr</option>
                            <option value="10cr+">10 Cr+</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-solid fa-chart-pie me-2"></i>Target ROI</label>
                        <input type="text" class="form-control" name="roi" placeholder="e.g. Min 6%">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-solid fa-building me-2"></i>Asset Type</label>
                        <select class="form-select" id="propertyType" name="type" onchange="toggleConfig()">
                            <option value="residential" selected>Residential</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" id="configLabel"><i
                                class="fa-solid fa-layer-group me-2"></i>Configuration</label>

                        <div id="residentialOptions">
                            <select class="form-select" name="bhk_config">
                                <option selected disabled>Select BHK</option>
                                <option value="1">1 BHK Luxury</option>
                                <option value="2">2 BHK Grande</option>
                                <option value="3">3 BHK Premium</option>
                                <option value="4">4 BHK Penthouse</option>
                                <option value="5">5 BHK Villa</option>
                            </select>
                        </div>

                        <div id="commercialOptions" style="display: none;">
                            <select class="form-select" name="comm_config">
                                <option selected disabled>Select Type</option>
                                <option value="office">Grade A Office Space</option>
                                <option value="shop">High Street Retail / Shop</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-search">
                            Find Properties <i class="fa-solid fa-arrow-right-long ms-2"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <!-- Removed Scroll Button -->
    </div>
</header>

<section class="section-padding bg-offwhite">
    <div class="bg-abstract"></div>
    <div class="shape-blob shape-1"></div>
    <div class="shape-blob shape-2"></div>
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Exclusive Opportunities</h2>
            <p class="section-subtitle">Handpicked assets offering the perfect blend of luxury and high-yield
                potential.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="property-card-modern">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=1920&auto=format&fit=crop"
                            class="card-img-top" alt="Luxury Home">
                        <div class="card-overlay-info">
                            <span><i class="fa-solid fa-expand me-2"></i>View Details</span>
                        </div>
                    </div>
                    <div class="card-body-modern">
                        <span class="roi-badge-floating">Expected ROI: 7.5%</span>
                        <span class="price-tag-modern">₹ 4.5 Cr</span>
                        <h5 class="card-title">The Azure Residence</h5>
                        <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                style="color: var(--accent-rich);"></i>Worli Seaface, Mumbai</p>

                        <div class="prop-features-modern">
                            <span><i class="fa-solid fa-bed me-2"></i> 3 BHK Sea View</span>
                            <span><i class="fa-solid fa-ruler-combined me-2"></i> 1850 Sqft</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="property-card-modern">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=1920&auto=format&fit=crop"
                            class="card-img-top" alt="Commercial Tower">
                        <div class="card-overlay-info">
                            <span><i class="fa-solid fa-expand me-2"></i>View Details</span>
                        </div>
                    </div>
                    <div class="card-body-modern">
                        <span class="roi-badge-floating">Expected ROI: 9.2%</span>
                        <span class="price-tag-modern">₹ 2.8 Cr</span>
                        <h5 class="card-title">Orbital Tech Park</h5>
                        <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                style="color: var(--accent-rich);"></i>Kharadi, Pune</p>

                        <div class="prop-features-modern">
                            <span><i class="fa-solid fa-briefcase me-2"></i> Grade A Office</span>
                            <span><i class="fa-solid fa-ruler-combined me-2"></i> 1200 Sqft</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mx-auto" data-aos="fade-up" data-aos-delay="300">
                <div class="property-card-modern">
                    <div class="card-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1920&auto=format&fit=crop"
                            class="card-img-top" alt="Luxury Villa">
                        <div class="card-overlay-info">
                            <span><i class="fa-solid fa-expand me-2"></i>View Details</span>
                        </div>
                    </div>
                    <div class="card-body-modern">
                        <span class="roi-badge-floating">Expected ROI: 6.8%</span>
                        <span class="price-tag-modern">₹ 6.2 Cr</span>
                        <h5 class="card-title">Elysium Golf Villas</h5>
                        <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                style="color: var(--accent-rich);"></i>Gurgaon, Delhi NCR</p>

                        <div class="prop-features-modern">
                            <span><i class="fa-solid fa-house-chimney me-2"></i> 5 BHK Villa</span>
                            <span><i class="fa-solid fa-ruler-combined me-2"></i> 4500 Sqft</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">The ROIMaster Advantage</h2>
            <p class="section-subtitle mx-auto">We move beyond standard listings. We analyze, verify, and present
                only financially sound investments.</p>
        </div>

        <div class="about-grid mt-5">
            <div class="feature-box" data-aos="fade-up" data-aos-delay="100">
                <i class="fa-solid fa-magnifying-glass-chart feature-icon"></i>
                <h4>Data-Driven Analysis</h4>
                <p class="text-muted">Our proprietary algorithms assess market trends, future infrastructure, and
                    rental yields to predict ROI accurately.</p>
            </div>
            <div class="feature-box" data-aos="fade-up" data-aos-delay="200">
                <i class="fa-solid fa-shield-halved feature-icon"></i>
                <h4>100% Legal Vetting</h4>
                <p class="text-muted">Zero tolerance for ambiguity. Every property undergoes rigorous legal due
                    diligence before reaching you.</p>
            </div>
            <div class="feature-box" data-aos="fade-up" data-aos-delay="300">
                <i class="fa-solid fa-gem feature-icon"></i>
                <h4>Private Wealth Service</h4>
                <p class="text-muted">Experience concierge-level service with dedicated relationship managers for
                    our HNI clients.</p>
            </div>
        </div>
    </div>
</section>
<?php include 'layouts/footer.php'; ?>