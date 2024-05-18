<?php
  require_once("templetes/header.php");

  require_once("dao/MovieDAO.php");

  // DAO dos filmes
  $movieDao = new MovieDAO($conn, $BASE_URL);

  $latestMovies = $movieDao->getLatestMovies();

  $romanceMovies = $movieDao->getMoviesByCategory("Romance");

  $comedyMovies = $movieDao->getMoviesByCategory("Comédia");

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no GBL Filmes</p>
    <div class="movies-container">
      <?php foreach($latestMovies as $movie): ?>
        <?php require("templetes/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($latestMovies) === 0): ?>r
        <p class="empty-list">Ainda não há filmes cadastrados!</p>
      <?php endif; ?>
    </div>
    <h2 class="section-title">Romance</h2>
    <p class="section-description">Veja os melhores filmes de Romance</p>
    <div class="movies-container">
      <?php foreach($romanceMovies as $movie): ?>
        <?php require("templetes/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($romanceMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes de Romance cadastrados!</p>
      <?php endif; ?>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
      <?php foreach($comedyMovies as $movie): ?>
        <?php require("templetes/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($comedyMovies) === 0): ?>
        <p class="empty-list">Ainda não há filmes de comédia cadastrados!</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templetes/footer.php");
?>