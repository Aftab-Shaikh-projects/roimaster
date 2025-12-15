<?php
include 'layouts/header.php';

if (!isset($_GET['id'])) {
    Config::redirect('property_list.php');
}

$prop_id_e = $_GET['id'];
$prop_id = res(dec($prop_id_e));
$page_title = "Property Details";

$prop_sql = "SELECT * FROM `properties` WHERE `id` = '$prop_id'";
$prop_res = mysqli_query($conn, $prop_sql);
$prop = mysqli_fetch_assoc($prop_res);

if (!$prop) {
    Config::redirect('property_list.php');
}

// Fetch Gallery Images
$gal_sql = "SELECT * FROM `property_gallery` WHERE `property_id` = '$prop_id' ORDER BY id DESC";
$gal_res = mysqli_query($conn, $gal_sql);
?>

<div class="row">
    <!-- Property Info Column -->
    <div class="col-md-4">
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-header bg-primary text-white py-3 rounded-top-4">
                <h5 class="mb-0"><i class="bx bx-info-circle"></i> Property Info</h5>
            </div>
            <div class="card-body p-4">
                <?php 
                $img_src = $prop['image'];
                if (!filter_var($img_src, FILTER_VALIDATE_URL)) {
                    $img_src = "../" . $img_src; 
                }
                ?>
                <img src="<?= $img_src ?>" class="img-fluid rounded-3 mb-3 w-100" style="height: 200px; object-fit: cover;" alt="Main Image">
                <h4 class="fw-bold mb-1"><?= $prop['title'] ?></h4>
                <p class="text-muted mb-3"><i class="bx bx-map"></i> <?= $prop['location'] ?></p>
                
                <hr>
                
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block">Price</small>
                        <span class="fw-bold text-primary">₹ <?= AmountFormat($prop['price']) ?></span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block">Type</small>
                        <span class="fw-bold"><?= $prop['type'] ?></span>
                    </div>
                     <div class="col-6">
                        <small class="text-muted d-block">BHK</small>
                        <span class="fw-bold"><?= $prop['bhk'] ?></span>
                    </div>
                     <div class="col-6">
                        <small class="text-muted d-block">Status</small>
                         <?php if ($prop['active'] == 'Y'): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Inactive</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="add_property.php?id=<?= $prop_id_e ?>" class="btn btn-outline-primary"><i class="bx bx-edit"></i> Edit Details</a>
                    <a href="property_list.php" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Management Column -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 rounded-top-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary"><i class="bx bx-images"></i> Gallery Manager</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="bx bx-upload"></i> Upload Images
                </button>
            </div>
            <div class="card-body p-4">
                <?php if (mysqli_num_rows($gal_res) > 0): ?>
                    <div class="row g-3">
                        <?php while ($img = mysqli_fetch_assoc($gal_res)): 
                            $g_src = $img['image_path'];
                            if (!filter_var($g_src, FILTER_VALIDATE_URL)) {
                                $g_src = "../" . $g_src;
                            }
                        ?>
                            <div class="col-md-4 col-6">
                                <div class="position-relative group-hover-container rounded-3 overflow-hidden shadow-sm border" style="height: 200px;">
                                    <img src="<?= $g_src ?>" class="w-100 h-100 object-fit-cover" alt="Gallery">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <form action="forms/delete_gallery_image.php" method="POST" onsubmit="return confirm('Delete this image?');">
                                            <?= $csrf ?>
                                            <input type="hidden" name="id" value="<?= enc($img['id']) ?>">
                                            <input type="hidden" name="prop_id" value="<?= enc($prop_id) ?>">
                                            <button type="submit" class="btn btn-danger btn-sm rounded-circle p-2" style="width: 32px; height: 32px; line-height: 1;">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <i class="bx bx-image-add fs-1 mb-2"></i>
                        <p>No gallery images uploaded yet.</p>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload Now</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="forms/save_gallery_image.php" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
            <?= $csrf ?>
            <input type="hidden" name="prop_id" value="<?= enc($prop_id) ?>">
            
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bx bx-cloud-upload"></i> Upload Gallery Images</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="gallery_images" class="form-label">Select Images</label>
                    <input class="form-control" type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*" required>
                    <div class="form-text">You can select multiple images (JPG, PNG, WebP).</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
