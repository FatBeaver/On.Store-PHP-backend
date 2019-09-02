<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
    <h1>Вы на странице создания поста блога</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form">

        <label for="fn">Заголовок</label>
        <input type="text" name="title" id="fn"/>
        <label for="ln">Краткое описание</label>
        <input type="text" name="min_desc" id="ln"/>
        <label for="pw">Содержимое</label>
        <input type="text" name="content" id="pw">

        <label for="category">Выберите категории</label>
        <?php foreach($categories as $category): ?>
        <div class="blog_check">
            <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>"> <?= $category['title'] ?> 
        </div>
        <?php endforeach; ?>
        </select>

        <input type="submit" name="submit" value="Создать">
    </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>