<?php
include 'layouts/header.php';
$form_url = 'forms/add_property.php';
$page_title = "Add Property";
$edit_input = false;

if (isset($_GET["id"])) {
  $prop_id_e = $_GET["id"];
  $prop_id = res(dec($prop_id_e));

  if ($prop_id != "") {
    $prop_sql = "SELECT * FROM `properties` WHERE `id` = '$prop_id'";
    $prop_res = mysqli_query($conn, $prop_sql);

    if ($prop_res) {
      $prop = mysqli_fetch_assoc($prop_res);
      $page_title = "Edit Property";
      $edit_input = true;
    }
  }
}
?>

<section class="py-5">
  <div class="container">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-primary text-white py-3 rounded-top-4">
        <h4 class="mb-0"><i class="bx bx-building-house"></i> <?= $page_title ?></h4>
      </div>

      <div class="card-body p-4">
        <form id="propertyForm" action="<?= $form_url ?>" method="POST" enctype="multipart/form-data" novalidate>
          <?= $csrf ?>
          <?php if ($edit_input): ?>
            <input type="hidden" name="edit_id" value="<?= $prop_id_e ?? "" ?>">
            <input type="hidden" name="old_image" value="<?= $prop['image'] ?>">
          <?php endif; ?>

          <!-- PROPERTY DETAILS -->
          <div class="mb-4">
            <h5 class="fw-bold text-secondary mb-3"><i class="bx bx-home"></i> Property Details</h5>
            <div class="row g-4">
              <div class="col-md-6">
                <label for="title" class="form-label">Property Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg" id="title" name="title"
                  value="<?= isset($prop) ? htmlspecialchars($prop['title']) : '' ?>" required>
              </div>

              <div class="col-md-6">
                <label for="price" class="form-label">Price (Flat Amount) <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-lg" id="price" name="price" min="0"
                  value="<?= isset($prop) ? htmlspecialchars($prop['price']) : '' ?>" placeholder="e.g. 15000000" required>
                <div class="form-text">Enter full amount (e.g. 15000000 for 1.5 Cr). System will format it automatically.</div>
              </div>

              <div class="col-md-6">
                <label for="roi" class="form-label">Target ROI</label>
                <input type="text" class="form-control form-control-lg" id="roi" name="roi"
                  value="<?= isset($prop) ? htmlspecialchars($prop['roi']) : '' ?>" placeholder="e.g. 6%">
              </div>


               <div class="col-md-6">
                <label for="location" class="form-label">City <span class="text-danger">*</span></label>
                <select class="form-select" id="city" name="city" required>
                  <option value="">-- Select City --</option>
                  <?php
                    $city_sql = "SELECT * FROM `city_master` WHERE `active`='Y' ORDER BY `name` ASC";
                    $city_res = mysqli_query($conn, $city_sql);
                    if(mysqli_num_rows($city_res) > 0) {
                        while($row = mysqli_fetch_assoc($city_res)) {
                            $db_city = $row['name']; // Stored as lowercase usually, or whatever is in DB
                            $disp_city = ucwords($row['name']); // Display as Capitalized
                            $selected = (isset($prop) && strtolower($prop['city']) == strtolower($db_city)) ? 'selected' : '';
                            echo "<option value='".$db_city."' $selected>".$disp_city."</option>";
                        }
                    }
                  ?>
                  <option value="Other" <?= isset($prop) && $prop['city'] == 'Other' ? 'selected' : '' ?>>Other (Add New)</option>
                </select>
              </div>

               <div class="col-md-6" id="city_new_div" style="display: none;">
                <label for="city_new" class="form-label">Enter New City <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="city_new" name="city_new" placeholder="e.g. Hyderabad">
              </div>

               <div class="col-md-6">
                <label for="sub_location" class="form-label">Sub Location / Area <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sub_location" name="sub_location"
                  value="<?= isset($prop) ? htmlspecialchars($prop['sub_location']) : '' ?>" placeholder="e.g. Bandra West" required>
              </div>
              
            </div>
          </div>

          <!-- SPECS -->
          <div class="mb-4">
            <h5 class="fw-bold text-secondary mb-3"><i class="bx bx-list-ul"></i> Specifications</h5>
            <div class="row g-4">
              <div class="col-md-3">
                <label for="bhk" class="form-label">BHK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="bhk" name="bhk"
                  value="<?= isset($prop) ? htmlspecialchars($prop['bhk']) : '' ?>" placeholder="e.g. 2 BHK" required>
              </div>

              <div class="col-md-3">
                <label for="area" class="form-label">Area <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="area" name="area"
                  value="<?= isset($prop) ? htmlspecialchars($prop['area']) : '' ?>" placeholder="e.g. 850 Sqft" required>
              </div>

              <div class="col-md-3">
                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                 <select class="form-select" id="type" name="type" required>
                  <option value="">-- Select --</option>
                  <option value="Residential" <?= isset($prop) && $prop['type'] == 'Residential' ? 'selected' : '' ?>>Residential</option>
                  <option value="Commercial" <?= isset($prop) && $prop['type'] == 'Commercial' ? 'selected' : '' ?>>Commercial</option>
                  <option value="Villa" <?= isset($prop) && $prop['type'] == 'Villa' ? 'selected' : '' ?>>Villa</option>
                  <option value="Plot" <?= isset($prop) && $prop['type'] == 'Plot' ? 'selected' : '' ?>>Plot</option>
                </select>
              </div>
              
              <div class="col-md-3" id="comm_type_div" style="display: none;">
                <label for="comm_type" class="form-label">Commercial Type</label>
                 <select class="form-select" id="comm_type" name="comm_type">
                  <option value="">-- Select --</option>
                  <option value="office" <?= isset($prop) && $prop['comm_type'] == 'office' ? 'selected' : '' ?>>Grade A Office Space</option>
                  <option value="shop" <?= isset($prop) && $prop['comm_type'] == 'shop' ? 'selected' : '' ?>>High Street Retail / Shop</option>
                </select>
              </div>
              
              <div class="col-md-3">
                <label for="possession" class="form-label">Possession <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="possession" name="possession"
                  value="<?= isset($prop) ? htmlspecialchars($prop['possession']) : '' ?>" placeholder="e.g. Dec 2024" required>
              </div>
            </div>
          </div>

          <!-- MEDIA & FEATURES -->
          <div class="mb-4">
            <h5 class="fw-bold text-secondary mb-3"><i class="bx bx-image"></i> Media & Features</h5>
            <div class="row g-4">
              <div class="col-md-12">
                <label for="image" class="form-label">Main Image <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                
                <?php if (isset($prop) && !empty($prop['image'])): ?>
                    <div class="mt-2">
                        <small class="text-muted">Current Image:</small>
                        <div class="d-flex align-items-center mt-1">
                            <img src="<?= $prop['image'] ?>" alt="Current" class="rounded shadow-sm" style="width: 100px; height: 60px; object-fit: cover;">
                            <span class="ms-2 text-muted small text-break"><?= $prop['image'] ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-text">Upload a high-quality main image for the property.</div>
                <?php endif; ?>
              </div>

              <div class="col-md-12">
                <label for="map_url" class="form-label">Map Embed URL</label>
                <input type="text" class="form-control" id="map_url" name="map_url"
                  value="<?= isset($prop) ? htmlspecialchars($prop['map_url']) : '' ?>" placeholder="https://www.google.com/maps/embed...">
              </div>

               <div class="col-md-12">
                <label for="features" class="form-label">Features / Amenities</label>
                <div class="form-text mb-2">Enter features separated by commas (e.g. Gym, Pool, Parking)</div>
                <textarea class="form-control" rows="3" id="features" name="features" placeholder="Gym, Swimming Pool, Garden"><?= isset($prop) ? htmlspecialchars($prop['features']) : '' ?></textarea>
              </div>
            </div>
          </div>

          <!-- DESCRIPTION -->
          <div class="mb-4">
            <h5 class="fw-bold text-secondary mb-3"><i class="bx bx-file"></i> Description</h5>
            <textarea class="form-control" rows="8" id="description" name="description" placeholder="Write detailed property description..." required><?= isset($prop) ? htmlspecialchars($prop['description']) : '' ?></textarea>
          </div>

          <!-- SETTINGS -->
          <div class="mb-4">
             <div class="row g-4">
              <div class="col-md-4">
                <label for="active" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="active" name="active" required>
                  <option value="Y" <?= isset($prop) && $prop['active'] == 'Y' ? 'selected' : '' ?>>Active</option>
                  <option value="N" <?= isset($prop) && $prop['active'] == 'N' ? 'selected' : '' ?>>Inactive</option>
                </select>
              </div>
             </div>
          </div>

          <!-- SUBMIT -->
          <div class="text-end">
            <button class="btn btn-lg btn-primary px-4" type="submit">
              <i class="bx bx-save"></i> <?= $page_title ?>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'layouts/footer.php'; ?>

<script>
    // Commercial Type Toggle
    const typeSelect = document.getElementById('type');
    const commTypeDiv = document.getElementById('comm_type_div');
    
    function toggleComm() {
        if(typeSelect.value === 'Commercial') {
            commTypeDiv.style.display = 'block';
        } else {
            commTypeDiv.style.display = 'none';
        }
    }
    
    typeSelect.addEventListener('change', toggleComm);
    toggleComm(); // Run on load
    
    // City "Other" Toggle
    const citySelect = document.getElementById('city');
    const cityNewDiv = document.getElementById('city_new_div');
    const cityNewInput = document.getElementById('city_new'); // Get input to toggle required
    
    function toggleCity() {
        if(citySelect.value === 'Other') {
            cityNewDiv.style.display = 'block';
            cityNewInput.setAttribute('required', 'required');
        } else {
            cityNewDiv.style.display = 'none';
            cityNewInput.removeAttribute('required');
        }
    }
    
    citySelect.addEventListener('change', toggleCity);
    toggleCity(); // Run on load
</script>
