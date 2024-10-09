<div class="col-12">
    <div <?php
    post_class('card shadow-sm'); ?>>

        <?php
        echo tsite_post_thumb(get_the_ID()) ?>

        <div class="card-body">
            <h5 class="card-title"> Standart<?php
                the_title() ?></h5>
            <div class="card-text"><?php
                the_excerpt(); ?></div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="<?php
                    the_permalink(); ?>" class="btn btn-sm btn-outline-secondary">View</a>
                </div>
                <small class="text-muted"><?php
                    echo tsite_get_human_time(); ?></small>
            </div>


        </div>
    </div>
</div>