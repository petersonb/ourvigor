<?php

/*

*/
class ExerciseLog extends DataMapper {
	
	var $has_one = array('exercise');
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}

	public function getData()
	{
		$data = array (
			'id'          => $this->id,
			'exercise_id' => $this->exercise_id,
			'date'        => $this->date,
			'time'        => $this->time,
			'distance'    => $this->distance,
			'laps'        => $this->laps,
			'weight'      => $this->weight,
			'reps'        => $this->repetitions,
			'sets'        => $this->sets
		);

		return $data;
	}
}

/* End of file exerciselog.php */
/* Location: ./application/models/exerciselog.php */
