<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
        <h1>Вы на странице редактирования поста блога</h1>
        <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form">

            <label for="fn">Заголовок</label>
            <input type="text" name="title" id="fn" 
                value="<?= !empty($post['post']['title']) ? $post['post']['title'] : ''; ?>"/>

            <label for="ln">Краткое описание</label>
            <input type="text" name="min_desc" id="ln"
                value="<?= !empty($post['post']['description']) ? $post['post']['description'] : ''; ?>"/>

            <label for="pw">Содержимое</label>
            <input type="text" name="content" id="pw" 
                value="<?= !empty($post['post']['content']) ? $post['post']['content'] : ''; ?>"/>

            <p>Текущее изображение</p>
            <img src="<?= FileImages::getImage('blog', $post['post']['image']) ?>" alt="update_blog_img" width="500px">
            <label for="image">Изменить изображение :</label>
            <input type="file" accept="image/*" id="image" name="image">

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

            <input type="submit" name="submit" value="Изменить">
        </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>