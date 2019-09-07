<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<section class="admin_main_userpage">
    <h1 class="header_admin_user">Вы на странице со списком всех записей портфолио</h1>
    <p class="admin_user_description">Вы можете изменить\удалить необходимую запись портфолио</p>
    <a href="/admin/" class="out_comment" id="out_comment">На главную</a>
    <a href="/admin/portfolio/create/" class="user_create">Опубликовать пост</a>
    <table class="all-user-table">
        <thead class="all_post_portfolio">
            <td>id</td>
            <td>Заголовок</td>
            <td>Кр.Описание</td>
            <td>Содержимое</td>
            <td>Рейтинг</td>
            <td>Клиент</td>
            <td>Вэб-сайт</td>
            <td>Изображение</td>              
            <td>Контакты</td>
            <td>Дата</td>
            <td>Категории</td>
            <td>Изменить</td>
            <td>Удалить</td>
        </thead>
        <tbody>
            <?php if (is_array($posts)) foreach($posts as $post):  ?>
                <tr>
                    <td><?= $post['id']; ?></td>
                    <td><?= $post['title']; ?></td>
                    <td><?= $post['description']; ?></td>
                    <td><p><?= mb_substr(wordwrap($post['content'], 30, true), 0, 50); ?></p></td>
                    <td><?= $post['rating']; ?></td>
                    <td><?= ucfirst($post['client']) ?></td>
                    <td><?= $post['website']; ?></td>
                    <td><img src="<?= FileImages::getImage('portfolio', $post['image']); ?>" width="100px" alt="p_img"></td>
                    <td><?= $post['contacts']; ?></td>
                    <td><?= $post['date']; ?></td>
                    <td class="cetegory_td">

                        <?php if (!empty($post['categories']) ): ?>

                            <?php foreach($post['categories'] as $category): ?>
                                <?=  $category . '<br/>'?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </td>
                    <td><a href="/admin/portfolio/update/<?= $post['id']; ?>">
                        <img src="/template/img/admin/update.svg" alt="update" width="45px">
                    </a></td>
                    <td><a href="/admin/portfolio/delete/<?= $post['id']; ?>">
                        <img src="/template/img/admin/delete.svg" alt="delete">
                    </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>