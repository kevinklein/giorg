<?php

global $wpdb;
$popups  = defined('SG_APP_POPUP_FILES') ? (array)$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."sg_popup",OBJECT_K) : array();
$options = usa_html5map_plugin_get_options();
$option_keys = is_array($options) ? array_keys($options) : array();
$map_id  = (isset($_REQUEST['map_id'])) ? intval($_REQUEST['map_id']) : array_shift($option_keys) ;

$states  = $options[$map_id]['map_data'];
$states  = json_decode($states, true);

$sId = isset($_GET['s_id']) ? $_GET['s_id'] : false;

if(isset($_POST['act_type']) && $_POST['act_type'] == 'usa-html5-map-states-save') {

    if($sId)
    {
        $s_id = 'st'.$sId;
        $vals = $states[$s_id];
        if(isset($_POST['name'][$vals['id']]))
            $states[$s_id]['name'] = stripslashes($_POST['name'][$vals['id']]);

        if(isset($_POST['shortname'][$vals['id']])) {
            $states[$s_id]['shortname'] = stripslashes($_POST['shortname'][$vals['id']]);
        }

        if(isset($_POST['URL'][$vals['id']]))
            $states[$s_id]['link'] = esc_url(stripslashes($_POST['URL'][$vals['id']]), null, 'url');

        if ($states[$s_id]['link'])
            $states[$s_id]['isNewWindow'] = isset($_POST['isNewWindow'][$vals['id']]) ? 1 : 0;
        else
            unset($states[$s_id]['isNewWindow']);

        if(isset($_POST['info'][$vals['id']]))
            $states[$s_id]['comment'] = wp_kses_post(stripslashes($_POST['info'][$vals['id']]));

        if(isset($_POST['image'][$vals['id']]))
            $states[$s_id]['image'] = sanitize_text_field($_POST['image'][$vals['id']]);

        if(isset($_POST['color'][$vals['id']]))
            $states[$s_id]['color_map'] = sanitize_text_field($_POST['color'][$vals['id']][0] == '#' ? $_POST['color'][$vals['id']] : '#' . $_POST['color'][$vals['id']]);

        if(isset($_POST['color_'][$vals['id']]))
            $states[$s_id]['color_map_over'] = sanitize_text_field($_POST['color_'][$vals['id']][0] == '#' ? $_POST['color_'][$vals['id']] : '#' . $_POST['color_'][$vals['id']]);

        if(isset($_POST['descr'][$vals['id']]))
            $options[$map_id]['state_info'][$vals['id']] = wp_kses_post(stripslashes($_POST['descr'][$vals['id']]));
        if(isset($_POST['popup-id']))
            $states[$s_id]['popup-id'] = intval($_POST['popup-id']);
        if(isset($_POST['_hide_name'][$vals['id']]))
            $states[$s_id]['_hide_name'] = 1;
        else
            unset($states[$s_id]['_hide_name']);

        if(isset($_POST['colorSimpleCh'][$vals['id']])) {
        foreach($states as $k=>$v) {
            $states[$k]['color_map'] = sanitize_text_field($_POST['color'][$vals['id']][0] == '#' ? $_POST['color'][$vals['id']] : '#' . $_POST['color'][$vals['id']]);
        }
        }

        if(isset($_POST['colorOverCh'][$vals['id']])) {
        foreach($states as $k=>$v) {
            $states[$k]['color_map_over'] = sanitize_text_field($_POST['color_'][$vals['id']][0] == '#' ? $_POST['color_'][$vals['id']] : '#' . $_POST['color_'][$vals['id']]);
        }
        }

    }

    $options[$map_id]['map_data'] = json_encode($states);

    $options[$map_id]['update_time'] = time();
    usa_html5map_plugin_save_options($options);
}

$dir     = plugins_url('/static/', __FILE__);

$map_data = json_decode($options[$map_id]['map_data'], true);
foreach ($map_data as &$sd)
    unset($sd["group"]);
unset($sd);
$map_data = json_encode($map_data);

