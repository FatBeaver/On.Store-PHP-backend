<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
    <h1>Вы на странице создания категории для постов</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form" id="create_user">

        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title" 
            value="<?= !empty($category['title']) ? $category['title'] : ''; ?>"/>

        <label for="description">Краткое описание</label>
        <input type="text" name="description" id="description" 
            value="<?= !empty($category['description']) ? $category['description'] : ''; ?>"/>

        <input type="submit" name="submit" value="Создать">
    </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>