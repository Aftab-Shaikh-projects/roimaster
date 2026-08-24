<?php
// Adjust this path based on your folder structure. 
include '../config/vary_con.php'; 

$pagelimit = 10;
$page = 1;
$all_filters = "";

// --- 1. Filter Logic ---
if (isset($_POST["filters"])) {
    $filters = $_POST["filters"];

    // Set Limit
    if (isset($filters["limitSetter"]) && isset($filters["limitSetter"][0])) {
        $pagelimit = mysqli_real_escape_string($conn, $filters["limitSetter"][0]);
    }

    // Set Search
    if (isset($filters["search"])) {
        foreach ($filters["search"] as $search) {
            if ($search != "" || $search == "0") {
                $search = mysqli_real_escape_string($conn, $search);
                // Search in Name, Email, Phone, OR Subject
                $all_filters .= " AND (name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR subject LIKE '%$search%')";
            }
        }
    }
}

// --- 2. Pagination Setup ---
if (isset($_POST["page"])) {
    $page = mysqli_real_escape_string($conn, $_POST["page"]);
} else {
    $page = 1;
}

$filename = "_contact_messages"; // For pagination JS function
$offset = ($page - 1) * $pagelimit;

$base_sql = "SELECT * FROM `contact_enquiries` WHERE 1 $all_filters";

// Query for Table Data
$sql = "$base_sql ORDER BY created_at DESC LIMIT $offset, $pagelimit";
$res = mysqli_query($conn, $sql);

// Query for Total Count
$total_query = mysqli_query($conn, $base_sql);
$totalrecord_all = mysqli_num_rows($total_query);
$totalpages = ceil($totalrecord_all / $pagelimit);

// --- 4. No Data Handler ---
if ($totalrecord_all == 0) {
    echo '<div class="my-5 text-center text-muted">
            <h4><i class="bx bx-envelope fs-1 d-block mb-3"></i> No Messages Found!</h4>
          </div>';
    exit;
}

$srno = 1 + $offset;
?>

<table class="table table-striped table-hover align-middle shadow-sm rounded-3 overflow-hidden my-4">
    <thead class="table-secondary">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Client Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Subject</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($res)) {
            $date = date('d M Y, h:i A', strtotime($row['created_at']));
        ?>
            <tr>
                <td><strong><?= $srno++ ?></strong></td>
                
                <td><small class="text-muted fw-bold"><?= $date ?></small></td>
                
                <td><strong class="text-dark"><?= htmlspecialchars($row['name']) ?></strong></td>

                <td>
                    <div class="d-flex flex-column">
                        <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="small text-primary text-decoration-none">
                            <?= htmlspecialchars($row['email']) ?>
                        </a>
                        <a href="tel:<?= htmlspecialchars($row['phone']) ?>" class="small text-muted text-decoration-none">
                            <i class="bx bx-phone me-1"></i> <?= htmlspecialchars($row['phone']) ?>
                        </a>
                    </div>
                </td>

                <td>
                    <span class="badge bg-label-primary"><?= htmlspecialchars($row['subject']) ?></span>
                </td>

                <td class="text-center">
                    <button type="button" 
                            class="btn btn-sm btn-outline-primary view-msg" 
                            data-bs-toggle="modal" 
                            data-bs-target="#msgModal"
                            data-name="<?= htmlspecialchars($row['name']) ?>"
                            data-subject="<?= htmlspecialchars($row['subject']) ?>"
                            data-message="<?= htmlspecialchars($row['message']) ?>">
                        <i class="bx bx-show me-1"></i> View Message
                    </button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php if ($totalpages > 0): ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a onclick="PaginationBtn(this,`<?= $filename ?>.php`)" value="1" class="page-link" href="#alltable">First</a>
            </li>
            <li class="page-item">
                <a onclick="PaginationBtn(this,`<?= $filename ?>.php`)" value="<?= max(1, $page - 1) ?>" class="page-link" href="#alltable">&laquo;</a>
            </li>

            <?php for ($i = 1; $i <= $totalpages; $i++): 
                $active = ($i == $page) ? "active" : "";
                if ($i == $page || $i == $page - 1 || $i == $page + 1 || $i == 1 || $i == $totalpages): ?>
                    <li class="page-item <?= $active ?>">
                        <a onclick="PaginationBtn(this,`<?= $filename ?>.php`)" value="<?= $i ?>" class="page-link" href="#alltable"><?= $i ?></a>
                    </li>
                <?php elseif ($i == $page - 2 || $i == $page + 2): ?>
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                <?php endif; 
            endfor; ?>

            <li class="page-item">
                <a onclick="PaginationBtn(this,`<?= $filename ?>.php`)" value="<?= min($totalpages, $page + 1) ?>" class="page-link" href="#alltable">&raquo;</a>
            </li>
            <li class="page-item">
                <a onclick="PaginationBtn(this,`<?= $filename ?>.php`)" value="<?= $totalpages ?>" class="page-link" href="#alltable">Last</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>

<div class="text-end text-muted small">
    Total Entries: <?= $totalrecord_all ?>
</div>