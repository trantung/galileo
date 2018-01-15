$(document).ready(function(){

	$(document).on('click', '.item.select-subject-wrapper >.remove.remove-ajax', function(){
		var classId = $(this).attr('class-id');
		var subjectId = $(this).attr('subject-id'),
		_this = $(this);
		$.ajax({
			'url': '/ajax/delete',
			'method': 'POST',
			'data': {
				'class_id': classId,
				'subject_id': subjectId,
			},
			success: function(data) {
				console.log(data);
			}
		});
    })

    //////// Save document in each lesson
    $(document).on('submit', 'form.document-of-lesson-form', function(e){
    	var data = $(this).serializeArray(),
    	form_data = new FormData(this),
		_this = $(this);

    	$.ajax({
			url: '/ajax/save-document',
			method: 'POST',
    		enctype: 'multipart/form-data',
    		processData: false,
    		contentType: false,
    		dataType: 'json',
    		cache: false,
			data: form_data,
			success: function(data) {
				var parent = _this.parent().parent();
				parent.find('>.wrap-multi-file-each-lesson').hide(300, function(){
					$(this).remove();
					parent.append(data);
				})
				console.log(data);
			},
			error: function(error){
				console.log(error);
			}
		});
    	e.preventDefault();
    	return false;
    })

    /// Get class, subject and level list when select center in admin user form
    $('.user-create-form select.select-center').on('change', function(){
    	var id = $(this).val(),
    	wrapper = $(this).parents('form').find('.get-list-level-by-center-wrap');
		console.log(id);
    	wrapper.empty();
    	if( id != '' ){
    		$.ajax({
				'url': '/ajax/get-list-class-by-center',
				'method': 'POST',
				'data': {
					center_id: id,
				},
				success: function(data) {
					console.log('get list class subject level success!');
					wrapper.append(data);
				},
				error: function(error){
					console.log(error);
				}
			});
    	}
    })

})