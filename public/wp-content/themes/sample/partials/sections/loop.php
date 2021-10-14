<section>
    <h2>Article loop section</h2>
    <div class="row">

        <?php
            if(have_posts()) {
                while(have_posts()) {
                    the_post();
                    echo '<div  class="col-6">';
                        echo '<article>';
                            echo '<figure>';
                                echo get_the_post_thumbnail();
                            echo '</figure>';
                            echo '<h3>' . get_the_title() . '</h3>';
                            echo '<p>' . get_the_excerpt() . '</p>';
                            echo '<footer>';
                                echo '<a href="' . get_the_permalink() . '">Lire la suite</a>';
                            echo '</footer>';
                        echo '</article>';
                    echo '</div>';
                }
            }
        ?>

    </div>
</section>