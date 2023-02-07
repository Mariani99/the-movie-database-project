<?php require './functions.php';

$actor_id = $_GET['actor_id'];
$actor = getMdbApi('https://api.themoviedb.org/3/person/'.$actor_id);
$images = getMdbApi('https://api.themoviedb.org/3/person/'.$actor_id.'/images');
$movies = getMdbApi('https://api.themoviedb.org/3/person/'.$actor_id.'/movie_credits');

get_header($actor->name);
?>

<div class="bg" style="background-image: url('https://wallpaperaccess.com/full/1820712.jpg')"></div>
<div class="bg-mask"></div>  

<div class="container movie-wrap">
    <div class="row">
        <div class="col">
            <img src="https://image.tmdb.org/t/p/w500/<?php echo $actor->profile_path; ?>" alt="" style="height: 100vh;">
        </div>
        <div class="col">
            <a href="../"><span class="badge text-bg-warning">Home</span></a>
            <h1 class="text-white"><?php echo $actor->name; ?><span class="badge bg-secondary"><?php echo $actor->birthday; ?></span></h1>
            <?php if($actor->place_of_birth != null): ?>
                <p><span class="badge rounded-pill text-bg-success"><?php echo $actor->place_of_birth; ?> </span></p>
            <?php endif; ?>
            <?php if($actor->deathday != null):?>
                <p><span class="badge rounded-pill text-bg-danger">Deathday: <?php echo $actor->deathday; ?></span></p>
            <?php endif; ?>
                <p class="text-white">Popularity: <?php echo '<b>'.$actor->popularity.'</b>'; ?></p>
            <?php if($actor->biography != null):?>
                <p class="text-white"><b>Biography</b></p>
                <p class="text-white"><?php echo $actor->biography; ?></p>
            <?php endif; ?>
            </div>
    </div>

<?php if($images->profiles != null): ?>
    <h2 class="text-white">Gallery</h2>
    <div class="row">
            <?php
                $images_counter = 0;
                foreach($images->profiles as $image):
                    if($images_counter <= 9):
                        $images_counter++;
            ?>
                    <div class="col-sm-4 col-md-4 col-lg-2">
                        <div class="card" style="width: 11rem;">
                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $image->file_path; ?>" alt="">
                        </div>
                    </div>
            <?php
                    endif;
                endforeach;
            ?>
    </div>
<?php endif; ?>

    <h3 class="text-white">Movies</h3>
    <div class="row">
            <?php
                foreach($movies->cast as $movie):
            ?>
                    <div class="col-sm-4 col-md-4 col-lg-2">
                        <div class="card" style="width: 11rem;">
                        <?php if($movie->poster_path != null){ ?>
                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->poster_path; ?>" class="card-img-top" alt="No image found">
                        <?php }else{ ?>
                            <img src="./img/default-movie.jpg" class="card-img-top" alt="No image found">
                        <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $movie->original_title; ?></h5>
                                <p><span class="badge text-bg-success"><?php echo $movie->character; ?></span></p>
                                <a href="movie.php?movie_id=<?php echo $movie->id; ?>" class="btn btn-primary">Read more</a>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            ?>
    </div>
</div>