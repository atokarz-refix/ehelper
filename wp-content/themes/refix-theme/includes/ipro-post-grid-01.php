<?php


add_shortcode('rfx_post_grid_01','rfx_post_grid_01');
function rfx_post_grid_01(){

ob_start();

    $posty = get_posts(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => 3,
        )
    );

    
$posty = array(1,2,3);
    ?>
<div class="rfx_post-grid-01">
    <div class="kontener">
        <?php
    foreach($posty as $item){
        ?>
        <div class="rfx_grid-item">
            <a href="#">
            <p><img style="max-width:100%;" width="375" height="250" loading="lazy" src="/wp-content/uploads/2022/07/bg-02.webp" srcset="/wp-content/uploads/2022/07/bg-02-768x512.webp 800w, /wp-content/uploads/2022/07/bg-02.webp" sizes="(max-width: 800px) 800px, 1200px"></p>
            <h4 class="grid-title">Tytuł wpisu 01</h4>
            <div class="grid-item-nakladka"><img width="375" height="250" src="/wp-content/uploads/2022/07/grid-nakladka-01.png"></div>
            </a>
        </div>
        <?php
    }//foreach
        ?>
    </div>
</div>
    <?php

    $output = ob_get_clean();
    return $output;

}//rfx_post_grid_01()

?>