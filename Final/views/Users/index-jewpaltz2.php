<?
require_once (__DIR__ . '/../../models/Accounts.php');
require_once (__DIR__ . '/../../models/Users.php');
$results = Users::GetAll();
RequireLogin();
?>
				<? if(isset($_GET['inserted'])): ?>
				    <div class="alert alert-success">
					    <button type="button" class="close">×</button>
					    A user has been successfuly added.
				    </div>
				<? endif; ?>
				<div class="alert alert-success hide" id="success-message">
					    <button type="button" class="close">×</button>
					    A user has been successfuly added.
				</div>
				<div class="alert alert-error hide" id="error-message">
					    <button type="button" class="close">×</button>
					    <span></span>
				</div>

				<a href="<?=$rootUrl?>/../W/Users/edit">+ Create New</a>
				
				<form action="<?=$rootUrl?>/../W/Users/edit" method="post">
					<table class="table table-bordered table-condensed table-hover table-striped">
						<thead>
							<tr>
							<th>First Name</th><th>Last Name</th><th>Type</th><th>Actions</th>
						</tr>
						</thead>
						<tbody>
							<?while($row = $results->fetch_assoc()):?>
								<? include('item.php'); ?>
							<? endwhile; ?>
						</tbody>
					</table>
				</form>
		    <div id="delete-box" class="modal hide fade">
			    <div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h3>Delete</h3>
			    </div>
			    <div class="modal-body">
				    
			    </div>
		    </div>
		    
		<script type="text/javascript" src="<?=$rootUrl?>/static/js/bootstrap.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.js"></script>
		<script type="text/javascript">
			function TransformToTr(html)
			{
				return $(html).find(".control-group").wrapAll("<tr class='edit-form' />").wrap("<td />")
					.find("input").attr('placeholder', function(){
						return $(this).closest("td").find("label").hide().text();
					})
					.closest("tr").find("label").hide()
					.closest("tr");				
			}
			function CancelEdit()
			{
				$(".edit-form").first().prev().show().end().remove();
			};
			$(function(){
				//$("table").dataTable({        "bJQueryUI": true,        "sPaginationType": "full_numbers"    });
				$(".close").click(function(){
					$(this).closest(".alert").slideUp();
				});
				$(".error").removeClass('error', 'slow');
				$(".delete-link").click(function(){
					$("#delete-box").modal({'show':true });
					$.get(this.href, function(data){
						$("#delete-box").find(".modal-body").html($(data).find("form"));
					});
					return false;
				});
				$(".edit-link").live('click', function(){
					CancelEdit();
					var $tr = $(this).closest("tr").hide();
					$.get(this.href, {date: new Date() } , function(data){
						$tr.after(TransformToTr(data));
					});
					return false;
				});
				$(".edit-form button").live('click',function(){
						CancelEdit();
				});
				$("form").submit(function(){
						$.post(this.action + '?ajax', $(this).serialize() , function(data){
							if(data.status=='success')
								$('#success-message').fadeIn();
							else{
								
								$('#error-message').fadeIn().find('span').html($.map(data.errors, function(val, key){
									return $("<div />").text(key + ': ' + val);
								}));								
							}
							if($(data.contents).find("form").length > 0)
							{
								$(".edit-form").replaceWith(TransformToTr(data.contents));
							}else{
								$(".edit-form").replaceWith(data.contents);								
							}
						}, 'json');
						return false;
				});
				$.get('edit.php', function(html){
					TransformToTr(html).appendTo("tbody");
				});
				
			});
		</script>
