<style>
.grid-item {
	width: 33.3333%;
}
.grid-item .card {
	min-height: 205px;
}
</style>
<?php
$topics = array(
    "Reimbursement & Revenue",
    "Human Resources",
    "Patient Engagement",
    "Policy & Procedures",
    "Professional Relationships",
    "Quality Enhancements",
    "Wellness",
    "National Affairs & Public Relations"
);
if (in_array($_GET["topic"], $topics)) {
    $topic = htmlspecialchars($_GET["topic"]);
} else {
    $topic = "";
}
?>
<p><strong>Accessible, relevant, and practical projects to improve your practice.</strong></p>
<p>Gastroenterologists in private practice find themselves working in a time of unprecedented transformation. Pressures are high as they make important management
decisions that profoundly affect their business future, their private lives, and their ability to provide care to patients. The ACG Practice Management Committee has a
mission to bring practicing colleagues together to explore solutions to overcome management challenges, to improve operations, enhance productivity, and support
physician leadership. It was in this spirit that the Practice Management Toolbox was created.</p>
<p>The Toolbox is a series of short articles, written by practicing gastroenterologists, that provide members with easily accessible information to improve their practices.
Each article covers an issue important to private practice gastroenterologists and physician-lead clinical practices. They include a brief introduction, a topic overview,
specific suggestions, helpful examples and a list of resources or references. Each month a new edition of the Toolbox will be released and will then remain available
here along with all previous editions. The Practice Management Committee is confident this series will a provide valuable resource for members striving to optimize
their practices.</p>

<div class="text-center container-sm m-b-md p-lg-x-xl">
	<form role="search" method="get" class="input-group" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="form-control" name="s" id="s" value="" placeholder="Search the toolbox">
		<input type="hidden" name="post_type" value="guideline">
		<span class="input-group-btn"><input type="submit" class="btn btn-orange" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" /></span>
	</form>
</div>
<div class="text-center container-sm m-b-md p-lg-x-xl">
	<form role="search" method="get" class="input-group">
        <select name="topic" class="form-control" onchange="this.form.submit()">
            <option></option>
            <?php
                    foreach($topics as $item) {
                        echo '<option';
                        if (htmlspecialchars($item) == $topic) {
                            echo ' selected="selected"';
                        }
                        echo '>';
                        echo $item;
                        echo '</option>';
                    }
            ?>
        </select>
	</form>
</div>
<div class="text-right m-t m-b text-sm">
	<div class="btn-group sort-by-button-group">
		<button class="button btn btn-xs btn-outline" data-sort-by="name">
			Sort A to Z
		</button>
		<button class="button btn btn-xs btn-outline" data-sort-by="date">
			Sort by Date
		</button>
	</div>
</div>

<div class="grid row">
<?php
        if (strlen($topic)) {
            $category = "&category=".$topic;
        } else {
            $category = "";
        }
        $response = wp_remote_get( 'https://contentcms.gi.org/query/?keywords=Practice%20Management%20Toolbox%20'.$category, array(
            'headers' => array(
                'x-api-key' => 'CYtpwThdAn2nYLUVchmYS4muAh8MR2sM18H20uy8'
            )
        ) );
        if ( is_array( $response ) ) {
            $header = $response['headers']; // array of http header lines
            $body = $response['body']; // use the content
        }
        $data = json_decode( $body );
        if( ! empty( $data ) ) {
            //echo '<ul>';
	            foreach( $data->hits->hits as $hit ) {
                    ?>
                    <div class="grid-item">
                        <div class="card display-flex flex-column">
                            <div class="card-block flex-1">
                                <h3 class="text-md m-b-xs text-700">
                                    <?php
                                    echo '<a href="' . esc_url( $hit->_source->url ) . '">';
                                        echo '<span class="name">' . $hit->_source->title . '</span>';
                                    echo '</a>';
                                    ?>
                                </h3>
                                <?php
                                    if (!empty($hit->_source->publish_date)) {
                                        $dateMillis = $hit->_source->publish_date;
                                        $seconds = $dateMillis / 1000;
                                        $dateDisplay = date("m-Y", $seconds);
                                    } else {
                                        $dateDisplay = "";
                                    }
                                ?>
                                <p class="text-sm text-mute m-b-xs date"><?php echo $dateDisplay; ?></p>
<?php
                                    $tmp = array_reverse($hit->_source->authors);
?>
                                <p class="text-sm m-b-0"><svg class="icon icon-user2"><use xlink:href="#icon-user2"></use></svg> <?php echo array_pop($tmp); ?></p>
                            </div>
                            <div class="card-footer bg-gray-lighter p-y-sm text-uc item-flex">
                                <div class="item-flex-main">
                                    <?php if (strlen($post->decisionsupporttoolurl) > 0) : ?>
                                        <a href="<?php echo $post->decisionsupporttoolurl; ?>" target="_blank">Decision Support Tool</a> <span class="text-pipe">|</span>
                                    <?php endif; ?>
                                    <?php if (strlen($post->summaryurl) > 0) : ?>
                                        <a href="<?php echo $post->summaryurl; ?>" target="_blank">Summary</a>
                                    <?php endif; ?>
                                </div>
                                <div class="item-flex-addon">
                                <a href="<?php echo esc_url( $hit->_source->url ) ?>" class="" target="_blank">Read the Article</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    ?>
                    </div>
                    <?php
		            //echo '<li>';
			        //    echo '<a href="' . esc_url( $hit->_source->url ) . '">' . $hit->_source->title . '</a>';
		            //echo '</li>';
	            }
	        //echo '</ul>';
        }
        ?>
        </div>
</div>
