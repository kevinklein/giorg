<!-- this is a dead file delete kevin said this on 3/5 if this is 4/5 then delete it -->

<?php if ( is_page( 'patients') ) : ?>
<section class="row-container bg-primary text-inverse overflow-hidden hero hero-patients m-b-lg">
  <div class="container">
    <div class="row col-count-2">
    
      <div class="col bg-primary raised-lg">
        <div class="p-a p-lg-x-lg p-t-lg p-b-lg">
          <h1 class="m-b-sm text-webfont-one display-4 text-300">
            Patients
          </h1>
          <p class="display-2 text-webfont-one text-300 m-b-md">
            ACG Knows the Gut – <br>
			From A to Z
          </p>
          <nav class="display-flex justify-content-space-between text-xl item-reveal-5">
            <a class="btn btn-inverse-outline flex-1 m-r-sm" href="/patients/find-a-gastroenterologist/">Find a Gastroenterologist</a> 
			<a class="btn btn-inverse-outline flex-1 m-l-sm" href="/patients/find-a-liver-expert/">Find a Liver Expert</a>
          </nav>
        </div>
      </div>

      <div class="col">
        <div class="p-a p-lg-x-lg p-t-lg p-b-lg item-reveal-4">
          	<p class="display-2 text-uppercase m-b-md"><b>Get Your Colon Screen in ‘19</b></p>
		  	<p class="display-2 text-webfont-one text-300 m-b-md">Talk to your doctor about<br> colorectal cancer screening.</p>
			<a class="display-1" href="gi.org/coloncancer"><b>gi.org/coloncancer | #CRCScreen19</b></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<?php
	wp_nav_menu( array(
		'theme_location' => 'menu-4',
		'menu_id' => 'nav-patients',
		'menu_class' => 'nav-section',
		'container_class' => 'm-b-lg',
		'container' => 'div',
		'depth'=> 1
	) );
?>