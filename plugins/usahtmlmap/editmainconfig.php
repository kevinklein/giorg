<?php

$options = usa_html5map_plugin_get_options();
$option_keys = is_array($options) ? array_keys($options) : array();
$map_id  = (isset($_REQUEST['map_id'])) ? intval($_REQUEST['map_id']) : array_shift($option_keys) ;

if((isset($_POST['act_type']) && $_POST['act_type'] == 'usa-html5-map-main-save') && current_user_can('manage_options')) {

    $_REQUEST['options']['nameStroke']     = (isset($_REQUEST['options']['nameStroke'])) ? 1 : 0;
    $_REQUEST['options']['name']           = stripslashes($_REQUEST['options']['name']);

    if ($_REQUEST['options']['popupCommentColor'] == 'default')
        $_REQUEST['options']['popupCommentColor'] = '';

    foreach (array('borderColor', 'nameColor', 'popupNameColor', 'popupCommentColor') as $field)
        $_REQUEST['options'][$field]    = $_REQUEST['options'][$field] ?
            ($_REQUEST['options'][$field][0] == '#' ? $_REQUEST['options'][$field] : '#' . $_REQUEST['options'][$field]) : '';

    if ( ! empty($_REQUEST['options']['defaultAddInfo']))
        $_REQUEST['options']['defaultAddInfo'] = wp_kses_post(stripslashes($_REQUEST['options']['defaultAddInfo']));
    else
        $_REQUEST['options']['defaultAddInfo'] = '';

    $_REQUEST['options']['zoomEnable']              = (isset($_REQUEST['options']['zoomEnable'])) ? 1 : 0;

    if ($_REQUEST['options']['zoomEnable']) {

        $_REQUEST['options']['zoomEnableControls']      = (isset($_REQUEST['options']['zoomEnableControls'])) ? 1 : 0;
        $_REQUEST['options']['zoomIgnoreMouseScroll']   = (isset($_REQUEST['options']['zoomIgnoreMouseScroll'])) ? 1 : 0;

        $zm = intval($_REQUEST['options']['zoomMax']);
        $_REQUEST['options']['zoomMax'] = $zm = min(10, max(1, $zm));

        if (preg_match('/(\d+[\.,])?\d+/', $_REQUEST['options']['zoomStep'])) {
            $v = str_replace(',','.', $_REQUEST['options']['zoomStep']);
            if ($v > $zm)
                $v = $zm/2;
            elseif ($v < 0)
                $v = 0.2;
            $_REQUEST['options']['zoomStep'] = $v;
        } else {
            $_REQUEST['options']['zoomStep'] = 0.2;
        }
    }
    if (isset($_REQUEST['options']['shadowWidth']))
    {
        if (preg_match('/(\d+[\.,])?\d+/', $_REQUEST['options']['shadowWidth'])) {
            $v = str_replace(',','.', $_REQUEST['options']['shadowWidth']);
            if ($v > 10)
                $v = 10;
            elseif ($v < 0)
                $v = 0.2;
            $_REQUEST['options']['shadowWidth'] = $v;
        } else {
            $_REQUEST['options']['shadowWidth'] = 1.5;
        }
    }

    if (isset($_REQUEST['options']['borderWidth']))
    {
        if (preg_match('/(\d+[\.,])?\d+/', $_REQUEST['options']['borderWidth'])) {
            $v = str_replace(',','.', $_REQUEST['options']['borderWidth']);
            if ($v > 3)
                $v = 3;
            elseif ($v < 0)
                $v = 0.2;
            $_REQUEST['options']['borderWidth'] = $v;
        } else {
            $_REQUEST['options']['borderWidth'] = 1.5;
        }
    }

    foreach($_REQUEST['options'] as $key => $value) if ($key != 'defaultAddInfo') { $_REQUEST['options'][$key] = sanitize_text_field($value); }

    if ( ! isset($options[$map_id]['defaultAddInfo']))
        $options[$map_id]['defaultAddInfo'] = '';

    $options[$map_id] = wp_parse_args($_REQUEST['options'],$options[$map_id]);
    if ( ! empty($_REQUEST['options']['hideSN']))
        $options[$map_id]['hideSN'] = true;
    else
        unset($options[$map_id]['hideSN']);

    $options[$map_id]['shadowAllow'] = ( ! empty($_REQUEST['options']['shadowAllow']));
    $options[$map_id]['autoScrollToInfo'] = ( ! empty($_REQUEST['options']['autoScrollToInfo']));
    $options[$map_id]['freezeTooltipOnClick'] = ( ! empty($_REQUEST['options']['freezeTooltipOnClick']));

    $options[$map_id]['areasList'] = ( ! empty($_REQUEST['options']['areasList']));
    $options[$map_id]['tooltipOnHighlightIn'] = ( ! empty($_REQUEST['options']['tooltipOnHighlightIn']));
    $options[$map_id]['cacheSettings'] = ( ! empty($_REQUEST['options']['cacheSettings']));
    $options[$map_id]['tooltipOnMobileCentralize'] = ( ! empty($_REQUEST['options']['tooltipOnMobileCentralize']));

    if (isset($_REQUEST['options']['tooltipOnMobileWidth'])) {
        $tcw = (int)$_REQUEST['options']['tooltipOnMobileWidth'];
        if (!$tcw) $tcw = 80;
        $options[$map_id]['tooltipOnMobileWidth'] = min(100, max(50, $tcw)).'%';
    }

    $options[$map_id]['update_time'] = time();
    usa_html5map_plugin_save_options($options);

}

