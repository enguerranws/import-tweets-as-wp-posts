jQuery(document).ready(function(){
        
        ajaxGetTweets.init(ajaxGetTweets.query);
        jQuery('#updateCatOnChange').on('change', function() {

            ajaxGetTweets.updateCategories('#updateCatOnChange');
        });
});

var ajaxGetTweets = {
        query: '',
        lastID: '',
        nbPage: 0,
        init: function(tag){
                
                ajaxGetTweets.insertPost();
                ajaxGetTweets.rejectPost();
                ajaxGetTweets.getPostIdsAndRun('#results',tag);
                ajaxGetTweets.loadMore();

        },
        getPostIdsAndRun: function(container,tag,lastID){
             var data = 
                {
                    'action': 'tweets_to_posts_getAllPostSlug'
                };
            var ids = '';
            jQuery.post(ajaxurl, data, function(response){
                
                ids = response;
                
                
                ajaxGetTweets.getTagFeed(container,tag,ids,ajaxGetTweets.lastID);
               
            });
        },
        updateCategories: function(el) {
        var type = jQuery(el).val();
        var data = {
            'action': 'tweets_to_posts_getPostTypeCats',
            'post_type': type
        };

        jQuery.post(ajaxurl, data, function(response) {
            console.log(response);
            if (response === "empty") {
                jQuery('#catsSelect').addClass('hidden');
            } else {
                jQuery('#catsSelect').removeClass('hidden');
                jQuery('#catsSelect select').html(function() {
                    var html = "";
                    response = JSON.parse(response);

                    for (var i = 0; i < response.length; i++) {
                        if (ajaxGetYoutube.currentCat === response[i].id) {
                            html += '<option selected value="' + response[i].id + '" >' + response[i].name + '</option>';
                        } else {
                            html += '<option value="' + response[i].id + '" >' + response[i].name + '</option>';
                        }



                    }
                    return html;
                });
            }




        });
    },
        getTagFeed: function(container,tag,ids,lastID){
            var args = {};
            if(!container){
                container = '#results';
            }
            // OPTIMISER : définir 1 fois tout ce qui est global à args
            switch(ajaxGetTweets.query_type){
                case "user":
                    args = {
                        
                        ids: ids,
                        hashtag: null,
                        username: ajaxGetTweets.query,
                        count: ajaxGetTweets.number,
                        postType: ajaxGetTweets.post_type?ajaxGetTweets.post_type:'post',
                        template: '<div class="result" data-id="{{id}}"><div class="thumb"><a href="{{url}}" target="_blank" >{{media}}</a></div><div>{{user_name}} ({{screen_name}})</div><div class="content">{{tweet}}</div><div class="nbLikes">{{date}}</div><div class="buttons"><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-content="  " class="btn-deny button button-secondary" href="#">'+ ajaxGetTweets.trans.reject+'</a><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-account="{{twitter_name}}" data-content="" data-date="{{date}}" class="btn-approve button button-primary" href="#">'+ ajaxGetTweets.trans.approve+'</a></div></div>'
                    }
                    break;
                case "hashtag":
                    args = {
                        
                        ids: ids,
                        hashtag: '#'.ajaxGetTweets.query,
                        username: null,
                        count: ajaxGetTweets.number,
                        postType: ajaxGetTweets.post_type?ajaxGetTweets.post_type:'post',
                        template: '<div class="result" data-id="{{id}}"><div class="thumb"><a href="{{url}}" target="_blank" >{{media}}</a></div><div>{{user_name}} ({{screen_name}})</div><div class="content">{{tweet}}</div><div class="nbLikes">{{date}}</div><div class="buttons"><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-content="  " class="btn-deny button button-secondary" href="#">'+ ajaxGetTweets.trans.reject+'</a><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-account="{{twitter_name}}" data-content="" data-date="{{date}}" class="btn-approve button button-primary" href="#">'+ ajaxGetTweets.trans.approve+'</a></div></div>'
                    }
                    break;
                case "free":
                    args = {
                        
                        ids: ids,
                        hashtag: ajaxGetTweets.query,
                        username: null,
                        count: ajaxGetTweets.number,
                        postType: ajaxGetTweets.post_type?ajaxGetTweets.post_type:'post',
                        template: '<div class="result" data-id="{{id}}"><div class="thumb"><a href="{{url}}" target="_blank" >{{media}}</a></div><div>{{user_name}} ({{screen_name}})</div><div class="content">{{tweet}}</div><div class="date">{{date}}</div><div class="buttons"><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-content="  " class="btn-deny button button-secondary" href="#">'+ ajaxGetTweets.trans.reject+'</a><a data-id="{{id}}" data-src="{{media_url}}" data-author="{{user_name}}" data-account="{{twitter_name}}" data-content="" data-date="{{date}}" class="btn-approve button button-primary" href="#">'+ ajaxGetTweets.trans.approve+'</a></div></div>'
                    }
                    break;
            }
            if(lastID){
                args.lastID = lastID;
                
            }

            if(ajaxGetTweets.only_images === 'true'){
                args.onlyImages = true;
            }
            if(ajaxGetTweets.exclude_replies === 'true'){
                args.hideReplies = true;
            }


             jQuery(container).twittie(args,function(){
                   ajaxGetTweets.lastID = jQuery(container).find('ul > li:last-child .result').attr('data-id'); 
                   
                });
                
        },
        insertPost: function(){
            jQuery(document).on('click', '.btn-approve', function(e){
                e.preventDefault();
                var $that = jQuery(this);
                var id = $that.attr('data-id');
                var title = 'Twitter post '+ id;
                var content = $that.parents('.result').find('.content').html();
                var imgSrc = $that.attr('data-src');
                var author = $that.attr('data-author');
                var account = $that.attr('data-account');
                var date = $that.attr('data-date');
                var data = {
                    'action': 'tweets_to_posts_insertPost',
                    'id': id,
                    'title': title,
                    'content': content,
                    'author' : author,
                    'imgSrc' : imgSrc,
                    'account': account,
                    'postType': ajaxGetTweets.post_type,
                    'date': date
                };
                jQuery('.updated-custom p').html(ajaxGetTweets.trans.loading).parent().fadeIn();
                jQuery.post(ajaxurl, data,function(response){
                        
                    if(response === 'ok'){
                        $that.parents('.result').fadeOut();
                         ajaxGetTweets.showAlert('mediaAdded');
                    }
                }); // wp_insert_post();
            });
        },
        showAlert: function(message) {
            var msg;
            if (message === "needUpdate") {
                msg = ajaxGetTweets.trans.needUpdate;
            }
            else if (message === "mediaAdded") {
                msg = ajaxGetTweets.trans.mediaAdded;
            }
            else if (message === "mediaRejected") {
                msg = ajaxGetTweets.trans.mediaRejected;
            }
            jQuery('.updated-custom p').html(msg).fadeIn(function() {
                jQuery('.updated-custom').fadeOut();   
            });

        },
        rejectPost: function(){
            jQuery(document).on('click', '.btn-deny', function(e){
                e.preventDefault();
                var $that = jQuery(this);
                var id = $that.attr('data-id');
                var title = 'Twitter post '+ id;
                var content = $that.attr('data-content');
                var imgSrc = $that.attr('data-src');
                var author = $that.attr('data-author');
                console.log('ok deny');
                var data = {
                    'action': 'tweets_to_posts_rejectPost',
                    'id': id,
                    'title': title,
                    'content': content,
                    'imgSrc' : imgSrc
                };
                jQuery('.updated-custom p').html(ajaxGetTweets.trans.loading).parent().fadeIn();
                jQuery.post(ajaxurl, data,function(response){
                    if(response === 'ok'){
                        $that.parents('.result').fadeOut();
                         ajaxGetTweets.showAlert('mediaRejected');
                    }
                }); // wp_insert_post();
            });
        },
        loadMore: function(){
            var loadButton = jQuery('#loadMore');
            var container = '#results';
            
            loadButton.on('click',function(e){
                e.preventDefault();
                ajaxGetTweets.nbPage++;
                jQuery(container).after('<div class="results" id="results-'+ajaxGetTweets.nbPage+'" />');
                container = '#results-'+ajaxGetTweets.nbPage;
                ajaxGetTweets.getPostIdsAndRun(container,ajaxGetTweets.defaultTag,ajaxGetTweets.lastID+1);
            });
        }
}