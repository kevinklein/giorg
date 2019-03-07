<?php

// if(session_id() == '')
//      session_start();
/**
 * The header for our theme
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package giorg
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="top"></div>
<header id="header-main" class="raised-sm position-relative">
    <div class="text-sm bg-primary-lightest" role="directory" id="header-hud">
        <div class="container item-flex justify-content-flex-end">
            <nav class="hidden-sm-down p-r">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-3',
                    'menu_id' => 'nav-top',
                    'menu_class' => 'nav-top',
                    'container_class' => '',
                    'container' => 'ul',
                    'depth'=> 1
                ) );
                ?>
            </nav>
            <div class="item-flex-addon">
                <a href="#" class="btn btn-primary btn-sm br-a-0"><svg class="icon icon-users"><use xlink:href="#icon-users"></use></svg> My ACG/Log In</a>
            </div>
        </div>
    </div>
    <div class="header-main" role="banner">
        <div class="container">
            <div class="item-flex">
                <div class="item-flex-main item-flex p-y p-r">
                    <div class="logo"> 
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" class="img-circle" alt="<?php bloginfo( 'name' ); ?>"></a>
                    </div>
                    <div class="m-l-sm logo-description">
                        <a href="/" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-type-gotham.svg" alt="<?php bloginfo( 'description' ); ?>"></a>
                    </div>
                </div>
                <div class="item-flex-addon">
                    <nav class="item-flex position-relative text-xl">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'menu-2',
                            'menu_id' => 'nav-ancillary',
                            'menu_class' => 'list-inline nav-ancillary',
                            'container_class' => '',
                            'container' => 'ul',
                            'depth'=> 1
                        ) );
                        ?>
                        <a href="http://acgmeetings.gi.org" class="m-l-md" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/meeting-2019.svg" width="110"></a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="position-relative">
        <nav class="container item-flex">

            <button class="btn-link display-2 m-r p-a-0 toggle-is-toggled" id="menu-toggle" data-toggle="modal" data-target=".modal-menu"><svg class="icon icon-menu"><use xlink:href="#icon-menu"></use></svg></button>

			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id' => 'nav-primary',
				'menu_class' => 'nav-primary hidden-sm-down item-flex-main main-nav',
				'container_class' => 'menu-container',
				'container' => 'ul',
                'depth'=> 2
			) );
			?>

            <button class="btn-link m-l toggle-is-toggled btn-search-toggle" id="search-toggler">
                <span>
                    <svg class="icon icon-search"><use xlink:href="#icon-search"></use></svg>
                    <svg class="icon icon-close"><use xlink:href="#icon-close"></use></svg>
                </span>
            </button>

        </nav>
    </div>

    <div class="p-y border-bottom position-absolute bg-white raised" style="display:none;z-index:1599;right:0;left:0; top:100%" id="search-container">
        <div class="container">
            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                <div class="input-group">
                    <input type="text" value="" name="s" id="s" class="form-control form-control-lg"  placeholder="Search Gi.org">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg br-a-0" type="submit" id="searchsubmit">Search</button>
                    </span> 
                </div>
            </form>
        </div>
    </div>

</header>

<!-- menu modal -->
<div class="modal modal-menu" tabindex="-1">
    <div class="modal-dialog modal-dialog-lg modal-lg">
        <div class="modal-content">
            <div class="modal-body bg-primary text-inverse">
                <div class="text-right">
                    <button type="button" class="circle bg-white text-primary text-xl" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="p-x p-b">
                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-1' ); ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-2' ); ?>
                            <?php } ?>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
                                <?php dynamic_sidebar( 'footer-3' ); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>

<?php require_once( 'partials/breadcrumbs.php' ); ?>
<?php require_once( 'partials/page-title.php' ); ?>

<?php
    $containerSize = get_field('container_size');
    if (empty($containerSize)) :
        $containerSize = "container";
    endif; 
?>

<main id="main" class="
    <?php echo $containerSize ?>
    <?php if ( $containerSize != "none" ) { echo "p-y-lg"; } ?>
    main-content">