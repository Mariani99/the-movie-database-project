<?php require './functions.php';
    $movie_id = $_GET['movie_id'];

    $movie              = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id);    
    $videos             = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id.'/videos');
    $video_id           = get_official_trailer_id($videos->results);
    $reviews            = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id.'/reviews');
    $credits            = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id.'/credits');
    $similar_movies     = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id.'/similar');
    $alternative_titles = getMdbApi('https://api.themoviedb.org/3/movie/'.$movie_id.'/alternative_titles'); 
    // var_dump($alternative_titles->titles);

    get_header($movie->original_title);
?>
<div class="bg" style="background-image: url('https://www.themoviedb.org/t/p/w1920_and_h800_multi_faces/<?php echo $movie->backdrop_path; ?>'")></div>
<div class="bg-mask"></div>    

<div class="container movie-wrap">
    <div class="row">
        <div class="col">
            <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->poster_path; ?>" alt="" style="height: 100vh;">
        </div>
        <div class="col">
            <a href="../"><span class="badge text-bg-warning">Home</span></a>
            <h1 class="text-white"><?php echo $movie->original_title; ?><span class="badge bg-secondary"><?php echo $movie->release_date; ?></span></h1>
            <?php foreach($alternative_titles->titles as $title):?>
                <p><span class="badge text-bg-primary"><?php echo $title->title;?></span></p>
            <?php endforeach; ?>



            <p><span class="badge rounded-pill text-bg-success">Language: <?php echo $movie->original_language; ?> </span></p>
            <?php
                echo '<p>';
                foreach ($movie->genres as $genre) {
                    echo '<span class="badge rounded-pill text-bg-danger">'.$genre->name.'</span>';
                }
                echo '</p>';
            ?>
            <p class="text-white">Popularity: <?php echo '<b>'.$movie->popularity.'</b>'; ?></p>
            <p class="text-white"><b>Synopsis:</b></p>
            <p class="text-white"><?php echo $movie->overview; ?></p>
            <?php 
                foreach ($movie->production_companies as $company){
                    echo '<span class="badge rounded-pill text-bg-warning">'.$company->name.'</span>';
                }
            ?>
            <div class="youtube-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video_id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <h2 class ="text-white">Cast</h2>
    <div class="row">
        <?php
            foreach($credits->cast as $cast):
                if($cast->known_for_department === 'Acting'):
        ?>            
                    <div class="col-sm-4 col-md-4 col-lg-2">
                        <div class="card">
                            <?php if($cast->profile_path != null){?>
                                <img src="https://image.tmdb.org/t/p/w500/<?php echo $cast->profile_path; ?>" class="card-img-top" alt="No image found">
                            <?php }else{ ?>
                                <img src="./img/default-actor.jpeg" class="card-img-top" alt="No image found">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $cast->name; ?></h5>
                                <a href="actor.php?actor_id=<?php echo $cast->id; ?>" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
        <?php
                endif;
            endforeach;
        ?>
    </div>
    
    <?php if(!empty($reviews->results)): ?>
        <h3 class="text-white">Reviews</h3>
        <div class="row">
            <?php
                foreach($reviews->results as $review):
            ?> 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $review->author; ?></h5>
                                <p class="card-text"><?php echo $review->content; ?></p>
                            </div>
                        </div>
                    </div>
                <?php    
                    endforeach;
                ?>
        </div>
    <?php endif; ?>

    <h2 class ="text-white">Similar Movies</h2>
    <div class="row">
        <?php
            foreach($similar_movies->results as $movie):
        ?>            
                    <div class="col-sm-4 col-md-4 col-lg-2">
                        <div class="card">
                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->poster_path; ?>" class="card-img-top" alt="No image found">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $movie->original_title; ?></h5>
                                <a href="movie.php?movie_id=<?php echo $movie->id; ?>" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
        <?php
            endforeach;
        ?>
    </div>
</div>


<?php 
    get_footer();