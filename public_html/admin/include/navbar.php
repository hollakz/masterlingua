<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid d-none d-lg-block">
        <a class="navbar-brand" href="/">Cайт</a>
        <a class="navbar-brand" href="/admin">Админка</a>
        <?php if ($user['role'] !== 'student'): ?>
            <a class="navbar-brand" href="/admin/students.php">Список студентов</a>
        <?php endif; ?>
        <?php if ($user['role'] !== 'student'): ?>
            <a class="navbar-brand" href="/admin/teacher_tasks.php">Задания</a>
        <?php endif; ?>
        <?php if ($user['role'] !== 'teacher'): ?>
            <a class="navbar-brand" href="/admin/student_tasks.php">Задания</a>
        <?php endif; ?>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-xl-none">
            <a class="navbar-brand" href="/">Cайт</a>
            <a class="navbar-brand" href="/admin">Админка</a>
            <?php if ($user['role'] !== 'student'): ?>
                <a class="navbar-brand" href="/admin/students.php">Список студентов</a>
            <?php endif; ?>
            <?php if ($user['role'] !== 'student'): ?>
                <a class="navbar-brand" href="/admin/teacher_tasks.php">Задания</a>
            <?php endif; ?>
            <?php if ($user['role'] !== 'teacher'): ?>
                <a class="navbar-brand" href="/admin/student_tasks.php">Задания</a>
            <?php endif; ?>
        </ul>
    </div>
</nav>

