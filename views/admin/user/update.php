<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>

<div class="create_user_wrapper">
    <?php if ($errors != false): ?>
        <?php foreach($errors as $error): echo '<br/>' ?>
            <?= $error; ?>
        <?php endforeach; ?>
    <?php endif;?>
    <h1>Вы на странице редактирования пользвотеля</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form">

        <label for="fn">Измените имя:</label>
        <input type="text" name="first_name" id="fn" 
            value="<?= !empty($user['first_name']) ? $user['first_name'] : ''; ?>"/>

        <label for="ln">Измените фамилию:</label>
        <input type="text" name="last_name" id="ln"
            value="<?= !empty($user['last_name']) ? $user['last_name'] : ''; ?>"/>

        <label for="pw">Измените пароль:</label>
        <input type="text" name="password" id="pw"
            value="<?= !empty($user['password']) ? $user['password'] : ''; ?>"/>

        <label for="em">Измените email:</label>
        <input type="text" name="email" id="em" 
            value="<?= !empty($user['email']) ? $user['email'] : ''; ?>"/>

        <p>Текущее изображение</p>
        <img src="<?= FileImages::getImage('user', $user['image']); ?>" width="500px" alt="user_img">
        <label for="img">Изменить изображение:</label>
        <input type="file" name="image" id="img" accept="image/*"/> <!-- Добавить метод загрузки изображения -->

        <label for="w_p">Измените должность</label>
        <input type="text" name="work_postition" id="w_p" 
            value="<?= !empty($user['work_position']) ? $user['work_position'] : ''; ?>"/>

        <label for="status">Измените статус</label>
        <input type="status" name="status" id="status" 
            value="<?= !empty($user['status']) ? $user['status'] : ''; ?>"/>

        <input type="submit" name="submit" value="Изменить">
    </form>
</div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>