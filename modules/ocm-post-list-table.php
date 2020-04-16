<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Manage Posts Columns
 * 
 * @since 1.0.0
 */
add_filter( 'manage_post_posts_columns', 'ocm_post_table_column' );
function ocm_post_table_column( $columns ) {
    $columns['ocm'] = 'OCM';
    return $columns;
}

/**
 * Manage Posts Custom Columns
 * 
 * @since 1.0.0
 */
add_action( 'manage_post_posts_custom_column', 'ocm_post_table_content', 10, 2 );
function ocm_post_table_content( $column_name, $post_id ) {
    if ($column_name == 'ocm') {
        $event_date = get_post_meta( $post_id, '_ocm_meta_event_date', true );
        ob_start();
        ?>
            <div class="ocm-post-list-wrapper">
                <div id="ocm-post-list-buttons" class="ocm-post-list-buttons">
                    <a href="" class="ocm-tooltip ocm-copy-text" title="Copy post text"><i class="far fa-copy"></i></a>
                    <a href="" class="ocm-tooltip ocm-copy-link" title="Copy post link"><i class="fas fa-link"></i></a>
                </div>
                <div class="ocm-post-hidden-fields" >
                    <span name="ocm-copy-text-select" class="ocm-copy-text-select" ><?php echo get_the_title( $post_id ); ?></span>
                    <span name="ocm-copy-link-select" class="ocm-copy-link-select" ><?php echo get_the_permalink( $post_id ); ?></span>
                </div>
            </div>
        <?php
        $html = ob_get_clean();
        echo $html;
    }
}