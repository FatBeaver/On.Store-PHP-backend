<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_userpage">
    <h1 class="header_admin_user">Вы на странице со списком всех пользователей сайта</h1>
    <p class="admin_user_description">Вы можете изменить\удалить текущего пользователя или же добавить нового</p>
    <a href="/admin/" class="out_comment" id="out_comment">На главную</a>
    <a href="/admin/user/create" class="user_create">Создать пользователя</a>
    <table class="all-user-table">
        <thead class="all_post_user">
            <td>id</td>
            <td>Имя</td>
            <td>Фамииля</td>
            <td>Email</td>
            <td>Должность</td>
            <td>Изображение</td>
            <td>Контакты</td>
            <td>Статус</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['work_position']; ?></td>
                    <td><?php echo $user['image']; ?></td>
                    <td><?php echo $user['contacts']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td><a href="/admin/user/update/<?= $user['id']; ?>">
                        <img src="/template/img/admin/update.svg" alt="update" width="50px">
                    </a></td>
                    <td><a href="/admin/user/delete/<?= $user['id']; ?>">
                        <img src="/template/img/admin/delete.svg" alt="delete">
                    </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>