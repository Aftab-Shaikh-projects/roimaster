<?php
include '../config/vary_con.php';
$pagelimit = 10;
$page = 0;
$all_filters = "";
if (isset($_POST["filters"])) {
  $filters = $_POST["filters"];
  if (isset($filters["limitSetter"])) {
    if (isset($filters["limitSetter"][0])) {
      $pagelimit = RES($filters["limitSetter"][0]);
    }
  }

  if (isset($filters["search"])) {
    foreach ($filters["search"] as $search) {
      if ($search != "" || $search == "0") {
        $search = res($search);
        $all_filters .= "AND (`title` LIKE '$search%' OR `location` LIKE '%$search%')";
      }
    }
  }
}
if (isset($_POST["page"])) {
  $page = RES($_POST["page"]);
} else {
  $page = 1;
}

$filename = "_video_requests"; // For pagination links
$offset = ($page - 1) * $pagelimit;

// 3. Main Query
$base_sql = "SELECT vc.*, p.title as property_title 
             FROM `video_consultations` vc 
             LEFT JOIN `properties` p ON vc.property_id = p.id 
             WHERE 1 $all_filters";

// Fetch Limited Data
$sql = "$base_sql ORDER BY vc.created_at DESC LIMIT $offset, $pagelimit";
$res = mysqli_query($conn, $sql);

// Fetch Total Count (for Pagination)
$total_query = mysqli_query($conn, $base_sql);
$totalrecord_all = mysqli_num_rows($total_query);
$totalpages = ceil($totalrecord_all / $pagelimit);

// 4. No Data Found
if ($totalrecord_all == 0) {
    echo '<div class="my-4 text-center text-muted"><h4><i class="bx bx-data fs-1 d-block mb-2"></i> No Requests Found!</h4></div>';
    exit;
}

$srno = 1 + $offset;
?>

<table class="table table-striped table-hover align-middle shadow-sm rounded-3 overflow-hidden my-4">
  <thead class="table-secondary">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client Details</th>
      <th scope="col">Requested Schedule</th>
      <th scope="col">Property Interest</th>
      <th scope="col">Status</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($res)) {
        $req_date = date('d M Y', strtotime($row['vc_date']));
        $req_time = date('h:i A', strtotime($row['vc_time']));
        $created = date('d M, h:i A', strtotime($row['created_at']));

        // Status Colors
        $status_class = 'bg-warning'; // Pending
        if ($row['status'] == 'Scheduled') $status_class = 'bg-info';
        if ($row['status'] == 'Completed') $status_class = 'bg-success';
        if ($row['status'] == 'Cancelled') $status_class = 'bg-danger';
    ?>
      <tr>
        <td><strong><?= $srno++ ?></strong></td>
        
        <td>
            <div class="d-flex flex-column">
                <strong class="text-dark"><?= htmlspecialchars($row['name']) ?></strong>
                <a href="tel:<?= htmlspecialchars($row['mobile']) ?>" class="small text-muted text-decoration-none">
                    <i class="bx bx-phone"></i> <?= htmlspecialchars($row['mobile']) ?>
                </a>
                <a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="small text-primary text-decoration-none">
                     <?= htmlspecialchars($row['email']) ?>
                </a>
            </div>
        </td>

        <td>
            <span class="d-block fw-bold text-primary"><?= $req_date ?></span>
            <span class="small text-muted">at <?= $req_time ?></span>
        </td>

        <td>
            <div class="d-flex flex-column" style="max-width: 200px;">
                <span class="d-inline-block text-truncate fw-semibold">
                    <?= !empty($row['property_title']) ? htmlspecialchars($row['property_title']) : '<span class="text-danger">Property Deleted</span>' ?>
                </span>
                <small class="text-muted">Req: <?= $created ?></small>
            </div>
        </td>

        <td><span class="badge <?= $status_class ?>"><?= htmlspecialchars($row['status']) ?></span></td>

        <td class="text-center ">
            <button type="button" class="btn btn-sm btn-outline-primary manage" data-bs-toggle="modal" data-bs-target="#vcModal" value="<?= $row['id'] ?>" remark="<?= htmlspecialchars($row['remark']) ?>" status="<?= htmlspecialchars($row['status']) ?>" mobile="<?= htmlspecialchars($row['mobile']) ?>">
                Manage
            </button>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<?php
if ($pagelimit > $totalrecord_all) {
  // If all records fit in one page, still show total entries but exit pagination loop
  // Wait, if pagelimit > totalrecord, we don't need pagination links?
  // The original code exited.
}

if ($totalpages > 0) {
    echo '<nav aria-label="Page navigation example">
    <ul class="pagination">
    <li class="page-item">
      <a onclick="PaginationBtn(this,`' . $filename . '.php`)" value="1" class="page-link" id="first" href="#alltable">First</a>
    </li>
    <li class="page-item">
      <a id="prev" onclick="PaginationBtn(this,`' . $filename . '.php`)" class="page-link" href="#alltable" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
    for ($i = 1; $i <= $totalpages; $i++) {
      if ($i == $page) {
        $cname = "paginactive";
      } else {
        if ($i == $page - 1 || $i == $page + 1 || $i == $page + 2) {
          $cname = "";
        } else {
          $cname = "d-none";
        }
      }
      echo '<li class="page-item"><a onclick="PaginationBtn(this,`' . $filename . '.php`)" class="page-link ' . $cname . '" id="' . $i . '" href="#alltable">' . $i . '</a></li>';
    }
    echo '<li class="page-item">
    <a id="next" onclick="PaginationBtn(this,`' . $filename . '.php`)" class="page-link" href="#alltable" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
    </a>
    </li>
    <li class="page-item">
    <a onclick="PaginationBtn(this,`' . $filename . '.php`)" value="' . $totalpages . '" class="page-link" id="last" href="#alltable">Last</a>
    </li>
    </ul>
    </nav>
    ';
}
?>
<small>
  <?= "Total Entries: " . $totalrecord_all ?>
</small>