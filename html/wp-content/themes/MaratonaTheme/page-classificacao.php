<?php get_header(); ?>
<div class="container">
<div class="primary">
    <div id="content" role="main">
        <h2 class="center">Confira a classificação das equipes!</h2>
        <?php
        $sum = 0;
        list ($equipes["fisica"]["pt_total"], $equipes["fisica"]["tam"], $equipes["fisica"]["pt_final"],$equipes["fisica"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'fisica' ) );
        $sum = $sum + $equipes["fisica"]["pt_final"];
        list ($equipes["ccsi"]["pt_total"], $equipes["ccsi"]["tam"], $equipes["ccsi"]["pt_final"],$equipes["ccsi"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'ccsi' ) );
        $sum = $sum + $equipes["ccsi"]["pt_final"];
        list ($equipes["mat"]["pt_total"], $equipes["mat"]["tam"], $equipes["mat"]["pt_final"],$equipes["mat"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'mat' ) );
        $sum = $sum + $equipes["mat"]["pt_final"];
        $equipe_ord = ordenar_equipes($equipes);

        ?>
        <div id="barras_principal">
            <?php
            $i = 1;
                foreach($equipe_ord as $equipe){
                    ?>
                    <div id="barras">
                    <p><? echo $equipe["equipe"] ?>:</p>
                      <div class="barra<?=$i?>" style="width:<?=($equipe["pt_final"] / $sum)*100 ?>%"><p> <?=$equipe["pt_final"] ?> pontos</p></div>
                  </div>
                    <?php
                    $i = $i +1;
                }
            ?>
        </div>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
