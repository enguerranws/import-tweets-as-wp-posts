<script type="text/javascript">
    var pluginDirectory = '<?php echo plugins_url('', __FILE__); ?>';
    
</script>


<div class="wrap">
    <h2>Tweets to Posts plugin options</h2>

   <form method="post" action="options.php">
   <?php settings_fields( 'tweets_to_posts-settings-group' ); ?>
    <?php do_settings_sections( 'tweets_to_posts-settings-group' ); ?>
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

   <h3>Plugin settings</h3>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Query type :</th>
        <td>
          <select name="tweets_to_posts_query_type">
            <option value="free" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'free'){ echo 'selected'; } ?>>Query (will search in tweets content)</option>
            <option value="user" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'user'){ echo 'selected'; } ?> >User (find tweets from an user)</option>
            <option value="hash" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'hash'){ echo 'selected'; } ?> >Hashtag (find tweets with a hashtag)</option>
          </select>
        </td>
        </tr>
         <tr valign="top">
        <th scope="row">Query text :</th>
        <td><input type="text" placeholder="Don't type # or @, just the query." name="tweets_to_posts_query" value="<?php echo esc_attr( get_option('tweets_to_posts_query') ); ?>" /></td>
        </tr>
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
        <th scope="row">Only fetch tweets with images ?</th>
        <td> <select name="tweets_to_posts_only_images">
          
              <option value="true" <?php if(esc_attr( get_option('tweets_to_posts_only_images') ) === true){ echo 'selected'; } ?> >Yes</option>
              <option value="false" <?php if(esc_attr( get_option('tweets_to_posts_only_images') ) === false){ echo 'selected'; } ?> >No</option>
          </select></td>
        </tr>
       
        <tr valign="top">
        <th scope="row">Exclude replies ?</th>
        <td> <select name="tweets_to_posts_exclude_replies">
          
              <option value="true" <?php if(esc_attr( get_option('tweets_to_posts_exclude_replies') ) === true){ echo 'selected'; } ?> >Yes</option>
              <option value="false" <?php if(esc_attr( get_option('tweets_to_posts_exclude_replies') ) === false){ echo 'selected'; } ?> >No</option>
          </select></td>
        </tr>
        <tr valign="top">
        <th scope="row">Tweets by page ?</th>
        <td><input type="number" placeholder="Default is 30" name="tweets_to_posts_number" value="<?php echo esc_attr( get_option('tweets_to_posts_number') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>