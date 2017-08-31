$(document).ready(function () {
    $('body').on('submit', '.reg, .reg-ext', function () {
        var form = $(this),
            data = form.serialize();
        form.find('input,button').prop('disabled', true);
        $.ajax({
            'url': form.attr('action'),
            'type': 'post',
            'dataType': 'json',
            'data': data,
            'success': function (json) {
                if (json.status == 'success' && json.view) {
                    form.fadeOut(300, function () {
                        form.after(json.view);
                        form.remove();
                    });
                }
                form.find('input,button').prop('disabled', false);
            }
        });
    });

    $('body').on('change', '#org-form', function () {
        if ($(this).val() == 'ООО') {
            $('.only-ooo').show().find('input').prop('disabled', true);
            $('#org-share')[0].required = true;
        } else {
            $('.only-ooo').hide().find('input').prop('disabled', false);
            $('#org-share')[0].required = false;
        }
    });
	
	
    $('body').on('submit', '#feedback_form', function () {
		var form = $(this),
            data = form.serialize();
        form.find('input,button').prop('disabled', true);
		$.ajax({
            'url': 'ajax/partner.php',
            'type': 'post',
            'dataType': 'json',
            'data': data,
            'success': function (json) {
				if(json.name){
					form.find('input[name="name"]').addClass('has-error');
				}else{
					form.find('input[name="name"]').removeClass('has-error');
				}
				
				if(json.email){
					form.find('input[name="email"]').addClass('has-error');
				}else{
					form.find('input[name="email"]').removeClass('has-error');
				}
				
				if(json.phone){
					form.find('input[name="phone"]').addClass('has-error');
				}else{
					form.find('input[name="phone"]').removeClass('has-error');
				}
				if(json.msg){
					$('#feedback_form').html(json.msg);
				}
				form.find('input,button').prop('disabled', false);
            }
        });
	});

    /*
    if ($('.counter-wrap_count').length) {
        setInterval(function () {
            $.ajax({
                'url': 'ajax/timer.php',
                'success': function (html) {
                    $('.counter-wrap_count').html(html);
                }
            });
        }, 30000);
    }
    */

});

function send(id) {
    $.ajax({
        'url': 'ajax/send.php',
        'type': 'post',
        'data': {
            'id': id
        },
        'success': function (ajax) {
            window.location.href = ajax;
        }
    });
}