 <style>
   /* Reduce sidebar width */
  .offcanvas-start {
    width: 220px !important;
  }

  /* Ensure text/icons fit nicely */
  .offcanvas-body ul li a {
    font-size: 1rem;
    white-space: nowrap;
  }
</style>

<!-- Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="sidebarLabel">Dashboard</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-unstyled">
        <!-- Common link -->
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-house"></i> Home</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-person"></i> Profile</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-journal-bookmark"></i> Courses</a></li>

        <!-- Role-specific links -->
        <?php if (session()->get('role') === 'admin'): ?>
            <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-people"></i> Users</a></li>
            <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-bar-chart"></i> Reports</a></li>
        <?php else: ?>
            <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-clipboard"></i> To do</a></li>
        <?php endif; ?>

        <!-- Common link --> 
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-megaphone"></i> Announcements</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-envelope"></i> Inbox</a></li>
        <li><a href="#" class="text-white text-decoration-none d-block py-2"><i class="bi bi-gear"></i> Settings</a></li>
        <li><a href="<?= base_url('logout') ?>" class="btn btn-danger mt-3">Logout</a></li>
    </ul>
  </div>
</div>