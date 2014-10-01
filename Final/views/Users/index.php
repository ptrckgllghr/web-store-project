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
				<table>
							<tr class="hide" id="form-elements">
						    	<td><input name="FirstName" class="FirstName" placeholder="First Name" type="text"  /></td>
						    	<td><input name="LastName" class="LastName" placeholder="Last Name" type="text" /></td>
						    	<td>
						    		
						    	</td>
						    	<td>
						    		<input name="id" class="id" type="hidden"  />
						    		<input type="submit" value="Save" class="btn" />
						    	</td>
						    </tr>
				</table>
		    <div id="delete-box" class="modal hide fade">
			    <div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h3>Delete</h3>
			    </div>
			    <div class="modal-body">
				    
			    </div>
		    </div>

		<script type="text/javascript">
			function TransformToTr(html)
			{
				return $(html).find(".control-group").wrapAll("<tr class='edit-form' />").wrap("<td />")
					.find("input").attr('placeholder', function(){
						return $(this).closest("td").find("label").hide().text();
					})
					.closest("tr").find("label").hide().closest("tr");				
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
				$(".edit-link").live("click",function(){
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
						$.post(this.action + '?ajax=json', $(this).serialize() , function(data){
							if(data.status=='success')
								$('#success-message').fadeIn();
							else{								
								$('#error-message').fadeIn().find('span').html($.map(data.errors, function(val, key){
									return $("<div />").text(key + ': ' + val);
								}));								
							}
							if(data.status != 'success')
							{
								$tr2 = $("<tr />").html($("#form-elements").html());
								$(".edit-form").replaceWith( $tr2 );
								$tr2
										.find(".FirstName").val(data.contents.FirstName).end()
										.find(".LastName").val(data.contents.LastName).end()
										.find(".id").val(data.contents.id);
							}else{
								
								var refer = '<a href="'+ location.href + 'details/ ' + data.contents.id +'">Details</a>' +
											'<a href="'+ location.href + 'edit/ ' + data.contents.id +'">Edit</a>' +
											'<a href="'+ location.href + 'delete/ ' + data.contents.id +'">Delete</a>'  ; 
											
								var type = $('#Keyword_id option[value="' + data.contents.Keyword_id + '"]').text();
								
								$(".edit-form").replaceWith(
									$("<tr />")
										.append($("<td />").text(data.contents.FirstName))
										.append($("<td />").text(data.contents.LastName))
										.append($("<td />").text(type))
										.append($("<td />").html(refer))
								);								
							}
						}, 'json');
						return false;
				});
				$.get('edit.php', function(html){
					TransformToTr(html).appendTo("tbody");
				});
				
			});
		</script>
