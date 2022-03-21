<?php require_once "dependencias.php"; ?>

<?php 
    
    $idusuario = $_SESSION['iduser'];
    require_once "../classes/conexao.php"; 
    $c= new conectar();
    $conexao=$c->conexao();

    $sql = "SELECT funcao from usuarios where id = '$idusuario'";
    $result = mysqli_query($conexao, $sql);
    $mostrar=mysqli_fetch_row($result);

?>


<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Gestão - Laboratório</title>
  <link rel="shortcut icon" href="../img/kdebecker.png">
</head>
<body>

  <!-- Inicio Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Home</a>
            </li>

            
          </li>


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="servicos.php">Lançar Serviços</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-file"></span> Consultas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="servico_tabela.php">Histórico Serviços</a></li>
            </ul>
          </li>
          
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Opções   <span class="caret"></span></a>
            <ul class="dropdown-menu">
            
              <li> <a style="color: red" href="../procedimentos/sair.php"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
                    
            </ul>
          </li>

        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.contatiner -->
  </div>
</div>
<!-- Main jumbotron for a primary marketing message or call to action -->





<!-- /container -->        


</body>
</html>

