$(function(){
    $('#requestapp form').on('submit', function (e){
        e.preventDefault();
        let data = {
            action: 'requestapp',
            name: $('#requestapp [name=requestapp_name]').val(),
            email: $('#requestapp [name=requestapp_email]').val(),
            list: $('#requestapp [name=requestapp_list]').val(),
            status: $('#requestapp [name=requestapp_status]').val(),
            text: $('#requestapp [name=requestapp_text]').val()
        };

        $.post(window.wp.ajax_url, data, function(res){
            if (res.success){
                alert('Ваша заявка принята!');
                $('#requestapp').html('<p>Заявка успешно добавлена</p><p style="color:red">Узнавайте статус заявки на специальной страничке <a href="#">Тут</a></p>');
            } else {
                alert(res.err);
            }
        }, 'json');
    });
});