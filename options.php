<script type="text/javascript">
    var pluginDirectory = '<?php echo plugins_url('', __FILE__); ?>';
    
</script>

<div class="wrap">
    <h2><img src="<?php echo plugins_url('', __FILE__); ?>/img/logo-t2p.png"></h2>

   <form method="post" action="options.php">
   <?php settings_fields( 'tweets_to_posts-settings-group' ); ?>
    <?php do_settings_sections( 'tweets_to_posts-settings-group' ); ?>
    <h3><?php _e('Twitter API settings:', 'tweets-to-posts') ?></h3>
   <table class="form-table">
        
         <tr valign="top">
        <th scope="row"><?php _e('Twitter API Consumer key:', 'tweets-to-posts') ?></th>
        <td><input type="text" placeholder="" name="tweets_to_posts_ck" value="<?php echo esc_attr( get_option('tweets_to_posts_ck') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row"><?php _e('Twitter API Consumer secret:', 'tweets-to-posts') ?></th>
        <td><input type="text" placeholder="" name="tweets_to_posts_cs" value="<?php echo esc_attr( get_option('tweets_to_posts_cs') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row"><?php _e('Twitter API Access token:', 'tweets-to-posts') ?></th>
        <td><input type="text" placeholder="" name="tweets_to_posts_at" value="<?php echo esc_attr( get_option('tweets_to_posts_at') ); ?>" /></td>
        </tr>
          <tr valign="top">
        <th scope="row"><?php _e('Twitter API Access secret:', 'tweets-to-posts') ?></th>
        <td><input type="text" placeholder="" name="tweets_to_posts_as" value="<?php echo esc_attr( get_option('tweets_to_posts_as') ); ?>" /></td>
        </tr>
    </table>
    <hr>

   
    <h3><?php _e('Wordpress feed options:', 'tweets-to-posts') ?></h3>
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><?php _e('Post type to feed:', 'tweets-to-posts') ?></th>
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
        <th scope="row"><?php _e('Category to feed:', 'tweets-to-posts') ?></th>
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
        <th scope="row"><?php _e('Use a custom title?', 'tweets-to-posts') ?></th>
        <td><input type="text" placeholder="<?php _e('e.g : Last tweet by %a%, posted on %d%', 'tweets-to-posts') ?>" name="tweets_to_posts_title_template" value="<?php echo esc_attr( get_option('tweets_to_posts_title_template') ); ?>" />
            <p><?php _e('You can use Tweet date (%d%) and Tweet (%a%) author to customize your title', 'tweets-to-posts') ?></p>
            </td>
        </tr>
      </table>
      <hr>
       <h3><?php _e('How can I get a Twitter API key and access tokens?', 'tweets-to-posts') ?></h3>
    <p class="description">
      <?php _e('To use this plugin, you\'ll need to create a Twitter API key. Dealing with Twitter Developers Console can be a bit confusing. Here\'s how to do that:', 'tweets-to-posts') ?>
      

    </p>
    <ol>
      <li><?php _e('Login to https://apps.twitter.com/ using your Twitter account', 'tweets-to-posts') ?>
      </li>
      <li><?php _e('Click on "Create new app"', 'tweets-to-posts') ?></li>
      
      <li><?php _e('Set up your Twitter app', 'tweets-to-posts') ?></li>
      <li><?php _e('On your new app dashboard, click on Keys and access tokens : there you can find your Consumer Key and your Consumer Secret', 'tweets-to-posts') ?></li>
      <li><?php _e('On the bottom of this page, click on Create My access token and token secret', 'tweets-to-posts') ?></li>
      <li><?php _e('Now that you have your Consumer Key, your Consumer Secret, your Access Token and your Access Token Secret copy them into the Tweets to Posts Settings page', 'tweets-to-posts') ?></li>
      <li><?php _e('It\'s done, congrats :)', 'tweets-to-posts') ?></li>
    </ol>
    <?php submit_button(); ?>

</form>
</div>