<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="delete_admin">
        <p class="name_delete">Вы действительно хотите удалить пользователя : 
            <?= ucfirst($user['first_name']) . ' ' .  ucfirst($user['last_name']); ?> ?
        </p>
        <form action="#" method="post">
            <a href="/admin/user/" class="back_button">Назад</a>
            <input type="submit" name="submit" class="delete_button" value="Удалить">   
        </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>