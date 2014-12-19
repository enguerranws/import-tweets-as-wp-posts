<script type="text/javascript">
    var pluginDirectory = '<?php echo plugins_url('', __FILE__); ?>';
    
</script>

<div class="wrap">
    <h2><img src="<?php echo plugins_url('', __FILE__); ?>/img/logo-t2p.png"></h2>

   <form method="post" action="options.php">
   <?php settings_fields( 'tweets_to_posts_api-settings-group' ); ?>
    <?php do_settings_sections( 'tweets_to_posts_api-settings-group' ); ?>
    <h3>Twitter API settings :</h3>
   <table class="form-table">
        
         <tr valign="top">
        <th scope="row">Consumer key :</th>
        <td><input type="text" placeholder="Your consumer key" name="tweets_to_posts_ck" value="<?php echo esc_attr( get_option('tweets_to_posts_ck') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row">Consumer secret :</th>
        <td><input type="text" placeholder="Your consumer secret" name="tweets_to_posts_cs" value="<?php echo esc_attr( get_option('tweets_to_posts_cs') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row">Access token :</th>
        <td><input type="text" placeholder="Your access token" name="tweets_to_posts_at" value="<?php echo esc_attr( get_option('tweets_to_posts_at') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row">Access secret :</th>
        <td><input type="text" placeholder="Your access secret" name="tweets_to_posts_as" value="<?php echo esc_attr( get_option('tweets_to_posts_as') ); ?>" /></td>
        </tr>
    </table>
    <hr>

   
    <h3>Feed options</h3>
    <table class="form-table">
      <tr valign="top">
        <th scope="row">Post type to feed :</th>
        <td> <select name="tweets_to_posts_post_type">
          <?php 
            $types = get_post_types(array('public'   => true));
            foreach ($types as $type) { ?>
              <option value="<?php echo $type; ?>" <?php if(esc_attr( get_option('tweets_to_posts_post_type') ) === $type){ echo 'selected'; } ?> ><?php echo $type; ?></option>
            <?php }
          ?>
          </select></td>
        </tr>
        <tr valign="top">
        <th scope="row">Category to feed :</th>
        <td> <select name="tweets_to_posts_cat">
          <?php 
              
            $args = array(
             
              'hide_empty'               => 0

            ); 
            $terms = get_categories($args);

            foreach ($terms as $term) { ?>
              <option value="<?php echo $term->term_id; ?>" <?php if(esc_attr( get_option('tweets_to_posts_cat') ) === $term->term_id){ echo 'selected'; } ?> ><?php echo $term->name; ?></option>
            <?php }
          ?>
          </select></td>
        </tr>
         <tr valign="top">
        <th scope="row">Use a custom title ?</th>
        <td><input type="text" placeholder="" name="tweets_to_posts_title_template" value="<?php echo esc_attr( get_option('tweets_to_posts_title_template') ); ?>" />
            <p>You case use Tweet date (%d%) and Tweet (%a%) author to customize your title</p>
            </td>
        </tr>
      </table>
    <?php submit_button(); ?>

</form>
</div>