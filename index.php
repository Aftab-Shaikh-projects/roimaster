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
            <p class="hero-subtitle gs-reveal">Making Your Real Estate Investments Easy!.</p>
        </div>

        <div class="filter-container gs-reveal">
            <form action="properties.php" method="GET">
                <div class="row g-4">

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Location</label>
                        <select class="form-select" name="city">
                            <option value="">All Cities</option>
                            <?php
                            // Fetch Cities dynamically if valid connection exists
                            if(isset($conn)) {
                                $c_sql = "SELECT * FROM `city_master` WHERE `active`='Y' ORDER BY `name` ASC";
                                $c_res = mysqli_query($conn, $c_sql);
                                while($row = mysqli_fetch_assoc($c_res)) {
                                    echo '<option value="'.$row['name'].'">'.ucwords($row['name']).'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fa-regular fa-map me-2"></i>Sub Location</label>
                        <input type="text" class="form-control" name="sub_location" placeholder="e.g. Bandra West">
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
                            <option value="villa">Villa</option>
                            <option value="commercial">Commercial</option>
                            <option value="plot">Plots</option>
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

        <?php include 'components/property_grid.php'; ?>
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
<?php include 'components/ourimpact.php'; ?>

<!-- TESTIMONIALS SECTION -->
<style>
    /* --- Premium Dark Testimonial Styles --- */
    .testimonial-section {
        position: relative;
        overflow: hidden;
        padding-bottom: 100px !important;
        padding-top: 100px !important;
        background-color: var(--primary-deep); /* Dark Navy Background */
        color: #fff;
    }

    /* Background Pattern Overlay */
    .testimonial-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.5;
        pointer-events: none;
    }

    .testimonial-wrapper {
        display: flex;
        width: 100%;
        overflow: hidden;
        padding: 40px 0;
    }

    .testimonial-track {
        display: flex;
        gap: 40px; /* Increased gap for elegance */
        width: max-content;
        padding: 0 20px;
    }

    .testimonial-card {
        width: 450px; /* Slightly wider cards */
        background: linear-gradient(145deg, #0b2247, #06142e); /* Deep gradient */
        border: 1px solid rgba(197, 164, 126, 0.2); /* Subtle Gold Border */
        border-radius: 15px; /* Softer radius */
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        transition: transform 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
        flex-shrink: 0;
        position: relative;
    }

    /* Hover Effect */
    .testimonial-card:hover {
        transform: translateY(-10px);
        border-color: var(--accent-rich); /* Bright Gold on Hover */
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), 0 0 20px rgba(197, 164, 126, 0.1); /* Glow */
    }

    /* Large decorative quote mark */
    .testimonial-card::after {
        content: '\201C'; /* Unicode Left Double Quote */
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 8rem;
        font-family: 'Times New Roman', serif;
        color: var(--accent-rich);
        opacity: 0.05;
        line-height: 1;
        pointer-events: none;
    }

    .client-profile {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05); /* Divider */
        padding-bottom: 20px;
    }

    .client-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 20px;
        border: 2px solid var(--accent-rich);
        padding: 3px; /* Gap between border and image */
        background: transparent;
    }

    .client-info h5 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: #fff;
        margin: 0 0 5px 0;
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }

    .client-info span {
        font-size: 0.85rem;
        color: var(--accent-rich); /* Gold Text */
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .testimonial-text {
        font-family: 'Poppins', sans-serif; /* Clean sans-serif feels more modern premium */
        font-size: 1.05rem;
        color: #d1d1d1; /* Soft white/grey */
        font-weight: 300;
        line-height: 1.8;
        margin-bottom: 25px;
        flex-grow: 1;
        position: relative;
        z-index: 1;
    }

    .rating {
        color: var(--accent-rich); /* Gold Stars */
        font-size: 0.9rem;
        display: flex;
        gap: 5px;
    }
    
    /* Section Header Overrides for Dark Mode */
    .testimonial-section .section-title {
        color: #fff;
    }
    
    .testimonial-section .section-title::after {
        background: var(--accent-rich);
    }
    
    .testimonial-section .section-subtitle {
        color: var(--accent-light);
        opacity: 0.8;
    }

    /* Gradient Masks */
    .testimonial-section .mask-left,
    .testimonial-section .mask-right {
        position: absolute;
        top: 0;
        width: 200px;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }
    
    .testimonial-section .mask-left {
        left: 0;
        background: linear-gradient(to right, var(--primary-deep), transparent);
    }
    
    .testimonial-section .mask-right {
        right: 0;
        background: linear-gradient(to left, var(--primary-deep), transparent);
    }
</style>

<section class="testimonial-section">
    <!-- Gradient Masks -->
    <div class="mask-left"></div>
    <div class="mask-right"></div>

    <div class="container container-full-width"> 
        <div class="section-header text-center" data-aos="fade-up">
            <h2 class="section-title">Trusted by the Elite</h2>
            <p class="section-subtitle mx-auto">Join a community of sophisticated investors creating generational wealth.</p>
        </div>
    </div>

    <!-- Mark the wrapper for the slider -->
    <div class="testimonial-wrapper">
        <div class="testimonial-track">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div class="client-profile">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="client-img">
                    <div class="client-info">
                        <h5>Rajesh Mehta</h5>
                        <span>Real Estate Magnate</span>
                    </div>
                </div>
                <p class="testimonial-text">"THEROIMaster isn't just a platform; it's a strategic partner. Their insights into commercial real estate helped me optimize my portfolio for maximum yield. Exceptional service."</p>
                <div class="rating">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div class="client-profile">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="client-img">
                    <div class="client-info">
                        <h5>Sneha Kapoor</h5>
                        <span>Investment Banker</span>
                    </div>
                </div>
                <p class="testimonial-text">"I value time and transparency above all. THEROIMaster delivers both. The pre-leased assets they presented were fully vetted, making my decision-making process effortless."</p>
                <div class="rating">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>

             <!-- Testimonial 3 -->
             <div class="testimonial-card">
                <div class="client-profile">
                    <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Client" class="client-img">
                    <div class="client-info">
                        <h5>Ankit Sharma</h5>
                        <span>Tech Entrepreneur</span>
                    </div>
                </div>
                <p class="testimonial-text">"Diversifying into real estate was a goal, but I lacked the expertise. THEROIMaster's advisory team bridged that gap perfectly. I'm now seeing consistent 8% rental yields."</p>
                <div class="rating">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="testimonial-card">
                <div class="client-profile">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="client-img">
                    <div class="client-info">
                        <h5>Dr. Priya Reddy</h5>
                        <span>Chief Surgeon</span>
                    </div>
                </div>
                <p class="testimonial-text">"A truly 'Private Banking' experience for real estate. The team understands the requirements of HNI clients—confidentiality, quality, and speed."</p>
                <div class="rating">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>
            
             <!-- Testimonial 5 -->
             <div class="testimonial-card">
                <div class="client-profile">
                    <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Client" class="client-img">
                    <div class="client-info">
                        <h5>Vikram Singh</h5>
                        <span>Senior Architect</span>
                    </div>
                </div>
                <p class="testimonial-text">"The curation is impeccable. As an architect, I am critical of construction quality, but THEROIMaster's listed properties consistently meet the highest standards."</p>
                <div class="rating">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Register GSAP Plugin if needed (not needed for basic tweens, but good practice if using ScrollTrigger etc later)
        // gsap.registerPlugin(ScrollTrigger); 

        const track = document.querySelector(".testimonial-track");
        const cards = document.querySelectorAll(".testimonial-card");
        
        // Clone cards for seamless loop
        cards.forEach(card => {
            let clone = card.cloneNode(true);
            track.appendChild(clone);
        });

        // Calculate total width
        // A simple way is to animate xPercent
        
        gsap.to(track, {
            xPercent: -50, // Move 50% because we doubled the content
            ease: "none",
            duration: 40, // Adjust speed
            repeat: -1
        });
        
        // Pause on hover
        const wrapper = document.querySelector(".testimonial-wrapper");
        wrapper.addEventListener("mouseenter", () => gsap.globalTimeline.timeScale(0));
        wrapper.addEventListener("mouseleave", () => gsap.globalTimeline.timeScale(1));
    });
</script>

<?php include 'layouts/footer.php'; ?>