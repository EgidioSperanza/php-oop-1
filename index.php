<?php

$key = "e0151c8f32093eec292358373e03c7c1";
$json = file_get_contents("https://api.themoviedb.org/3/movie/upcoming?api_key=$key&language=it");

$response = json_decode($json, true);
$result = $response['results'];
// var_dump($result);


class UpcomingMovie {
    public $title;
    public $overview;
    public $photo_url;
    public $genres;
    public $release_date;

    function __construct($_result)
    {
        $this->title=$_result['original_title'];
        $this->overview=$_result['overview'];
        $this->photo_url="https://www.themoviedb.org/t/p/original".$_result['poster_path'];
        $this->genres=$_result['genre_ids'];
        $this->release_date=$_result['release_date'];
    }
}

$movies=[];
foreach($result as $key => $value){
    array_push($movies, "movie_$key");
}
// var_dump($movies);
foreach($movies as $key => $value){
    $value= new UpcomingMovie($result[$key]);
    var_dump($value);
}
?>