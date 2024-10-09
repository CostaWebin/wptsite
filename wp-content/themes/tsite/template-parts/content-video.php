<div class="col-12">
    <div <?php
	post_class( 'card shadow-sm tsite-format-video' ); ?>>


        <div class="card-body">

			<?php
			tsite_debug( tsite_get_media( array( 'iframe', 'video' ) ) );
			?>

        </div>


    </div>
</div>
</div>

sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html