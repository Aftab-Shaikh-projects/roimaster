<?php include 'layouts/header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header pb-0">Property Enquiries</h5>
            <div class="card-body mt-3">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Property</th>
                                <th>Client Name</th>
                                <th>Contact</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            $sql = "SELECT e.*, p.title as property_title 
                                    FROM `property_enquiries` e
                                    JOIN `properties` p ON e.property_id = p.id
                                    ORDER BY e.created_at DESC";
                            $res = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($res) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></td>
                                        <td><strong><?= htmlspecialchars($row['property_title']) ?></strong></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td>
                                            <a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a><br>
                                            <a href="tel:<?= htmlspecialchars($row['phone']) ?>"><?= htmlspecialchars($row['phone']) ?></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#msgModal<?= $row['id'] ?>">
                                                View Message
                                            </button>

                                            <!-- Message Modal -->
                                            <div class="modal fade" id="msgModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Message from <?= htmlspecialchars($row['name']) ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="mb-0"><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>No enquiries found yet.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
