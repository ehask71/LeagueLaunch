<!DOCTYPE html>
<html lang="en">
<head>
<title>Professional Camps </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php 
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('style');
	echo $this->Html->css('//fonts.googleapis.com/css?family=Open+Sans:400,700');
    ?>
</head>
<body>

<div class="container">
	<div class="row" id="body-content">
		<div class="span6" >
		
			<div class="row">
				<div class="span6" id="goals">
				<h4>Our Goal</h4>
				<p>
					To bring professional 

training to a little league level. 

With our elite team of instructors we provide each individual 
 with a better understanding and knowledge of the game. Campers 

will be put through drills that 

they not only take home but take their game to the next level. From 

hitting drills that support getting more connected and powerful,

to infield instruction that will

create smoothness and fluidity, to pitching mechanics that will create consistency. Let us share our knowledge for 

the game, and get each individual to another level.
					</p>
				</div>
			</div>	
			<?php echo $this->element('payment_form');?>
		</div>
		<div class="span6" >
			<div id="sidebar">
				<?php echo $this->Html->image('callout.jpg',array('title'=>"Addison Maruszak Teaches Professional Level Skills to Little League Player of all ages"));?>
				<div  id="coaches">
					<h4>Camp Coaches</h4>
				<p>
					Each instructor is playing or coaching in professional baseball. We 

strive to have a 15-1 camper to coach ratio to help maximize each individual's potential 

growth. Each instructor has been in your little palyer's shoes, and has made it 

up to the ranks to professional baseball, even to the major league level. They 

know the ins and outs to the game, and each loves to share their knowledge to 

help the next generation get where they are now.
				</p>
				</div>
			
			</div>
		</div>
	</div>
	<div class="row" id="footer">
		<? echo $this->Regions->blocks('footer');?>
	</div>
</div>
<?php
    echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    echo $this->Html->script('bootstrap');
?>
</body>
</html>
