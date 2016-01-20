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
});