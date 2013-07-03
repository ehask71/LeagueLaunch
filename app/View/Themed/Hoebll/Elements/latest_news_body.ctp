<?php
$latest_news = $this -> requestAction(array('controller' => 'news','action' => 'index'),array('named'=>array('limit'=>10,'sort'=>'desc','order'=>'News.id')));
if (isset($latest_news) && count(@$latest_news) > 0) {
    foreach ($latest_news AS $news) {
	?>
	<div class = "article">
	<h2><?php echo $news['News']['title']?></h2>
	<cite>posted: <?php echo $news['News']['created']?></cite>
	<img src = "ebll/images/test-image.jpg" class = "right">
	<p>
	    <?php echo $news['News']['content']?>
	</p>
	</div>
	<?php
    }
} else {
    ?>
<div class="article">
    <h2>No News!</h2>
</div>
    <?php
}
?>