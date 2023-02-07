<?php
    define('API_KEY', '9cc482abbbf848446a73c5cc665240e7');

    function getMdbApi($url, $query_string = ''){
        $url = $url."?api_key=".API_KEY.$query_string;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        return json_decode(curl_exec($ch));
    }

    function get_header($title = ''){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="script.js"></script>
    </head>
    <body> 
<?php
    } // get_header()

    function get_footer(){
?>
    </body>
</html>
<?php
    } // get_footer();

    function get_genre($genre_ids){
        $results = getMdbApi('https://api.themoviedb.org/3/genre/movie/list');

        foreach ($results->genres as $genre) {
            if(in_array($genre->id, $genre_ids)){
                echo '<span class="badge rounded-pill text-bg-danger">'.$genre->name.'</span>';
            }
        }
    }

    function get_official_trailer_id($videos){
        //var_dump($videos);

        foreach($videos as $video){
            if(strtolower($video->name) === 'official trailer'){
                return $video->key;
            }
        }
    }