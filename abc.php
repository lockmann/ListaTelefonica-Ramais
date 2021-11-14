<div class="container p-0">
		<div class="container text-center abc">
			<?php
			foreach( range( 'A', 'Z' ) as $letra ) { ?>
			   <a href="./?p=<?php echo $letra ?>" class="text-decoration-none"><?php echo $letra ?></a>
			<?php } ?>			
		</div>
</div>