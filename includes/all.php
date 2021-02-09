<?php
    include_once('m/requestapp.php');
    $requestapp_all = requestapp_all();
//    echo '<pre>';
//    print_r($requestapp_all);
//    echo '</pre>';
?>

<h2>Заявки</h2>
<p><a href="<?=$_SERVER['PHP_SELF']?>?page=requestapp&c=add">Добавить новую заявку</a></p>
<table border="1">
    <tr>
        <td>Номер заявки</td>
        <td>Дата поступления</td>
        <td>ФИО</td>
        <td>Email</td>
        <td>Список УНУ</td>
        <td>Статус</td>
<!--        <td>Описание</td>-->
        <td></td>
    </tr>
    <?php foreach ($requestapp_all as $requestapp): ?>
    <tr>
        <td><?=$requestapp['id_request']?></td>
        <td><?=$requestapp['date']?></td>
        <td><?=$requestapp['name']?></td>
        <td><?=$requestapp['email']?></td>
        <td><?=$requestapp['list']?></td>
        <td><?=$requestapp['status']?></td>
<!--        <td>--><?//=requestapp_text_limit($requestapp['text'])?><!--</td>-->
        <td><a href="<?=$_SERVER['PHP_SELF']?>?page=requestapp&c=edit&id=<?=$requestapp['id_request']?>">Редактировать</a></td>
    </tr>
    <?php endforeach; ?>
</table>

