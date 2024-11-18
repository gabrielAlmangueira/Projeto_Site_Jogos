<?php

  if(empty($game->image)) {
    $game->image = "movie_cover.jpg";
  }

?>

<div class="card game-card">
  <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
  <div class="card-body">
    <h5 class="card-title">
      <a href="<?= $BASE_URL ?>game.php?id=<?= $game->id ?>"><?= $game->title ?></a>
    </h5>
    <p class="card-text"><?= $game->description ?></p>
    <a href="<?= $BASE_URL ?>game.php?id=<?= $game->id ?>" class="btn btn-primary">Ver mais</a>
  </div>
</div>