<?php

ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

$api_url='http://data.gov.au/api/action/datastore_search?resource_id=3e39dd7d-e777-4f47-9160-95aaca34bff5&limit=5';

$data=file_get_contents($api_url);

$data=json_decode($data, true);

$quizlist = array();

$questions = array();


if(is_array($data)){
	foreach($data['result']['records'] as $recordKey => $recordValue) {
		$recordQuestion=$recordValue['English'];
		$recordAnswer1=$recordValue['Yugara'];
		$recordAnswer2=$recordValue['Yugambeh'];
		$recordAnswer3=$recordValue['Yugara'];



		if($recordQuestion && $recordAnswer1 && $recordAnswer2 && $recordAnswer3){
			$dataquestion = array();

			$dataquestion["question"] = $recordQuestion;
			$dataquestion["option1"] = $recordAnswer1;
			$dataquestion["option2"] = $recordAnswer2;
			$dataquestion["option3"] = $recordAnswer3;
			array_push($questions, $dataquestion);

		}		

		$quizlist["quizlist"] = $questions;
	}
}

// print_r($quizlist);

echo json_encode($quizlist);
// this put contents wont work without correct directory or permissions - see the cache example for how to
file_put_contents("cache/questions.json", json_encode($quizlist));

?>