<?php
include 'layouts/header.php';
$page_title = "Property List";
?>

<!-- Page Title -->
<div class="card shadow-sm border-0 p-3 mb-4 rounded-3 bg-light">
  <div class="d-flex justify-content-between align-items-center">
      <h2 class="mb-0 fw-bold text-primary">
        <i class="bx bx-buildings me-2"></i> <?= $page_title ?>
      </h2>
      <a href="add_property.php" class="btn btn-primary">
          <i class="bx bx-plus"></i> Add Property
      </a>
  </div>
</div>

<!-- Property List Container -->
<div class="card shadow-sm border-0 rounded-3">
  <div class="card-body">

    <!-- Search + Filter -->
    <div class="row mb-3 g-2 align-items-center">
      <div class="col-md-6 col-8">
        <div class="input-group">
          <span class="input-group-text bg-primary text-white"><i class="bx bx-search"></i></span>
          <input type="text" 
                 onkeyup="pagination(1,'_property_list.php')" 
                 name="search" 
                 placeholder="Search properties..."
                 class="form-control filters">
        </div>
      </div>

      <div class="col-md-3 col-4">
        <select name="limitSetter" 
                onchange="pagination(1,'_property_list.php')" 
                class="form-select filters">
          <option value="5">5 per page</option>
          <option value="10" selected>10 per page</option>
          <option value="25">25 per page</option>
          <option value="50">50 per page</option>
          <option value="100">100 per page</option>
        </select>
      </div>
    </div>

    <!-- Dynamic Table -->
    <div id="alltable" class="table-responsive">
      <!-- Data loads here -->
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="delete_prop_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="delete_prop_modalLabel" aria-hidden="true">
  <form action="forms/add_property.php" method="POST" class="modal-dialog modal-dialog-centered">
    <?= $csrf ?>
    <div class="modal-content shadow-lg border-0 rounded-3">
      
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="delete_prop_modalLabel">
          <i class="bx bx-error me-2"></i> Confirm Delete
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <input type="hidden" name="delete_id" id="prop_id_input">
        <p class="fs-5 mb-0">Are you sure you want to delete this property?</p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
          <i class="bx bx-x"></i> No
        </button>
        <button type="submit" class="btn btn-danger px-4">
          <i class="bx bx-check"></i> Yes
        </button>
      </div>
    </div>
  </form>
</div>

<?php
include 'layouts/footer.php';
?>

<!-- Scripts -->
<script>
$(document).ready(function() {
  pagination(1, "_property_list.php");
});

$(document).on("click", ".delete_prop_btn", function() {
  let btn = $(this);
  let val = btn.attr("value");
  $("#prop_id_input").val(val);
});
</script>
