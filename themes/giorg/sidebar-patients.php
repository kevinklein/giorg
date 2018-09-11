<div class="list-group m-b-md">
	<div class="list-group-item"><b class="text-uc text-gray-dark">GI Health Centers</b></div>
	<?php get_health_centers_for_menu(); ?>
</div>
<div class="list-group m-b-md">
	<div class="list-group-item"><b class="text-uc text-gray-dark">Digestive Health Topics</b></div>
	<?php get_digestive_health_topics_for_menu(); ?>
	<a href="/gi-health-and-disease/" class="list-group-item text-sm text-600">See All Topics (A-Z)</a>
</div>
<div class="list-group m-b-md">
	<div class="list-group-item"><b class="text-uc text-gray-dark">GI Procedures</b></div>
	<?php get_giprocedures_for_menu(); ?>
	<a href="/gi-health-and-disease/#tabs6" class="list-group-item text-sm text-600">See All Procedures (A-Z)</a>
</div>
<?php if (!is_page ('patients') ): ?>
	<div class="border border-gray-light p-a-sm m-b">
		<a href="/find-a-gastroenterologist/" class="toggle-target-next text-normal text-700">Find a<br /> Gastroenterologist</a>
		<div class="showhide-div p-a-sm bg-gray-lightest m-t-sm">
			<form method="post" action="/find-a-gastroenterologist/">
				<p class="small">Locate an ACG member gastroenterologist in your area.</p>
				<div class="input-group">
					<input type="text" class="form-control form-control-sm search clearvalues" name="mixed-values" placeholder="City, State, or Zip" />
					<span class="input-group-btn"><input type="submit" class="btn btn-sm btn-primary" value="Go" /></span>
				</div>
			</form>
		</div>
	</div>
	<div class="border border-gray-light p-a-sm m-b">
		<a href="/find-a-liver-expert/" class="toggle-target-next text-normal text-700">Find a<br /> Liver Expert</a>			
		<div class="showhide-div p-a-sm bg-gray-lightest m-t-sm">
			<p class="small">Find an ACG member gastroenterologist with a specialized interest in liver disease.</p>
			<form method="post" action="/find-a-liver-expert/">
				<div class="input-group">
					<input type="text" class="form-control form-control-sm search clearvalues" name="mixed-values" placeholder="City, State, or Zip" />
					<span class="input-group-btn"><input type="submit" class="btn btn-sm btn-primary" value="Go" /></span>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>