<div id="courses-feature">

<?php if($role === 'admin'): ?>
    <!-- ADMIN VIEW -->
    <h4><i class="bi bi-gear"></i> Manage Courses</h4>
    <a href="<?= base_url('course/create') ?>" class="btn btn-success mb-3">Add New Course</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($allCourses as $course): ?>
                <tr>
                    <td><?= esc($course['title']) ?></td>
                    <td><?= esc($course['description']) ?></td>
                    <td>
                        <a href="<?= base_url('course/edit/'.$course['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('course/delete/'.$course['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php elseif($role === 'user'): ?>
    <!-- STUDENT VIEW -->
    <div class="mt-4"  id="enrolled-courses">
        <h4><i class="bi bi-bookmark-check"></i> Enrolled Courses</h4>
        <?php if (!empty($enrolledCourses)): ?>
            <div class="list-group mt-3">
                <?php foreach ($enrolledCourses as $course): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                        <span><?= esc($course['course_name']) ?></span>
                        <small class="text-muted">Enrolled on: <?= esc($course['enrollment_date']) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted mt-3">You are not enrolled in any courses yet.</p>
        <?php endif; ?>
    </div>
    <!-- Available Courses Section -->
    <div class="mt-5">
        <h4><i class="bi bi-journal-bookmark"></i> Available Courses</h4>
        <?php if (!empty($availableCourses)): ?>
        <div class="row mt-3">
            <?php foreach ($availableCourses as $course): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($course['title']) ?></h5>
                            <p class="card-text"><?= esc($course['description']) ?></p>
                            <button class="btn btn-primary enroll-btn" data-course-id="<?= $course['id'] ?>">
                                <i class="bi bi-plus-circle"></i> Enroll
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p class="text-muted mt-3">No available courses to enroll in.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>