<?php
    require_once("twitteroauth/twitteroauth.php");
    require_once('config.php');

 
    if (CONSUMER_KEY === '' || CONSUMER_SECRET === '' || CONSUMER_KEY === 'CONSUMER_KEY_HERE' || CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
        echo 'You need a consumer key and secret keys. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
      
        exit;
    }

    $username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $number = filter_input(INPUT_GET, 'count', FILTER_SANITIZE_NUMBER_INT);
    $exclude_replies = filter_input(INPUT_GET, 'exclude_replies', FILTER_SANITIZE_SPECIAL_CHARS);
    $list_slug = filter_input(INPUT_GET, 'list_slug', FILTER_SANITIZE_SPECIAL_CHARS);
    $hashtag = filter_input(INPUT_GET, 'hashtag', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastID = filter_input(INPUT_GET, 'lastID', FILTER_SANITIZE_SPECIAL_CHARS);
    $onlyImages = filter_input(INPUT_GET, 'onlyImages', FILTER_SANITIZE_SPECIAL_CHARS);

    function getConnectionWithToken($cons_key, $cons_secret, $oauth_token, $oauth_secret)
    {
        $connection = new T2PTwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_secret);
      
        return $connection;
    }
    
    // Connect
    $connection = getConnectionWithToken(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
    
    // Get Tweets
    if (!empty($list_slug)) {
      $params = array(
          'owner_screen_name' => $username,
          'slug' => $list_slug,
          'per_page' => $number
      );

      $url = '/lists/statuses';
    } 

    else if($hashtag) {
      
        $params = array(
          'count' => $number,
          'q' => $hashtag,
          'include_entities' => true

      );
      
      

      $url = '/search/tweets';
    } else {

      $params = array(

          'count' => $number,
          'exclude_replies' => $exclude_replies,
          'screen_name' => $username
      );

      $url = '/statuses/user_timeline';
    }

    if($lastID){
      $params['max_id'] = $lastID;
    }
    if($onlyImages){
      $params['q'] .= ' filter:images';
    }
    
    $tweets = array();

    $tweets = $connection->get($url, $params);



    // Return JSON Object
    header('Content-Type: application/json');
    

    $tweets = json_encode( $tweets);
    
   
    echo $tweets;
