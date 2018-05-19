<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

$sql = "SELECT * from alunos_ocorrencias";
$posts = $db_handle->runSelectQuery($sql);
//var_dump($posts);
?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="crud.js"></script>

<style>
body{width:615px;}
.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
</style>

<table class="tbl-qa">
  <thead>
	<tr>
	  <th class="table-header">id</th>
	  <th class="table-header">id_aluno</th>
	  <th class="table-header">data</th>
	  <th class="table-header">ocorrencia</th>
	  <th class="table-header">Actions</th>
	</tr>
  </thead>
  <tbody id="table-body">
	<?php
	if(!empty($posts)) { 
	foreach($posts as $k=>$v) {
	  ?>
	  <tr class="table-row" id="table-row-<?php echo $posts[$k]["id"]; ?>">

		<td><?php echo $posts[$k]["id"]; ?></td>
		<td contenteditable="true" onBlur="save(this,'id_aluno','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["id_aluno"]; ?></td>
		<td contenteditable="true" onBlur="save(this,'data','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["data"]; ?></td>
		<td contenteditable="true" onBlur="save(this,'ocorrencia','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[$k]["ocorrencia"]; ?></td>		
		<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[$k]["id"]; ?>);">Delete</a></td>
	  </tr>
	  <?php
	}
	}
	?>
  </tbody>
</table>
<div class="ajax-action-button" id="add-more" onClick="createNew();">Add More</div>