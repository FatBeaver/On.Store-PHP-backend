<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
    <h1>Вы на странице создания поста блога</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form" id="create_user">

        <label for="title">Заголовок</label>
        <input type="text" name="title" id="title"
            value="<?= !empty($post['post']['title']) ? $post['post']['title'] : ''; ?>"/>

        <label for="description">Краткое описание</label>
        <input type="text" name="description" id="description"
            value="<?= !empty($post['post']['description']) ? $post['post']['description'] : ''; ?>"/>

        <label for="content">Содержимое</label>
        <textarea name="content" id="content" cols="30" rows="5" form="create_user"><?= !empty($post['post']['content']) ? $post['post']['content'] : ''; ?></textarea>

        <label for="client">Клиент</label>
        <input type="text" name="client" id="client"
            value="<?= !empty($post['post']['client']) ? $post['post']['client'] : ''; ?>"/>

        <label for="rating">Рейтинг</label>
        <input type="text" name="rating" id="rating" 
            value="<?= !empty($post['post']['rating']) ? $post['post']['rating'] : ''; ?>"/>

        <label for="website">Web-site</label>
        <input type="text" name="web_site" id="website" 
            value="<?= !empty($post['post']['website']) ? $post['post']['website'] : ''; ?>"/>

        <label for="images">Добавьте изображение</label>
        <input type="file" name="images" id="images" 
            value="<?= !empty($post['post']['images']) ? $post['post']['images'] : ''; ?>"/>

        <label for="contacts">Добавьте ссылки на контакты через запятую</label>
        <input type="text" name="contacts" id="contacts" 
            value="<?= !empty($post['post']['contacts']) ? $post['post']['contacts'] : ''; ?>"/>

        <label for="category">Выберите категории</label>
            
            <?php $i = 0; 
            foreach($categories as $category): ?>  
             
            <?php if (@in_array($category['title'], $post['categories'])): ?>

                <div class="blog_check">
                    <input type="checkbox" name="categories[]" 
                        value="<?= $category['id'] ?>" checked="checked"> <?= $category['title'] ?> 
                </div>

            <?php else: ?>

                <div class="blog_check">
                    <input type="checkbox" name="categories[]" value="<?= $category['id'] ?>"> <?= $category['title'] ?> 
                </div>

            <?php 
            endif;
            $i++;
            endforeach; ?>

        <input type="submit" name="submit" value="Создать">
    </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>