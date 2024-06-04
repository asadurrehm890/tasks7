<?php
/**
 * Template Name: Project Archive
 */

get_header();
?>
<style>
.container {
    max-width: 1280px;
    margin: auto;
    padding: 1rem;
}

.container .flexed {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    column-gap: 1rem;
    row-gap: 1rem;
}

.container .project {
    max-width: 300px;
    text-align: center;
    padding: 1rem;
    border: 1px solid #000;
}

.text-center {
    text-align: center;
    margin-top: 2rem;
}

.coffeeshow{
    max-width:300px;
    width:100%;
    height:auto;
  
}
</style>
<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type'      => 'project',
    'posts_per_page' => 6,
    'paged'          => $paged
);

$projects_query = new WP_Query($args);
?>
<div class="container">
    <h2 class="text-center">Task 4</h2>
    <div class="flexed">
        <?php
if ($projects_query->have_posts()) :
    while ($projects_query->have_posts()) : $projects_query->the_post();

?>
        <div class="project">
            <?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <div class="project-content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php
endwhile;
?>
    </div>
    <div class="text-center">
        <?php
$big = 999999999;
echo paginate_links(array(
    'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format'  => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total'   => $projects_query->max_num_pages
));
?>
    </div>
    <?php
else :
    
    echo 'No projects found.';
endif;
?>

</div>
<?php

wp_reset_postdata();


?>
<div class="container task5">
    <h2 class="text-center">Task 5</h2>

    <div class="flexed">

    </div>
</div>

<div class="container task5">
    <h2 class="text-center">Task 6</h2>

    <?php 
    
    function hs_give_me_coffee() {
   
    $api_url = 'https://coffee.alexflipnote.dev/random.json';

    
    $response = wp_remote_get( $api_url );

    
    if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
        
        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body );

       
        if ( isset( $data->file ) ) {
            
            return $data->file;
        } else {
            return 'No coffee link found.';
        }
    } else {
        return 'Failed to fetch coffee data.';
    }
}


$link_to_coffee = hs_give_me_coffee();
echo "<div class='text-center'><img class='coffeeshow' src='".$link_to_coffee."'></div>";

    ?>
</div>


<div class="container">
    <h2 class="text-center">Task 7</h2>
    
    <?php

function get_kanye_quotes() {
    
    $api_url = 'https://api.kanye.rest';

    
    $quotes = array();

    
    for ($i = 0; $i < 5; $i++) {
        
        $response = wp_remote_get($api_url);

       
        if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
           
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);

           
            if (isset($data->quote)) {
                
                $quotes[] = $data->quote;
            }
        }
    }

    
    return $quotes;
}



    
    $quotes = get_kanye_quotes();

   
    $output = '';

   
    if (!empty($quotes)) {
       
        $output .= '<div class="flexed">';
        foreach ($quotes as $quote) {
            $output .= '<div class="project">'. esc_html($quote) . '</div>';
        }
        $output .= '</div>';
    } else {
        $output .= 'Failed to fetch Kanye quotes.';
    }

    echo $output;
 



?>
</div>    
<?php
get_footer();
?>
