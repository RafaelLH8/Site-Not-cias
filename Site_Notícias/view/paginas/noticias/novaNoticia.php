<main>
<div class="panel-heading"><h1>Adicione uma notícia</h1></div>
  <form class="form" method="post" action="<?php echo HOME_URI?>noticia/salvar">
   <div class="form-group">
     <input type="text" class="form-control" name="title" placeholder="Titulo">
     <input type="text" class="form-control" name="not" placeholder="Adicione uma notícia">
     <input type="hidden" name="hid" value="<?php echo $noticia->id?>">
     <div class="input-form">
       <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
     </div>
  </div>
</main>
