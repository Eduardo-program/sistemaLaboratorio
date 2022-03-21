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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tags"></span> Gestão Estoque <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT" || $mostrar[0] == "Analista" || $mostrar[0] == "Técnico III"): ?>
              <li><a href="entrada_avulsa.php">Entrada</a></li>
              <?php endif; ?>
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT" || $mostrar[0] == "Analista"): ?>
              <li><a href="saidas.php">Saída</a></li>
              <?php endif; ?>
              <li><a href="notas.php">Lançar NF</a></li>
            </ul>
          </li>
		  <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-bookmark"></span> Compras <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT"): ?>
              <li><a href="lanca_compra.php">Ordem de Compra</a></li>
              <li><a href="compras_cotacao.php">Confirma Cotação</a></li>
              <li><a href="compras_compra.php">Confirma Compra</a></li>
              <?php endif; ?>
              <li><a href="compras_recebe.php">Confirma Recebimento</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-folder-open"></span> Cadastros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT" || $mostrar[0] == "Analista"): ?>
              <li><a href="lojas.php">Lojas</a></li>
              <?php endif; ?>
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT"): ?>
              <li><a href="produtos.php">Produtos</a></li>
              <?php endif; ?>
              <li><a href="categorias.php">Categorias</a></li>
              <li><a href="fornecedores.php">Fornecedor</a></li>
              <li><a href="servicos.php">Lançar Serviços</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-file"></span> Consultas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="produtos_lista.php">Produtos</a></li>
              <li><a href="produtos_estoque.php">Estoque</a></li>
              <li><a href="ordens_todas.php">Ordens</a></li>
              <li><a href="servico_tabela.php">Histórico Serviços</a></li>
			        <li><a href="compra_tabela.php">Histórico Compras</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Ordens de Serviço<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT" || $mostrar[0] == "Analista" || $mostrar[0] == "Técnico III"): ?>
              <li><a href="ordens_nova.php">Nova Ordem</a></li>
              <?php endif; ?>
              <li><a href="ordens_encerrar.php">Encerrar Ordem</a></li>
              <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT"): ?>
              <li><a href="ordens.php">Gerenciador de OS</a></li>
              <?php endif; ?>
            </ul>
          </li>
          
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Opções   <span class="caret"></span></a>
            <ul class="dropdown-menu">
            <?php if( $mostrar[0] == "Administrador" || $mostrar[0] == "ROOT"): ?>
              <li> <a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Gestão Usuários</a></li>
              <?php if( $mostrar[0] == "ROOT"): ?>
              <li> <a href="fechamento.php"><span class="glyphicon glyphicon-floppy-saved"></span> Backup DataBase</a></li>
              <?php endif; ?>
            <?php endif; ?>
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

