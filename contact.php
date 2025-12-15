<?php include 'layouts/header.php'; ?>

<style>
    /* --- Scoped Variables --- */
    :root {
        --primary-deep: #06142e;
        --accent-rich: #C5A47E;
        --accent-light: #DAC0A3;
        --bg-offwhite: #f4f7f6;
    }

    /* --- Page Hero --- */
    .contact-hero {
        height: 50vh;
        min-height: 350px;
        background: url('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(6, 20, 46, 0.85); /* Dark Navy Overlay */
    }

    /* --- Floating Contact Container --- */
    .contact-wrapper {
        margin-top: -100px; /* Overlap effect */
        position: relative;
        z-index: 10;
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    /* --- Left Side: Info Panel --- */
    .info-panel {
        background: var(--primary-deep);
        color: #fff;
        padding: 60px 40px;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    /* Decorative Circle */
    .info-panel::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border: 20px solid rgba(197, 164, 126, 0.1);
        border-radius: 50%;
    }

    .info-item {
        margin-bottom: 40px;
        display: flex;
        align-items: flex-start;
    }
    .info-icon-box {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-rich);
        font-size: 1.2rem;
        margin-right: 20px;
        flex-shrink: 0;
        transition: 0.3s;
    }
    .info-item:hover .info-icon-box {
        background: var(--accent-rich);
        color: var(--primary-deep);
    }
    .info-label {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9rem;
        color: var(--accent-rich); /* Gold Text */
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
        display: block;
    }
    .info-value {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.9);
        line-height: 1.6;
    }

    /* --- Right Side: Form Panel --- */
    .form-panel {
        padding: 60px 50px;
        background: #fff;
    }
    
    .form-group { margin-bottom: 25px; }
    
    .form-control-custom {
        width: 100%;
        padding: 15px 0;
        border: none;
        border-bottom: 2px solid #eee;
        background: transparent;
        font-size: 1rem;
        transition: 0.3s;
        border-radius: 0;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-bottom-color: var(--accent-rich);
        background: transparent;
    }
    
    .form-label-custom {
        font-size: 0.85rem;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .btn-submit {
        background: var(--primary-deep);
        color: #fff;
        padding: 15px 40px;
        border: none;
        font-weight: 600;
        letter-spacing: 1px;
        margin-top: 10px;
        transition: 0.3s;
        text-transform: uppercase;
    }
    .btn-submit:hover {
        background: var(--accent-rich);
        color: #fff;
        transform: translateY(-2px);
    }

    /* --- Process Section Styles --- */
    .process-step {
        text-align: center;
        padding: 20px;
    }
    .step-number {
        font-size: 4rem;
        font-weight: 800;
        color: rgba(6, 20, 46, 0.05); /* Very subtle number */
        line-height: 1;
        margin-bottom: -30px;
        position: relative;
        z-index: 1;
    }
    .step-content {
        position: relative;
        z-index: 2;
    }
    .step-icon {
        color: var(--accent-rich);
        font-size: 2rem;
        margin-bottom: 15px;
    }

    /* --- FAQ Styles --- */
    .faq-item {
        background: #fff;
        padding: 25px;
        border-left: 3px solid var(--accent-rich);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .faq-item:hover {
        transform: translateX(10px);
    }
    .faq-question {
        font-weight: 700;
        color: var(--primary-deep);
        margin-bottom: 10px;
        font-family: 'Montserrat', sans-serif;
    }

    /* --- Map Section --- */
    .map-container {
        height: 400px;
        width: 100%;
        filter: grayscale(100%); /* Elegant B&W Map */
        transition: 0.5s;
    }
    .map-container:hover {
        filter: grayscale(0%); /* Color on hover */
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .contact-wrapper { margin-top: 0; border-radius: 0; box-shadow: none; }
        .form-panel { padding: 40px 20px; }
        .info-panel { padding: 40px 20px; }
    }
</style>

<section class="contact-hero">
    <div class="container text-center position-relative z-2">
        <h1 class="display-4 fw-bold text-white mb-2" data-aos="fade-up">Start the Conversation</h1>
        <p class="lead text-white-50" data-aos="fade-up" data-aos-delay="100">Schedule a private consultation with our investment experts.</p>
    </div>
</section>

<section class="bg-offwhite pb-5">
    <div class="container">
        <div class="contact-wrapper">
            <div class="row g-0">
                
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="info-panel">
                        <h3 class="fw-bold mb-5 font-heading">Contact Information</h3>
                        
                        <div class="info-item">
                            <div class="info-icon-box"><i class="fa-solid fa-building-columns"></i></div>
                            <div>
                                <span class="info-label">Headquarters (Mumbai)</span>
                                <div class="info-value">
                                    108, 1st Floor, Srishti Plaza, Sakivihar Road, Chandivali, Powai - 400072
                                </div>
                            </div>
                        </div>

                        <!-- <div class="info-item">
                            <div class="info-icon-box"><i class="fa-solid fa-archway"></i></div>
                            <div>
                                <span class="info-label">Regional Office (Lucknow)</span>
                                <div class="info-value">
                                    Gomti Nagar Extension,<br>
                                    Near Ekana Stadium,<br>
                                    Lucknow, Uttar Pradesh
                                </div>
                            </div>
                        </div> -->

                        <div class="info-item">
                            <div class="info-icon-box"><i class="fa-solid fa-phone-volume"></i></div>
                            <div>
                                <span class="info-label">Call Us</span>
                                <div class="info-value">+91 7208565700</div>
                                <small class="text-white-50">Mon-Sun, 10am - 7pm</small>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon-box"><i class="fa-solid fa-envelope-open-text"></i></div>
                            <div>
                                <span class="info-label">Email Us</span>
                                <div class="info-value">roimaster.official@gmail.com</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="form-panel">
                        <h3 class="fw-bold mb-4 font-heading" style="color: var(--primary-deep);">Send a Message</h3>
                        <p class="text-muted mb-5">Interested in a property? Fill out the form below and our relationship manager will contact you shortly.</p>
                        
                        <form action="forms/submit_contact.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label-custom">Your Name</label>
                                    <input type="text" name="name" class="form-control-custom" placeholder="John Doe" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control-custom" placeholder="+91 98765 43210" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="form-label-custom">Email Address</label>
                                    <input type="email" name="email" class="form-control-custom" placeholder="john@example.com" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label-custom">Interested In</label>
                                    <select name="subject" class="form-control-custom text-muted">
                                        <option value="Buying Property">Buying Property</option>
                                        <option value="Selling Property">Selling Property</option>
                                        <option value="Investment Advisory">Investment Advisory</option>
                                        <option value="Lucknow Projects">Lucknow Projects</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-label-custom">Your Message</label>
                                <textarea name="message" class="form-control-custom" rows="4" placeholder="Tell us about your requirements..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit">
                                Send Request <i class="fa-solid fa-arrow-right-long ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="mt-5 pt-5 text-center">
            <h5 class="text-uppercase text-muted letter-spacing-2 mb-2">How We Work</h5>
            <h2 class="fw-bold mb-5" style="color: var(--primary-deep);">The Advisory Process</h2>
            
            <div class="row mt-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="process-step">
                        <div class="step-number">01</div>
                        <div class="step-content">
                            <i class="fa-solid fa-comments step-icon"></i>
                            <h4 class="fw-bold mb-3">Consultation</h4>
                            <p class="text-muted">We begin with a private discussion to understand your financial goals, lifestyle needs, and preferred locations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="process-step">
                        <div class="step-number">02</div>
                        <div class="step-content">
                            <i class="fa-solid fa-magnifying-glass-location step-icon"></i>
                            <h4 class="fw-bold mb-3">Curated Selection</h4>
                            <p class="text-muted">We filter through hundreds of listings to present you with the top 3-5 properties that match your specific ROI criteria.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="process-step">
                        <div class="step-number">03</div>
                        <div class="step-content">
                            <i class="fa-solid fa-file-signature step-icon"></i>
                            <h4 class="fw-bold mb-3">Seamless Closing</h4>
                            <p class="text-muted">From legal due diligence to registration paperwork, our team handles the bureaucracy while you enjoy the asset.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5 pt-5">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <h3 class="fw-bold" style="color: var(--primary-deep);">Frequently<br>Asked Questions</h3>
                        <p class="text-muted">Can't find the answer you're looking for? Reach out to our support team directly.</p>
                        <a href="https://wa.me/917208565700" class="text-decoration-none fw-bold" style="color: var(--accent-rich);">Chat on WhatsApp <i class="fa-brands fa-whatsapp ms-1"></i></a>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="faq-item">
                                    <div class="faq-question">Do you charge for site visits?</div>
                                    <p class="small text-muted mb-0">No, all our initial consultations and curated site visits are complimentary for our registered clients.</p>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="faq-item">
                                    <div class="faq-question">Do you assist with home loans?</div>
                                    <p class="small text-muted mb-0">Yes, we have tie-ups with leading banks like HDFC, SBI, and ICICI to ensure you get the best interest rates.</p>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="faq-item">
                                    <div class="faq-question">Are the properties RERA approved?</div>
                                    <p class="small text-muted mb-0">Absolutely. We have a strict policy of only dealing with RERA-registered and legally clear projects.</p>
                                </div>
                            </div>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="faq-item">
                                    <div class="faq-question">Do you handle NRI investments?</div>
                                    <p class="small text-muted mb-0">Yes, we specialize in NRI portfolios, handling everything from Power of Attorney (POA) guidance to asset management.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section>
    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.811264473411!2d72.88800307602682!3d19.115933982096934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c80e8fb4454d%3A0x8208a6867b87e47c!2sSristhi%20Plaza!5e0!3m2!1sen!2sin!4v1765626356562!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?php include 'layouts/footer.php'; ?>