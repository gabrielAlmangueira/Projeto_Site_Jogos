<?php
  require_once("templetes/header.php");

  require_once("dao/GameDAO.php");

  // DAO dos jogos
  $gameDao = new GameDAO($conn, $BASE_URL);

  // Resgata busca do usuário
  $q = filter_input(INPUT_GET, "q");

  $games = $gameDao->findByTitle($q);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
    <div class="games-container">
      <?php foreach($games as $game): ?>
        <?php require("templetes/game_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($games) === 0): ?>
        <p class="empty-list">Não há jogos para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  require_once("templetes/footer.php");
?>