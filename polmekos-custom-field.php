<?php
/*
 *
 * Plugin Name: Polmekos Custom Field
 * Plugin URI: http://polmekos.github.io
 * Description: This plugin adds a custom meta box with posts titles based on category as checkboxes.
 * Version: 1.1
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
			__( 'Select category from list below', 'wordpress' ),
			array($this, 'polmekos_cf_settings_section_callback'),
			'pluginPage'
		);

		add_settings_field(
			'polmekos_cf_text_field_0',
			__( 'Metabox 1', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_0_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);
		add_settings_field(
			'polmekos_cf_text_field_1',
			__( 'Metabox 2', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_1_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);
		add_settings_field(
			'polmekos_cf_text_field_2',
			__( 'Metabox 3', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_2_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);
		add_settings_field(
			'polmekos_cf_text_field_3',
			__( 'Metabox 4', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_3_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);
		add_settings_field(
			'polmekos_cf_text_field_4',
			__( 'Metabox 5', 'wordpress' ),
			array($this, 'polmekos_cf_text_field_4_render'),
			'pluginPage',
			'polmekos_cf_pluginPage_section'
		);

	}


	public function polmekos_cf_text_field_0_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		global $wpdb;
		$query = "
		SELECT term_id, name FROM $wpdb->terms";
		$cat_result = $wpdb->get_results($query);
		$number = $this->options['polmekos_cf_text_field_0'];
		?>
		<select name="polmekos_cf_settings[polmekos_cf_text_field_0]">

			<?php
		foreach ($cat_result as $cat_list ) {
		?>
		<option value="<?php echo $cat_list->term_id; ?>" <?php selected(esc_attr( $this->options['polmekos_cf_text_field_0']), $cat_list->term_id ); ?>><?php echo $cat_list->name; ?></option>
<?php } ?>
</select>

		<?php

	}
	public function polmekos_cf_text_field_1_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		global $wpdb;
		$query = "
		SELECT term_id, name FROM $wpdb->terms";
		$cat_result = $wpdb->get_results($query);
		?>
		<select name="polmekos_cf_settings[polmekos_cf_text_field_1]">

		<?php
		foreach ($cat_result as $cat_list ) {
			?>
			<option value="<?php echo $cat_list->term_id; ?>" <?php selected(esc_attr( $this->options['polmekos_cf_text_field_1']), $cat_list->term_id ); ?>><?php echo $cat_list->name; ?></option>
		<?php } ?>
		</select>
		<?php

	}
	public function polmekos_cf_text_field_2_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		global $wpdb;
		$query = "
		SELECT term_id, name FROM $wpdb->terms";
		$cat_result = $wpdb->get_results($query);
		?>
		<select name="polmekos_cf_settings[polmekos_cf_text_field_2]">

		<?php
		foreach ($cat_result as $cat_list ) {
			?>
			<option value="<?php echo $cat_list->term_id; ?>" <?php selected(esc_attr( $this->options['polmekos_cf_text_field_2']), $cat_list->term_id ); ?>><?php echo $cat_list->name; ?></option>
		<?php } ?>
		</select>
		<?php

	}
	public function polmekos_cf_text_field_3_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		global $wpdb;
		$query = "
		SELECT term_id, name FROM $wpdb->terms";
		$cat_result = $wpdb->get_results($query);
		?>
		<select name="polmekos_cf_settings[polmekos_cf_text_field_3]">

		<?php
		foreach ($cat_result as $cat_list ) {
			?>
			<option value="<?php echo $cat_list->term_id; ?>" <?php selected(esc_attr( $this->options['polmekos_cf_text_field_3']), $cat_list->term_id ); ?>><?php echo $cat_list->name; ?></option>
		<?php } ?>
		</select>
		<?php

	}
	public function polmekos_cf_text_field_4_render(  ) {

		$this->options = get_option( 'polmekos_cf_settings' );
		global $wpdb;
		$query = "
		SELECT term_id, name FROM $wpdb->terms";
		$cat_result = $wpdb->get_results($query);
		?>
		<select name="polmekos_cf_settings[polmekos_cf_text_field_4]">

		<?php
		foreach ($cat_result as $cat_list ) {
			?>
			<option value="<?php echo $cat_list->term_id; ?>" <?php selected(esc_attr( $this->options['polmekos_cf_text_field_4']), $cat_list->term_id ); ?>><?php echo $cat_list->name; ?></option>
		<?php } ?>
		</select>
		<?php

	}

	public function polmekos_cf_settings_section_callback(  ) {

		echo __( 'It will display all post titles based on category name as checkboxes.', 'wordpress' );

	}


	public function polmekos_cf_options_page(  ) {

		?>
    <div class="wrap">
        <h2>Polmekos Custom Field Settings</h2>
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
		add_meta_box('polmekos_meta', 'metabox 1', array($this, 'polmekos_meta_callback'), 'post');
		add_meta_box('polmekos_meta1', 'metabox 2', array($this, 'polmekos_meta_callback1'), 'post');
		add_meta_box('polmekos_meta2', 'metabox 3', array($this, 'polmekos_meta_callback2'), 'post');
		add_meta_box('polmekos_meta3', 'metabox 4', array($this, 'polmekos_meta_callback3'), 'post');
		add_meta_box('polmekos_meta4', 'metabox 5', array($this, 'polmekos_meta_callback4'), 'post');
}

	public function polmekos_meta_callback($post) {
	wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
		$polmekos_cf_stored_meta = get_post_meta( $post->ID, 'polmekoscf', true );
		$polmekos_cf_stored_meta = explode('|', $polmekos_cf_stored_meta);
	global $wpdb;
	$this->options = get_option( 'polmekos_cf_settings' );
	$number = $this->options['polmekos_cf_text_field_0'];
	$query = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number
ORDER BY post_title
";

	$results = $wpdb->get_results( $query );
	foreach ( $results as $result ) {
		?>

		<input type="checkbox" name="polmekoscf[]" id="polmekoscf" value="<?php echo $result->post_title ?>" <?php  if (in_array($result->post_title, $polmekos_cf_stored_meta) ){echo "checked";}?> />
		<label for="polmekoscf"><?php echo $result->post_title ?></label><br>
		<?php
	};
}
	public function polmekos_meta_callback1($post) {
		wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
		$polmekos_cf_stored_meta = get_post_meta( $post->ID, 'polmekoscf', true );
		$polmekos_cf_stored_meta = explode('|', $polmekos_cf_stored_meta);
		global $wpdb;
		$this->options = get_option( 'polmekos_cf_settings' );
		$number1 = $this->options['polmekos_cf_text_field_1'];
		$query1 = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number1
ORDER BY post_title
";

		$results1 = $wpdb->get_results( $query1 );
		foreach ( $results1 as $result ) {
			?>

			<input type="checkbox" name="polmekoscf[]" id="polmekoscf" value="<?php echo $result->post_title ?>" <?php  if (in_array($result->post_title, $polmekos_cf_stored_meta) ){echo "checked";}?> />
			<label for="polmekoscf"><?php echo $result->post_title ?></label><br>
			<?php
		};
	}
	public function polmekos_meta_callback2($post) {
		wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
		$polmekos_cf_stored_meta = get_post_meta( $post->ID, 'polmekoscf', true );
		$polmekos_cf_stored_meta = explode('|', $polmekos_cf_stored_meta);
		global $wpdb;
		$this->options = get_option( 'polmekos_cf_settings' );
		$number2 = $this->options['polmekos_cf_text_field_2'];
		$query2 = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number2
ORDER BY post_title
";

		$results2 = $wpdb->get_results( $query2 );
		foreach ( $results2 as $result ) {
			?>

			<input type="checkbox" name="polmekoscf[]" id="polmekoscf" value="<?php echo $result->post_title ?>" <?php  if (in_array($result->post_title, $polmekos_cf_stored_meta) ){echo "checked";}?> />
			<label for="polmekoscf"><?php echo $result->post_title ?></label><br>
			<?php
		};
	}
	public function polmekos_meta_callback3($post) {
		wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
		$polmekos_cf_stored_meta = get_post_meta( $post->ID, 'polmekoscf', true );
		$polmekos_cf_stored_meta = explode('|', $polmekos_cf_stored_meta);
		global $wpdb;
		$this->options = get_option( 'polmekos_cf_settings' );
		$number3 = $this->options['polmekos_cf_text_field_3'];
		$query3 = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number3
ORDER BY post_title
";

		$results3 = $wpdb->get_results( $query3 );
		foreach ( $results3 as $result ) {
			?>

			<input type="checkbox" name="polmekoscf[]" id="polmekoscf" value="<?php echo $result->post_title ?>" <?php  if (in_array($result->post_title, $polmekos_cf_stored_meta) ){echo "checked";}?> />
			<label for="polmekoscf"><?php echo $result->post_title ?></label><br>
			<?php
		};
	}
	public function polmekos_meta_callback4($post) {
		wp_nonce_field( basename( __FILE__ ), 'polmekos_nonce' );
		$polmekos_cf_stored_meta = get_post_meta( $post->ID, 'polmekoscf', true );
		$polmekos_cf_stored_meta = explode('|', $polmekos_cf_stored_meta);
		global $wpdb;
		$this->options = get_option( 'polmekos_cf_settings' );
		$number4 = $this->options['polmekos_cf_text_field_4'];
		$query4 = "
SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = $number4
ORDER BY post_title
";

		$results4 = $wpdb->get_results( $query4 );
		foreach ( $results4 as $result ) {
			?>

			<input type="checkbox" name="polmekoscf[]" id="polmekoscf" value="<?php echo $result->post_title ?>" <?php  if (in_array($result->post_title, $polmekos_cf_stored_meta) ){echo "checked";}?> />
			<label for="polmekoscf"><?php echo $result->post_title ?></label><br>
			<?php
		};
	}

	public function polmekos_cf_shortcode(){
		ob_start();
		global $post;
		$repertuar = get_post_meta( $post->ID, 'polmekoscf', true );
		$items = explode('|', $repertuar);
		$return = '';
		$return .=  '<ul>';
		foreach ( $items as $item ) {
			$return .= '<li>' . $item . '</li>';
		}
		$return .= '</ul>';
		ob_get_clean();
		return $return;

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
	if(isset($_POST['polmekoscf'])) {
		$oldrep = get_post_meta( $post_id, 'polmekoscf', true );
		$rep = $_POST['polmekoscf'];
		$rep = implode( '|', $rep );
	}
	// Checks for input and sanitizes/saves if needed
		if ( $rep && $rep != $oldrep ) {
			update_post_meta($post_id, 'polmekoscf', $rep);
		}
		elseif ( '' == $rep ) {
			update_post_meta($post_id, 'polmekoscf', '');
		}

}

}
add_shortcode( 'polmekoscf', array( 'polmekos_cf', 'polmekos_cf_shortcode' ) );
$cf_settings = new polmekos_cf();