$defOptions = usa_html5map_plugin_map_defaults('', 1, true);
foreach ($defOptions as $k => $v) {
    if (!isset($options[$map_id][$k]))
        $options[$map_id][$k] = $v;
}

$mce_options = array(
    //'media_buttons' => false,
    'editor_height'   => 150,
    'textarea_rows'   => 20,
    'textarea_name'   => 'options[defaultAddInfo]',
    'tinymce' => array(
        'add_unload_trigger' => false,
    )
);

echo "<div class=\"wrap\"><h2>" . __('HTML5 Map Config', 'usa-html5-map') . "</h2>";
?>
<script xmlns="http://www.w3.org/1999/html">
    jQuery(function($){
        $('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

        $('.color~.colorpicker').each(function(){
            $(this).farbtastic($(this).prev().prev());
            $(this).hide();
            $(this).prev().prev().bind('focus', function(){
                $(this).next().next().fadeIn();
            });
            $(this).prev().prev().bind('blur', function(){
                $(this).next().next().fadeOut();
            });
        });

        $('input[name*=isResponsive]').change(function() {

            var resp = $('input[name*=isResponsive]:eq(0)').attr('checked')=='checked' ? false : true;
            $('input[name*=maxWidth]').attr('disabled',!resp);
            $('input[name*=mapWidth],input[name*=mapHeight]').attr('disabled',resp);

        });
        $('input[name*=isResponsive]').trigger('change');

        $('input[name*=zoomEnable]').change(function() {

            var resp = $('input[name*=zoomEnable]:eq(0)').attr('checked')=='checked' ? false : true;
            $('input[name*=zoomEnableControls],input[name*=zoomIgnoreMouseScroll],input[name*=zoomMax],input[name*=zoomStep]').attr('disabled',resp);

        });
        $('input[name*=tooltipOnMobileCentralize]').change(function() {
            var resp = $('input[name*=tooltipOnMobileCentralize]:eq(0)').attr('checked')=='checked' ? false : true;
            $('input[name*=tooltipOnMobileWidth],select[name*=tooltipOnMobileVPosition]').attr('disabled',resp);

        });
        $('input[name*=shadowAllow]').change(function() {
            var resp = $('input[name*=shadowAllow]:eq(0)').attr('checked')=='checked' ? false : true;
            $('input[name*=shadowWidth]').attr('disabled',resp);
        });
        $('input[name*=zoomEnable],input[name*=shadowAllow],input[name*=tooltipOnMobileCentralize]').trigger('change');

        $('input[name*=statesInfoArea]').change(function() {
            $('input[name*=autoScrollToInfo]').attr('disabled', $('input[name*=statesInfoArea]:checked').val() == 'bottom' ? false : true);
        }).trigger('change');

        $('input[name*="areasList"]').change(function() {
            $('input[name*=listWidth],input[name*=listFontSize],input[name*=tooltipOnHighlightIn]').attr('disabled', !$(this).prop('checked'));
        }).trigger('change');

    });
</script>
<br />
<form method="POST" class="usa-html5-map main">
<?php 
    usa_html5map_plugin_map_selector('options', $map_id, $options);
    echo "<br /><br />\n";
    usa_html5map_plugin_nav_tabs('options', $map_id);
?>

    <p><?php echo __('Specify general settings of the map. To choose a color, click a color box, select the desired color in the color selection dialog and click anywhere outside the dialog to apply the chosen color.', 'usa-html5-map'); ?></p>
    <fieldset>
        <legend><?php echo __('Map Settings', 'usa-html5-map'); ?></legend>

        <span class="title"><?php echo __('Map name:', 'usa-html5-map'); ?> </span><input type="text" name="options[name]" value="<?php echo $options[$map_id]['name']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Name of the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('Layout type:', 'usa-html5-map'); ?> </span>
        <label><?php echo __('Not Responsive:', 'usa-html5-map'); ?> <input type="radio" name="options[isResponsive]" value=0 <?php echo !$options[$map_id]['isResponsive']?'checked':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><?php echo __('Responsive:', 'usa-html5-map'); ?> <input type="radio" name="options[isResponsive]" value=1 <?php echo $options[$map_id]['isResponsive']?'checked':''?> /></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Type of the layout', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 10px"></div>

        <span class="title"><?php echo __('Map width:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[mapWidth]" value="<?php echo $options[$map_id]['mapWidth']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The width of the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('Map height:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[mapHeight]" value="<?php echo $options[$map_id]['mapHeight']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The height of the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('Max width:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[maxWidth]" value="<?php echo $options[$map_id]['maxWidth']; ?>" disabled />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The max width of the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="height: 10px"></div>

        <hr/>
        <h4 class="title"><?php echo __('List of names:', 'usa-html5-map'); ?> </h4><br/>

        <div style="float: left; width: 50%; padding-top: 5px;">
        <span class="title"><?php echo __('Show list of names:', 'usa-html5-map'); ?> </span><input type="checkbox" name="options[areasList]" value="1" <?php echo (isset($options[$map_id]['areasList'])&&$options[$map_id]['areasList']) ?'checked':''?> />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Show list of names', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 20px"></div>

        <span class="title"><?php echo __('Show name/tooltip on hover:', 'usa-html5-map'); ?> </span><input type="checkbox" name="options[tooltipOnHighlightIn]" value="1" <?php echo $options[$map_id]['tooltipOnHighlightIn'] ?'checked':'' ?> disabled />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Show name/tooltip on hover', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 10px"></div>
        </div>

        <div style="float: left; width: 50%;">
        <span class="title"><?php echo __('List width (%):', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[listWidth]" value="<?php echo $options[$map_id]['listWidth']; ?>" disabled />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The width of the list', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        <span class="title"><?php echo __('List Font Size:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[listFontSize]" value="<?php echo $options[$map_id]['listFontSize']; ?>" disabled />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Font size of the list', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>

<!-- @ifdef wp_allow_zoom -->
<hr/>
        <h4 class="title"><?php echo __('Zooming capabilities:', 'usa-html5-map'); ?> </h4><br/>
        <div style="float: left; width: 50%;">
        <label><span class="title"><?php echo __('Allow zoom:', 'usa-html5-map') ?></span> <input type="checkbox" name="options[zoomEnable]" value="right" <?php echo (isset($options[$map_id]['zoomEnable'])&&$options[$map_id]['zoomEnable']) ?'checked':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="tipsy-q" original-title="<?php esc_attr_e('Allow map zooming', 'usa-html5-map'); ?>">[?]</span><br />
        <label><span class="title"><?php echo __('Show zoom controls:', 'usa-html5-map') ?></span> <input type="checkbox" name="options[zoomEnableControls]" value="bottom" <?php echo (isset($options[$map_id]['zoomEnableControls'])&&$options[$map_id]['zoomEnableControls']) ?'checked':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="tipsy-q" original-title="<?php esc_attr_e('Whether to show or not +/- buttons', 'usa-html5-map'); ?>">[?]</span><br />
        <label><span class="title"><?php echo __('Ignore mouse scroll:', 'usa-html5-map') ?></span> <input type="checkbox" name="options[zoomIgnoreMouseScroll]" value="bottom" <?php echo (isset($options[$map_id]['zoomIgnoreMouseScroll'])&&$options[$map_id]['zoomIgnoreMouseScroll']) ?'checked':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="tipsy-q" original-title="<?php esc_attr_e('Do not zoom in/out by mouse scrolling', 'usa-html5-map'); ?>">[?]</span><br />
        </div>
        <div style="float: left; width: 50%;">
        <span class="title"><?php echo __('Max zoom:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[zoomMax]" value="<?php echo (isset($options[$map_id]['zoomMax'])&&intval($options[$map_id]['zoomMax']))? intval($options[$map_id]['zoomMax']) : 2; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Maximum zooming level', 'usa-html5-map'); ?>">[?]</span><br />
        <span class="title"><?php echo __('Zoom step:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[zoomStep]" value="<?php echo (isset($options[$map_id]['zoomStep']))? $options[$map_id]['zoomStep'] : 0.2; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('Zoom step', 'usa-html5-map'); ?>">[?]</span>
        </div>
        <div class="clear"></div>
<!-- @endif -->
<hr>
        <div style="float: left; width: 50%;">
        <label><span class="title"><?php echo __('Hide shortnames:', 'usa-html5-map'); ?> </span>
        <input type="checkbox" name="options[hideSN]" <?php echo isset($options[$map_id]['hideSN'])?'checked="checked"':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="tipsy-q" original-title="<?php esc_attr_e('Do not show shortnames on the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 10px"></div>

        <label><span class="title"><?php echo __('Enable shadows:', 'usa-html5-map'); ?> </span>
        <input type="checkbox" name="options[shadowAllow]" <?php echo $options[$map_id]['shadowAllow']?'checked="checked"':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <span class="tipsy-q" original-title="<?php esc_attr_e('Enable / disable shadows', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 10px"></div>

        <label><span class="title"><?php echo __('Shadow width:', 'usa-html5-map'); ?> </span>
        <input class="span2" type="text" name="options[shadowWidth]" value="<?php echo (float)($options[$map_id]['shadowWidth']); ?>" /></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Shadow width', 'usa-html5-map'); ?>">[?]</span><br />
        </div>

        <div style="float: left; width: 50%;">
        <label><span class="title" style="width: 250px"><?php echo __('Pin tooltip on click:', 'usa-html5-map'); ?> </span>
        <input type="checkbox" name="options[freezeTooltipOnClick]" <?php echo $options[$map_id]['freezeTooltipOnClick']?'checked="checked"':''?> /></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Pin tooltip on click', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear" style="margin-bottom: 10px"></div>

        <label><span class="title" style="width: 250px"><?php echo __('Center tooltip on mobile devices:', 'usa-html5-map'); ?> </span>
        <input class="span2" type="checkbox" name="options[tooltipOnMobileCentralize]" <?php echo $options[$map_id]['tooltipOnMobileCentralize']?'checked="checked"':''; ?> /></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Center tooltip on mobile devices', 'usa-html5-map'); ?>">[?]</span><br />
        <div class="clear" style="margin-bottom: 10px"></div>

        <label><span class="title" style="width: 250px"><?php echo __('Centered tooltip width:', 'usa-html5-map'); ?> </span>
        <input class="span2" type="text" name="options[tooltipOnMobileWidth]" value="<?php echo $options[$map_id]['tooltipOnMobileWidth']; ?>" style="width: 150px"/></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Centered tooltip width (only on mobile devices)', 'usa-html5-map'); ?>">[?]</span><br />
<?php if (0) {  // temporary disabled due to pure implementation ?>
        <label><span class="title" style="width: 250px"><?php echo __('Centered tooltip vertical position:', 'usa-html5-map'); ?> </span>
        <select class="span2" name="options[tooltipOnMobileVPosition]">
            <option value="top" <?php echo $options[$map_id]['tooltipOnMobileVPosition'] == "top" ? 'selected':'' ?>>Over</option>
            <option value="center" <?php echo $options[$map_id]['tooltipOnMobileVPosition'] == "center" ? 'selected':'' ?>>Behind</option>
            <option value="bottom" <?php echo $options[$map_id]['tooltipOnMobileVPosition'] == "bottom" ? 'selected':'' ?>>Under</option>
        </select>
        </label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Tooltip vertical position (only on mobile devices)', 'usa-html5-map'); ?>">[?]</span><br />
<?php } ?>
        </div>
        <div class="clear" style="margin-bottom: 10px"></div>

<hr>
        <div style="float: left; width: 50%;">
        <span class="title"><?php echo __('Borders Color:', 'usa-html5-map'); ?> </span><input class="color" type="text" name="options[borderColor]" value="<?php echo $options[$map_id]['borderColor']; ?>" style="background-color: #<?php echo $options[$map_id]['borderColor']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The color of borders on the map', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div>
        <div class="clear"></div>

        <span class="title"><?php echo __('Borders Width:', 'usa-html5-map'); ?> </span><input class="" type="text" name="options[borderWidth]" value="<?php echo $options[$map_id]['borderWidth']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The width of borders on the map', 'usa-html5-map'); ?>">[?]</span>
        <div class="clear"></div>

        </div>

        <div style="float: left; width: 50%;">
        <span class="title"><?php echo __('Borders Hover Color:', 'usa-html5-map'); ?> </span><input class="color" type="text" name="options[borderColorOver]" value="<?php echo $options[$map_id]['borderColorOver']; ?>" style="background-color: #<?php echo $options[$map_id]['borderColorOver']; ?>" />
        <span class="tipsy-q" original-title="<?php esc_attr_e('The color of borders on the map while mouse is over this region', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div>
        <div class="clear"></div>

        </div>
    </fieldset>


    <fieldset>
        <legend><?php echo __('Content Info', 'usa-html5-map'); ?></legend>
        <span class="title"><?php echo __('Additional Info Area:', 'usa-html5-map'); ?> </span>
        <label><?php echo __('At right:', 'usa-html5-map') ?> <input type="radio" name="options[statesInfoArea]" value="right" <?php echo $options[$map_id]['statesInfoArea'] == 'right'?'checked="checked"':''?> /></label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><?php echo __('At bottom:', 'usa-html5-map') ?> <input type="radio" name="options[statesInfoArea]" value="bottom" <?php echo $options[$map_id]['statesInfoArea'] == 'bottom'?'checked="checked"':''?> /></label>
        <span class="tipsy-q" original-title="<?php esc_attr_e('Where to place an additional information about state', 'usa-html5-map'); ?>">[?]</span><br /><br/>
        <label><input type="checkbox" name="options[autoScrollToInfo]" <?php echo (isset($options[$map_id]['autoScrollToInfo']) AND $options[$map_id]['autoScrollToInfo'])?'checked="checked"':''?>>
            <?php echo __('Automatically scroll to info area on click', 'usa-html5-map')?></label><br/>
        <br/>
        <div id="action-info">
            <span class="title"><?php echo __('Default content:', 'usa-html5-map'); ?> <span class="tipsy-q" original-title="<?php esc_attr_e('Default content that will be shown in area for additional information', 'usa-html5-map'); ?>">[?]</span> </span>
            <br/><br/>
            <?php wp_editor(isset($options[$map_id]['defaultAddInfo']) ? $options[$map_id]['defaultAddInfo'] : '', 'defaultAddInfo', $mce_options); ?>
        </div>
    </fieldset>

    <fieldset class="font-sizes">
        <legend><?php echo __('Font sizes and colors', 'usa-html5-map'); ?></legend>

        <div class="left-block">
            <h4 class="settings-chapter">
                <?php echo __('Name displayed on the map', 'usa-html5-map'); ?>
            </h4>

            <span class="title"><?php echo __('Font Size:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[nameFontSize]" value="<?php echo $options[$map_id]['nameFontSize']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('Font size of names on the map', 'usa-html5-map'); ?>">[?]</span><br />

            <span class="title"><?php echo __('Color:', 'usa-html5-map'); ?> </span><input id='color' class="color" type="text" name="options[nameColor]" value="<?php echo $options[$map_id]['nameColor']; ?>" style="background-color: #<?php echo $options[$map_id]['nameColor']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of names on the map', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />

            <span class="title"><?php echo __('Color over:', 'usa-html5-map'); ?> </span><input id='colorOver' class="color" type="text" name="options[nameColorOver]" value="<?php echo $options[$map_id]['nameColorOver']; ?>" style="background-color: #<?php echo $options[$map_id]['nameColorOver']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of names on the map while mouse is over', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />

            <span class="title"><?php echo __('Name Stroke:', 'usa-html5-map'); ?> </span><input type="checkbox" name="options[nameStroke]" value=1 <?php echo $options[$map_id]['nameStroke']?'checked':''?> autocomplete="off" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The stroke on regions names', 'usa-html5-map'); ?>">[?]</span><br />
            <div class="clear" style="margin-bottom: 10px"></div>

            <span class="title"><?php echo __('Stroke color:', 'usa-html5-map'); ?> </span><input id='scolor' class="color" type="text" name="options[nameStrokeColor]" value="<?php echo $options[$map_id]['nameStrokeColor']; ?>" style="background-color: #<?php echo $options[$map_id]['nameStrokeColor']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of names on the map', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />

            <span class="title"><?php echo __('Stroke color over:', 'usa-html5-map'); ?> </span><input id='scoloro' class="color" type="text" name="options[nameStrokeColorOver]" value="<?php echo $options[$map_id]['nameStrokeColorOver']; ?>" style="background-color: #<?php echo $options[$map_id]['nameStrokeColorOver']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of names on the map while mouse is over', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />

        </div>

        <div class="left-block">
            <h4 class="settings-chapter">
                <?php echo __('Tooltip name', 'usa-html5-map'); ?>
            </h4>

            <span class="title"><?php echo __('Font Size:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[popupNameFontSize]" value="<?php echo $options[$map_id]['popupNameFontSize']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('Font size of names on the popup', 'usa-html5-map'); ?>">[?]</span><br />

            <span class="title"><?php echo __('Color:', 'usa-html5-map'); ?> </span><input id='pncolor' class="color" type="text" name="options[popupNameColor]" value="<?php echo $options[$map_id]['popupNameColor']; ?>" style="background-color: #<?php echo $options[$map_id]['popupNameColor']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of names on the popup', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />

            <h4 class="settings-chapter">
                <?php echo __('Tooltip comment', 'usa-html5-map'); ?>
            </h4>

            <span class="title"><?php echo __('Font Size:', 'usa-html5-map'); ?> </span><input class="span2" type="text" name="options[popupCommentFontSize]" value="<?php echo $options[$map_id]['popupCommentFontSize']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('Font size of content in the popup', 'usa-html5-map'); ?>">[?]</span><br />

            <span class="title"><?php echo __('Color:', 'usa-html5-map'); ?> </span><input id='pccolor' class="color" type="text" name="options[popupCommentColor]" value="<?php echo $options[$map_id]['popupCommentColor'] ? $options[$map_id]['popupCommentColor'] : 'default'; ?>" style="background-color: #<?php echo $options[$map_id]['popupCommentColor']; ?>" />
            <span class="tipsy-q" original-title="<?php esc_attr_e('The color of content in the popup', 'usa-html5-map'); ?>">[?]</span><div class="colorpicker"></div><br />
        </div>

    </fieldset>

<?php
$cacheCanBeEnabled = is_writable(dirname(__FILE__).'/static');
$cacheEnabled = (isset($options[$map_id]['update_time']) and isset($options[$map_id]['cacheSettings']) and $options[$map_id]['cacheSettings']);
?>
    <fieldset class="font-sizes">
        <legend><?php echo __('Performance settings', 'usa-html5-map'); ?></legend>

        <span class="title"><?php echo __('Enable settings caching:', 'usa-html5-map'); ?> </span><input type="checkbox" name="options[cacheSettings]" value="1" <?php echo $cacheEnabled ?'checked':'' ?> <?php echo $cacheCanBeEnabled ? '' : 'disabled' ?> />
        <span class="tipsy-q" original-title="<?php esc_attr_e('This will increase map loading speed', 'usa-html5-map'); ?>">[?]</span>
        <?php if ( ! $cacheCanBeEnabled) { ?>
        <div class="error"><?php echo __('Settings cache cannot be enabled because plugins directory is not writable', 'usa-html5-map'); ?></div>
        <?php } ?>
        <div class="clear" style="margin-bottom: 10px"></div>

	</fieldset>

    <input type="hidden" name="act_type" value="usa-html5-map-main-save" />
    <p class="submit"><input type="submit" value="<?php esc_attr_e('Save Changes', 'usa-html5-map'); ?>" class="button-primary" id="submit" name="submit"></p>

</form>
</div>
