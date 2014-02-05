<?php
include 'block/header.php';
include 'block/menu.php';
?>

<br /><br /><div id="content">

<!--форма для заполнения данных входа-->
<form name="login_form" action="login_action.php" method="post">

<label style="font-weight: bold">Введите логин</label><br />
<input name="u_login" type="text" /><br /><br />
<label style="font-weight: bold">Введите пароль</label><br />
<input name="u_pass" type="password" /><br /><br />
<input name="submit" type="submit" value="Вход" />

</form>

</div>

<?php include 'block/footer.php';?>