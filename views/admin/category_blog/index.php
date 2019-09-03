<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_userpage">
    <h1 class="header_admin_user">Вы на странице со списком всех категорий для постов</h1>
    <p class="admin_user_description">Вы можете изменить\удалить выбранную категорию</p>
    <a href="/admin/" class="out_comment" id="out_comment">На главную</a>
    <a href="/admin/category/create/" class="user_create">Добавить категорию</a>
    <table class="all-user-table">
        <thead>
            <td>id</td>
            <td>Заголовок</td>
            <td>Описание</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['title']; ?></td>
                    <td><?php echo $category['description']; ?></td>
                    <td><a href="/admin/category/update/<?= $category['id']; ?>">
                        <img src="/template/img/admin/update.svg" alt="update" width="45px">    
                    </a></td>
                    <td><a href="/admin/category/delete/<?= $category['id']; ?>">
                        <img src="/template/img/admin/delete.svg" alt="delete">
                    </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>