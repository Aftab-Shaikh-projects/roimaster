<?php
include 'config/db.php';
$config = new Config;
$conn = $config->db();
$csrf = Config::csrf();
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

</html>

<?php
include 'layouts/head.php';
?>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                LOGO
              </a>
            </div>
            <!-- /Logo -->


            <form id="formAuthentication" class="mb-3" action="forms/login_verify.php" method="POST">
              <?= $csrf ?>
              <div class="mb-3">
                <label for="email" class="form-label">Email or Mobile</label>
                <input type="text" class="form-control" id="email" name="user" placeholder="Enter your email or username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <!-- <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="auth-forgot-password-basic.html">
                    <small>Forgot Password?</small>
                  </a>
                </div> -->
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" aria-describedby="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <!-- <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div> -->
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

            <!-- <p class="text-center">
              <span>New on our platform?</span>
              <a href="auth-register-basic.html">
                <span>Create an account</span>
              </a>
            </p> -->
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <?php
  include 'layouts/script.php';
  ?>

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
  ?>
</body>

</html>