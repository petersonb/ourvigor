
var exercise_count = 0;
var exercise_index = 1;

function addExercise() {
	$.ajax({
		url:"/exercises/load_create_form/"+exercise_index,
		success:function (data) {$('#exerciseTable').append(data); },
		dataType: 'html'
	});
    exercise_count++;
    exercise_index++;
    updateExerciseCount();
}

function removeExercise(index) {
    $('#exercise_'+index).remove();
    exercise_count--;
    updateExerciseCount();
}

function updateExerciseCount()
{
    $('#exerciseCount').val(exercise_count);
}

$(document).ready( function () {
    exercise_count = Number($('#exerciseCount').val());
    exercise_index = Number($('#exerciseCount').val()) + 1;
});
