<footer>
    <div class="container position-relative z-2">
        <div class="row g-5">
            <div class="col-lg-5 mb-4" data-aos="fade-right">
                <h4 class="mb-4 font-weight-bold">ROI<span>MASTER</span></h4>
                <p class="text-white-50 lead">Redefining real estate investment through intelligence, integrity, and
                    exclusive access to premium assets.</p>
                <div class="mt-4">
                    <a href="https://www.facebook.com/share/1CwM5K8fSf/" class="text-white me-3" target="_blank"><i class="fa-brands fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/roi_master_/?hl=en" class="text-white" target="_blank"><i class="fa-brands fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h5 class="mb-4 text-white">Navigation</h5>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="index.php">Home</a></li>
                    <li class="mb-2"><a href="about.php">About Us</a></li>
                    <li class="mb-2"><a href="properties.php">Properties</a></li>
                    <li class="mb-2"><a href="contact.php">Contact</a></li>

                </ul>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-left" data-aos-delay="200">
                <h5 class="mb-4 text-white">Concierge Desk</h5>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone-volume"></i>
                    <div>
                        <span class="d-block text-white">+91 7208565700</span>
                        <small>Mon - Sun, 10am - 7pm</small>
                    </div>
                </div>
                <div class="footer-contact-item mt-3">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <div>
                        <span class="d-block text-white">roimaster.official@gmail.com</span>
                        <small>For HNIs & Institutional Investors</small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-secondary mt-5 opacity-25">
        <div class="row align-items-center text-white-50">
            <div class="col-md-6">
                <small>&copy; 2025 ROIMaster. All rights reserved.</small>
            </div>
            <div class="col-md-6 text-md-end">
            <div class="footer-credit">Design and Developed By <span style="color: #247bb5;">Nexg</span><span
            style="color: #fff;">enn</span> <span style="color: red;">Technologies</span></div>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/lib/bootstrap.bundle.min.js"></script>

<script src="assets/js/lib/aos.js"></script>
<script src="assets/js/lib/gsap.min.js"></script>
<script src="assets/js/lib/ScrollTrigger.min.js"></script>
<script src="assets/js/lib/fancybox.umd.js"></script>

<script>
    // Fancybox Configuration
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
        thumbs : {
            autoStart : true
        },
        toolbar: "auto",
        closeButton: "top",
    });
</script>

