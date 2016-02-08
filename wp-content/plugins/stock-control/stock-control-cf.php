<?php
add_action( 'add_meta_boxes', 'create_product_meta_box' );
add_action('save_post', 'product_meta_save');

/**
* Creating products custom fields
*/
function create_product_meta_box() {
    add_meta_box(
        'product_meta_box',
        'Products Informations',
        'product_meta_box_callback',
        'product',
        'normal'
    );
}

function product_meta_box_callback($post) {
    wp_nonce_field( basename(__FILE__), 'product_nonce' );
    $product_stored_meta = get_post_meta( $post->ID );
?>

    <div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="name" class="meta-label-title">Name</label>
            </div>
            <div class="meta-field-content">
                <input type="text" name="name" id="name" value="<?php if( !empty($product_stored_meta['name']) ) echo esc_attr($product_stored_meta['name'][0]); ?>" placeholder="Product name"/>
            </div>
        </div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="price" class="meta-label-title">Price</label>
            </div>
            <div class="meta-field-content">
                <input type="number" min="0" step="0.01" name="price" id="price" value="<?php if( !empty($product_stored_meta['price']) ) echo esc_attr($product_stored_meta['price'][0]); ?>" placeholder="Product price"/>
            </div>
        </div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="description" class="meta-label-title">Description</label>
            </div>
            <div class="meta-editor"></div>
            <?php
            $content = get_post_meta($post->ID, 'description', true);
            $editor = 'description';
            $settings = array('textarea_rows' => 8);

            wp_editor($content, $editor, $settings);
            ?>
        </div>
    </div>
<?php
}

function product_meta_save($post_id) {
    // Check save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['product_nonce']) && wp_verify_nonce($_POST['product_nonce'], basename(__FILE__))) ? true : false;

    // Exit script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if (isset($_POST["name"])) {
        update_post_meta($post_id, 'name', sanitize_text_field($_POST['name']));
    }
    if (isset($_POST["price"])) {
        update_post_meta($post_id, 'price', $_POST['price']);
    }
    if (isset($_POST["description"])) {
        update_post_meta($post_id, 'description', sanitize_text_field($_POST['description']));
    }
}