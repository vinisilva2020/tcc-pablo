<h1></h1>

<section class="hero bg-image" data-image-src="img/fundo.png">
        <div class="hero-inner">
            <div class="container text-center font-white">
                <h1>Facilitando seu dia a dia </h1>
                <h1>Peça e receba onde estiver.</h1>
                <div class="banner-form">
                    <form class="form-inline">
                    </form>
                </div>
                <div class="steps">
                    <div class="step-item step1">
                        <h4><span style="color:white;">1. </span>Escolha seu pedido</h4>
                    </div>
                    <div class="step-item step2">
                        <h4><span style="color:white;">2. </span>Adicione ao carrinho</h4>
                    </div>
                    <div class="step-item step3">
                        <h4><span style="color:white;">3. </span>Delivery ou busca</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
<h1></h1>
<section class="popular">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 food-item">
                <div class="widget-heading">
                    <h3 class="widget-title text-dark">
                        Seu Carrinho
                    </h3>
                    <div class="clearfix"></div>
                    <div class="order-row bg-white">
                        <?php
                        $item_total = 0;
                        foreach ($_SESSION["cart_item"] as $item) {
                            ?>
                            <div class="title-row">
                                <?php echo $item["title"]; ?><a
                                    href="dishes.php?produto_id=<?php echo $_GET['produto_id']; ?>&action=remove&id=<?php echo $item["produto_id"]; ?>">
                                    <i class="fa fa-trash pull-right"></i></a>
                            </div>
                            <div class="form-group row no-gutter">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control b-r-0" value=<?php echo "$" . $item["produto_preco"]; ?>
                                        readonly id="exampleSelect1">
                                </div>
                            </div>
                            <?php
                            $item_total += ($item["preco"]);
                        }
                        ?>
                    </div>
                    <div class="widget-body">
                        <div class="preco-wrap text-xs-center" style="color: black;">
                            <p>TOTAL</p>
                            <h3 class="value"><strong>
                                    <?php echo "$" . $item_total; ?>
                                </strong></h3>
                            <p>Delivery gratis????(mudar)(bairro)</p>
                            <?php
                            if ($item_total == 0) {
                                ?>
                                <a href="checkout.php?produto_id=<?php echo $_GET['produto_id']; ?>&action=check"
                                    class="btn btn-danger btn-lg disabled">Finalizar Pedido</a>
                                <?php
                            } else {
                                ?>
                                <a href="checkout.php?produto_id=<?php echo $_GET['produto_id']; ?>&action=check"
                                    class="btn btn-success btn-lg active">Finalizar Pedido</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-9 food-item">
                <h2>Categoria 1</h2>
                <div class="row">
                    <?php
                    $query_res = mysqli_query($db, "select * from produtos");
                    while ($r = mysqli_fetch_array($query_res)) {
                        echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                                            <div class="food-item-wrap">
                                                <div class="figure-wrap bg-image" data-image-src="' . $r['produto_img'] . '"></div>
                                                <div class="content">
                                                    <h5><a href="produtos.php?produto_id='. $r['produto_nome'] . '</a></h5>
                                                    <div class="product-name">' . $r['descricao'] . '</div>
                    
                                                    <div class="preco-btn-block"> <span class="produto_preco">$' . $r['produto_preco'] . '</span> <a href="produtos.php?produto_id=' . $r['produto_id'] . '" class="btn theme-btn-dash pull-right">Adicionar</a> </div>
                                                </div>
                                                
                                            </div>
                                    </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<hr style="margin-top: 200px;">

</section>