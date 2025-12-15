<?php
// Fetch Properties
$prop_sql = "SELECT * FROM `properties` WHERE `active`='Y' ORDER BY `id` DESC";
$prop_res = mysqli_query($conn, $prop_sql);
?>

<div class="row g-5">
    <?php if (mysqli_num_rows($prop_res) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($prop_res)): 
            $img_src = $row['image'];
            // If local path starting with admin/, it works relative to root. 
            // If URL, works.
            $bhk_display = $row['bhk'];
            // Auto-append 'BHK' if not present? User input usually "2 BHK".
        ?>
            <!-- Property Item -->
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
                        <span class="roi-badge-floating">Premium</span>
                        <span class="price-tag-modern"><?= format_price_indian($row['price']) ?></span>
                        <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                        <p class="text-muted mb-4"><i class="fa-solid fa-location-dot me-2"
                                style="color: var(--accent-rich);"></i><?= htmlspecialchars(ucwords($row['sub_location']) . ', ' . ucwords($row['city'])) ?></p>

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
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <h3 class="text-muted">No Properties Found</h3>
            <p>Check back later for new premium listings.</p>
        </div>
    <?php endif; ?>
</div>
