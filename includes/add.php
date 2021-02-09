<?php include_once('m/requestapp.php'); ?>

<h3><a href="<?=$_SERVER['PHP_SELF']?>?page=requestapp">Заявки</a></h3>
<?php
    if(!empty($_POST)){
        $requestapp_name = $_POST['requestapp_name'];
        $requestapp_email = $_POST['requestapp_email'];
        $requestapp_list = $_POST['requestapp_list'];
        $requestapp_status = $_POST['requestapp_status'];
        $requestapp_text = $_POST['requestapp_text'];

        if(requestapp_add($requestapp_name, $requestapp_email, $requestapp_list, $requestapp_status, $requestapp_text)){
            die('Заявка успешно добавлена!');
        }

        $error = true;

    } else {
        $requestapp_name = '';
        $requestapp_email = '';
        $requestapp_text = '';
    }
?>

<h2>Новая заявка</h2>
<?php if ($error): ?>
    <p>Пожалуйста, заполните все поля!</p>
<?php endif; ?>
<form method="post">
    <p>
        <label>
            <div>ФИО</div>
            <input type="text"  name="requestapp_name" value="<?=$requestapp_name?>" required>
        </label>
    </p>
    <p>
        <label>
            <div>Email</div>
            <input type="email" name="requestapp_email" value="<?=$requestapp_email?>" required>
        </label>
    </p>
    <p>
        <div>Список УНУ</div>
        <select name="requestapp_list" required>
            <option disabled="" selected="" value=''>выберите УНУ</option>
            <option value="Гербарий">Гербарий Полярно-альпийского ботанического сада-института (KPABG)</option>
            <option value="Инсектарий">Инсектарий Полярно-альпийского ботаничкого сада-института</option>
            <option value="Коллекция растений">Коллекция живых растений Полярно-альпийского ботанического сада-института</option>
        </select>
    </p>
    <p>
        <input type="hidden" name="requestapp_status" value="Первичный">
    </p>
    <p>
        <div>Содержание</div>
        <textarea name="requestapp_text" style="width: 90%" required><?=$requestapp_text?></textarea>
    </p>
    <p>
        <input type="submit" value="Добавить заявку">
    </p>
</form>
