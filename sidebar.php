<?php
    $IDCarrello=isset($_SESSION["Carrello"]) ? $_SESSION["Carrello"]: "0";
    require "connector.php";
    $query="Select count(ID) as conta from prodotti_carrello where IDCarrello='$cart'";
    $query2="select Totale from carrello where ID='$cart'";
    if($result=$conn->query($query)){
        $row=$result->fetch_assoc();
    }
    if($result=$conn->query($query2)){
    $row2=$result->fetch_assoc();
    }
?>

<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.php"><img src="themes/images/ico-cart.png" alt="cart"><?php echo $row['conta']; ?> Items in your cart  <span class="badge badge-warning pull-right">€ <?php echo $row2['Totale']; ?></span></a></div>
    
    <?php
        $result = $conn->query("SELECT count(IDTipo) as Somma, categoria_prodotto.Nome as Nome, categoria_prodotto.ID as i
                                    from categoria_prodotto join tipo_prodotto 
                                    on categoria_prodotto.ID=tipo_prodotto.IDCategoria
                                    join prodotto
                                    on tipo_prodotto.ID=prodotto.IDTipo
                                    group by (IDCategoria)");
        $open=1;
        while ($row = $result->fetch_assoc()) { 
    ?>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        <li class=<?php if ($open==1) echo "subMenu open"; else echo "subMenu";?>><a><?php echo $row["Nome"];echo " ["; echo $row["Somma"]; echo "]";?></a>
            <ul>
            <?php
            $result2 = $conn->query("select count(IDTipo) as Somma, IDTipo, tipo_prodotto.Nome as Nome, tipo_prodotto.IDCategoria as i2
                                    from prodotto 
                                    join tipo_prodotto
                                    on tipo_prodotto.ID=prodotto.IDTipo
                                    group by (IDTipo)");
            while ($row2 = $result2->fetch_assoc()) {
                if($row["i"]==$row2["i2"]){
            ?>
            <li>
            <a class="active" href="products.php?Type=<?php echo $row2['IDTipo'];?>"><i class="icon-chevron-right"></i>
                <?php
                     echo $row2["Nome"];echo " ["; echo $row2["Somma"]; echo "]";
                ?>
            </a>
            </li>
            <?php
                }
                $open=0; 
            } 
            ?>
            </ul>
        </li>

    </ul>
    <?php } ?>
    
    <!--Prodotto in basso a sinistra-->
    <br/>
    <br/>
    <?php
    $query="Select Totale From carrello Where ID='$IDCarrello'";
    $result=$conn->query($query);
    $row=$result->fetch_assoc();
    
    ?>
        <div class="caption">
              <h5>Payment Methods</h5>
        </div>
        <br/>
        <div style="padding:10px">
            <form action="<?php if($row['Totale']>0) echo "https://www.sandbox.paypal.com/cgi-bin/webscr";?>" method="post" target="_top">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="GM7YSE885TYPW">
                <input type="hidden" name="lc" value="IT">
                <input type="hidden" name="item_name" value="WebProject">
                <input type="hidden" name="amount" value="<?php echo $row['Totale']?>">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="button_subtype" value="services">
                <input type="hidden" name="no_note" value="1">
                <input type="hidden" name="no_shipping" value="2">
                <input type="hidden" name="rm" value="1">
                <input type="hidden" name="return" value="http://localhost/WebProject/paid.php">
                <input type="hidden" name="cancel_return" value="http://localhost/WebProject/">
                <input type="hidden" name="shipping" value="18.00">
                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                <input type="image" src="https://www.sandbox.paypal.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal è il metodo rapido e sicuro per pagare e farsi pagare online.">
                <img alt="" border="0" src="https://www.sandbox.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
            </form>  
        </div>
        <br/>		
</div>