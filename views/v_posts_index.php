
<?php foreach($posts as $post): ?>

	<article>

	    <h5>
	    	<?=$post['first_name']?> <?=$post['last_name']?> -- Posted on:
		    <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		        <?=Time::display($post['created'])?>
		    </time>
		</h5>

	    <p><?=$post['content']?></p>

	
	</article>
	<br>
<?php endforeach; ?>
