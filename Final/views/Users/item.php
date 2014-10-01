		<tr class="<?= isset($_GET['inserted']) && $row['id'] == $_GET['inserted'] ? 'error' : '' ?>">
							<td><?=$row['FirstName']?></td>
							<td><?=$row['LastName']?> </td>
							<td><?=$row['Name']?> </td>
							
							<td>
								<a href="<?=$rootUrl?>/../W/Users/details/<?=$row['id']?>">Details</a>
								<a href="<?=$rootUrl?>/../W/Users/edit/<?=$row['id']?>" class="edit-link">Edit</a>
								<a href="<?=$rootUrl?>/../W/Users/delete/<?=$row['id']?>" class="delete-link">Delete</a>
							</td>				
		</tr>
