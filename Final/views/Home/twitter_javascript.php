	<style type="text/css">
		li {
			min-height: 60px;
		}
		li img{
			float: left;
		}
		#ui {
			font-size: 12px;
		}
		#ui img {
			width: 20px;
		}
	</style>

<div id="ui"></div>
<a href="#">Load More</a>

<script id="twitter_template" type="text/template">
	<ul class="unstyled">
	{{#each results}}
		{{> t_tweet}}
	{{/each}}
	</ul>
</script>
<script id="tweet_template" type="text/template">
	<li>
				<img src="{{profile_image_url}}" />
				<i>{{from_user_name}}</i>
				<b>(@{{from_user}})</b>
				{{text}}
				<div>{{created_at}}</div>
	</li>
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.rc.1/handlebars.min.js">
</script>
<script type="text/javascript">
			var t_twitter = Handlebars.compile($("#twitter_template").html());
			var t_tweet = Handlebars.compile($("#tweet_template").html());
			Handlebars.registerPartial('t_tweet', t_tweet);

	var url = 'http://search.twitter.com/search.json?callback=?';
	var tData = null;
	$.getJSON(url, {q: 'newpaltz'}, function(data){
		$("#ui").append(data.query);
		$("#ui").append(t_twitter(data));
		tData = data;
	});
	$("a").click(function(){
		$.getJSON('http://search.twitter.com/search.json' + tData.next_page + '&callback=?', function(data){
			$("#ui").append(t_twitter(data));
			tData = data;
		});

		return false;
	})
</script>

















