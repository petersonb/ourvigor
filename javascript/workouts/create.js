

function addExercise() {
	$.ajax({
		url:"/exercises/load_create_form",
		success:function (data) {$('#exerciseTable').append(data); },
		dataType: 'html'
	});
}

$(document).ready( function () {
    
});
