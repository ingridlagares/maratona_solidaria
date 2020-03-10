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
        list ($equipes["estatistica"]["pt_total"], $equipes["estatistica"]["tam"], $equipes["estatistica"]["pt_final"],$equipes["estatistica"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'estatistica' ) );
        $sum = $sum + $equipes["estatistica"]["pt_final"];
        list ($equipes["matcomp"]["pt_total"], $equipes["matcomp"]["tam"], $equipes["matcomp"]["pt_final"],$equipes["matcomp"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'matcomp' ) );
        $sum = $sum + $equipes["matcomp"]["pt_final"];
        list ($equipes["quimica"]["pt_total"], $equipes["quimica"]["tam"], $equipes["quimica"]["pt_final"],$equipes["quimica"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'quimica' ) );
        $sum = $sum + $equipes["quimica"]["pt_final"];
        list ($equipes["atuariais"]["pt_total"], $equipes["atuariais"]["tam"], $equipes["atuariais"]["pt_final"],$equipes["atuariais"]["equipe"])  = calcular_pontuacao( get_user_by( 'login', 'atuariais' ) );
        $sum = $sum + $equipes["quimica"]["pt_final"];
        $equipe_ord = ordenar_equipes($equipes);
        ?>
        <div id="barras_principal">
            <?php
            $i = 1;
                foreach($equipe_ord as $equipe){
                    ?>
                    <div id="barras">
                    <p><? echo $equipe["equipe"] ?>:</p>
                        <?php if($equipe["pt_final"]): ?>
                          <div class="barra<?=$i?>" style="width:<?=($equipe["pt_final"] / $sum)*100 ?>%"><p> <?=$equipe["pt_final"] ?> pontos</p></div>
                        <?php else: ?>
                         <div class="barra<?=$i?>" style="width:0%"><p> <?=$equipe["pt_final"] ?> pontos</p></div>
                     <?php endif; ?>
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