echo "<div class=\"wrap\"><h2>" . __('Configuration of Map Areas', 'usa-html5-map') . "</h2>";
?>
<script>
    var map_cfg = {

    mapWidth        : 0,
    mapHeight       : 0,

    shadowAllow     : false,

    borderColor     : "<?php echo $options[$map_id]['borderColor']; ?>",
    borderColorOver     : "<?php echo $options[$map_id]['borderColorOver']; ?>",

    nameColor       : "<?php echo $options[$map_id]['nameColor']; ?>",
    popupNameColor      : "<?php echo $options[$map_id]['popupNameColor']; ?>",
    nameFontSize        : "<?php echo $options[$map_id]['nameFontSize'].'px'; ?>",
    popupNameFontSize   : "<?php echo $options[$map_id]['popupNameFontSize'].'px'; ?>",
    nameFontWeight      : "<?php echo $options[$map_id]['nameFontWeight']; ?>",

    pointColor            : "<?php echo $options[$map_id]['pointColor']?>",
    pointColorOver        : "<?php echo $options[$map_id]['pointColorOver']?>",
    pointBorderColor        : "<?php echo $options[$map_id]['pointBorderColor']?>",
    pointBorderColorOver    : "<?php echo $options[$map_id]['pointBorderColorOver']?>",
    pointNameColor        : "<?php echo $options[$map_id]['pointNameColor']?>",
    pointNameColorOver    : "<?php echo $options[$map_id]['pointNameColorOver']?>",
    pointNameStrokeColor        : "<?php echo $options[$map_id]['pointNameStrokeColor']?>",
    pointNameStrokeColorOver    : "<?php echo $options[$map_id]['pointNameStrokeColorOver']?>",
    pointNameFontSize    : "<?php echo $options[$map_id]['pointNameFontSize']?>",

    overDelay       : <?php echo $options[$map_id]['overDelay']; ?>,
    nameStroke      : <?php echo $options[$map_id]['nameStroke']?'true':'false'; ?>,
    nameStrokeColor : "<?php echo $options[$map_id]['nameStrokeColor']; ?>",
    map_data        : <?php echo $map_data; ?>,
    ignoreLinks     : true,
    points          : {}
    };
    var imageFieldId = false;
    jQuery(function($){

        jQuery('select[name=state_select]').change(function() {
            location.href='admin.php?page=usa-html5-map-states&map_id=<?php echo $map_id; ?>&s_id='+jQuery(this).val();
        });

        jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

        jQuery('.color~.colorpicker').each(function(){
            var me = this;

            jQuery(this).farbtastic(function(color){

                var textColor = this.hsl[2] > 0.5 ? '#000' : '#fff';

                jQuery(me).prev().prev().css({
                    background: color,
                    color: textColor
                }).val(color);

                if(jQuery(me).next().find('input').attr('checked') == 'checked') {
                    return;
                    var dirClass = jQuery(me).prev().prev().hasClass('colorSimple') ? 'colorSimple' : 'colorOver';

                    jQuery('.'+dirClass).css({
                        background: color,
                        color: textColor
                    }).val(color);
                }

            });

            jQuery.farbtastic(this).setColor(jQuery(this).prev().prev().val());

            jQuery(jQuery(this).prev().prev()[0]).bind('change', function(){
                jQuery.farbtastic(me).setColor(this.value);
            });

            jQuery(this).hide();
            jQuery(this).prev().prev().bind('focus', function(){
                jQuery(this).next().next().fadeIn();
            });
            jQuery(this).prev().prev().bind('blur', function(){
                jQuery(this).next().next().fadeOut();
            });
        });

        jQuery('.stateinfo input:radio').click(function(){
            var el_id = jQuery(this).attr('id').substring(1);
            if(jQuery(this).attr('id').charAt(0)=='n'){
                jQuery("#URL"+el_id).val("");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='u'){
                jQuery("#URL"+el_id).val("http://");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeIn(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='m'){
                jQuery("#URL"+el_id).val("#info");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeIn(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='p'){
                jQuery("#URL"+el_id).val("#popup");
                jQuery("#stateURL"+el_id).fadeOut(0)
                jQuery("#stateDescr"+el_id).fadeOut(0);
                jQuery("#statePopup"+el_id).fadeIn(0);
            }
        });

        jQuery('.colorSimpleCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorSimpleCh').attr('checked', false);
                this.checked = true;
            }
        });

        jQuery('.colorOverCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorOverCh').attr('checked', false);
                this.checked = true;
            }
        });

        window.send_to_editorArea = window.send_to_editor;

        window.send_to_editor = function(html) {
            if(imageFieldId === false) {
                window.send_to_editorArea(html);
            }
            else {
                var imgurl = jQuery('img',html).attr('src');

                jQuery('#'+imageFieldId).val(imgurl);
                imageFieldId = false;

                tb_remove();
            }

        }
        if (typeof tinyMCE !== 'undefined') tinyMCE.execCommand('mceAddControl', true, 'descr'+this.value)
