$(document).ready(function(){
    /*
    var json;
    $.ajax ({
	dataType : "json",
	url : '/api/exerciselogs/exercise/2',
    });

	json = $.parseJSON(json);
	alert(json);
	*/

	var exercise_id = $('#exercise_id').val()
	var jsonUrl = '/api/exerciselogs/exercise/' + exercise_id;
	var jsonData;
	$.getJSON(jsonUrl,function(data){
		//data = json;   
		test(data);
	});         

	
	
	function test(data) {
		console.log(data);

		dateList = [];
		data.forEach(function(obj){
			console.log(obj.date);
			obj.distance = parseFloat((obj.distance * .000621371).toFixed(2));
			dateList = dateList.concat([[obj.date,obj.distance]]);
		});

		console.log(dateList);

		//var plot2 = $.jqplot ('chart2', [[3,7,9,1,5,3,8,2,5]], {
		var plot2 = $.jqplot ('chart2', [dateList], {
			title: 'Distance',

			
			axesDefaults: {
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer
			},

			seriesDefaults: {
				rendererOptions: {
					smooth: true
				}
			},
						
			axes: {

				xaxis: {
					label: "Date",
					renderer:$.jqplot.DateAxisRenderer,
					pad: 0
				},
				yaxis: {
					label: "Distance"
				}
			}
		});
	}
});
