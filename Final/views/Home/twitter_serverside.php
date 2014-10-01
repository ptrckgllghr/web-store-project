<?
	require_once __DIR__ . '/../../inc/functions.php';
	$url = 'http://search.twitter.com/search.json?q=newpaltz';
	$results = curl_download($url);
	$ob = json_decode($results);
	
	

	
?>
	<style type="text/css">
		li {
			min-height: 60px;
		}
		li img{
			float: left;
		}
	</style>
	
	
	<h3>Search for: <?=$ob->query?></h3>
	<ul class="unstyled">
		<? foreach ($ob->results as $tweet): ?>
			<li>
				<img src="<?=$tweet->profile_image_url?>" />
				<i><?=$tweet->from_user_name?></i>
				<b>(@<?=$tweet->from_user?>)</b>
				<?=$tweet->text?>
			</li>
		<? endforeach; ?>
	</ul>
	<pre>
		<? print_r($ob); ?>
	</pre>