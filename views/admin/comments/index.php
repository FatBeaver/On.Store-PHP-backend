<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_userpage">
    <h1 class="header_admin_user">Вы на странице со списком всех комментариев</h1>
    <p class="admin_user_description">Вы можете скрыть или же удалить комментарии</p>
    <a href="/admin/" class="out_comment" id="out_comment">На главную</a>
    <table class="all-user-table">
        <thead>
            <td>id</td>
            <td>Текст</td>
            <td>Дата</td>
            <td>Блог</td>
            <td>Автор</td>
            <td>Статус</td>
            <td>Удалить</td>
        </thead>
        <tbody>
            <?php foreach($comments as $comment): ?>
                <tr>
                    <td><?php echo $comment['id']; ?></td>
                    <td><?php echo $comment['text']; ?></td>
                    <td><?php echo $comment['date']; ?></td>
                    <td><?php echo $comment['blog_id']; ?></td>
                    <td><?php echo $comment['user_id']; ?></td>
                    <td><a href="/admin/comment/statusChange/<?= $comment['id']; ?>">
                        <?php echo ($comment['status'] == (int) 0) ? 'Скрыть' :  'Разблокировать';?>
                    </a></td>
                    <td><a href="/admin/comment/delete/<?= $comment['id']; ?>">
                        <img src="/template/img/admin/delete.svg" alt="delete">
                    </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>