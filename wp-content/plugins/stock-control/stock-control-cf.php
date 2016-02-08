<?php
add_action('add_meta_boxes', 'create_product_meta_box' );
add_action('save_post', 'product_meta_save');

add_action('add_meta_boxes', 'create_client_meta_box' );
add_action('save_post', 'client_meta_save');

add_action('add_meta_boxes', 'create_order_meta_box' );
add_action('save_post', 'order_meta_save');

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
        update_post_meta($post_id, 'description', $_POST['description']);
    }
}

/**
* Creating clients custom fields
*/
function create_client_meta_box() {
    add_meta_box(
        'client_meta_box',
        'clients Informations',
        'client_meta_box_callback',
        'client',
        'normal'
    );
}

function client_meta_box_callback($post) {
    wp_nonce_field( basename(__FILE__), 'client_nonce' );
    $client_stored_meta = get_post_meta( $post->ID );
?>

    <div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="name" class="meta-label-title">Name</label>
            </div>
            <div class="meta-field-content">
                <input type="text" name="name" id="name" value="<?php if( !empty($client_stored_meta['name']) ) echo esc_attr($client_stored_meta['name'][0]); ?>" placeholder="Client name"/>
            </div>
        </div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="email" class="meta-label-title">E-Mail</label>
            </div>
            <div class="meta-field-content">
                <input type="email" name="email" id="email" value="<?php if( !empty($client_stored_meta['email']) ) echo esc_attr($client_stored_meta['email'][0]); ?>" placeholder="Client E-Mail"/>
            </div>
        </div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="phone" class="meta-label-title">Phone</label>
            </div>
            <div class="meta-field-content">
                <input type="text" name="phone" id="phone" value="<?php if( !empty($client_stored_meta['phone']) ) echo esc_attr($client_stored_meta['phone'][0]); ?>" placeholder="Client phone"/>
            </div>
        </div>
    </div>
<?php
}

function client_meta_save($post_id) {
    // Check save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['client_nonce']) && wp_verify_nonce($_POST['client_nonce'], basename(__FILE__))) ? true : false;

    // Exit script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if (isset($_POST["name"])) {
        update_post_meta($post_id, 'name', sanitize_text_field($_POST['name']));
    }
    if (isset($_POST["email"])) {
        update_post_meta($post_id, 'email', sanitize_text_field($_POST['email']));
    }
    if (isset($_POST["phone"])) {
        update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
    }
}

/**
* Creating orders custom fields
*/
function create_order_meta_box() {
    add_meta_box(
        'order_meta_box',
        'orders Informations',
        'order_meta_box_callback',
        'order',
        'normal'
    );
}

function order_meta_box_callback($post) {
    wp_nonce_field( basename(__FILE__), 'order_nonce' );
    $order_stored_meta = get_post_meta( $post->ID );
?>

    <div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="product_id" class="meta-label-title">Product</label>
            </div>
            <div class="meta-field-content">
                <select name="product_id" id="product_id">
                    <option value="">--</option>
                    <?php
                    $products = get_posts(array('post_type' => 'product', 'post_status' => 'publish'));
                    foreach ($products as $product):
                    ?>
                        <option value="<?=$product->ID?>" <?php selected($order_stored_meta['product_id'][0], $product->ID);?>><?=$product->post_title?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="meta-field-box">
            <div class="meta-field-head">
                <label for="client_id" class="meta-label-title">Client</label>
            </div>
            <div class="meta-field-content">
                <select name="client_id" id="client_id">
                    <option value="">--</option>
                    <?php
                    $clients = get_posts(array('post_type' => 'client', 'post_status' => 'publish'));
                    foreach ($clients as $client):
                    ?>
                        <option value="<?=$client->ID?>" <?php selected($order_stored_meta['client_id'][0], $client->ID);?>><?=$client->post_title?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
    </div>
<?php
}

function order_meta_save($post_id) {
    // Check save status
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['order_nonce']) && wp_verify_nonce($_POST['order_nonce'], basename(__FILE__))) ? true : false;

    // Exit script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }

    if (isset($_POST["product_id"])) {
        update_post_meta($post_id, 'product_id', $_POST['product_id']);
    }

    if (isset($_POST["client_id"])) {
        update_post_meta($post_id, 'client_id', $_POST['client_id']);
    }
}