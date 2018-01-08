$(document).ready(function(){

	$(document).on('click', '.item.select-subject-wrapper >.remove.remove-ajax', function(){
		var classId = $(this).attr('class-id');
		var subjectId = $(this).attr('subject-id');
		$.ajax({
			'url': '/ajax/delete',
			'method':'POST',
			'data': {
				'class_id': classId,
				'subject_id': subjectId,
			},
			success:function(tung) {
				console.log(tung);
			}
		});
    })

    /// Get class, subject and level list when select center in admin user form
    $('.user-create-form select.select-center').on('change', function(){
    	var id = $(this).val(),
    	wrapper = $(this).parents('form').find('.get-list-level-by-center-wrap');
    	
    	wrapper.empty();
    	if( id != '' ){
    		$.ajax({
				'url': '/ajax/get-list-class-by-center',
				'method':'POST',
				'data': {
					center_id: id,
				},
				success:function(data) {
					console.log(data);
				}
			});
    	}
    })

})