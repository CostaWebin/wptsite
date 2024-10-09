<?php get_header(); ?>

<?php get_header() ?>

<main>


    <div class="album py-5 bg-light">
        <div class="container">


            <div class="row">

                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-12">
                        <div class="card shadow-sm">

                            <?php echo tsite_post_thumb(get_the_ID(), 'full', 'card-full-thumb') ?>

                            <div class="card-body">
                                <h1 class="card-title"><?php the_title() ?></h1>
                                <div class="card-text"><?php the_content(); ?></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">

                                    </div>
                                    <div class="text-muted">
                                       <small> <?php echo tsite_get_human_time(); ?></small><br>
                                       <small> <?php  the_tags(); ?></small><br>
                                      <small>Категории: <?php the_category('; '); ?></small>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>



            </div>
        </div>
    </div>

</main>

<?php get_footer() ?>



<?php get_footer(); ?>
