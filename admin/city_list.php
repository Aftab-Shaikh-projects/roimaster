<?php
include 'layouts/header.php';
$page_title = "Manage Cities";
?>

<!-- Page Title -->
<div class="card shadow-sm border-0 p-3 mb-4 rounded-3 bg-light">
  <div class="d-flex justify-content-between align-items-center">
      <h2 class="mb-0 fw-bold text-primary">
        <i class="bx bx-buildings me-2"></i> <?= $page_title ?>
      </h2>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_city_modal">
          <i class="bx bx-plus"></i> Add City
      </button>
  </div>
</div>

<!-- City List Table -->
<div class="card shadow-sm border-0 rounded-3">
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>City Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `city_master` ORDER BY `name` ASC";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $status_badge = ($row['active'] == 'Y') 
                            ? '<span class="badge bg-success">Active</span>' 
                            : '<span class="badge bg-danger">Inactive</span>';
                        ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= $status_badge ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger delete_city_btn" value="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#delete_city_modal">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No cities found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  </div>
</div>

<!-- Add City Modal -->
<div class="modal fade" id="add_city_modal" tabindex="-1" aria-hidden="true">
  <form action="forms/city_ops.php" method="POST" class="modal-dialog modal-dialog-centered">
    <?= $csrf ?>
    <input type="hidden" name="action" value="add">
    <div class="modal-content shadow-lg border-0 rounded-3">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bx bx-plus-circle me-2"></i> Add New City</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">City Name</label>
            <input type="text" name="name" class="form-control" required placeholder="e.g. Bangalore">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save City</button>
      </div>
    </div>
  </form>
</div>

<!-- Delete City Modal -->
<div class="modal fade" id="delete_city_modal" tabindex="-1" aria-hidden="true">
  <form action="forms/city_ops.php" method="POST" class="modal-dialog modal-dialog-centered">
    <?= $csrf ?>
     <input type="hidden" name="action" value="delete">
    <div class="modal-content shadow-lg border-0 rounded-3">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title"><i class="bx bx-trash me-2"></i> Delete City</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="delete_id" id="city_id_input">
        <p class="fs-5 mb-0">Are you sure? This might affect properties linked to this city.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
      </div>
    </div>
  </form>
</div>

<?php include 'layouts/footer.php'; ?>

<script>
$(document).on("click", ".delete_city_btn", function() {
  let btn = $(this);
  let val = btn.attr("value");
  $("#city_id_input").val(val);
});
</script>
