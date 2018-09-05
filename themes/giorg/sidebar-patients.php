<div class="list-group m-b-md">
	<div class="list-group-item"><b>GI Health Centers</b></div>
	<?php get_health_centers_for_menu(); ?>
</div>
<div class="list-group m-b-md">
	<div class="list-group-item"><b>Digestive Health Topics</b></div>
	<?php get_digestive_health_topics_for_menu(); ?>
	<a href="/gi-health-and-disease/" class="list-group-item text-sm">See All Topics (A-Z)</a>
</div>
<div class="list-group m-b-md">
	<div class="list-group-item"><b>GI Procedures</b></div>
	<?php get_giprocedures_for_menu(); ?>
	<a href="/gi-health-and-disease/#tabs6" class="list-group-item text-sm">See All Procedures (A-Z)</a>
</div>

	<?php if(!is_home()){ ?>
	<div class="find stomach">
	<a href="/find-a-gastroenterologist/" class="showhide">Find a Gastroenterologist</a>
	<div class="showhide-div">
		<form method="post" action="/find-a-gastroenterologist/">
		<p class="small">Locate an ACG member gastroenterologist in your area.</p>
		<input type="text" name="mixed-values" value="City, State, or Zip" class="search clearvalues" />
		<input type="submit" class="button" value="GO" />
		</form>
	</div>
	</div>
	<div class="find liver">
	<a href="/find-a-liver-expert/" class="showhide">Find a<br /> Liver Expert</a>					
	<div class="showhide-div">
		<p class="small">Find an ACG member gastroenterologist with a specialized interest in liver disease.</p>
		<form method="post" action="/find-a-liver-expert/">
		<input type="text" name="mixed-values" value="City, State, or Zip" class="search clearvalues" />
		<input type="submit" class="button" value="GO" />
		</form>
	</div>
	</div>
	<?php } ?>

