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
    <h2>Tweets to Wordpress Posts</h2>

   

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