<?php
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
<header id="header-main" class="cd-morph-dropdown raised-sm position-relative">
    <div class="text-sm bg-gray-lightest" role="directory" id="header-hud">
        <div class="container item-flex justify-content-flex-end">
            <nav class="text-normal hidden-sm-down p-r">
                <a href="#" class="nav-link text-hover-underline">About</a>
                <span class="text-pipe">|</span>
                <a href="#" class="nav-link text-hover-underline">Donate</a>
                <span class="text-pipe">|</span>
                <a href="#" class="nav-link text-hover-underline">ACG Store</a>
                <span class="text-pipe">|</span>
                <a href="#" class="nav-link text-hover-underline">Online Store</a>
                <span class="text-pipe">|</span>
                <a href="#" class="nav-link text-hover-underline">Find a GI</a>
                <span class="text-pipe">|</span>
                <a href="/membership/" class="nav-link text-hover-underline">Membership</a>
                <span class="text-pipe">|</span>
                <a href="/membership/" class="nav-link text-hover-underline">Find Your ACG Governor</a>
                <span class="text-pipe">|</span>
                <a href="/membership/" class="nav-link text-hover-underline">Join</a>
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
                    <div class="m-l-sm text-primary logo-description logo-description-v3 logo-description-v4">
                        <a href="/" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-type-gotham.svg" alt="<?php bloginfo( 'description' ); ?>"></a>
                    </div>
                </div>
                <div class="item-flex-addon">
                    <nav class="item-flex position-relative text-lg">
                        <a href="/guidelines" class="m-x text-hover-underline">Guidelines</a>
                        <a href="/guidelines" class="m-x text-hover-underline">ACG Blog</a>
                        <a href="/guidelines" class="m-x text-hover-underline">Patients</a>
                        <a href="http://acgmeetings.gi.org" class="m-l-md" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/acg2018-philly-logo-header.svg" width="110"></a>
                    </nav>
                </div>
            </div>
        </div>

    </div>

    <div class="position-relative">
        <nav class="container item-flex">

            <button class="btn-link display-2 m-r p-a-0 toggle-is-toggled" id="menu-toggle" data-toggle="modal" data-target=".modal-menu"><svg class="icon icon-menu"><use xlink:href="#icon-menu"></use></svg></button>

            <!-- <ul class="nav-primary hidden-sm-down item-flex-main main-nav">
                <li class="has-dropdown" data-content="education"><a href="#"><span>Education</span></a></li>
                <li class="has-dropdown" data-content="journal"><a href="#"><span>Journal<br>& Publications</span></a></li>
                <li class="has-dropdown" data-content="research"><a href="#"><span>Research</span></a></li>
                <li class="has-dropdown" data-content="institute"><a href="#"><span>ACG Institute</span></a></li>
                <li class="has-dropdown" data-content="practice"><a href="#"><span>Practice<br>Management</span></a></li>
                <li class="has-dropdown" data-content="public"><a href="#"><span>Public Policy</span></a></li>
                <li class="has-dropdown" data-content="trainees"><a href="/trainees"><span>Trainees</span></a></li>
            </ul> -->

			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id' => 'nav-primary',
				'menu_class' => 'nav-primary hidden-sm-down item-flex-main main-nav',
				'container_class' => 'menu-container',
				'container' => 'ul'
			) );
			?>

            <button class="btn-link m-l toggle-is-toggled btn-search-toggle" id="search-toggler">
                <span>
                    <svg class="icon icon-search"><use xlink:href="#icon-search"></use></svg>
                    <svg class="icon icon-close"><use xlink:href="#icon-close"></use></svg>
                </span>
            </button>

        </nav>

        <div class="morph-dropdown-wrapper">
			<div class="dropdown-list">
				<ul>
					<li id="education" class="dropdown">
						<div class="content">	
                            <ul class="list-unstyled m-lg-b-0">
                                <li><a href="#" class="text-muted text-hover-underline">ACG 2018</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Meetings & Events Calendar</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Claim CME & MOC</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Education Universe</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Board Prep</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Journal CME & MOC</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Training Program Resources</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Exhibitors & Sponsors</a></li>
                            </ul>
                            <a class="bg-gray-lighter p-a item-flex" href="#">
                                <img src="/svg/acg2018-logo-type.svg" class="" width="70">
                                <div class="p-l item-flex-main">
                                   <span class="text-xs display-block text-muted">October 5-10, 2018  <!-- <span class="text-pipe">|</span> Philadelphia, PA --></span>
                                    <span class="text-dark text-normal text-500">Join us in Philly for ACG 2018</span>
                                </div>
                            </a>
						</div>
					</li>
					<li id="journal" class="dropdown">
						<div class="content">
							<ul class="list-unstyled m-b-sm">
                                <li><a href="#" class="text-muted text-hover-underline">AJG</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">CTG</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">ACG Case Reports Journal</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">ACG Magazine</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">ACG Blog</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Podcasts</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">This Week in Washington DC</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">SmartBrief</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Digestive Health Insights</a></li>
                            </ul>
                            <a class="bg-gray-lighter p-a item-flex" href="#">
                                <span class="circle circle-md bg-secondary text-inverse"><img src="/img/gastro-girl.png" width="74"></span>
                                <div class="p-l item-flex-main">
                                    <span class="text-xs display-block text-muted">Support for GI Patients</span>
                                    <span class="text-dark text-normal text-500">Digestive Health Insights with Gastro Girl</span>
                                </div>
                            </a>
						</div>
					</li>
					<li id="research" class="dropdown">
						<div class="content">	
							<ul class="list-unstyled m-b-sm">
                                 <li><a href="#" class="text-muted text-hover-underline">Junior Faculty Grants</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Clinical Research Awards</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Grants & Publishing</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Pilot Projects</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Smaller Programs Awards</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Past Recipients</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">ACG Scholars</a></li>
                            </ul>
                            <!-- <a class="bg-gray-lighter p-a item-flex" href="#">
                                <span class="circle circle-md bg-secondary text-inverse"><svg class="icon icon-mobile"><use xlink:href="#icon-mobile"></use></svg></span>
                                <div class="p-l item-flex-main">
                                    <span class="text-xs display-block text-muted">On a phone or tablet?</span>
                                    <span class="text-dark text-normal text-500">Download the ACG Guidelines App</span>
                                </div>
                            </a> -->
						</div>
					</li>
                    <li id="institute" class="dropdown">
						<div class="content">	
							<ul class="list-unstyled m-b-sm">
                                <li><a href="#" class="text-muted text-hover-underline">About</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Ways to Give</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Edgar Achkar Visiting Professorships</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Research Awards</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Initiatives and Programs</a></li>
                            </ul>
                            <!-- <a class="bg-gray-lighter p-a item-flex" href="#">
                                <img src="/svg/acg-blog-black.svg" width="74">
                                <div class="p-l item-flex-main">
                                    <span class="text-xs display-block text-muted">Stay Informed</span>
                                    <span class="text-dark text-normal text-500">ACG Blog: the latest GI news & topics</span>
                                </div>
                            </a> -->
						</div>
					</li>
                    <li id="practice" class="dropdown">
						<div class="content">	
							<ul class="list-unstyled m-lg-b-0">
                                <li><a href="#" class="text-muted text-hover-underline">Toolbox</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Coding & Reimbursement</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">GIQuIC Registry</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">This Week in Washington DC</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Contact Your ACG Governor</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">CMS</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">FDA</a></li>
                            </ul>
						</div>
					</li>
                    <li id="public" class="dropdown">
						<div class="content">	
							<ul class="list-unstyled m-b-sm">
                                <li><a href="#" class="text-muted text-hover-underline">This Week in Washington DC</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Legislative Action Center</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">GIQuIC Registry</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Contact Your ACG Governor</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Legislative & Public Policy Council</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">State GI Societies</a></li>
                            </ul>
                            <!-- <a class="bg-gray-lighter p-a item-flex" href="#">
                                <span class="circle circle-md bg-secondary text-inverse"><img src="/img/gastro-girl.png" width="74"></span>
                                <div class="p-l item-flex-main">
                                    <span class="text-xs display-block text-muted">Support for GI Patients</span>
                                    <span class="text-dark text-normal text-500">Digestive Health Insights with Gastro Girl</span>
                                </div>
                            </a> -->
						</div>
					</li>
                    <li id="trainees" class="dropdown">
						<div class="content">	
							<ul class="list-unstyled m-b-sm">
                                <li><a href="#" class="text-muted text-hover-underline">Membership</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Professional Development Resources</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">Grants & Publishing</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">For Program Directors</a></li>
                                <li><a href="#" class="text-muted text-hover-underline">For Residents</a></li>
                            </ul>
                            <!-- <a class="bg-gray-lighter p-a item-flex" href="#">
                                <span class="circle circle-md bg-secondary text-inverse"><img src="/img/gastro-girl.png" width="74"></span>
                                <div class="p-l item-flex-main">
                                    <span class="text-xs display-block text-muted">Support for GI Patients</span>
                                    <span class="text-dark text-normal text-500">Digestive Health Insights with Gastro Girl</span>
                                </div>
                            </a> -->
						</div>
					</li>
				</ul>

				<div class="bg-layer" aria-hidden="true"></div>
			</div> <!-- dropdown-list -->
		</div> <!-- morph-dropdown-wrapper -->

    </div>

    <div class="p-y border-bottom position-absolute bg-white raised" style="display:none;z-index:1599;right:0;left:0; top:100%" id="search-container">
        <div class="container">
            <div class="input-group">
                <input type="text" class="form-control form-control-lg" style="padding-top:.5rem;padding-bottom:.5rem;" id="search" placeholder="Search Gi.org">
                <span class="input-group-btn">
                    <button class="btn btn-secondary btn-lg br-a-0" type="button">Search</button>
                </span>
            </div>
        </div>
    </div>

</header>

<!-- menu modal -->
<div class="modal modal-menu" tabindex="-1">
    <div class="modal-dialog modal-dialog-lg modal-lg">
        <div class="modal-content">
            <div class="modal-body bg-primary-dark text-inverse">
                <div class="text-right">
                    <button type="button" class="circle bg-white text-primary text-xl" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="p-x p-b">
                    <?php include 'nav-v2.php' ?>
                </div>
            </div>
		</div>
    </div>
</div>

