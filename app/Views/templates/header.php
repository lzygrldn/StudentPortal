<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
      <i class="bi bi-list"></i> Menu
    </button>
    <span class="navbar-text text-white ms-auto">
        <?php if (session()->get('role') === 'admin'): ?> Admin Dashboard
        <?php else: ?> Student Dashboard
        <?php endif; ?>
    </span>
  </div>
</nav>