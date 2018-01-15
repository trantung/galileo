$(document).ready(function(){

	$(document).on('click', '.item.select-subject-wrapper >.remove.remove-ajax', function(){
		var classId = $(this).attr('class-id');
		var subjectId = $(this).attr('subject-id');
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
    	var data = $(this).serializeArray();
    	var form_data = new FormData(this);
    	// console.log(data)
        $.each( $(this).find('input[type="file"]'), function(i, file) {
        	// console.log($(file).attr('name'));
		    // form_data.append($(file).attr('name'), $(file).prop('files')[0]);
		    // console.log($(file).attr('name'));
		});
        $.each( $(this).find('input'), function(i, input) {
        	if( $(input).attr('type') != 'file' ){
		    	// form_data.append($(input).attr('name'), $(input).val());
        	}
		});
		// console.log(form_data);

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