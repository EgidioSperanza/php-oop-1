<?php

$key = 'e0151c8f32093eec292358373e03c7c1';
$json = file_get_contents(
    "https://api.themoviedb.org/3/movie/upcoming?api_key=$key&language=it"
);

$response = json_decode($json, true);
$result = $response['results'];
// var_dump($result);

class UpcomingMovie
{
    public $title;
    public $overview;
    public $photo_url;
    public $genres;
    public $release_date;

    function __construct($_result)
    {
        $this->title = $_result['original_title'];
        $this->overview = $_result['overview'];
        $this->photo_url =
            'https://www.themoviedb.org/t/p/original' . $_result['poster_path'];
        $this->genres = $_result['genre_ids'];
        $this->release_date = date("d-m-Y", strtotime($_result['release_date']));
    }

    public function printMovie()
    {
        echo "<div class='card'>";
        echo "<h1>$this->title</h1>";
        echo "<div class='poster'>
                <p>$this->overview</p>
                <img src=\"$this->photo_url\">
            </div>";
        if($this->release_date>date("d-m-Y")){
            echo "<p>In uscita il $this->release_date</p>";
        }else{
            echo "<p>Uscito il $this->release_date</p>";
        }
        echo '</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Movies</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>MovieDBool</h1>
    </header>
    <main>
        <?php foreach ($result as $key => $value) {
            $value = new UpcomingMovie($result[$key]);
            $value->printMovie();
            // var_dump($value);
        } ?>
    </main>
    <footer>
        <h1>MovieDBool</h1>
    </footer>
</body>
</html>