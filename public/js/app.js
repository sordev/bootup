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
			stepcontainer = $('.projectstepcontainer');
			switch(step){
				case 'addproject':
					ajaxCallback(formData, '/projects/postnext', function (d) {
						if(d.status == false){
							console.log(d);
						} else {
							stepcontainer.html(d.view);
							imageUpload('image');
						}
					});
				break
			}
		});
	}
	postNext();
	
	uploadButton = $('<div/>')
		.addClass('btn btn-primary')
		.prop('disabled', true)
		.text('Processing...')
		.on('click', function () {
			var $this = $(this),
				data = $this.data();
			$this
				.off('click')
				.text('Abort')
				.on('click', function () {
					$this.remove();
					data.abort();
				});
			delete data.form;
			console.log(data);
			/**/data.submit().always(function () {
				$this.remove();
			});
		});
	
	
	
	function imageUpload(id){
		if($('#upload_'+id).length > 0) {
			$('#upload_'+id).fileupload({
				url: '/projects/upload/image',
				dataType: 'json',
				autoUpload: false,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				maxFileSize: 999000,
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/
					.test(window.navigator.userAgent),
				previewMaxWidth: 100,
				previewMaxHeight: 100,
				previewCrop: true
				//method: 'POST'
			}).on('fileuploadadd', function (e, data) {
				$('#files_'+id).html('');
				data.context = $('<div/>').appendTo('#files_'+id);
				$.each(data.files, function (index, file) {
					var node = $('<p/>')
							.append($('<span/>').text(file.name));
					if (!index) {
						node
							.append('<br>')
							.append(uploadButton.clone(true).data(data));
					}
					node.appendTo(data.context);
				});
			}).on('fileuploadprocessalways', function (e, data) {
				var index = data.index,
					file = data.files[index],
					node = $(data.context.children()[index]);
				if (file.preview) {
					node
						.prepend('<br>')
						.prepend(file.preview);
				}
				if (file.error) {
					node
						.append('<br>')
						.append($('<span class="text-danger"/>').text(file.error));
				}
				if (index + 1 === data.files.length) {
					data.context.find('div.btn')
						.text('Upload')
						.prop('disabled', !!data.files.error);
				}
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress_'+id+' .progress-bar').css(
					'width',
					progress + '%'
				);
			}).on('fileuploaddone', function (e, data) {
				//disables multiupload
				console.log(data);
				$('#'+id).off('click');
				$.each(data.result.files, function (index, file) {
					$('#'+id).val(file.name);
					if (file.url) {
						var link = $('<a>')
							.attr('target', '_blank')
							.prop('href', file.url);
						$(data.context.children()[index])
							.wrap(link);
					} else if (file.error) {
						var error = $('<span class="text-danger"/>').text(file.error);
						$(data.context.children()[index])
							.append('<br>')
							.append(error);
					}
					
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger"/>').text('File upload failed.');
					$(data.context.children()[index])
						.append('<br>')
						.append(error);
				});
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
		}
	}
});
function callRecaptcha(){
	$.each($('.g-recaptcha'),function(i,v){
		grecaptcha.render(v, {
		  'sitekey' : recaptchakey, //Replace this with your Site key
		  'theme' : 'light'
		})
	});
}