<?php if($content_row_title): echo '<h3 class="header-full"><span>' . $content_row_title . '</span></h3>'; endif; ?>

<section class="row-container <?php if($content_row_wrap_css_class): echo $content_row_wrap_css_class; endif;?>">

    <div class="<?php if($content_row_wrap_inner_css_class): echo $content_row_wrap_inner_css_class; endif;?>">

        <?php if($content_row_html): echo $content_row_html; endif; ?>

    </div>

</section>