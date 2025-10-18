<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <?= $this->include('templates/header') ?>
  <?= $this->include('templates/sidebar') ?>

  <div class="container mt-5">
    <!-- Flash message -->
    <?php if (session()->getFlashdata('message')): ?>
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <!-- Admin Dashboard Content -->
    <?php if (session()->get('role') === 'admin'): ?>
        <p>Manage users, courses, and reports here.</p>

    <!-- Student Dashboard Content -->
    <?php else: ?>
        <p>Welcome to your student dashboard.</p>
        
    <?php endif; ?>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    //Auto-hide alert after 3 seconds
    setTimeout(() => {
      const alert = document.querySelector('.alert');
      if (alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      }
    }, 3000);
  </script>

</body>
</html>