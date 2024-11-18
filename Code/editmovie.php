<?php
  require_once("templetes/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/GameDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $gameDao = new GameDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

  } else {

    $game = $gameDao->findById($id);

    // Verifica se o jogo existe
    if(!$game) {

      $message->setMessage("O jogo não foi encontrado!", "error", "index.php");

    }

  }

  // Checar se o jogo tem imagem
  if($game->image == "") {
    $game->image = "game_cover.jpg";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?= $game->title ?></h1>
          <p class="page-description">Altere os dados do jogo no formulário abaixo:</p>
          <form id="edit-game-form" action="<?= $BASE_URL ?>game_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $game->id ?>">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu jogo" value="<?= $game->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="length">Duração:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do jogo" value="<?= $game->length ?>">
            </div>
            <div class="form-group">
              <label for="category">Categoria:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação" <?= $game->category === "Ação" ? "selected" : "" ?>>Ação</option>
                <option value="Drama" <?= $game->category === "Drama" ? "selected" : "" ?>>Drama</option>
                <option value="Comédia" <?= $game->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                <option value="Fantasia / Ficção" <?= $game->category === "Fantasia / Ficção" ? "selected" : "" ?>>Fantasia / Ficção</option>
                <option value="Romance" <?= $game->category === "Romance" ? "selected" : "" ?>>Romance</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $game->trailer ?>">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o jogo..."><?= $game->description ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar jogo">
          </form>
        </div>
        <div class="col-md-3">
          <div class="game-image-container" style="background-image: url('<?= $BASE_URL ?>img/games/<?= $game->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templetes/footer.php");
?>
