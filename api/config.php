<?php
    

    define('CONSUMER_KEY', get_option( 'tweets_to_posts_ck', '' ));
    define('CONSUMER_SECRET', get_option( 'tweets_to_posts_cs', '' ));
    define('ACCESS_TOKEN', get_option( 'tweets_to_posts_at', '' ));
    define('ACCESS_SECRET', get_option( 'tweets_to_posts_as', '' ));


	
	define('CACHE_ENABLED', false);
	define('CACHE_LIFETIME', 3600); // in seconds
	define('HASH_SALT', md5(dirname(__FILE__)));