<?php if($sId) { ?>
        jQuery('input[type=submit]').attr('disabled',false);
<?php } ?>
        var map = new FlaShopUSAMap(map_cfg);
        map.draw('map-preview');
        map.on('click', function(ev, sid, map) {
            var id = sid.substr(2);
            jQuery('select[name="state_select"]').val(id).trigger('change');
        });
        jQuery('.map-show').click(function() {
            var text   = jQuery(this).text();
            var toggle = jQuery(this).data('toggle');

            jQuery(this).data('toggle',text).text(toggle);

            jQuery('#map-preview').toggle();

            if (jQuery('#map-preview:visible').length) {
                map.reloadMap();
            }

            return false;
        });

    });

    function clearImage(f) {
        jQuery(f).prev().val('');
    }

    function adjustSubmit() {
        if(jQuery('.colorOverCh:checked').length > 0) {
            var ch = jQuery('.colorOverCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorOver').val(color);
        }

        if(jQuery('.colorSimpleCh:checked').length > 0) {
            var ch = jQuery('.colorSimpleCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorSimple').val(color);
        }
    }
</script>
<br />
<form method="POST" class="usa-html5-map main" onsubmit="adjustSubmit()">
<?php 
    usa_html5map_plugin_map_selector('states', $map_id, $options);
    echo "<br /><br />\n";
    usa_html5map_plugin_nav_tabs('states', $map_id);
