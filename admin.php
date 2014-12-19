<script type="text/javascript">
  var pluginDirectory = '<?php echo plugins_url('', __FILE__); ?>';
  ajaxGetTweets.query = '<?php echo get_option( 'tweets_to_posts_query', '' ) ?>';
  ajaxGetTweets.query_type = '<?php echo get_option( 'tweets_to_posts_query_type', '' ) ?>';
  ajaxGetTweets.post_type = '<?php echo get_option( 'tweets_to_posts_post_type', '' ) ?>';
  ajaxGetTweets.exlude_rt = '<?php echo get_option( 'tweets_to_posts_exclude_rt', '' ) ?>';
  ajaxGetTweets.exclude_replies = '<?php echo get_option( 'tweets_to_posts_exclude_replies', '' ) ?>';
  ajaxGetTweets.number = '<?php echo get_option( 'tweets_to_posts_number', '' ) ?>';
  ajaxGetTweets.only_images = '<?php echo get_option( 'tweets_to_posts_only_images', '' ) ?>';
</script>
<div class="updated">
  <p>Media added !</p>
</div>
<div class="wrap">
  <h2><img src="<?php echo plugins_url('', __FILE__); ?>/img/logo-t2p.png"></h2>
  <h3>Tweets query options</h3>
  <form method="post" action="options.php" class="options-custom">
    
    <?php
      settings_fields( 'tweets_to_posts_query-settings-group' ); ?>
    <?php do_settings_sections( 'tweets_to_posts_query-settings-group' ); ?>
    <div class="option">
      <label>Query type :</label>
      <select name="tweets_to_posts_query_type">
        <option value="free" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'free'){ echo 'selected'; } ?>>Query (will search in tweets content)</option>
        <option value="user" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'user'){ echo 'selected'; } ?> >User (find tweets from an user)</option>
        <option value="hash" <?php if(esc_attr( get_option('tweets_to_posts_query_type') ) === 'hash'){ echo 'selected'; } ?> >Hashtag (find tweets with a hashtag)</option>
      </select>
    </div>
    <div class="option">
      <label>Query text :</label>
      <input type="text" placeholder="Don't type # or @, just the query." name="tweets_to_posts_query" value="<?php echo esc_attr( get_option('tweets_to_posts_query') ); ?>" />
    </div>
    <div class="option">
      <label>Only tweets with image ?</label>
      <select name="tweets_to_posts_only_images">
        
        <option value="true" <?php if(esc_attr( get_option('tweets_to_posts_only_images') ) === true){ echo 'selected'; } ?> >Yes</option>
        <option value="false" <?php if(esc_attr( get_option('tweets_to_posts_only_images') ) === false){ echo 'selected'; } ?> >No</option>
      </select>
    </div>
    <div class="option">
      <label>Exclude replies ?</label>
      
      <select name="tweets_to_posts_exclude_replies">
        
        <option value="true" <?php if(esc_attr( get_option('tweets_to_posts_exclude_replies') ) === true){ echo 'selected'; } ?> >Yes</option>
        <option value="false" <?php if(esc_attr( get_option('tweets_to_posts_exclude_replies') ) === false){ echo 'selected'; } ?> >No</option>
      </select>
    </div>
    <div class="option">
    <label>Tweets number by page ?</label>
    <input type="number" placeholder="Default is 30" name="tweets_to_posts_number" value="<?php echo esc_attr( get_option('tweets_to_posts_number') ); ?>" /></td>
    </div>


<?php submit_button(); ?>
</form>

<h3>List of last Twitter posts for the query : "<?php echo get_option( 'tweets_to_posts_query', '' ) ?>"</h3>
<?php if(checkAPIsettings()){ ?>
<div id="headResults">
<div class="manage-column column-image"><strong>Image</strong></div>
<div class="manage-column column-auteur"><strong>Author</strong></div>
<div class="manage-column column-texte"><strong>Text</strong></div>
<div class="manage-column column-date"><strong>Date</strong></div>
<div class="manage-column column-action"><strong>Action</strong></div>
</div>
<div id="results" class="results">
</div>

<a href="#" class="button button-primary" id="loadMore">Load previous medias</a>
<?php
} else { ?>
<p>Your Twitter API access is not defined, go set it on the settings page.</p>
<?php
}?>

</div>