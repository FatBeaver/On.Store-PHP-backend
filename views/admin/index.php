<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_page">
    <h1 class="admin_hello">Добро пожаловать в панель администратора!</h1>
    <p >Вам доступен следующий функционал для работы с сайтом :</p>
    <div class="action_list">
        <a href="/admin/user/">Управление пользователями</a>
        <a href="/admin/comment/">Управление комментариями</a>
        <a href="/admin/blog/">Управление постами блога</a>
        <a href="/admin/portfolio/">Управление постами портфолио</a>
        <a href="/admin/category/">Управление категориями</a>
    </div>
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>