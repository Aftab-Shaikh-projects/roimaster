<?php
include 'layouts/header.php';
$page_title = "Video Presentation Requests";
?>

<div class="card shadow-sm border-0 p-3 mb-4 rounded-3 bg-light">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0 fw-bold text-primary">
            <i class="bx bx-video me-2"></i> <?= $page_title ?>
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
            <?php unset($_SESSION['msg']);
            unset($_SESSION['msg_type']); ?>
        <?php endif; ?>


        <div class="row mb-3 g-2 align-items-center">
            <div class="col-md-6 col-8">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white"><i class="bx bx-search"></i></span>
                    <input type="text"
                        onkeyup="pagination(1,'_video_requests.php')"
                        name="search"
                        placeholder="Search requests..."
                        class="form-control filters">
                </div>
            </div>

            <div class="col-md-3 col-4">
                <select name="limitSetter"
                    onchange="pagination(1,'_video_requests.php')"
                    class="form-select filters">
                    <option value="5">5 per page</option>
                    <option value="10" selected>10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>

        <div id="alltable" class="table-responsive">
        </div>
    </div>
</div>
<div class="modal fade text-start" id="vcModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Manage Request</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="forms/update_vc_status.php" method="POST" class="mb-4 p-3 bg-light rounded border">
                    <?= $csrf ?>
                    <input type="hidden" name="id" value="" id="id">
                    <label class="form-label fw-bold">Update Status</label>
                    <div class="input-group">
                        <select name="status" class="form-select" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="small text-muted fw-bold">Client Remark:</label>
                        <div class="p-2 bg-white rounded border" id="remark">

                        </div>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <a href="" class="btn btn-success w-100" id="call"><i class="bx bx-phone"></i> Call Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'layouts/footer.php';
?>


<script>
    $(document).ready(function() {
        // Load initial data
        pagination(1, "_video_requests.php");
    });

    $(document).on("click", ".manage", function() {

        var id = $(this).attr("value");
        var remark = $(this).attr("remark");
        var status = $(this).attr("status");
        var mobile = $(this).attr("mobile");

        var data = {
            id: id,
            remark: remark,
            status: status,
            mobile: mobile
        };
        $('#id').val(data.id);
        $('#status').val(data.status);
        $('#remark').text(data.remark);
        $('#call').attr('href', 'tel:' + data.mobile);
    });
</script>