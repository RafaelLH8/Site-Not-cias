<main>
<a href="<?php echo HOME_URI;?>usuario/criar" class="btn">ADD</a>
<table class="table">
  <thead>
    <tr><td>#</td><td>Nome</td><td>Email</td><td></td></tr>
  </thead>
  <tbody>
    <?php
      $conexao = Conexao::getInstance();
      $sql = 'SELECT * FROM usuario';
      $resultado = $conexao->query($sql);
      while($usuarios = $resultado->fetch(PDO::FETCH_OBJ)){
        echo
          '
            <tr>
                <td>'.$usuarios->id_usuario.'</td>
                <td id="nome'.$usuarios->id_usuario.'">'.$usuarios->nome.'</td>
                <td id="email'.$usuarios->id_usuario.'">'.$usuarios->email.'</td>
                <td> <a class="btn btn-danger" href="'.HOME_URI.'usuario/deletar/'.$usuarios->id_usuario.'"><span class = "glyphicon glyphicon-trash"></a> </td>
          </tr>
        ';
      }
    ?>
  </tbody>
</table>
</main>
