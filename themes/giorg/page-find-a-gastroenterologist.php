<?php
if( isset( $_POST['mixed-values'] ) && $_POST['mixed-values'] != 'City, State, or Zip'){
	
	if(preg_match("/([^,]+),\s*(\w{2})\s*(\d{5}(?:-\d{4})?)/", $_POST['mixed-values'], $matches)){
		//is it city, st zip
		list($locations['addr'], $locations['city'], $locations['state'], $locations['zip']) = $matches;
		$passed_city = strip_tags($locations["city"]);
		$passed_state = strip_tags($locations["state"]);
		$passed_zip = strip_tags($locations["zip"]);
		$passed_address_type = "full";
	}elseif(preg_match("/^(\d{5}(?:-\d{4})?)/", $_POST['mixed-values'], $matches)){
		//is it just zip?
		list($locations['addr'],$locations['zip']) = $matches;
		$passed_city = "";
		$passed_state = "";
		$passed_zip = strip_tags($locations["zip"]);
		$passed_address_type = "zip";
	}elseif(preg_match("/^(\w{2})$/", $_POST['mixed-values'], $matches)){
		//is it just state?
		list($locations['addr'],$locations['state']) = $matches;
		$passed_city = "";
		$passed_state = strip_tags($locations["state"]);
		$passed_zip = "";
		$passed_address_type = "state";
	}else{
		$passed_city = strip_tags($_POST['mixed-values']);
		$passed_state = strip_tags($_POST['mixed-values']);
		$passed_zip = "";
		$passed_address_type = "text";
	}
}else{
	$passed_city = "";
	$passed_state = "";
	$passed_zip = "";
	$passed_address_type = "";
}
/**
 * The template for displaying gi health and disease list.
 *
 */

get_header(); ?>

	<div class="group">
	
		<div id="main" role="main">

				<h1 class="page-title">Find a Gastroenterologist</h1>

      <p>All ACG Members, Fellows (FACG) and Masters (MACG) of the College can be located via this GI Physician Locator service. You may search by Last Name, City, State or Zip Code. The search results will list the names, addresses and phone numbers for all physicians meeting your search criteria.</p>
      <p>Also available, a new <a href="/find-a-liver-expert/">ACG Liver Expert Locator</a> to identify ACG member physicians who have expressed an interest in liver disease.</p>
            <form action="/find-a-gastroenterologist/" method="POST" id="find-a-gastroenterologist">
            <div id="find-a-gastroenterologist-results"></div>
            <div class="gform_body">
            <ul class="gform_fields top_label">
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_last">Last Name</label>
            		<div class="ginput_container"><input name="last" id="phylocator_last" type="text" size="30"></div>
            	</li>
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_city">City</label>
            		<div class="ginput_container"><input name="city" id="phylocator_city" type="text" size="30" value="<?php echo $passed_city; ?>"></div>
            	</li>
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_state">Select State/Province</label>
            		<div class="ginput_container">
            		  <select name="state" size="1" id="phylocator_state" class="gfield_select" rel="<?php echo $passed_state; ?>">
                      <option value="zzz"> </option>
                      <option value="AK">AK</option>
                      <option value="AL">AL</option>
                      <option value="AR">AR</option>
                      <option value="AZ">AZ</option>
                      <option value="CA">CA</option>
                      <option value="CO">CO</option>
                      <option value="CT">CT</option>
                      <option value="DC">DC</option>
                      <option value="DE">DE</option>
                      <option value="FL">FL</option>
                      <option value="GA">GA</option>
                      <option value="HI">HI</option>
                      <option value="IA">IA</option>
                      <option value="ID">ID</option>
                      <option value="IL">IL</option>
                      <option value="IN">IN</option>
                      <option value="KS">KS</option>
                      <option value="KY">KY</option>
                      <option value="LA">LA</option>
                      <option value="MA">MA</option>
                      <option value="MD">MD</option>
                      <option value="ME">ME</option>
                      <option value="MI">MI</option>
                      <option value="MN">MN</option>
                      <option value="MO">MO</option>
                      <option value="MS">MS</option>
                      <option value="MT">MT</option>
                      <option value="NC">NC</option>
                      <option value="ND">ND</option>
                      <option value="NE">NE</option>
                      <option value="NH">NH</option>
                      <option value="NJ">NJ</option>
                      <option value="NM">NM</option>
                      <option value="NV">NV</option>
                      <option value="NY">NY</option>
                      <option value="OH">OH</option>
                      <option value="OK">OK</option>
                      <option value="OR">OR</option>
                      <option value="PA">PA</option>
                      <option value="PR">PR</option>
                      <option value="RI">RI</option>
                      <option value="SC">SC</option>
                      <option value="SD">SD</option>
                      <option value="TN">TN</option>
                      <option value="TX">TX</option>
                      <option value="UT">UT</option>
                      <option value="VA">VA</option>
                      <option value="VT">VT</option>
                      <option value="WA">WA</option>
                      <option value="WI">WI</option>
                      <option value="WV">WV</option>
                      <option value="WY">WY</option>
                      <option value="zzz">---</option>
                      <option value="AB">AB</option>
                      <option value="BC">BC</option>
                      <option value="MB">MB</option>
                      <option value="NB">NB</option>
                      <option value="NL">NL</option>
                      <option value="NS">NS</option>
                      <option value="ON">ON</option>
                      <option value="PE">PE</option>
                      <option value="QC">QC</option>
                      <option value="SK">SK</option>
                    </select>
            		</div>
            	</li>
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_country">Select Country</label>
            		<div class="ginput_container">
            		  <select name="country" size="1" id="phylocator_country" class="gfield_select">
                      <option value="zzz"> </option>
                      <option value="us">United States</option>
                      <option value="canada">Canada</option>
                      </select>
            		</div>
            	</li>
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_zip">Zip/Postal Code</label>
            		<div class="ginput_container"><input name="zip" id="phylocator_zip" type="text" size="30" value="<?php echo $passed_zip; ?>" /></div>
            	</li>
            	<li class="gfield">
            		<label class="gfield_label" for="phylocator_sortby">Sort By</label>
            		<div class="ginput_container">
            		  <select name="order" size="1" id="phylocator_sortby" class="gfield_select">
                      <option value="LAST" selected>Last Name</option>
                      <option value="CITY">City</option>
                      <option value="ZIP">Zip/Postal Code</option>
                      </select>
            		</div>
            	</li>
            </ul>
            </div>
            <div class="gform_footer top_label"> <input type="submit" id="gform_submit_button_2" class="button gform_button" value="Submit"></div>
            </form>
			<?php
			if( isset( $_POST['mixed-values'] ) ){
				echo '<span id="phylocator_externalformsubmit" rel="'.$passed_address_type.'"></span>';
			}
			?>

		</div>
	
	<?php get_sidebar(); ?>
	
	</div>

</div>
<?php get_footer(); ?>