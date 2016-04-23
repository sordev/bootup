jQuery(document).ready(function($j){
	//ajaxcall function with return data
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

	function initStartEnd() {
        $('#start').datetimepicker({
			disabledHours:false,
			minDate: moment(),
			format: 'YYYY/MM/DD'
		});
        $('#end').datetimepicker({
			disabledHours:false,
			format: 'YYYY/MM/DD',
            useCurrent: false //Important! See issue #1075
        });
        $("#start").on("dp.change", function (e) {
            $('#end').data("DateTimePicker").minDate(e.date);
        });
        $("#end").on("dp.change", function (e) {
            //$('#end').data("DateTimePicker").maxDate(e.date);
        });
    };

	function validate(){
		$(document).on('submit','form',function(e){
			v = validateRequired($(this));
			if (v==false){
				e.preventDefault();
			} else {
				//$(this).submit();
			}
		})
		$(document).on('keyup','.required',function(){
			f = $(this).closest('form')
			v = validateRequired(f);
		});
		$(document).on('focus','.required',function(){
			f = $(this).closest('form')
			v = validateRequired(f);
		});
	}
	validate();
	function validateRequired(f){
		var r = false;
		var e = {};
		var l = '';
		$.each(f.find('.required'),function(i,v){
			value=$.trim($(v).val());
			console.log(value);
			if (value == 0){
				if($(v).siblings('label').length > 0){
					l = $(v).siblings('label').html();
				}
				id = $(v).attr('id');
				if (l){
					e[id] = [''+l+' талбарыг бөглөнө үү'];
				} else {
					e[id] = ['Энэ талбарыг бөглөнө үү'];
				}
			}
		});
		console.log(e)
		if ($.isEmptyObject(e)){
			r = true;
		} else {
			showError(e);
		}
		
		return r;
	}
	//validateRequired();

	function setDateInput() {
		$.each($('.date'),function(i,v){
			$(v).datetimepicker({
				disabledHours:false,
				minDate: moment(),
				format: 'YYYY/MM/DD'
			});
		});
	}
	setDateInput();

	//prevent form submission for all form with btn with data-action
	function preventFormSubmission(){
		f = $('form.preventSubmit');
		$.each(f,function(i,v){
			$.each($(v).find('button, .btn'),function(ii,vv){
				aa = $(vv).data('action');
				if(typeof aa !== 'undefined'){
					$(document).on('submit',$(vv),function(e){
						e.preventDefault();
						//buttonActions(aa);
					});
				}
			});
		});
	}
	preventFormSubmission();

	//action buttons
	function buttonActions(){
		
		$(document).on('click','button, .btn',function(e){
			btn = $(this);
			a = btn.data('action');
			f = btn.closest('form');
			if(typeof a !== 'undefined'){
				console.log('asdadasdasdas');
				showError();
				e.preventDefault();
				formData = f.serialize();
				projectid = $('.project_id').val();
				switch(a){
					case 'addTeamMemberModal':
						ajaxCallback(formData, '/user/search/modal', function (d) {
							if(d.status == false){
								//showError(d.errors);
							} else {
								if($('#searchusermodal').length == 0){
									$('body').append(d.view);
									preventFormSubmission();
								}
								$('#searchusermodal').modal('show');
							}
						});
					break;
					case 'addTeamMember':
						userid = btn.data('userid');
						li = btn.closest('li');
						tm = $('.team_members').val();
						tmarr = tm.split(',');
						tl = $('.projectteammemberscontainer').data('teamleader');
						if(userid != tl && $.inArray(""+userid+"",tmarr) < 0){
							$('.projectteammemberslist>ul').append(li);
							btn.html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Хасах');
							btn.data('action','removeTeamMember');
							tmarr.push(userid);
							$('.team_members').val(tmarr.join());
						};
					break;
					case 'removeTeamMember':
						userid = btn.data('userid');
						tm = $('.team_members').val();
						tmarr = tm.split(',');
						li = btn.closest('li');
						li.remove();
						i = tmarr.indexOf(""+userid+"");
						if(i > -1){
							tmarr.splice(i,1);
						}
						$('.team_members').val(tmarr.join());
					break;
					case 'searchUser':
						ajaxCallback(formData, '/user/search/list', function (d) {
							if(d.status == false){
								showError(d.errors);
							} else {
								$('.userlistmodal').html(d.view);
							}
						});
					break;
					case 'addGoalModal':
						ajaxCallback(formData, '/project/add/goalmodal', function (d) {
							if(d.status == false){
								//showError(d.errors);
							} else {
								if($('#addgoalmodal').length == 0){
									$('body').append(d.view);
									preventFormSubmission();
								}
								$('#addgoalmodal').modal('show');
								initStartEnd();
							}
						});
					break;
					case 'addGoal':
						ajaxCallback(formData+'&project_id='+projectid, '/project/add/goal', function (d) {
							if(d.status == false){
								showError(d.errors);
							} else {
								$('.projectgoalslist>ul').append(d.view);
								$('#addgoalmodal').modal( 'hide' ).data( 'bs.modal', null );
							}
						});
					break;
					case 'removeGoal':
						goalid = btn.data('goalid');
						li = btn.closest('li');
						ajaxCallback(formData+'&project_id='+projectid+'&goalid='+goalid, '/project/remove/goal', function (d) {
							if(d.status == false){
								showError(d.errors);
							} else {
								li.remove();
							}
						});
					break;
					case 'addRewardModal':
						ajaxCallback(formData, '/project/add/rewardmodal', function (d) {
							if(d.status == false){
								//showError(d.errors);
							} else {
								if($('#addrewardmodal').length == 0){
									$('body').append(d.view);
									preventFormSubmission();
								}
								$('#addrewardmodal').modal('show');
								
								if($('#reward_image').length > 0){
									imageUpload('reward_image','/project/upload/reward');
								}
								setDateInput();
							}
						});
					break;
					case 'addReward':
						ajaxCallback(formData+'&project_id='+projectid, '/project/add/reward', function (d) {
							if(d.status == false){
								showError(d.errors);
							} else {
								$('.projectrewardslist>ul').append(d.view);
								$('#addrewardmodal').modal( 'hide' ).data( 'bs.modal', null );
							}
						});
					break;
					case 'removeReward':
						rewardid = btn.data('rewardid');
						li = btn.closest('li');
						ajaxCallback(formData+'&project_id='+projectid+'&rewardid='+rewardid, '/project/remove/reward', function (d) {
							if(d.status == false){
								showError(d.errors);
							} else {
								li.remove();
							}
						});
					break;
				}
			}
		});
	}
	buttonActions();

	//show error function, errors should be 'element':['errorText']
	function showError(errors){
		//clean errors first
		$('.form-group').removeClass('has-error has-feedback');
		$('.help-block.with-errors').remove();
		//console.log(errors);
		//show errors
		if(typeof errors !== 'undefined'){
			$.each(errors,function(i,v){
				formgroup = $('#'+i).closest('.form-group');
				errorblock = $('<div class="help-block with-errors"><ul class="list-unstyled"></ul></div>');
				$.each(v,function(vi,vv){
					errorblock.append('<li>'+vv+'</li>');
				});
				formgroup.append(errorblock);
				formgroup.addClass('has-error has-feedback');
			});
		}
	}

	//for every step 
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
					ajaxCallback(formData, '/project/postnext', function (d) {
						if(d.status == false){
							showError(d.errors);
						} else {
							stepcontainer.html(d.view);
							imageUpload('image');
						}
					});
				break
				case 'addprojectdetail':
					ajaxCallback(formData, '/project/postnext', function (d) {
						if(d.status == false){
							showError(d.errors);
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
	
	if($('#image').length > 0){
		imageUpload('image','/project/upload/image');
	}
	
	function imageUpload(id,url){
		if($('#upload_'+id).length > 0) {
			$('#upload_'+id).fileupload({
				url: url,
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