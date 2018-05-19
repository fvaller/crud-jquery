function createNew() {
	$("#add-more").hide();
	var data = '<tr class="table-row" id="new_row_ajax">' +
	'<td contenteditable="true" id="txt_id" onBlur="addToHiddenField(this, \'id\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_id_aluno" onBlur="addToHiddenField(this, \'id_aluno\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_data" onBlur="addToHiddenField(this, \'data\')" onClick="editRow(this);"></td>' +
	'<td contenteditable="true" id="txt_description" onBlur="addToHiddenField(this,\'ocorrencia\')" onClick="editRow(this);"></td>' +	
	'<td><input type="hidden" id="id" /><input type="hidden" id="id_aluno" /><input type="hidden" id="data" /><input type="hidden" id="ocorrencia" />'+
	'<span id="confirmAdd"><a onClick="addToDatabase()" class="ajax-action-links">Save</a> / <a onclick="cancelAdd();" class="ajax-action-links">Cancel</a></span></td>' +	
	'</tr>';
  $("#table-body").append(data);
}
function addToHiddenField(addColumn,hiddenField) {
	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}

function addToDatabase() {
  var id = $("#id").val();
  var id_aluno = $("#id_aluno").val();
  var data = $("#data").val();
  var ocorrencia = $("#ocorrencia").val();  

	  $("#confirmAdd").html('<img src="loaderIcon.gif" />');
	  $.ajax({
		url: "add.php",
		type: "POST",
		data:'id='+id+'&id_aluno='+id_aluno+'&data='+data+'&ocorrencia='+ocorrencia,
		success: function(data){
		  $("#new_row_ajax").remove();
		  $("#add-more").show();		  
		  $("#table-body").append(data);
		}
	  });
}
function cancelAdd() {
	$("#add-more").show();
	$("#new_row_ajax").remove();
}
function editRow(editableObj) {
  $(editableObj).css("background","#BEE7FC");
}

function save(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
  $.ajax({
    url: "edit.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id,
    success: function(data){
      $(editableObj).css("background","#D7F9E6");
    }
  });
}

function deleteRecord(id) {
	if(confirm("Are you sure you want to delete this row?")) {
		$.ajax({
			url: "delete.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}