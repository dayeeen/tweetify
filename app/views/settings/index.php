<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
$twitter = new Setting();
$profile = $twitter->displayProfile($_SESSION["id"]);
$twitter->editProfile();
?>

  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <!-- back icon -->
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
      </a>
    </div>
  </nav>
  <div class="d-flex align-items-start">
    <div class="sidebar nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
        type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Profile</button>
      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
        type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Privacy & Safety</button>
      <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled"
        type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false">Notifications</button>
      <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
        type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Theme and Display</button>
      <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings"
        type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Blocks & Mute</button>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"
        tabindex="0">
      </div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
        tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab"
        tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"
        tabindex="0">...</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"
        tabindex="0">...</div>
    </div>
  </div>
  <!-- script bootstrap & js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
    integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
    integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