<script>
    // Initialize Animate On Scroll Library
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Preloader & Reveal Animation
    window.addEventListener("load", () => {
        const tl = gsap.timeline();
        tl.to(".loader-logo", {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power3.out"
            })
            .to(".loader-line", {
                width: "150px",
                duration: 0.8,
                ease: "power2.inOut"
            })
            .to("#preloader", {
                y: "-100%",
                duration: 1,
                delay: 0.5,
                ease: "expo.inOut"
            })
            .from(".gs-reveal", {
                y: 50,
                opacity: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power3.out"
            }, "-=0.5");
    });

    // --- THREE.JS PARTICLE ANIMATION (Standard Effect) ---
    function initCity3D() { // Keeping name to avoid breaking calls
        const container = document.getElementById('canvas-container');
        const scene = new THREE.Scene();

        const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 100);
        camera.position.z = 20;

        const renderer = new THREE.WebGLRenderer({
            alpha: true,
            antialias: true
        });
        renderer.setSize(container.clientWidth, container.clientHeight);
        container.appendChild(renderer.domElement);

        // Particles Geometry
        const particlesGeometry = new THREE.BufferGeometry();

        // OPTIMIZATION: Reduce particles on mobile for performance
        const isMobile = window.innerWidth < 768;
        const particlesCount = isMobile ? 100 : 300;

        const posArray = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i++) {
            // Spread them out cleanly
            posArray[i] = (Math.random() - 0.5) * 40;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

        // Material: Clean Golden Dots
        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.1,
            color: 0xC5A47E, // Brand Accent Gold
            transparent: true,
            opacity: 0.8,
            sizeAttenuation: true
        });

        // Mesh
        const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particlesMesh);

        // Mouse Interaction (Subtle)
        let mouseX = 0;
        let mouseY = 0;

        // Animation Loop
        function animate() {
            requestAnimationFrame(animate);

            // Slow, elegant rotation
            particlesMesh.rotation.y += 0.0005;
            particlesMesh.rotation.x += 0.0002;

            renderer.render(scene, camera);
        }
        animate();

        // Resize Handler
        window.addEventListener('resize', () => {
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        });
    }

    // --- HERO SLIDESHOW SCRIPT ---
    const slides = document.querySelectorAll('.slide');
    let currentSlide = 0;

    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Change slide every 6 seconds
    setInterval(nextSlide, 6000);

    // Init 3D scene after load to ensure container exists
    window.addEventListener('DOMContentLoaded', initCity3D);

    // Navbar color change on scroll

    // Navbar color change on scroll
    window.addEventListener('scroll', function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;

        // Navbar
        if (winScroll > 50) {
            document.querySelector('.navbar').classList.add('scrolled');
        } else {
            document.querySelector('.navbar').classList.remove('scrolled');
        }

        // Elevator Script (Sync only if NOT dragging)
        if (!isDraggingElevator) {
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            let elevator = document.getElementById('elevatorCabin');
            if (elevator) {
                elevator.style.top = scrolled + "%";
            }
        }

        // Parallax Script
        let parallax = document.getElementById('parallaxBg');
        if (parallax) {
            // Move gently
            parallax.style.transform = `translateY(-${winScroll * 0.2}px)`;
        }
    });

    // --- INTERACTIVE ELEVATOR SCRIPT ---
    let isDraggingElevator = false;
    const elevatorCabin = document.getElementById('elevatorCabin');
    const elevatorContainer = document.querySelector('.elevator-container');

    // Drag Start
    elevatorCabin.addEventListener('mousedown', (e) => {
        isDraggingElevator = true;
        elevatorCabin.style.transition = 'none'; // Disable transition for instant follow
        document.body.style.userSelect = 'none'; // Creating selection issues
        e.stopPropagation(); // Prevent click on container
    });

    // Dragging
    window.addEventListener('mousemove', (e) => {
        if (!isDraggingElevator) return;

        e.preventDefault();
        const containerRect = elevatorContainer.getBoundingClientRect();
        const containerHeight = containerRect.height;
        const relativeY = e.clientY - containerRect.top;

        // Calculate percentage (clamped 0-100)
        let percentage = (relativeY / containerHeight) * 100;
        percentage = Math.max(0, Math.min(100, percentage));

        // Move Cabin visual
        elevatorCabin.style.top = percentage + "%";

        // Move Page Scroll
        const totalPageHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollToY = (percentage / 100) * totalPageHeight;

        window.scrollTo(0, scrollToY);
    });

    // Drag End
    window.addEventListener('mouseup', () => {
        if (isDraggingElevator) {
            isDraggingElevator = false;
            elevatorCabin.style.transition = 'top 0.1s linear';
            document.body.style.userSelect = '';
        }
    });

    // Click on Track to Jump
    elevatorContainer.addEventListener('click', (e) => {
        const containerRect = elevatorContainer.getBoundingClientRect();
        const containerHeight = containerRect.height;
        const relativeY = e.clientY - containerRect.top;

        let percentage = (relativeY / containerHeight) * 100;
        percentage = Math.max(0, Math.min(100, percentage));

        const totalPageHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollToY = (percentage / 100) * totalPageHeight;

        window.scrollTo({
            top: scrollToY,
            behavior: 'smooth'
        });
    });

    // --- TILE REVEAL ANIMATION ---
    // Generate Tiles
    const tileContainer = document.getElementById('tile-container');
    const rows = 10;
    const cols = 10;

    for (let i = 0; i < rows * cols; i++) {
        let tile = document.createElement('div');
        tile.classList.add('tile');
        tileContainer.appendChild(tile);
    }


    // Animate Tiles on Scroll (Grid Stagger Effect)
    gsap.registerPlugin(ScrollTrigger);

    gsap.to(".tile", {
        opacity: 0.1, // Increased visibility
        scale: 1,
        stagger: {
            amount: 1.5,
            grid: [rows, cols],
            from: "random"
        },
        scrollTrigger: {
            trigger: "body",
            start: "top top",
            end: "bottom bottom",
            scrub: 1
        }
    });

    // Filter Logic Script
    function toggleConfig() {
        var typeSelect = document.getElementById("propertyType");
        var selectedValue = typeSelect.value;

        var resOptions = document.getElementById("residentialOptions");
        var commOptions = document.getElementById("commercialOptions");

        if (selectedValue === "residential" || selectedValue === "villa") {
            resOptions.style.display = "block";
            commOptions.style.display = "none";
        } else if (selectedValue === "commercial") {
            resOptions.style.display = "none";
            commOptions.style.display = "block";
        } else {
            // Plots or others
            resOptions.style.display = "none";
            commOptions.style.display = "none";
        }
    }
</script>

<!-- WhatsApp Button -->
<a href="https://wa.me/917208565700" class="whatsapp-float" target="_blank">
    <i class="fa-brands fa-whatsapp"></i>
</a>

<!-- Global SweetAlert2 Handler -->
<?php
if(isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $icon = $alert['type']; // success, error, warning, info
    $title = $alert['title'];
    $text = $alert['message'];
    
    // Custom Gold/Premium Styling for SweetAlert
    echo "<script>
    Swal.fire({
        icon: '$icon',
        title: '$title',
        text: '$text',
        confirmButtonColor: '#C5A47E', // Gold Primary
        background: '#fff',
        color: '#06142E',
        iconColor: '$icon' == 'success' ? '#C5A47E' : '',
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        customClass: {
            popup: 'rounded-4 shadow-lg',
            confirmButton: 'px-4 py-2 rounded-3 fw-bold'
        }
    });
    </script>";
    
    // Clear Alert
    unset($_SESSION['alert']);
}
?>
</body>

</html>