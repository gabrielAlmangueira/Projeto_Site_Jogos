<?php
  require_once("templetes/header.php");
  require_once("dao/GameDAO.php");

  // DAO dos jogos
  $gameDao = new GameDAO($conn, $BASE_URL);

  $latestGames = $gameDao->getLatestGames();

  $actionGames = $gameDao->getGamesByCategory("Ação");
  $dramaGames = $gameDao->getGamesByCategory("Drama");
  $comedyGames = $gameDao->getGamesByCategory("Comédia");
  $fantasyGames = $gameDao->getGamesByCategory("Fantasia / Ficção");
  $romanceGames = $gameDao->getGamesByCategory("Romance");

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Jogos novos</h2>
    <p class="section-description">Veja as críticas dos últimos jogos adicionados no GBL Jogos</p>
    <div class="games-container">
      <?php foreach($latestGames as $game): ?>
        <?php require("templetes/game_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($latestGames) === 0): ?>
        <p class="empty-list">Ainda não há jogos cadastrados!</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templetes/footer.php");
?>