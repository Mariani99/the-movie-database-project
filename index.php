<?php require './functions.php'; get_header('Home');
    $movie_list = getMdbApi('https://api.themoviedb.org/3/movie/upcoming');
    $popular_actors = getMdbApi('https://api.themoviedb.org/3/person/popular');

?>
<div class="bg" style="background-image: url('./img/background.jpg')"></div>
<div class="bg-mask"></div>
<div class="container movie-wrap">
    <h1 class="text-white">Upcoming Movies</h1>
    <div class="row">
        <?php
            $movie_counter=0;

            foreach($movie_list->results as $movie):
                if($movie_counter <=9):
                    $movie_counter++;
        ?>
                    <div class="col-sm-4 col-md-4 col-lg-2">
                        <div class="card">
                                <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->poster_path; ?>" class="card-img-top" alt="No image found">
                                <div class="card-body card-movie">
                                    <h5 class="card-title"><?php echo $movie->original_title; ?></h5>
                                    <p><?php echo $movie->release_date; ?></p>
                                    <p><?php get_genre($movie->genre_ids); ?></p>
                                    <a href="movie.php?movie_id=<?php echo $movie->id; ?>" class="btn btn-primary">Read more</a>
                                </div>
                        </div>
                    </div>
            <?php endif; endforeach; ?>
            <h3><a href="movie-list.php"><span class="badge text-bg-warning">Go to Movie List</span></a></h3>
    </div>

    <h2 class="text-white">Most Popular Actors</h2>
    <div class="row">
        <?php
            $actor_counter=0;
            foreach($popular_actors->results as $actor):
                if($actor_counter<=9):
                    if($actor->known_for_department === 'Acting'):
                        $actor_counter++;
        ?>
                        <div class="col-sm-4 col-md-4 col-lg-2">
                            <div class="card">
                                    <img src="https://image.tmdb.org/t/p/w500/<?php echo $actor->profile_path; ?>" class="card-img-top" alt="No image found">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $actor->name; ?></h5>
                                        <a href="actor.php?actor_id=<?php echo $actor->id; ?>" class="btn btn-primary">Read more</a>
                                    </div>
                            </div>
                        </div>
        <?php endif; endif; endforeach;  ?>
    </div>
    <h3><a href="actor-list.php"><span class="badge text-bg-warning">Go to Actor List</span></a></h3>
</div>
<?php get_footer(); ?>