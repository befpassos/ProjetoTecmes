
<nav>
    <div class="nav-wrapper">
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <a href="/ProjetoTecmes/views/home.php" class="brand-logo red-text">TECMES</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/ProjetoTecmes/views/home.php">Página Principal</a></li>
            <li><a href="/ProjetoTecmes/views/vendas.php">Vendas</a></li>
            <li><a href="/ProjetoTecmes/Login/logout.php">Sair</a></li>
        </ul>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background" style="background-color: #118AB2;">
      </div>
      <i class="material-icons medium">account_circle</i>
      <a href="#name"><span class="black-text name"><?= $_SESSION['nome'] ?></span></a>
      <a href="#email"><span class="black-text email"><?= $_SESSION['email'] ?></span></a>
    </div></li>
    <li><a href="/ProjetoTecmes/views/ordemProducao.php"><i class="material-icons">add_circle</i>Painel de OP</a></li>
    <li><a href="/ProjetoTecmes/views/produtos.php"><i class="material-icons">widgets</i>Produtos</a></li>
    <li><a href="/ProjetoTecmes/views/consultaProducaoOp.php"><i class="material-icons">assignment</i>Produção</a></li>
    <li><a href="/ProjetoTecmes/views/vendas.php"><i class="material-icons">show_chart</i>Vendas</a></li>
    <li><a href="/ProjetoTecmes/Login/logout.php"><i class="material-icons">exit_to_app</i>Sair</a></li>

    <!-- <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li> -->
  </ul>