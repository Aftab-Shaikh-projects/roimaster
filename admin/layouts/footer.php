</div>
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
           
        </div>
        <div>
            
        </div>
    </div>
</footer>
<div class="content-backdrop fade"></div>
</div>
</div>
</div>
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include 'script.php'; ?>

<?php
if (isset($_SESSION["error_mess"])) {
    if (!empty($_SESSION["error_mess"])) {
        $error_mess =  $_SESSION["error_mess"];
?>
        <script>
            showAlert("<?= $error_mess["mess"] ?? "" ?>", "<?= $error_mess["color"] ?? "" ?>", "<?= $error_mess["other"] ?? "" ?>");
        </script>
<?php
    }
}
unset($_SESSION["error_mess"]);
unset($_SESSION["old_data"]);
?>

</body>

</html>