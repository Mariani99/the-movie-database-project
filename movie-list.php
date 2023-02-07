<?php require './functions.php'; get_header('Movie List');

    $movie_list = getMdbApi('https://api.themoviedb.org/3/discover/movie', '&sort_by=original_title.asc');
?>
<div class="bg" style="background-image: url('./img/background.jpg')"></div>
<div class="bg-mask"></div>
<div class="container movie-wrap">
    <div class="nav-links" style="display: flex; align-items: center;">
        <h1 class="text-white">Movie List</h1>
        <a href="../" class="ml-2" style="margin-left: 20px"><span class="badge text-bg-warning">Home</span></a>
    </div>
    <input type="search" placeholder="Filter by name, year, genre or title" name="search" class="form-control filter-input" onkeyup="filterMovie();" required>
    <div class="row mt-2">
        <?php
            foreach($movie_list->results as $movie):
        ?>
                <div class="col-sm-4 col-md-4 col-lg-2">
                    <div class="card">
                        <?php if($movie->poster_path != null){ ?>
                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->poster_path; ?>" class="card-img-top" alt="No image found">
                        <?php }else{ ?>
                            <img src="./img/default-movie.jpg" class="card-img-top" alt="No image found">
                        <?php } ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $movie->original_title; ?></h5>
                            <p><?php echo $movie->release_date; ?></p>
                            <p><?php get_genre($movie->genre_ids); ?></p>
                            <a href="movie.php?movie_id=<?php echo $movie->id; ?>" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
</div>
<?php get_footer(); ?>