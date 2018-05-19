<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["id_aluno"])) {
	$id = (strip_tags($_POST["id"]));
	$id_aluno = (strip_tags($_POST["id_aluno"]));
	$data = (strip_tags($_POST["data"]));
	$ocorrencia = (strip_tags($_POST["ocorrencia"]));

  $sql = "INSERT INTO alunos_ocorrencias (id_aluno, data, ocorrencia) VALUES ('{$id_aluno}', '{$data}', '{$ocorrencia}')";
  $faq_id = $db_handle->executeInsert($sql);  
	if(!empty($faq_id)) {
		$sql = "SELECT * from alunos_ocorrencias WHERE id = '$faq_id' ";
		$posts = $db_handle->runSelectQuery($sql);		
	}
?>
<tr class="table-row" id="table-row-<?php echo $posts[0]["id"]; ?>">
<td><?php echo $posts[0]["id"]; ?></td>
<td contenteditable="true" onBlur="save(this,'id_aluno','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["id_aluno"]; ?></td>
<td contenteditable="true" onBlur="save(this,'data','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["data"]; ?></td>
<td contenteditable="true" onBlur="save(this,'ocorrencia','<?php echo $posts[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $posts[0]["ocorrencia"]; ?></td>		
<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $posts[0]["id"]; ?>);">Delete</a></td>
</tr>  
<?php } ?>