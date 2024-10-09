<?php

get_header() ?>

<main>


    <div class="album py-5 bg-light">
        <div class="container">


            <div class="row g-3">

                <?php
                if (have_posts()) : while (have_posts()) : the_post(); ?>


                    <?php
                    get_template_part('template-parts/content', get_post_format()) ?>

                <?php
                endwhile;
                else : ?>
                    <p>Записей нет.</p>
                <?php
                endif; ?>


            </div>
        </div>
    </div>

</main>

<?php
get_footer() ?>
