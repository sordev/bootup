jQuery(document).ready(function($j){
	function ajaxCallback(f, u, c, t) {
		t = typeof t !== 'undefined' ? t : 'POST';
        if (f) {
            $.ajax({
                type: t,
                url: u,
                data: f,
                dataType: 'json'
            }).done(function (d, status, xhr) {
                c(d);
            }).fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
        }
    }

	function postNext(){
		$(document).on('click','.next',function(e){
			e.preventDefault();
			f = $(this).closest('form');
			formData = f.serialize();
			step = f.find('.step').val();
			btn = f.find('.btn');
			switch(step){
				case 'addproject':
					ajaxCallback(formData, '/projects/postnext', function (d) {
						console.log(d);
					});
				break
			}
		});
	}
	postNext();
	
});
function callRecaptcha(){
	$.each($('.g-recaptcha'),function(i,v){
		grecaptcha.render(v, {
		  'sitekey' : recaptchakey, //Replace this with your Site key
		  'theme' : 'light'
		})
	});
}