<!DOCTYPE html>
<html>
	<head>
		<title>Odoo - Todo Apps</title>
		<style>
			table {
			    border-collapse: collapse;
			}

			table, th, td {
			   border: 1px solid black;
			} 

			.table {
				margin:0 auto;
			}

			.table thead tr{
				background: grey;
			}

			.table tr td {
				padding:10px;
			}

			.table tr:hover {
				background-color: yellow;
			}

			.table tr:nth-child(even) {
				background-color: #f2f2f2;
			}

		</style>
	</head>
	<body>
		<h1>Odoo To-do Apps</h1>
		<hr />
		<form action="<?php echo site_url('/todo/update'); ?>" method="POST">
			<table class="table">
				<tbody>
					<tr>
						<td>Task</td>
						<td>:</td>
						<td><textarea cols="50" name="task"><?php echo $task['name'] ?></textarea></td>
					</tr>
					<tr>
						<td>Is Done?</td>
						<td>:</td>
						<td>	
							<select name="is_done">
								<option value="1" <?php echo ($task['is_done'] == 1 ? "selected": "");?> >Yes, it is done</option>
								<option value="0" <?php echo ($task['is_done'] == 0 ? "selected": "");?> >Not yet</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Is Active?</td>
						<td>:</td>
						<td>
							<select name="is_active">
								<option value="1" <?php echo ($task['active'] == 1 ? "selected": "");?> >Yes</option>
								<option value="0" <?php echo ($task['active'] == 0 ? "selected": "");?> >No</option>
							</select>
							<input type="hidden" name="id" value="<?php echo $task['id'] ?>" />
						</td>
					</tr>
					<tr>
						<td colspan="3"><input type="submit" value="Update Task" /> <a href="<?php echo site_url('todo/index'); ?>">Cancel</a></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
