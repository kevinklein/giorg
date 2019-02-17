<?php
/*
Plugin Name: Interactive Map of the USA for WP
Plugin URI: http://www.fla-shop.com
Description: High-quality map plugin of the USA for WordPress. The map depicts states and features color, font, landing page and popup customization
Text Domain: usa-html5-map
Domain Path: /languages
Version: 2.9.7
Author: Fla-shop.com
Author URI: http://www.fla-shop.com
License:
*/

add_action('plugins_loaded', 'usa_html5map_plugin_load_domain' );
function usa_html5map_plugin_load_domain() {
    load_plugin_textdomain( 'usa-html5-map', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
if (isset($_REQUEST['action']) && $_REQUEST['action']=='usa-html5-map-export') { usa_html5map_plugin_export(); }

add_action('admin_menu', 'usa_html5map_plugin_menu');


function usa_html5map_plugin_menu() {

    add_menu_page(__('USA Map', 'usa-html5-map'), __('USA Map', 'usa-html5-map'), 'manage_options', 'usa-html5-map-options', 'usa_html5map_plugin_options' );

    add_submenu_page('usa-html5-map-options', __('General Settings', 'usa-html5-map'), __('General Settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-options', 'usa_html5map_plugin_options' );
    add_submenu_page('usa-html5-map-options', __('Detailed settings', 'usa-html5-map'), __('Detailed settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-states', 'usa_html5map_plugin_states');
    add_submenu_page('usa-html5-map-options', __('Groups settings', 'usa-html5-map'), __('Groups settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-groups', 'usa_html5map_plugin_groups');
    add_submenu_page('usa-html5-map-options', __('Points settings', 'usa-html5-map'), __('Points settings', 'usa-html5-map'), 'manage_options', 'usa-html5-map-points', 'usa_html5map_plugin_points');
    add_submenu_page('usa-html5-map-options', __('Map Preview', 'usa-html5-map'), __('Map Preview', 'usa-html5-map'), 'manage_options', 'usa-html5-map-view', 'usa_html5map_plugin_view');

    add_submenu_page('usa-html5-map-options', __('Maps', 'usa-html5-map'), __('Maps', 'usa-html5-map'), 'manage_options', 'usa-html5-map-maps', 'usa_html5map_plugin_maps');
}

function usa_html5map_plugin_nav_tabs($page, $map_id)
{
?>
<h2 class="nav-tab-wrapper">
    <a href="?page=usa-html5-map-options&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'options' ? 'nav-tab-active' : '' ?>"><?php _e('General settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-states&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'states' ? 'nav-tab-active' : '' ?>"><?php _e('Detailed settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-groups&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'groups' ? 'nav-tab-active' : '' ?>"><?php _e('Groups settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-points&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'points' ? 'nav-tab-active' : '' ?>"><?php _e('Points settings', 'usa-html5-map') ?></a>
    <a href="?page=usa-html5-map-view&map_id=<?php echo $map_id ?>" class="nav-tab <?php echo $page == 'view' ? 'nav-tab-active' : '' ?>"><?php _e('Preview', 'usa-html5-map') ?></a>
</h2>
<?php
}

function usa_html5map_plugin_map_selector($page, $map_id, &$options) {
?>
<script type="text/javascript">
jQuery(function($){
    $('select[name=map_id]').change(function() {
        location.href='admin.php?page=usa-html5-map-<?php echo $page ?>&map_id='+$(this).val();
    });
});
</script>
<span class="title"><?php echo __('Select a map:', 'usa-html5-map'); ?> </span>
    <select name="map_id" style="width: 185px;">
        <?php foreach($options as $id => $map_data) { ?>
            <option value="<?php echo $id; ?>" <?php echo ($id==$map_id) ? 'selected' : '';?>><?php echo $map_data['name'] . (isset($map_data['type']) ? " ($map_data[type])" : ''); ?></option>
        <?php } ?>
    </select>
    <span class="tipsy-q" original-title="<?php esc_attr_e('The map', 'usa-html5-map'); ?>">[?]</span>
    <a href="admin.php?page=usa-html5-map-maps" class="page-title-action"><?php _e('Maps list', 'usa-html5-map'); ?></a>
<?php
}

function usa_html5map_plugin_messages($successes, $errors) {
    if ($successes and is_array($successes)) {
        echo "<div class=\"updated\"><ul>";
        foreach ($successes as $s) {
            echo "<li>" . (is_array($s) ? "<strong>$s[0]</strong>$s[1]" : $s) . "</li>";
        }
        echo "</ul></div>";
    }

    if ($errors and is_array($errors)) {
        echo "<div class=\"error\"><ul>";
        foreach ($errors as $s) {
            echo "<li>" . (is_array($s) ? "<strong>$s[0]</strong>$s[1]" : $s) . "</li>";
        }
        echo "</ul></div>";
    }
}

function usa_html5map_plugin_options() {
    include('editmainconfig.php');
}

function usa_html5map_plugin_states() {
    include('editstatesconfig.php');
}

function usa_html5map_plugin_groups() {
    include('editgroupsconfig.php');
}
function usa_html5map_plugin_points() {
    include('editpointsconfig.php');
}
function usa_html5map_plugin_maps() {
    include('mapslist.php');
}

function usa_html5map_plugin_view() {

    $options = usa_html5map_plugin_get_options();
    $option_keys = is_array($options) ? array_keys($options) : array();
    $map_id  = (isset($_REQUEST['map_id'])) ? intval($_REQUEST['map_id']) : array_shift($option_keys) ;

?>
<div class="wrap">
    <div style="clear: both"></div>

    <h2><?php _e('Map Preview', 'usa-html5-map') ?></h2>
    <br />
    <form method="POST" class="usa-html5-map main">
    <?php usa_html5map_plugin_map_selector('view', $map_id, $options) ?>
    <br /><br />
    </form>
    <style type="text/css">
        .usaHtml5MapBold {font-weight: bold}
    </style>
<?php
    usa_html5map_plugin_nav_tabs('view', $map_id);
    if (function_exists('sgPopupPluginLoaded')) {
        require_once(SG_APP_POPUP_PATH.'/javascript/sg_popup_javascript.php');
        if (function_exists('SgFrontendScripts'))
            SgFrontendScripts();
        elseif (class_exists('SgPopupBuilderConfig'))
            echo SgPopupBuilderConfig::popupJsDataInit();
    }
    echo '<p>'.sprintf(__('Use shortcode %s for install this map', 'usa-html5-map'), '<span class="usaHtml5MapBold">[usahtml5map id="'.$map_id.'"]</span>').'</p>';

    echo do_shortcode('<div style="width: 99%">[usahtml5map id="'.$map_id.'"]</div>');
    echo "</div>";
}

add_action('admin_init','usa_html5map_plugin_scripts');

function usa_html5map_plugin_scripts(){
    if ( is_admin() ){

        wp_register_style('jquery-tipsy', plugins_url('/static/css/tipsy.css', __FILE__));
        wp_enqueue_style('jquery-tipsy');
        wp_register_style('usa-html5-map-adm', plugins_url('/static/css/mapadm.css', __FILE__));
        wp_enqueue_style('usa-html5-map-adm');
        wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
        wp_enqueue_style('usa-html5-map-style');
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_style('wp-jquery-ui-dialog');
        wp_enqueue_script('farbtastic');
        wp_enqueue_script('tiny_mce');
        wp_register_script('jquery-tipsy', plugins_url('/static/js/jquery.tipsy.js', __FILE__));
        wp_enqueue_script('jquery-tipsy');
    }
    else {

        wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
        wp_enqueue_style('usa-html5-map-style');

        wp_register_script('raphael', plugins_url('/static/js/raphael.min.js', __FILE__));
        wp_enqueue_script('raphael');

        wp_enqueue_script('jquery');

    }

    wp_register_script('usa-html5-map-nicescroll', plugins_url('/static/js/jquery.nicescroll.js', __FILE__));
    wp_enqueue_script('usa-html5-map-nicescroll');
}

add_action('wp_enqueue_scripts', 'usa_html5map_plugin_scripts_method');

function usa_html5map_plugin_scripts_method() {
    wp_enqueue_script('jquery');
    wp_register_style('usa-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
    wp_enqueue_style('usa-html5-map-style');

    wp_register_script('usa-html5-map-nicescroll', plugins_url('/static/js/jquery.nicescroll.js', __FILE__));
    wp_enqueue_script('usa-html5-map-nicescroll');
}


add_shortcode( 'usahtml5map', 'usa_html5map_plugin_content' );

function usa_html5map_plugin_enable_popup_scripts(&$options) {
    if (! function_exists('sgRegisterScripts'))
        return FALSE;

    if (strpos($options['map_data'], '#popup'))
        return TRUE;

    if (isset($options['points']) AND is_array($options['points'])) foreach ($options['points'] as $pt) {
        if (isset($pt['link']) AND $pt['link'] == '#popup')
            return TRUE;
    }

    if (isset($options['groups']) AND is_array($options['groups'])) foreach ($options['groups'] as $gr) {
        if ($gr['_act_over'] AND isset($gr['link']) AND $gr['link'] == '#popup')
            return TRUE;
    }

    return FALSE;
}
function usa_html5map_plugin_content($atts, $content) {
    static $firstRun = true;
    $dir               = plugins_url('/static/', __FILE__);
    $siteURL           = get_site_url();
    $options           = usa_html5map_plugin_get_options();
    $option_keys       = is_array($options) ? array_keys($options) : array();

    if (isset($atts['id'])) {
        $map_id  = intval($atts['id']);
        $options = $options[$map_id];
    } else {
        $map_id  = array_shift($option_keys);
        $options = array_shift($options);
    }
    $prfx              = "_$map_id";
    $isResponsive      = $options['isResponsive'];
    $stateInfoArea     = $options['statesInfoArea'];
    $respInfo          = $isResponsive ? ' htmlMapResponsive' : '';
    $popupNameColor    = $options['popupNameColor'];
    $popupNameFontSize = $options['popupNameFontSize'].'px';
    $type_id           = 0;
    $map_file          = "{$dir}js/map.js";
    $style             = (!empty($options['maxWidth']) && $isResponsive) ? 'max-width:'.intval($options['maxWidth']).'px' : '';

    static $count = 0;

    $settings_file = usa_html5map_plugin_settings_url($map_id, $options);

    wp_register_script('raphaeljs', "{$dir}js/raphael.min.js", array(), '2.1.4');
    wp_register_script('usa-html5-map-mapjs_'.$type_id, $map_file, array('raphaeljs'));
    wp_register_script('usa-html5-map-map_cfg_'.$map_id, $settings_file, array('raphaeljs', 'usa-html5-map-mapjs_'.$type_id));
    wp_enqueue_script('usa-html5-map-map_cfg_'.$map_id);

    $comment_css = '';
    if ( ! empty($options['popupCommentColor'])) {
        $comment_css .= "\t\t\t\tcolor: $options[popupCommentColor];\n";
    }
    if ( ! empty($options['popupCommentFontSize'])) {
        $comment_css .= "\t\t\t\tfont-size: $options[popupCommentFontSize]px;\n";
    }

    if (usa_html5map_plugin_enable_popup_scripts($options)) {
        sgRegisterScripts();
    }
    $mapInit = "
        <!-- start Fla-shop.com HTML5 Map -->";
    $mapInit .= "
        <div class='usaHtml5Map$stateInfoArea$respInfo' style='$style'>";

    $styleC  = '';
    $areasJs = '';
    if ($options['areasList']) {

        $options['listWidth'] = intval($options['listWidth']) ;
        if ($options['listWidth']<=0) { $options['listWidth'] = 20; }

        $mapInit.= usa_html5map_plugin_areas_list($options,$count);

        $areasJs = '
            jQuery(document).ready(function($) {

                $( window ).resize(function() {
                    $("#usa-html5-map-areas-list_'.$count.'").show().css({height: jQuery("#usa-html5-map-map-container_'.$count.' .fm-map-container").height() + "px"}).niceScroll({cursorwidth:"8px"});
                });

                $("#usa-html5-map-areas-list_'.$count.'").show().css({height: jQuery("#usa-html5-map-map-container_'.$count.' .fm-map-container").height() + "px"}).niceScroll({cursorwidth:"8px"});

                $("#usa-html5-map-areas-list_'.$count.' a").click(function() {

                    var id  = $(this).data("key");
                    var map = usahtml5map_map_'.$count.';

                    html5map_onclick(null,id,map);

                    return false;
                });

                $("#usa-html5-map-areas-list_'.$count.' a").on("mouseover",function() {

                    var id  = $(this).data("key");
                    var map = usahtml5map_map_'.$count.';

                    map.stateHighlightIn(id);

                });

                $("#usa-html5-map-areas-list_'.$count.' a").on("mouseout",function() {

                    var id  = $(this).data("key");
                    var map = usahtml5map_map_'.$count.';

                    map.stateHighlightOut(id);

                });

            });';


        $styleC = 'width: '.($options['statesInfoArea']!='right' ? 100-$options['listWidth'].'%' : 60-$options['listWidth'].'%' ).'; float: left';

    }


    $mapInit.="<div id='usa-html5-map-map-container_{$count}' class='usaHtml5MapContainer' style='$styleC'></div>";

    if ($options['statesInfoArea']=='bottom') { $mapInit.="<div style='clear:both; height: 20px;'></div>"; }

    $mapInit.= "
            <style>
                #usa-html5-map-map-container_{$count} .fm-tooltip-name {
                    color: $popupNameColor;
                    font-size: $popupNameFontSize;
                }
                #usa-html5-map-map-container_{$count} .fm-tooltip-comment {
                    $comment_css
                }
            </style>
            <script type=\"text/javascript\">
            jQuery(function(){
                usahtml5map_map_{$count} = new FlaShopUSAMap(usahtml5map_map_cfg_{$map_id});
                usahtml5map_map_{$count}.draw('usa-html5-map-map-container_{$count}');

                $areasJs

                var html5map_onclick = function(ev, sid, map) {
                var cfg      = usahtml5map_map_cfg_{$map_id};
                var link     = map.fetchStateAttr(sid, 'link');
                var is_group = map.fetchStateAttr(sid, 'group');
                var popup_id = map.fetchStateAttr(sid, 'popup-id');
                var is_group_info = false;

                if (is_group==undefined) {

                    if (sid.substr(0,1)=='p') {
                        popup_id = map.fetchPointAttr(sid, 'popup_id');
                        link         = map.fetchPointAttr(sid, 'link');
                    }

                } else if (typeof cfg.groups[is_group]['ignore_link'] == 'undefined' || ! cfg.groups[is_group].ignore_link)  {
                    link = cfg.groups[is_group].link;
                    popup_id = cfg.groups[is_group]['popup_id'];
                    is_group_info = true;
                }
                if (link=='#popup') {

                    if (typeof SG_POPUP_DATA == \"object\") {
                        if (popup_id in SG_POPUP_DATA) {

                            SGPopup.prototype.showPopup(popup_id,false);

                        } else {

                            jQuery.ajax({
                                type: 'POST',
                                url: '{$siteURL}/index.php?usahtml5map_get_popup',
                                data: {popup_id:popup_id},
                            }).done(function(data) {
                                jQuery('body').append(data);
                                SGPopup.prototype.showPopup(popup_id,false);
                            });

                        }
                    }

                    return false;
                }
                if (link == '#info') {
                    var id = is_group_info ? is_group : (sid.substr(0,1)=='p' ? sid : map.fetchStateAttr(sid, 'id'));
                    jQuery('#usa-html5-map-state-info_{$count}').html('". __('Loading...', 'usa-html5-map') ."');
                    jQuery.ajax({
                        type: 'POST',
                        url: '{$siteURL}/index.php?usahtml5map_get_'+(is_group_info ? 'group' : 'state')+'_info='+id+'&map_id={$map_id}',
                        success: function(data, textStatus, jqXHR){
                            jQuery('#usa-html5-map-state-info_{$count}').html(data);
                            " . (($options['statesInfoArea'] == 'bottom' AND isset($options['autoScrollToInfo']) AND $options['autoScrollToInfo']) ? "
                            jQuery(\"html, body\").animate({ scrollTop: jQuery('#usa-html5-map-state-info_{$count}').offset().top }, 1000);" : "") . "
                        },
                        dataType: 'text'
                    });

                    return false;
                }

                    if (ev===null && link!='') {

                        if (!jQuery('.html5dummilink').length) {
                            jQuery('body').append('<a href=\"#\" class=\"html5dummilink\" style=\"display:none\"></a>');
                        }

                        jQuery('.html5dummilink').attr('href',link).attr('target',(map.fetchStateAttr(sid, 'isNewWindow') ? '_blank' : '_self'))[0].click();

                    }

                };
                usahtml5map_map_{$count}.on('click',html5map_onclick);

            });
            </script>
            <div id='usa-html5-map-state-info_{$count}' class='usaHtml5MapStateInfo'>".
            (empty($options['defaultAddInfo']) ? '' : apply_filters('the_content',$options['defaultAddInfo']))
            ."</div>
            </div>
            <div style='clear: both'></div>
            <!-- end HTML5 Map -->
    ";

    $count++;

    return $mapInit;
}


$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'usa_html5map_plugin_settings_link' );

function usa_html5map_plugin_settings_link($links) {
    $settings_link = '<a href="admin.php?page=usa-html5-map-options">'.__('Settings', 'usa-html5-map').'</a>';
    array_push($links, $settings_link);
    return $links;
}


add_action( 'init', 'usa_html5map_plugin_settings' );

function usa_html5map_plugin_settings() {

    $is_map_call = false;
    foreach($_REQUEST as $key => $value) { if (strpos($key,'usahtml5map')!==false) { $is_map_call = true; break; } }
    if (!$is_map_call) { return false; } else {
        remove_all_actions( 'wp_head' );
        remove_all_actions( 'wp_footer' );
    }

    $req_start = microtime(TRUE);
    if (isset($_REQUEST['usahtml5map_js_data']) or
        isset($_REQUEST['usahtml5map_get_state_info']) or
        isset($_REQUEST['usahtml5map_get_group_info'])) {
        $map_id  = intval($_REQUEST['map_id']);
        $options = usa_html5map_plugin_get_options();
        $options = $options[$map_id];
        if ($options)
            $options['map_data'] = str_replace('\\\\n','\\n',$options['map_data']);
    } else if (isset($_REQUEST['usahtml5map_get_popup']) ) {

        $popup = do_shortcode('[sg_popup id="'.intval($_REQUEST['popup_id']).'"][/sg_popup]');
        $popup = substr($popup,0,strpos($popup,'</script>')+9);
        echo $popup; exit();
    }


    if( isset($_GET['usahtml5map_js_data']) ) {

        header( 'Content-Type: application/javascript' );
        usa_html5map_plugin_print_map_settings($map_id, $options);
        echo '// Generated in '.(microtime(TRUE)-$req_start).' secs.';
        exit;
    }

    if(isset($_GET['usahtml5map_get_state_info'])) {
        $stateId = $_GET['usahtml5map_get_state_info'];

        $info = $options['state_info'][$stateId];
        echo apply_filters('the_content',$info);

        exit;
    }

    if(isset($_GET['usahtml5map_get_group_info'])) {
        $gid = $_GET['usahtml5map_get_group_info'];

        $info = isset($options['groups'][$gid]['info']) ? $options['groups'][$gid]['info'] : '';
        echo apply_filters('the_content',$info);

        exit;
    }
}

function usa_html5map_plugin_print_map_settings($map_id, &$map_options) {
    if ( ! $map_options) {
        ?>
        var	map_cfg = {
            map_data: {}
        };
        <?php
        return;
    }
    $data = json_decode($map_options['map_data'], true);
    $protected_shortnames = array('st7', 'st8', 'st9', 'st12', 'st21', 'st22', 'st30', 'st31', 'st40', 'st46');
    $siteURL           = get_site_url();
    foreach ($data as $sid => &$d)
    {
        if (isset($d['comment']) AND $d['comment'] AND preg_match('/\[([\w-_]+)([^\]]*)?\](?:(.+?)?\[\/\1\])?/', $d['comment']))
            $d['comment'] = do_shortcode($d['comment']);
        if (isset($d['_hide_name'])) {
            unset($d['_hide_name']);
            $d['name'] = '';
        }
        if (isset($map_options['hideSN']) AND ! in_array($sid, $protected_shortnames))
            $d['shortname'] = '';
        $d['link'] = strpos($d['link'], 'javascript:') === 0 ? '#info' : $d['link'];
    }
    unset($d);
    $map_options['map_data'] = json_encode($data);
    $grps = array();
    if (isset($map_options['groups']) AND is_array($map_options['groups'])) {
        foreach ($map_options['groups'] as $gid => $grp) {
            $grps[$gid] = array();
            if ($grp['_popup_over']) {
                $grps[$gid]['name'] = $grp['name'];
                $grps[$gid]['comment'] = $grp['comment'];
                $grps[$gid]['image'] = $grp['image'];
            }
            if ($grp['_act_over']) {
                $grps[$gid]['link'] = strpos($grp['link'], 'javascript:') === 0 ? '#info' : $grp['link'];
                $grps[$gid]['isNewWindow'] = empty($grp['isNewWindow']) ? FALSE : TRUE;
                $grps[$gid]['popup_id']    = isset($grp['popup-id']) ? intval($grp['popup-id']) : -1;
            } else {
                $grps[$gid]['ignore_link'] = true;
            }
            if ($grp['_clr_over']) {
                $grps[$gid]['color'] = $grp['color_map'];
                $grps[$gid]['colorOver'] = $grp['color_map_over'];
            }
            if ($grp['_ignore_group']) {
                $grps[$gid]['ignoreMouse'] = true;
            }
            if (!$grps[$gid])
                unset($grps[$gid]);
        }
    }
    $defOptions = usa_html5map_plugin_map_defaults('', 1, true);
    foreach ($defOptions as $k => $v) {
        if (!isset($map_options[$k]))
            $map_options[$k] = $v;
    }
    if (isset($map_options['points']) AND is_array($map_options['points'])) {
        foreach ($map_options['points'] as $pid => &$p) {
            if(isset($p['link']))
                $p['link'] = strpos($p['link'], 'javascript:') === 0 ? '#info' : $p['link'];
        }
        unset($p);
    }
    ?>

    var	usahtml5map_map_cfg_<?php echo $map_id ?> = {

    <?php  if(!$map_options['isResponsive']) { ?>
    mapWidth		: <?php echo $map_options['mapWidth']; ?>,
    mapHeight		: <?php echo $map_options['mapHeight']; ?>,
    <?php }     else { ?>
    mapWidth		: 0,
    <?php } ?>
    zoomEnable              : <?php echo (isset($map_options['zoomEnable']) AND $map_options['zoomEnable']) ? 'true' : 'false'; ?>,
    zoomEnableControls      : <?php echo (isset($map_options['zoomEnableControls']) AND $map_options['zoomEnableControls']) ? 'true' : 'false'; ?>,
    zoomIgnoreMouseScroll   : <?php echo (isset($map_options['zoomIgnoreMouseScroll']) AND $map_options['zoomIgnoreMouseScroll']) ? 'true' : 'false'; ?>,
    zoomMax   : <?php echo $map_options['zoomMax']; ?>,
    zoomStep   : <?php echo $map_options['zoomStep']; ?>,
    pointColor            : "<?php echo $map_options['pointColor']?>",
    pointColorOver        : "<?php echo $map_options['pointColorOver']?>",
    pointNameColor        : "<?php echo $map_options['pointNameColor']?>",
    pointNameColorOver    : "<?php echo $map_options['pointNameColorOver']?>",
    pointNameStrokeColor        : "<?php echo $map_options['pointNameStrokeColor']?>",
    pointNameStrokeColorOver    : "<?php echo $map_options['pointNameStrokeColorOver']?>",
    pointNameFontSize     : "12px",
    pointNameFontWeight   : "bold",
    pointNameStroke       : true,

    pointBorderWidth      : 0.5,
    pointBorderColor      : "<?php echo $map_options['pointBorderColor']?>",
    pointBorderColorOver  : "<?php echo $map_options['pointBorderColorOver']?>",
    shadowAllow             : <?php echo $map_options['shadowAllow'] ? 'true' : 'false'; ?>,
    shadowWidth		: <?php echo $map_options['shadowWidth']; ?>,
    shadowOpacity		: <?php echo $map_options['shadowOpacity']; ?>,
    shadowColor		: "<?php echo $map_options['shadowColor']; ?>",
    shadowX			: <?php echo $map_options['shadowX']; ?>,
    shadowY			: <?php echo $map_options['shadowY']; ?>,

    iPhoneLink		: <?php echo $map_options['iPhoneLink']; ?>,

    isNewWindow		: <?php echo $map_options['isNewWindow']; ?>,

    borderWidth     : "<?php echo $map_options['borderWidth']; ?>",
    borderColor		: "<?php echo $map_options['borderColor']; ?>",
    borderColorOver		: "<?php echo $map_options['borderColorOver']; ?>",

    nameColor		: "<?php echo $map_options['nameColor']; ?>",
    nameColorOver		: "<?php echo $map_options['nameColorOver']; ?>",
    popupNameColor		: "<?php echo $map_options['popupNameColor']; ?>",
    nameFontSize		: "<?php echo $map_options['nameFontSize'].'px'; ?>",
    popupNameFontSize	: "<?php echo $map_options['popupNameFontSize'].'px'; ?>",
    nameFontWeight		: "<?php echo $map_options['nameFontWeight']; ?>",

    overDelay		: <?php echo $map_options['overDelay']; ?>,
    nameStroke		: <?php echo $map_options['nameStroke']?'true':'false'; ?>,
    nameStrokeColor		: "<?php echo $map_options['nameStrokeColor']; ?>",
    nameStrokeColorOver	: "<?php echo $map_options['nameStrokeColorOver']; ?>",
    freezeTooltipOnClick: <?php echo $map_options['freezeTooltipOnClick']?'true':'false'; ?>,

    tooltipOnHighlightIn: <?php echo $map_options['tooltipOnHighlightIn']?'true':'false'; ?>,
    tooltipOnMobileCentralize: <?php echo $map_options['tooltipOnMobileCentralize']?'true':'false'; ?>,
    tooltipOnMobileWidth: "<?php echo $map_options['tooltipOnMobileWidth']; ?>",
    tooltipOnMobileVPosition: "<?php echo $map_options['tooltipOnMobileVPosition']; ?>",

    map_data        : <?php echo $map_options['map_data']; ?>
    ,groups          : <?php echo $grps ? json_encode($grps) : '{}'; ?>
    ,points         : <?php echo (isset($map_options['points']) AND $map_options['points']) ? json_encode($map_options['points']) : '{}'; ?>
    };

    <?php
}


function usa_html5map_plugin_map_defaults($name='New map', $type=1, $baseOnly=false) {
    $defaults = array(
        'mapWidth'          =>530,
        'mapHeight'         =>410,
        'maxWidth'          =>980,
        'shadowAllow'       => true,
        'zoomEnable'            => false,
        'zoomEnableControls'    => true,
        'zoomIgnoreMouseScroll' => false,
        'zoomMax'               => 2,
        'zoomStep'              => 0.2,
        'pointColor'            => "#FFC480",
        'pointColorOver'        => "#DC8135",
        'pointNameColor'        => "#000",
        'pointNameColorOver'    => "#222",
        'pointNameFontSize'     => "12px",
        'pointNameFontWeight'   => "bold",
        'pointNameStroke'       => true,
        'pointNameStrokeColor'  => "#FFFFFF",
        'pointNameStrokeColorOver'  => "#FFFFFF",

        'pointBorderWidth'      => 0.5,
        'pointBorderColor'      => "#ffffff",
        'pointBorderColorOver'  => "#eeeeee",
        'shadowWidth'       => 1.5,
        'shadowOpacity'     => 0.2,
        'shadowColor'       => "black",
        'shadowX'           => 0,
        'shadowY'           => 0,
        'iPhoneLink'        => "true",
        'isNewWindow'       => "false",
        'borderWidth'       => 1.01,
        'borderColor'       => "#ffffff",
        'borderColorOver'   => "#ffffff",
        'nameColor'         => "#ffffff",
        'nameColorOver'     => "#ffffff",
        'popupNameColor'    => "#000000",
        'nameFontSize'      => "10",
        'popupNameFontSize' => "20",
        'nameFontWeight'    => "bold",
        'overDelay'         => 300,
        'statesInfoArea'    => "bottom",
        'autoScrollToInfo'  => 0,
        'isResponsive'      => "1",
        'nameStroke'        => false,
        'nameStrokeColor'   => "#000000",
        'nameStrokeColorOver'=> "#000000",
        'freezeTooltipOnClick' => false,

        'areasList'         =>false,
        'tooltipOnHighlightIn' => true,
        'tooltipOnMobileCentralize' => false,
        'tooltipOnMobileWidth' => '80%',
        'tooltipOnMobileVPosition' => 'bottom',
    );
    if ($baseOnly)
        return $defaults;
    $initialStatesPath = dirname(__FILE__).'/static/settings_tpl.json';
    $defaults['name']           = $name;
    $defaults['update_time']    = time();
    $defaults['map_data']       = file_get_contents($initialStatesPath);
    $defaults['cacheSettings']  = true;
    $arr = json_decode($defaults['map_data'], true);
    foreach ($arr as $i) {
        $defaults['state_info'][$i['id']] = '';
    }

    return $defaults;
}

function usa_html5map_plugin_settings_url($map_id, &$map_options) {
    $cacheURL   = plugins_url('/static/cache', __FILE__);
    $siteURL    = get_site_url();
    $phpURL     = "{$siteURL}/index.php?usahtml5map_js_data=true&map_id=$map_id&r=".rand(11111,99999);

    if ( ! $map_options['update_time'])
        return $phpURL;

    if ( ! (isset($map_options['cacheSettings']) and $map_options['cacheSettings']))
        return $phpURL;

    $cache_name = "usa-html5-map-{$map_id}-{$map_options['update_time']}.js";
    $static_path = dirname(__FILE__).'/static';
    $cache_path  = "$static_path/cache";

    if (file_exists("$cache_path/$cache_name"))
        return "$cacheURL/$cache_name";

    if (!file_exists($cache_path)) {
        if (is_writable($static_path))
            mkdir($cache_path);
        else
            return $phpURL;
    }

    if (usa_html5map_plugin_generate_cache($map_id, $map_options, $cache_path, $cache_name))
        return "$cacheURL/$cache_name";
    else
        return $phpURL;
}

function usa_html5map_plugin_generate_cache($map_id, &$map_options, $cache_path, $cache_name) {
    $name_prefix = "usa-html5-map-{$map_id}";
    $dh = opendir($cache_path);
    if (!$dh)
        return false;
    while ($file = readdir($dh)) {
        if (strpos($file, $name_prefix) !== false)
            unlink("$cache_path/$file");
    }
    closedir($dh);

    ob_start();
    usa_html5map_plugin_print_map_settings($map_id, $map_options);
    $cntnt = ob_get_clean();
    if (file_put_contents("$cache_path/$cache_name", $cntnt))
        return true;
    else
        return false;
}

function usa_html5map_plugin_group_defaults($name) {
    return array(
        'group_name' => $name,
        '_popup_over' => false,
        '_act_over' => false,
        '_clr_over' => false,
        '_ignore_group' => false,
        'name' => $name,
        'comment' => '',
        'info' => '',
        'image' => '',
        'link' => '',
        'color_map' => '#ffffff',
        'color_map_over' => '#ffffff'
    );
}

function usa_html5map_plugin_get_options($blog_id = null) {
    $res = is_multisite() ?
        get_blog_option(is_null($blog_id) ? get_current_blog_id() : $blog_id, 'usahtml5map_options') :
        get_site_option('usahtml5map_options');
    return $res ? $res : array();
}

function usa_html5map_plugin_save_options(&$options, $blog_id = null) {
    if ( is_multisite() ) {
        update_blog_option(is_null($blog_id) ? get_current_blog_id() : $blog_id, 'usahtml5map_options', $options);
    } else {
        update_site_option('usahtml5map_options',$options);
    }
}

function usa_html5map_plugin_delete_options($blog_id = null) {
    if ( is_multisite() ) {
        delete_blog_option(is_null($blog_id) ? get_current_blog_id() : $blog_id, 'usahtml5map_options');
    } else {
        delete_site_option('usahtml5map_options');
    }
}


function usa_html5map_plugin_sort_states_by_name($a, $b) {
    return strcmp($a['name'], $b['name']);
}

register_activation_hook( __FILE__, 'usa_html5map_plugin_activation' );

function usa_html5map_plugin_activation() {

    $options = array(0 => usa_html5map_plugin_map_defaults());

    add_site_option('usahtml5map_options', $options);

}

register_deactivation_hook( __FILE__, 'usa_html5map_plugin_deactivation' );

function usa_html5map_plugin_deactivation() {

}

register_uninstall_hook( __FILE__, 'usa_html5map_plugin_uninstall' );

function usa_html5map_plugin_uninstall() {
    delete_site_option('usahtml5map_options');
}

add_filter('widget_text', 'do_shortcode');


function usa_html5map_plugin_export() {
    $maps    = explode(',',$_REQUEST['maps']);
    $options = usa_html5map_plugin_get_options();

    foreach($options as $map_id => $option) {
        if (!in_array($map_id,$maps)) {
            unset($options[$map_id]);
        }
    }

    if (count($options)>0) {
        $options = json_encode($options);

        header($_SERVER["SERVER_PROTOCOL"] . ' 200 OK');
        header('Content-Type: text/json');
        header('Content-Length: ' . (strlen($options)));
        header('Connection: close');
        header('Content-Disposition: attachment; filename="maps.json";');
        echo $options;

        exit();
    }

}

function usa_html5map_plugin_import() {
    $errors = array();
    if(is_uploaded_file($_FILES['import_file']["tmp_name"])) {

        $hwnd = fopen($_FILES['import_file']["tmp_name"],'r');
        $data = fread($hwnd,filesize($_FILES['import_file']["tmp_name"]));
        fclose($hwnd);

        $data    = json_decode($data, true);

        if ($data) {
            $def_settings = file_get_contents(dirname(__FILE__).'/static/settings_tpl.json');
            $def_settings = json_decode($def_settings, true);
            $states_count = count($def_settings);
            $options = usa_html5map_plugin_get_options();

            foreach($data as $map_id => $map_data) {
                if (isset($map_data['map_data']) and $map_data['map_data']) {

                    $data = json_decode($map_data['map_data'], true);
                    $cur_count = $data ? count($data) : 0;
                    $c = $options ? max(array_keys($options))+1 : 0;
                    if ($cur_count != $states_count) {
                        $errors[] = sprintf(__('Failed to import "%s", looks like it is a wrong map. Got %d states when expected states count was: %d', 'usa-html5-map'), $map_data['name'], $cur_count, $states_count);
                        continue;
                    }
                    $map_data['update_time'] = time();
                    $map_data['map_data'] = preg_replace("/javascript:[\w_]+_set_state_text[^\(]*\([^\)]+\);/", "#info", $map_data['map_data']);
                    $options[]              = $map_data;
                } else {
                   $errors[] = sprintf(__('Section "%s" skipped cause it has no "map_data" block.', 'usa-html5-map'), $map_id);
                }

            }
            usa_html5map_plugin_save_options($options);
        } else {
            $errors[] = __('Failed to parse uploaded file. Is it JSON?', 'usa-html5-map');
        }

        unlink($_FILES['import_file']["tmp_name"]);

    } else {
        $errors[] = __('File uploading error!', 'usa-html5-map');
    }
    foreach ($errors as $error) {
         echo '<div class="error">'.$error."</div>\n";
    }
}

function usa_html5map_plugin_areas_list($options,$count) {

    $map_data = (array)json_decode($options['map_data']);
    $areas    = array();
    foreach($map_data as $key => $area) {
        $areas[$area->name] = array(
            'id'   => $area->id,
            'key'  => $key,
            'name' => $area->name
        );
    }

    ksort($areas);

    $options['listFontSize'] = intval($options['listFontSize'])>0 ? $options['listFontSize'] : 16;

    $html = "<div class=\"usaHtml5Map-areas-list\" id=\"usa-html5-map-areas-list_{$count}\" style=\"width: ".$options['listWidth']."%;\" data-count=\"$count\">";

    foreach ($areas as $area) {
        $html.="<div class=\"usaHtml5Map-areas-item\"><a href=\"#\" style=\"font-size: ".$options['listFontSize']."px\" data-key=\"".$area['key']."\" data-id=\"".$area['id']."\" >".$area['name']."</a></div>";
    }

    $html.= "</div>";

    return $html;
}
