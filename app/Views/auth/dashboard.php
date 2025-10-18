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
        <h4>Admin Dashboard</h4>

        <!-- Admin feature view courses-->
        <?= view('features/courses') ?>

    <!-- Student Dashboard Content -->
    <?php elseif (session()->get('role') === 'user'): ?>
        <h4>Student Dashboard</h4>
        
        <!-- Load courses feature for students -->
        <?= view('features/courses') ?>
    <?php endif; ?>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf-token">
    <script>
    $(document).on('click', '.enroll-btn', function(e) {
        e.preventDefault();
        let button = $(this);
        let course_id = button.data('course-id');

        console.log('Enroll clicked, course_id=', course_id);

        // Disable button temporarily to prevent double clicks
        button.prop('disabled', true);

        $.ajax({
            url: "<?= base_url('course/enroll') ?>",
            method: "POST",
            data: {
                course_id: course_id,
                [$('#csrf-token').attr('name')]: $('#csrf-token').val()
            },
            dataType: "json",
            success: function(response) {
                console.log('Enroll response:', response);

                // Update CSRF token for next request
                if (response.csrf_token) {
                    $('#csrf-token').val(response.csrf_token);
                }

                // Show flash alert
                let alertHtml = `
                    <div class="alert alert-${response.status === 'success' ? 'success' : 'warning'} alert-dismissible fade show mt-3" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                $('.container').prepend(alertHtml);

                if (response.status === 'success') {
                    // Update button style
                    button.prop('disabled', true)
                        .removeClass('btn-primary')
                        .addClass('btn-secondary')
                        .html('<i class="bi bi-check-circle"></i> Enrolled');

                    // Update enrolled courses list
                    let $list = $('#enrolled-courses .list-group');
                    if ($list.length === 0) {
                        $('#enrolled-courses').append('<div class="list-group mt-3"></div>');
                        $list = $('#enrolled-courses .list-group');
                        $('#enrolled-courses .text-muted').remove();
                    }

                    if (response.course) {
                        $list.prepend(`
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${response.course.course_name}</span>
                                <small class="text-muted">Enrolled on: ${response.course.enrollment_date}</small>
                            </div>
                        `);
                    }
                } else {
                    // Re-enable button if enrollment failed
                    button.prop('disabled', false);
                }
            },
            error: function(xhr) {
                console.error('AJAX error:', xhr.status, xhr.responseText);
                let alertHtml = `
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                $('.container').prepend(alertHtml);

                // Re-enable button on error
                button.prop('disabled', false);
            }
        });
    });
    </script>
</body>
</html>