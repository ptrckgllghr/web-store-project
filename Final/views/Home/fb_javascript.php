
<div class="fb-like" data-href="http://www.jewpaltz.com" data-send="true" data-layout="box_count" data-width="450" data-show-faces="true"></div>
<div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1" data-scope="email,publish_stream"></div>
<br />




<div class="fb-comments" data-href="http://jewpaltz.com" data-width="470" data-num-posts="2"></div>




<?
	require_once __DIR__ . '/../../inc/functions.php';
	$url = "https://graph.facebook.com/me/feed?access_token=$_GET[access_token]";
	$results = curl_download($url);
	$ob = json_decode($results);
?>
<ul class="unstyled">
<? foreach ($ob->data as $f): ?>
	<li>
		<a href="http://facebook.com/<?=$f->id?>">
			<img src="http://graph.facebook.com/<?=$f->from->id?>/picture" />
			<?=$f->message?>
			<img src="<?=$f->picture?>" />
		</a>
	</li>
<? endforeach; ?>
</ul>
<pre>
	<? print_r($ob); ?>
</pre> 

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '398096586934539', // App ID from the App Dashboard
      status: true, cookie: true, xfbml: true
    });
    
    FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
	     var uid = response.authResponse.userID;
	    var accessToken = response.authResponse.accessToken;
	    <? if(!isset($_GET['access_token'])): ?>
		    location = "?access_token=" + accessToken;
	    <? endif; ?>
	  } else if (response.status === 'not_authorized') {
	    // the user is logged in to Facebook, 
	    // but has not authenticated your app
	  } else {
	    // the user isn't logged in to Facebook.
	  }
	 });
  };

  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
</script>