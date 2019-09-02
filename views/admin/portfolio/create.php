<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
    <h1>Вы на странице создания поста блога</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form" id="create_user">

        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title"/>

        <label for="description">Краткое описание</label>
        <input type="text" name="description" id="description"/>

        <label for="content">Содержимое</label>
        <textarea name="content" id="content" cols="30" rows="5" form="create_user"></textarea>

        <label for="client">Клиент</label>
        <input type="text" name="client" id="client">

        <label for="rating">Рейтинг</label>
        <input type="text" name="rating" id="rating">

        <label for="website">Web-site</label>
        <input type="text" name="web_site" id="website">

        <label for="images">Добавьте изображение</label>
        <input type="file" name="images" id="images">

        <label for="contacts">Добавьте ссылки на контакты через запятую</label>
        <input type="text" name="contacts" id="contacts">

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