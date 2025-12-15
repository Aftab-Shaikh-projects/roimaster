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

$table = "properties";
$filename = "_property_list";
$offset = ($page - 1) * $pagelimit;
$total_sql = "SELECT * FROM `$table` WHERE 1  $all_filters";
$sql = "$total_sql ORDER BY `id` DESC LIMIT {$offset},{$pagelimit}";
$res = mysqli_query($conn, $sql);
$totalrecord = mysqli_num_rows($res);

// For total count query (without limit) for multiple pages
$totaljobs = mysqli_query($conn, $total_sql);
$totalrecord_all = mysqli_num_rows($totaljobs);

if ($totalrecord_all == 0) {
?>
  <div class="my-4">
    <h4>
      Data Not Found!
    </h4>
  </div>
<?php
  exit;
}

$totalpages = ceil($totalrecord_all / $pagelimit);
$srno = 1 + $offset;
?>
<table class="table table-striped table-hover align-middle shadow-sm rounded-3 overflow-hidden my-4">
  <thead class="table-secondary">
    <tr>
      <th scope="col" style="width: 80px;">#</th>
      <th scope="col">Property Title</th>
      <th scope="col">Price</th>
      <th scope="col">Location</th>
      <th scope="col">Status</th>
      <th scope="col" class="text-center" style="width: 200px;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($res)) {
      $name = $row["title"];
      $prop_id = $row['id'];
    ?>
      <tr>
        <td><strong><?= $srno++ ?></strong></td>
        <td><?= htmlspecialchars($name) ?></td>
        <td>₹ <?= AmountFormat($row['price']) ?></td>
        <td><?= htmlspecialchars($row['location']) ?></td>
        <td>
            <?php if ($row['active'] == 'Y'): ?>
                <span class="badge bg-success">Active</span>
            <?php else: ?>
                <span class="badge bg-danger">Inactive</span>
            <?php endif; ?>
        </td>
        <td class="text-center">
            
          <a href="view_property?id=<?= enc($prop_id) ?>" 
             class="btn btn-sm btn-outline-info me-2" title="Manage Gallery & Details">
             <i class="bx bx-images"></i>
          </a>
            
          <a href="add_property?id=<?= enc($prop_id) ?>" 
             class="btn btn-sm btn-outline-primary me-2">
             <i class="bx bx-edit"></i>
          </a>
          <button type="button" 
                  class="btn btn-sm btn-outline-danger delete_prop_btn" 
                  data-bs-toggle="modal"
                  data-bs-target="#delete_prop_modal" 
                  value="<?= enc($prop_id) ?>">
            <i class="bx bx-trash"></i>
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
