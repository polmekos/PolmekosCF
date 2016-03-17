<?php
/*
 *
 * Plugin Name: Polmekos Custom Field
 * Plugin URI: http://polmekos.github.io
 * Description: This plugin adds a custom meta box with posts titles based on category.
 * Version: 1.0.0
 * Author: Michał "Polmekos" Kłosiński
 * Author URI: http://polmekos.github.io
 * License: GPL2
 */
class polmekos_cf{
	private $options;

	public function __construct()
	{
		add_action( 'admin_menu', array($this,'polmekos_cf_add_admin_menu' ));
		add_action( 'admin_init', array($this, 'polmekos_cf_settings_init' ));
		add_action( 'save_post', array($this, 'polmekos_cf_meta_save' ));
		add_action('add_meta_boxes', array($this, 'polmekos_cf_add_metabox'));
	}

	public function polmekos_cf_add_admin_menu(  ) {

		add_options_page( 'Polmekos CF', 'Polmekos CF', 'manage_options', 'polmekos_cf', array($this, 'polmekos_cf_options_page' ));

	}


	public function polmekos_cf_settings_init(  ) {

		register_setting( 'pluginPage', 'polmekos_cf_settings' );

		add_settings_section(
			'polmekos_cf_pluginPage_section',
			__( 'Select category from table above', 'wordpress' ),
			array($this, 'polmekos_cf_settings_section_callback'),
			'pluginPage'
		);

		add_settings_field(
			'polmekos_cf_text_field_0',
			__( 'Category ID', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_0_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);


	}


	public function polmekos_cf_text_field_0_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		?>
		<input type='text' name='polmekos_cf_settings[polmekos_cf_text_field_0]' value='<?php echo $options['polmekos_cf_text_field_0']; ?>'>
		<?php

	}


	public function polmekos_cf_settings_section_callback(  ) {

		echo __( 'It will display all post titles based on category ID in metabox.', 'wordpress' );

	}


	public function polmekos_cf_options_page(  ) {

		global $wpdb;
    $query = "
		SELECT term_id, name FROM $wpdb->terms";
    $cat_results = $wpdb->get_results($query);
    ?>
    <div class="wrap">
        <h2>Polmekos Custom Field Settings</h2>
        <table class="form-table">
            <tr>
                <td>Category id</td>
                <td>Category name</td>
            </tr>
            <?php
            foreach ($cat_results as $cat_result){
                ?>
                <tr>
                    <td><?php echo $cat_result->term_id ?></td>
                    <td><?php echo $cat_result->name ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
		<form action='options.php' method='post'>
			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>

		</form>
		</div>
		<?php

	}

	public function polmekos_cf_add_metabox(){
		add_meta_box('polmekos_meta', 'Polmekos Custom Field', array($this, 'polmekos_meta_callback'), 'post');
}

	public function polmekos_meta_callback($post) {
	wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
	$polmekos_cf_stored_meta = get_post_meta( $post->ID );
	global $wpdb;
	$this->options = get_option( 'polmekos_cf_settings' );
	$number = $this->options['polmekos_cf_text_field_0'];
	echo 'Category ID: '.$this->options['polmekos_cf_text_field_0'] . '<br>';
	$query = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number
ORDER BY post_date DESC
";

	$results = $wpdb->get_results( $query );
	foreach ( $results as $result ) {
		?>
		<label for="repertuar">
		<input type="checkbox" name="repertuar[]" id="repertuar" value="<?php echo $result->post_title ?>" <?php if ( isset ( $polmekos_cf_stored_meta['repertuar'] ) ) checked( $polmekos_cf_stored_meta['repertuar'][0], 'yes' );?> />
		</label><?php echo $result->post_title ?><br>
		<?php
	};
}
/**
 * Saves the custom meta input
 */
	public function polmekos_cf_meta_save( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'polmekos_nonce' ] ) && wp_verify_nonce( $_POST[ 'polmekos_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}
	if(isset($_POST['repertuar'])) {
		$rep = $_POST['repertuar'];
		$rep = implode( ',', $rep );
	}
	// Checks for input and sanitizes/saves if needed
	if( isset( $rep ) ) {
		update_post_meta( $post_id, 'repertuar', $rep );
	} else {
		update_post_meta( $post_id, 'repertuar', '' );
	}
}

}

$cf_settings = new polmekos_cf();