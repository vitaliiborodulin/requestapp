<?php include_once('m/requestapp.php'); ?>

<h3><a href="<?=$_SERVER['PHP_SELF']?>?page=requestapp">Заявки</a></h3>
<?php
    $id = (int)$_GET['id'];

    if($id == 0)
        die('Не передан id заявки!');

    if(!empty($_POST)){
        $requestapp_name = $_POST['requestapp_name'];
        $requestapp_email = $_POST['requestapp_email'];
        $requestapp_list = $_POST['requestapp_list'];
        $requestapp_status = $_POST['requestapp_status'];
        $requestapp_text = $_POST['requestapp_text'];

        if(isset($_POST['save'])){
            if(requestapp_edit($id, $requestapp_name, $requestapp_email, $requestapp_list, $requestapp_status, $requestapp_text)){
                die('Заявка успешно отредактирована!');
            }
        } elseif(isset($_POST['delete'])){
            if(requestapp_delete($id)){
                die('Заявка успешно удалена!');
            }
        }

        $error = true;

    } else {
        $requestapp = requestapp_get($id);
//        var_dump($requestapp);
        $requestapp_name = $requestapp['name'];
        $requestapp_email = $requestapp['email'];
        $requestapp_list = $requestapp['list'];
        $requestapp_status = $requestapp['status'];
        $requestapp_text = $requestapp['text'];
    }
?>

<h2>Редактирование заявки</h2>
<?php if ($error): ?>
    <p>Пожалуйста, заполните все поля!</p>
<?php endif; ?>
<form method="post">
    <p>
        <label>
            <div>ФИО</div>
            <input type="text" name="requestapp_name" value="<?=$requestapp_name?>" required>
        </label>
    </p>
    <p>
        <label>
            <div>Email</div>
            <input type="email" name="requestapp_email" value="<?=$requestapp_email?>" required>
        </label>
    </p>
    <p>
        <label>
            <div>Список УНУ</div>
            <select name="requestapp_list" required>
                <?php $requestapp_list_options = [
                    'Гербарий' => 'Гербарий Полярно-альпийского ботанического сада-института (KPABG)',
                    'Инсектарий' => 'Инсектарий Полярно-альпийского ботаничкого сада-института',
                    'Коллекция растений' => 'Коллекция живых растений Полярно-альпийского ботанического сада-института'
                ]; ?>
                <?php foreach($requestapp_list_options as $key => $value): ?>
                    <?php if($requestapp_list == $key): ?>
                        <option value="<?=$key?>" "selected"><?=$value;?></option>
                    <?php  else: ?>
                        <option value="<?=$key?>"><?=$value;?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
        <label>
            <div>Статус</div>
            <select name="requestapp_status" required>
                <?php $status_list_options = [
                    'Первичный' => 'Первичный',
                    'Находится на рассмотрении' => 'Находится на рассмотрении',
                    'Время рассмотрения продлено' => 'Время рассмотрения продлено',
                    'Принята' => 'Принята',
                    'Отклонена' => 'Отклонена'
                ]; ?>
                <?php foreach($status_list_options as $key => $value): ?>
                    <?php if($requestapp_status == $key): ?>
                        <option value="<?=$key?>" "selected"><?=$value;?></option>
                    <?php  else: ?>
                        <option value="<?=$key?>"><?=$value;?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </label>
    </p>
    <p>
    <div>Содержание</div>
    <textarea name="requestapp_text" style="width: 90%" required><?=$requestapp_text?></textarea>
    </p>
    <p>
        <input type="submit" name="save" value="Сохранить">
        <input type="submit" name="delete" value="Удалить">
    </p>
</form>
