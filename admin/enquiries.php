<?php
include 'layouts/header.php';
$page_title = "Property Enquiries";
?>

<div class="card shadow-sm border-0 p-3 mb-4 rounded-3 bg-light">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0 fw-bold text-primary">
            <i class="bx bx-envelope me-2"></i> <?= $page_title ?>
        </h2>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-<?= $_SESSION['msg_type']; ?> alert-dismissible fade show mb-4" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['msg']); unset($_SESSION['msg_type']); ?>
        <?php endif; ?>

        <div class="row mb-3 g-2 align-items-center">
            <div class="col-md-6 col-8">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bx bx-search"></i></span>
                    <input type="text"
                        onkeyup="pagination(1,'_property_enquiries.php')"
                        name="search"
                        placeholder="Search name, email or property..."
                        class="form-control filters">
                </div>
            </div>

            <div class="col-md-3 col-4">
                <select name="limitSetter"
                    onchange="pagination(1,'_property_enquiries.php')"
                    class="form-select filters">
                    <option value="5">5 per page</option>
                    <option value="10" selected>10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>

        <div id="alltable" class="table-responsive"></div>
    </div>
</div>

<div class="modal fade" id="msgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="modalTitle">Message Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="small text-muted fw-bold text-uppercase">Client Message</label>
                    <div class="p-3 bg-light rounded border text-dark" id="modalMessage"></div>
                </div>
            </div>
            </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Load initial data on page load
        pagination(1, "_property_enquiries.php");
    });

    // Handle "View Message" Button Click
    $(document).on("click", ".view-msg", function() {
        var name = $(this).attr("data-name");
        var message = $(this).attr("data-message");
        
        // Update Modal Content
        $('#modalTitle').text('Message from ' + name);
        
        // Handle empty messages and newlines
        var displayMsg = message ? message.replace(/\n/g, "<br>") : '<span class="text-muted fst-italic">No message provided.</span>';
        $('#modalMessage').html(displayMsg);
    });
</script>