<?php
include_once('m/requestapp.php');
$requestapp_all = requestapp_all();
?>

<div class="table-responsive">
    <table class="table table-bordered table-hover text-center">
        <tr class="info">
            <td>Номер заявки</td>
            <td>Дата поступления</td>
            <td>ФИО</td>
            <td>Email</td>
            <td>Список УНУ</td>
            <td>Статус</td>
        </tr>
        <?php foreach ($requestapp_all as $requestapp): ?>
            <tr>
                <td><?=$requestapp['id_request']?></td>
                <td><?=mysql2date('d M Y H:i', $requestapp['date'])?></td>
                <td><?=$requestapp['name']?></td>
                <td><?=$requestapp['email']?></td>
                <td><?=$requestapp['list']?></td>
                <td><?=$requestapp['status']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
