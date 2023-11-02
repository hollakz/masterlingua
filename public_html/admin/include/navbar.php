
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="row-cols-2">
            <a class="navbar-brand" href="/">Cайт</a>
            <a class="navbar-brand" href="/admin">Админка</a>
            <?php if ($user['role'] !== 'student'): ?>
                <a class="navbar-brand" href="/admin/students.php">Список студентов</a>
            <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>
