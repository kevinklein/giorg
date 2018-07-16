jQuery(document).ready(function(){
	var
	$acg_gi_patients_cpt_basics_add = jQuery("#acg_gi_patients_cpt_basics_add"),
	$acg_gi_patients_cpt_basics_items = jQuery("#acg_gi_patients_cpt_basics_items"),
	acg_gi_patients_cpt_basics_items_count = parseInt($acg_gi_patients_cpt_basics_items.val(),10),
	$acg_gi_patients_cpt_meta_topics_basics = jQuery("#acg_gi_patients_cpt_meta_topics_basics"),
	$acg_gi_patients_cpt_meta_topics_basics_inner = $acg_gi_patients_cpt_meta_topics_basics.find("div.inside"),
	$acg_gi_patients_cpt_faqs_add = jQuery("#acg_gi_patients_cpt_faqs_add"),
	$acg_gi_patients_cpt_faqs_items = jQuery("#acg_gi_patients_cpt_faqs_items"),
	acg_gi_patients_cpt_faqs_items_count = parseInt($acg_gi_patients_cpt_faqs_items.val(),10),
	$acg_gi_patients_cpt_meta_topics_faqs = jQuery("#acg_gi_patients_cpt_meta_topics_faqs"),
	$acg_gi_patients_cpt_meta_topics_faqs_inner = $acg_gi_patients_cpt_meta_topics_faqs.find("div.inside"),
	$acg_gi_patients_cpt_resources_add = jQuery("#acg_gi_patients_cpt_resources_add"),
	$acg_gi_patients_cpt_resources_items = jQuery("#acg_gi_patients_cpt_resources_items"),
	acg_gi_patients_cpt_resources_items_count = parseInt($acg_gi_patients_cpt_resources_items.val(),10),
	$acg_gi_patients_cpt_meta_topics_resources = jQuery("#acg_gi_patients_cpt_meta_topics_resources"),
	$acg_gi_patients_cpt_meta_topics_resources_inner = $acg_gi_patients_cpt_meta_topics_resources.find("div.inside"),
	$acg_gi_patients_cpt_promos_add = jQuery("#acg_gi_patients_cpt_promos_add"),
	$acg_gi_patients_cpt_promos_items = jQuery("#acg_gi_patients_cpt_promos_items"),
	acg_gi_patients_cpt_promos_items_count = parseInt($acg_gi_patients_cpt_promos_items.val(),10),
	$acg_gi_patients_cpt_meta_topics_promos = jQuery("#acg_gi_patients_cpt_meta_topics_Main"),
	$acg_gi_patients_cpt_meta_topics_promos_inner = $acg_gi_patients_cpt_meta_topics_promos.find("div.inside"),
	acg_gi_patients_cpt_methods = {};
	
	acg_gi_patients_cpt_methods.basics_form = function(itemnum){
		var htmlform = '<p>Section Title:<br /><input type="text" name="acg_gi_patients_cpt_basics_sectionname_' + itemnum + '" style="width: 98%;" value="" /><br />Section Content<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_basics_sectioncontent_' + itemnum + '" id="acg_gi_patients_cpt_basics_sectioncontent_' + itemnum + '"></textarea></p>';
		return htmlform;
	};
	
	acg_gi_patients_cpt_methods.faqs_form = function(itemnum){
		var htmlform = '<p>Question:<br /><input type="text" name="acg_gi_patients_cpt_faqs_question_' + itemnum + '" style="width: 98%;" value="" /><br />Answer<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_faqs_answer_' + itemnum + '" id="acg_gi_patients_cpt_faqs_answer_' + itemnum + '"></textarea></p>';
		return htmlform;
	};

	acg_gi_patients_cpt_methods.resources_form = function(itemnum){
		var htmlform = '<p>Resources Title:<br /><input type="text" name="acg_gi_patients_cpt_resources_resourcesname_' + itemnum + '" style="width: 98%;" value="" /><br />Resources Content<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_resources_resourcescontent_' + itemnum + '" id="acg_gi_patients_cpt_resources_resourcescontent_' + itemnum + '"></textarea></p>';
		return htmlform;
	};
	
	acg_gi_patients_cpt_methods.promos_form = function(itemnum){
		var htmlform = '<p>Promo HTML:<br /><textarea style="width: 98%;" rows="10" name="acg_gi_patients_cpt_promos_promocontent_' + itemnum + '" id="acg_gi_patients_cpt_promos_promocontent_' + itemnum + '"></textarea></p>';
		return htmlform;
	};

	if(isNaN(acg_gi_patients_cpt_basics_items_count)){
		acg_gi_patients_cpt_basics_items_count = 0;
		$acg_gi_patients_cpt_basics_items.val(0);
	}

	if(isNaN(acg_gi_patients_cpt_faqs_items_count)){
		acg_gi_patients_cpt_faqs_items_count = 0;
		$acg_gi_patients_cpt_faqs_items.val(0);
	}

	if(isNaN(acg_gi_patients_cpt_resources_items_count)){
		acg_gi_patients_cpt_resources_items_count = 0;
		$acg_gi_patients_cpt_resources_items.val(0);
	}

	if(isNaN(acg_gi_patients_cpt_promos_items_count)){
		acg_gi_patients_cpt_promos_items_count = 0;
		$acg_gi_patients_cpt_promos_items.val(0);
	}

	$acg_gi_patients_cpt_basics_add.live("click",function(){
		acg_gi_patients_cpt_basics_items_count++;
		$acg_gi_patients_cpt_basics_items.val(acg_gi_patients_cpt_basics_items_count);
		$acg_gi_patients_cpt_meta_topics_basics_inner.append(acg_gi_patients_cpt_methods.basics_form(acg_gi_patients_cpt_basics_items_count));
		return false;
	});

	$acg_gi_patients_cpt_faqs_add.live("click",function(){
		acg_gi_patients_cpt_faqs_items_count++;
		$acg_gi_patients_cpt_faqs_items.val(acg_gi_patients_cpt_faqs_items_count);
		$acg_gi_patients_cpt_meta_topics_faqs_inner.append(acg_gi_patients_cpt_methods.faqs_form(acg_gi_patients_cpt_faqs_items_count));
		return false;
	});

	$acg_gi_patients_cpt_resources_add.live("click",function(){
		acg_gi_patients_cpt_resources_items_count++;
		$acg_gi_patients_cpt_resources_items.val(acg_gi_patients_cpt_resources_items_count);
		$acg_gi_patients_cpt_meta_topics_resources_inner.append(acg_gi_patients_cpt_methods.resources_form(acg_gi_patients_cpt_resources_items_count));
		return false;
	});

	$acg_gi_patients_cpt_promos_add.live("click",function(){
		acg_gi_patients_cpt_promos_items_count++;
		$acg_gi_patients_cpt_promos_items.val(acg_gi_patients_cpt_promos_items_count);
		$acg_gi_patients_cpt_meta_topics_promos_inner.append(acg_gi_patients_cpt_methods.promos_form(acg_gi_patients_cpt_promos_items_count));
		return false;
	});

});