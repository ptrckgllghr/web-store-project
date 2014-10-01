<?
require_once (__DIR__ . '/../../models/Accounts.php');
?>
<style type="text/css">
	.item {
		width: 150px;
		float: left;
		margin: 5px;
	}
	.cart {
		clear: both;
	}
	.cart img {
		width: 20px;
		height:30px;
	}
	.img-wrapper{
		height: 150px;
	}
</style>
	<div id="login">
		<? if(IsLoggedIn()): ?>
			Welcome <?=UserId()?>
		<? else: ?>
			Log in <a href="<?=$rootUrl?>/../W/Accounts/login">here</a>
		<? endif; ?>
		
		<div id="ui">
			
		</div>
		
		<button style="background:grey; cursor: pointer" id="cancel">Cancel Order</button>  
		<a id="checkout" href="<?=$rootUrl?>/../W/Home/index2">Place Order</a>	
	</div>
	
	
	<script id="cart_hb" type="text/x-handlebars-template">
	  <ul class="unstyled cart">
	  {{#each items}}
	  	{{> t_cart_item}}
	  {{/each}}	 
	  </ul>
	</script>
	
	<script id="cart_item_partial_hb" type="text/x-handlebars-template">
	  	<li class="cart_item_{{id}}"> 	
	  	<img src="<?=$rootUrl?>/static/img/products/{{id}}.jpg"/>
	    {{id}}
	  	<input type="number" name="quantity" value="{{count}}" />
	  </li>
	</script>
	<script id="products_hb" type="text/x-handlebars-template">
	  {{#each aaData}}
	  	<div class="item">
	  		<div class="img-circle img-wrapper">
	  			<img src="<?=$rootUrl?>/static/img/products/{{id}}.jpg" />	  			
	  		</div>
	  		<h6>
	  			{{Name}}
	  			<span class="badge badge-important">{{Quantity}}</span>
	  		</h6>
	  		<h5>Our Price: ${{Price}}</h5>
	  		<a class="add-to-cart-link" href="<?=$rootUrl?>/../A/Cart/{{id}}">
	  			<img src="<?=$rootUrl?>/static/img/btn_add_to_cart.png" />
	  		</a>
	  	</div>  
	  {{/each}}
	</script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/1.0.rc.1/handlebars.min.js">
	</script>
	<script type="text/javascript">
		$(function(){
			var t_cart = Handlebars.compile($("#cart_hb").html());
			var t_cart_item = Handlebars.compile($("#cart_item_partial_hb").html());
			var t_products = Handlebars.compile($("#products_hb").html());
			Handlebars.registerPartial('t_cart_item', t_cart_item);
			
			
			$.get('<?=$rootUrl?>/../A/Products', function(data){
						$("#ui").html(t_products(data));
			},'json');
			
			$.get('<?=$rootUrl?>/../A/Cart', function(data){
				    var values = $.map( data, function( value, index ) {
				      return value;
				    }); 
					$("#ui").after(t_cart({items: values}));			
			},'json');
			
			$(".add-to-cart-link").live('click',function(){
				$.post(this.href, {_method: 'POST', count: 1}, function(data){
					if($("#cart_item_" + data.id).length > 0)
							$("#cart_item_" + data.id).replaceWith(t_cart_item(data));
					else
							$(".cart").append(t_cart_item(data));
				},'json');
				return false;
			});
		})
	</script>
	
	<script>
		$(document).ready(function(){
			$("#cancel").click(function(){
				$(".unstyled cart").hide();
			});
		});
	</script>