?>

    <p><?php echo __('This tab allows you to add the area-specific information and adjust colors of individual area on the map.', 'usa-html5-map'); ?></p>
    <p class="help"><?php echo __('* The term "area" means one of the following: region, state, country, province, county or district, depending on the particular plugin.', 'usa-html5-map'); ?></p>

    <select name="state_select">
        <option value=0><?php echo __('Select an area', 'usa-html5-map'); ?></option>
        <?php

        foreach($states as $s_id=>$vals)
        {
            ?>
            <option value="<?php echo $vals['id']?>" <?php echo $sId == $vals['id'] ? ' selected' : ''?>><?php echo preg_replace('/^\s?<!--\s*?(.+?)\s*?-->\s?$/', '\1', $vals['name']); ?></option>
            <?php
        }
        ?>
    </select>
    <button class="button button-secondary map-show" style="margin-top: 1px" data-toggle="<?php esc_attr_e('Hide map', 'usa-html5-map'); ?>"><?php _e('Choose on map', 'usa-html5-map') ?></button>

    <link rel='stylesheet' href='<?php echo $dir ?>css/map.css'>
    <style>
        #map-preview .fm-tooltip {
            color: <?php echo $options[$map_id]['popupNameColor']; ?>;
            font-size: <?php echo $options[$map_id]['popupNameFontSize'].'px'; ?>
        }
    </style>
    <script type='text/javascript' src='<?php echo $dir ?>js/raphael.min.js'></script>
    <script type='text/javascript' src='<?php echo $dir ?>js/map.js'></script>
    <div class="map-preview" id="map-preview" style="display: none"></div>
    <div style="clear: both; height: 30px;"></div>


    <?php

    if($sId) {
        $vals        = $states['st'.$sId];
        $rad_nill    = "";
        $rad_url     = "";
        $rad_more    = "";
        $rad_popup   = "";
        $style_input = "";
        $style_area  = "";
        $style_popup = "";

        $mce_options = array(
            //'media_buttons' => false,
            'editor_height'   => 150,
            'textarea_rows'   => 20,
            'textarea_name'   => "descr[{$vals['id']}]",
            'tinymce' => array(
                'add_unload_trigger' => false,
            )
        );

        $vals['shortname'] = str_replace("\n",'\n',$vals['shortname']);

        if(trim($vals['link']) == "") $rad_nill = "checked";
        elseif(stripos($vals['link'], "#popup") !== false ) $rad_popup = "checked";
        elseif(stripos($vals['link'], "javascript:usahtml5map_set_state_text") !== false OR $vals['link'] == '#info') $rad_more = "checked";
        else $rad_url = "checked";

        if($rad_url != "checked") $style_input = "display: none;";
        if($rad_more != "checked") $style_area = "display: none;";
        if($rad_popup!="checked") $style_popup = "display: none;";

    ?>

    <fieldset>
        <legend><?php echo __('Map area', 'usa-html5-map'); ?></legend>

        <div style="" id="stateinfo-<?php echo $vals['id']?>" class="stateinfo">
        <span class="title"><?php echo __('Name:', 'usa-html5-map'); ?> </span><input class="" type="text" name="name[<?php echo $vals['id']?>]" value="<?php echo $vals['name']?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Name of Area', 'usa-html5-map'); ?>">[?]</span>
        <label style="padding-left: 20px"><input type="checkbox" name="_hide_name[<?php echo $vals['id']?>]" <?php echo isset($vals['_hide_name']) ? 'checked="checked"' : '' ?>>
        <?php echo __('do not show popup name', 'usa-html5-map'); ?>
        </label>
        <div class="clear"></div>

        <span class="title"><?php echo __('Shortname:', 'usa-html5-map'); ?> </span><input class="" type="text" name="shortname[<?php echo $vals['id']?>]" value="<?php echo $vals['shortname']?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Shortname of Area', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('What to do when the area is clicked:', 'usa-html5-map'); ?></span>
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="n<?php echo $vals['id']?>" value="nill" <?php echo $rad_nill?> autocomplete="off">&nbsp;<?php echo __('Nothing', 'usa-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Do not react on mouse clicks', 'usa-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="u<?php echo $vals['id']?>" value="url" <?php echo $rad_url?> autocomplete="off">&nbsp;<?php echo __('Open a URL', 'usa-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('A click on this area opens a specified URL', 'usa-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="m<?php echo $vals['id']?>" value="more" <?php echo $rad_more?> autocomplete="off">&nbsp;<?php echo __('Show more info', 'usa-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Displays a side-panel with additional information (contacts, addresses etc.)', 'usa-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
        <label><input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="p<?php echo $vals['id']?>" value="popup-builder" <?php echo $rad_popup?> autocomplete="off" <?php echo (!count($popups)) ? "disabled" : ""; ?>>&nbsp;<?php echo __('Show lightbox popup', 'usa-html5-map'); ?></label> <span class="tipsy-q" original-title="<?php esc_attr_e('Show lightbox popup, that you are can create with the plugin "Popup Builder". To activate this option, install the "Popup Builder" plugin, then switch to it and create a new popup there. Then, you should open this tab again and specify the name of the created popup here.', 'usa-html5-map'); ?>">[?]</span><br />
        <div style="<?php echo $style_input; ?>" id="stateURL<?php echo $vals['id']?>">
            <span class="title"><?php echo __('URL:', 'usa-html5-map'); ?> </span><input style="width: 240px;" class="" type="text" name="URL[<?php echo $vals['id']?>]" id="URL<?php echo $vals['id']?>" value="<?php echo $vals['link']?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The landing page URL', 'usa-html5-map'); ?>">[?]</span>&nbsp;&nbsp;&nbsp;
            <label><input type="checkbox" name="isNewWindow[<?php echo $vals['id']?>]" <?php if (!empty($vals['isNewWindow'])) echo 'checked="checked" '; ?>/> <?php echo __('Open url in a new window', 'usa-html5-map'); ?></label></br>
        </div>

        <div style="<?php echo $style_area; ?>" id="stateDescr<?php echo $vals['id']?>"><br />
            <span class="title"><?php echo __('Description:', 'usa-html5-map'); ?> <span class="tipsy-q" original-title="<?php esc_attr_e('The description is displayed to the right of the map and contains contacts or some other additional information', 'usa-html5-map'); ?>">[?]</span> </span>
            <?php wp_editor($options[$map_id]['state_info'][$vals['id']], 'descr'.$vals['id'], $mce_options); ?>
            </br>
        </div>

        <div style="<?php echo $style_popup; ?>" id="statePopup<?php echo $vals['id']?>"><br />
            <span class="title"><?php echo __('Select lightbox popup:', 'usa-html5-map'); ?> </span>
            <select name="popup-id">
                <?php foreach($popups as $popup) { ?>
                <option value="<?php echo $popup->id; ?>" <?php echo ($vals['popup-id']==$popup->id) ? "selected" : ""; ?>><?php echo $popup->title; ?> - <?php echo $popup->type; ?></option>
                <?php } ?>
            </select>
        </div>
        <br />
        <span class="title"><?php echo __('Info for tooltip balloon:', 'usa-html5-map'); ?> <span class="tipsy-q" original-title="<?php esc_attr_e('Info for tooltip balloon', 'usa-html5-map'); ?>">[?]</span> </span><textarea style="width:100%; height: 150px;" class="" rows="10" cols="45" name="info[<?php echo $vals['id']?>]"><?php echo $vals['comment']?></textarea><br />

        <span class="title"><?php echo __('Area color:', 'usa-html5-map'); ?> </span><input class="color colorSimple" type="text" name="color[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map']?>" style="background-color: #<?php echo $vals['color_map']?>"  />
        <span class="tipsy-q" original-title='<?php esc_attr_e('The color of an area.', 'usa-html5-map'); ?>'>[?]</span><div class="colorpicker"></div>
        <label><input name="colorSimpleCh[<?php echo $vals['id']?>]" class="colorSimpleCh" type="checkbox" /> <?php echo __('Apply to all areas', 'usa-html5-map'); ?></label>
        <br />
        <span class="title"><?php echo __('Area hover color:', 'usa-html5-map'); ?> </span><input class="color colorOver" type="text" name="color_[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map_over']?>" style="background-color: #<?php echo $vals['color_map_over']?>"  />
        <span class="tipsy-q" original-title='<?php echo __('The color of an area when the mouse cursor is over it.', 'usa-html5-map'); ?>'>[?]</span><div class="colorpicker"></div>
        <label><input name="colorOverCh[<?php echo $vals['id']?>]" class="colorOverCh" type="checkbox" /> <?php echo __('Apply to all areas', 'usa-html5-map'); ?></label>
        <br />

        <span class="title"><?php echo __('Image URL:', 'usa-html5-map'); ?> </span>
            <input onclick="imageFieldId = this.id; tb_show('Image', 'media-upload.php?type=image&tab=library&TB_iframe=true');" class="" type="text" id="image-<?php echo $vals['id']?>" name="image[<?php echo $vals['id']?>]" value="<?php echo $vals['image']?>" />
            <span style="font-size: 10px; cursor: pointer;" onclick="clearImage(this)"><?php echo __('clear', 'usa-html5-map'); ?></span>
        <span class="tipsy-q" original-title="<?php esc_attr_e('The path to file of the image to display in a popup', 'usa-html5-map'); ?>">[?]</span><br />
        </div>

    </fieldset>
        <?php
    }
    ?>

    <input type="hidden" name="act_type" value="usa-html5-map-states-save" />
    <p class="submit"><input type="submit" value="<?php esc_attr_e('Save Changes', 'usa-html5-map'); ?>" class="button-primary" id="submit" name="submit" disabled="disabled"></p>
</form>
</div>
