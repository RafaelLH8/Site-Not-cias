<html>
<main>
<div class="panel-heading"><h1>Notícias</h1></div>
<div class="panel panel-primary">

<div class="panel-heading"><h1><?php echo $noticia->titulo ?></h1></div>
    <?php echo $noticia->descricao?>

    <div class='data'>
        <span class="label label-primary"><?php echo $noticia->data ?></span>
        <span class="label label-primary"><?php echo "Por:".$noticia->nome_usuario ?></span>
    </div>

</div>

    <div class="panel panel-primary">
      <?php
      if($noticia->comentario != false){
        foreach($noticia->comentario AS $comentario){
          ?>
          <div class="panel-heading">
              <h5 class="panel-title">Comentarios</h5>
          </div>
          <div class="coments">
              <p class="nome-user"><?php echo $comentario->nome ?></p>
              <p class="coment-user"><?php echo $comentario->comentario ?></p>
              <?php echo '<p><a class="btn btn-danger" href="'.HOME_URI.'Comentario/deletar/'.$comentario->id.'"><span class = "glyphicon glyphicon-trash"></a></p>'?>
          </div>
          <?php

        }
      }
      ?>
        <form class="form" method="post" action="<?php echo HOME_URI?>comentario/salvar">
            <div class="form-group">
              <input type="text" class="form-control" name="comment" placeholder="Adicione um comentário">
              <input type="hidden" name="hid" value="<?php echo $noticia->id?>">
              <div class="input-form">
                <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
              </div>
            </div>
        </form>
    </div>
</div>

</main>
</html>
