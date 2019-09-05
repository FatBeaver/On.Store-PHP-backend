<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_userpage">
    <h1 class="header_admin_user">Вы на странице со списком всех записей блога</h1>
    <p class="admin_user_description">Вы можете изменить\удалить необходимую запись блога</p>
    <a href="/admin/" class="out_comment" id="out_comment">На главную</a>
    <a href="/admin/blog/create/" class="user_create">Опубликовать пост</a>
    <table class="all-user-table">
        <thead class="all_post_blog">
            <td>id</td>
            <td>Заголовок</td>
            <td>Кр.Описание</td>
            <td>Изображение</td>
            <td>Автор</td>
            <td>Просмотренно</td>
            <td>Опубликованно</td>  
            <td>Категории</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </thead>
        <tbody>
            <?php if (is_array($posts)) foreach($posts as $post): ?>
                <tr>
                    <td><?= $post['id']; ?></td>
                    <td><?= $post['title']; ?></td>
                    <td><?= $post['description']; ?></td>
                    <td><img src="<?= FileImages::getImage('blog', $post['image']); ?>" width="100px" alt="blog_img"></td>
                    <td><?= ucfirst($post['first_name']) . ' ' . ucfirst($post['last_name']); ?></td>
                    <td><?= $post['viewed']; ?></td>
                    <td><?= $post['date']; ?></td>
                    <td class="cetegory_td">
                        <?php foreach($post['category'] as $category): ?>
                            <?=  $category . '<br/>'?>
                        <?php endforeach; ?>
                    </td>
                    <td><a href="/admin/blog/update/<?= $post['id']; ?>">
                        <img src="/template/img/admin/update.svg" alt="update" width="45px">
                    </a></td>
                    <td><a href="/admin/blog/delete/<?= $post['id']; ?>">
                        <img src="/template/img/admin/delete.svg" alt="delete">
                    </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>