<?php require './functions.php'; get_header('Actor List');

    $actor_list = getMdbApi('https://api.themoviedb.org/3/person/popular', '&sort_by=name.asc');
    // var_dump($actor_list);
?>
<div class="bg" style="background-image: url('./img/background.jpg')"></div>
<div class="bg-mask"></div>
<div class="container movie-wrap">
    <div class="nav-links" style="display: flex; align-items: center;">
        <h1 class="text-white">Actor List</h1>
        <a href="../" class="ml-2" style="margin-left: 20px"><span class="badge text-bg-warning">Home</span></a>
    </div>
    <input type="search" placeholder="Filter by name or movie" name="search" class="form-control filter-input" onkeyup="filterMovie();" required>
    <div class="row mt-2">
        <?php
            foreach ($actor_list->results as $actor):
                if($actor->known_for_department === 'Acting'):

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
        <?php endif; endforeach; ?>
    </div>
</div>