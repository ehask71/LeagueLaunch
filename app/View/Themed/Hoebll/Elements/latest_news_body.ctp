<?php

if ($latest_news && count(@$latest_news) > 0) {
    foreach ($latest_news AS $news) {
	?>
	<div class = "article">
	<h2><?php echo $news['title']?></h2>
	<cite>posted: <?php echo $news['created']?></cite>
	<img src = "ebll/images/test-image.jpg" class = "right">
	<p>
	    <?php echo $news['content']?>
	</p>
	</div>
	<?php
    }
}
?>