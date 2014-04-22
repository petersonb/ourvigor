function loadDistanceGraph (data) {
	var allList  = [];
	var numDataPoints = 0;
	data.forEach(function(obj){
		obj.distance = parseFloat((obj.distance * .000621371).toFixed(2));
		allList  = allList.concat([[obj.date, obj.distance]]);
	});

	var width = 20;
	
	var plot2 = $.jqplot ('distChart', [allList], {
		title: 'Distance',
		animate: true,

		cursor: {
			show: true,
			zoom: true,
		},
		
		axesDefaults: {
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
		},
		
		seriesDefaults: {
			renderer: $.jqplot.BarRenderer,
			rendererOptions: {
				barWidth: width,
			}
		},
		
		axes: {

			xaxis: {
				label: "Date",
				renderer:$.jqplot.DateAxisRenderer,
				tickOptions:{
					formatString:'%b %#d',
				},

			},
			yaxis: {
				label: "Distance (mi)",
			}
		}
	});
}

function loadTimeGraph (data) {
	
	var allList  = [];
	var numDataPoints = 0;
	data.forEach(function(obj){
		obj.time = obj.time / 60;
		allList  = allList.concat([[obj.date, obj.time]]);
	});

	var width = 20;
	
	var plot2 = $.jqplot ('timeChart', [allList], {
		title: 'Time',
		animate: true,

		cursor: {
			show: true,
			zoom: true,
		},
		
		axesDefaults: {
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
		},
		
		seriesDefaults: {
			renderer: $.jqplot.BarRenderer,
			rendererOptions: {
				barWidth: width,
			}
		},
		
		axes: {

			xaxis: {
				label: "Date",
				renderer:$.jqplot.DateAxisRenderer,
				tickOptions:{
					formatString:'%b %#d',
				},

			},
			yaxis: {
				label: "Time (min)"
			}
		}
	});
	
}

function loadDistTimeGraph (data) {
	
	dateList = [];
	data.forEach(function(obj){
		obj.distance = parseFloat((obj.distance * .000621371).toFixed(2));
		var avgSpeed = obj.distance / (obj.time / 60 / 60);
		dateList = dateList.concat([[obj.date, avgSpeed]]);
	});

	var plot2 = $.jqplot ('distTimeChart', [dateList], {
		title: 'Average Speed',
		animate: true,


		cursor: {
			show: true,
			zoom: true,
			showTooltip: true,
		},
		
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
				tickOptions:{
					formatString:'%b %#d',
				},
				pad: 0
			},
			yaxis: {
				label: "Average Speed (mph)"
			}
		}
	});	
}

function loadWeightGraph (data) {
	dateList = [];
	data.forEach(function(obj){
		dateList = dateList.concat([[obj.date, obj.weight * 1.0]]);
	});

	var plot2 = $.jqplot ('weightChart', [dateList], {
		title: 'Weight Progress',
		animate: true,


		cursor: {
			show: true,
			zoom: true,
			showTooltip: true,
		},
		
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
				
				tickOptions:{
					formatString:'%b %#d',
				},
			},
			yaxis: {
				label: "Weight (lbs)"
			}
		}
	});	
}


$(document).ready(function(){

	var exercise_id = $('#exercise_id').val()
	var jsonUrl     = '/api/exercises/index/' + exercise_id;

	var makeRequest;


	
	$.getJSON(jsonUrl,function(exercise){
		loadGraphs(exercise);
	});
	
	function loadGraphs(exercise) {
		var fields = exercise.fields;
		
		var dist = fields['dist'] == 1;
		var time = fields['time'] == 1;
		var laps = fields['laps'] == 1;
		var wght = fields['wght'] == 1;
		var reps = fields['reps'] == 1;
		var sets = fields['sets'] == 1;
		
		var exercise_id = $('#exercise_id').val()
		var jsonUrl = '/api/exerciselogs/exercise/' + exercise_id;
		var jsonData;
		
		$.getJSON(jsonUrl,function(data){
			if (dist) {
				loadDistanceGraph(data);
				
				if (time) {
					loadDistTimeGraph(data);
				}
			}
			if (time) {
				loadTimeGraph(data);
			}

			if (wght) {
				loadWeightGraph(data);
			}
		});
		
	}
});
