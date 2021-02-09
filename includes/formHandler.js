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
                $('#requestapp').html('<div class="alert alert-success" role="alert">Заявка успешно добавлена. Руководителю установки и вам направлено письмо, содержащее эту заявку, дальнейший статус заявки узнавайте на специальной страничке.</div>');
            } else {
                alert(res.err);
            }
        }, 'json');
    });
});