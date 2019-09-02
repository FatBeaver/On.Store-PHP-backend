<?php require_once ROOT . '/views/admin/layout/admin_header.php'; ?>
    <div class="create_user_wrapper">
    <?php if ($errors != false): ?>
        <?php foreach($errors as $error): echo '<br/>' ?>
            <?= $error; ?>
        <?php endforeach; ?>
    <?php endif;?>
    <h1>Вы на странице создания нового пользвотеля</h1>
    <form action="#" method="POST" enctype="multipart/form-data" class="create-user_form">

        <label for="fn">Введите имя:</label>
        <input type="text" name="first_name" id="fn"/>

        <label for="ln">Введите фамилию:</label>
        <input type="text" name="last_name" id="ln"/>
        <label for="pw">Введите пароль:</label>
        <input type="text" name="password" id="pw">
        <label for="em">Введите email:</label>
        <input type="text" name="email" id="em"/>
        <label for="img">Загрузите изображение:</label>
        <input type="file" name="image" id="img"/>
        <label for="w_p">Должность</label>
        <input type="text" name="work_postition" id="w_p">
        <label for="status">Статус</label>
        <input type="status" name="status" id="status">
        <input type="submit" name="submit" value="Создать">
    </form>
    </div>
<?php require_once ROOT . '/views/admin/layout/admin_footer.php'; ?>