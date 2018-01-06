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


})