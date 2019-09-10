<?php require_once ROOT . '/views/layouts/header.php';?>
<div class="comment-form">
    <h4>Вы на странице регистрации<br/>Заполните все поля для успешной регистрации</h4>
    <?php if ($errors != false): ?>
        <?php if (is_array($errors)) foreach ($errors as $error): ?>
            <?= $error ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <form method="POST" action="#">
        <div class="form-group form-inline registration">

            <div class="form-group col-lg-6 col-md-6 name">
                <label for="email">Email</label>
                <input required  type="email" class="form-control" name="email" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
            </div>

            <div class="form-group col-lg-6 col-md-6 name">
                <label for="password">Введите пароль </label>
                <input required  type="password" class="form-control" name="password" id="password" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Цифры, латиница 6 - 24 символа'">
            </div>

        </div>

        <input type="submit" name="submit" class="primary-btn submit_btn" value="Login"></a>	
    </form>
</div>
<?php require_once ROOT . '/views/layouts/footer.php'; ?>