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

			.main {
				margin:0 auto;
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
		<div class="main">
			<a href="<?php echo site_url('/todo/add'); ?>">Add Task</a>
		</div>
		<table class="table">
			<thead>
				<tr>
					<td>No</td>
					<td>Task</td>
					<td>Is Done?</td>
					<td>Is Active?</td>
					<td>Created Date</td>
					<td>Updated Date</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; foreach ($todos as $row) { ?>
				<tr>
					<td><?= $i; ?></td>
					<td><?= $row['name'] ?></td>
					<td><?= ($row['is_done'] ? 'Done' : 'Undone') ?></td>
					<td><?= ($row['active'] ? 'Active' : 'Inactive') ?></td>
					<td><?= $row['create_date'] ?></td>
					<td><?= $row['write_date'] ?></td>
					<td>
						<a href="<?php echo site_url('todo/set_done/'.$row['id']).'/'.($row['is_done'] ? 0 : 1); ?>"><?php echo ($row['is_done'] ? 'Set Undone' : 'Set Done' ) ?></a> | 
						<a href="<?php echo site_url('todo/edit/'.$row['id']); ?>">Edit</a> | 
						<a href="<?php echo site_url('todo/delete/'.$row['id']); ?>">Delete</a>
					</td>
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
	</body>
</html>
