function getModal(title, content, date, id, slug){
	$('#modal').modal('show');

	vlink = "{{ uri('post_show', {'id':"+ id+", 'slug':"+ slug+" }) }}";
	$('#modal-title').text(title);
	$('#modal-body').text(content);
	$('#modal-small').text(date);
	$('#modal-link').attr('href', "/post/"+id+"-"+slug);
}

function newTask() {
	
	var task = $('#task').val();
	var list = $('#list');

	$.post('/todo/add', {name : task}, function(data){
		if (data != 'error') {
			var array = JSON.parse(data);
			var id = array['id'];

			var newTask = "<li id=\"li"+id+"\"><p class='' id=\"checked"+id+"\"><i class=\"fas fa-times text-danger\"></i></p><p id=\"name"+id+"\">"+array['name']+"</p><div><button type=\"button\" class=\"bouton green\" id=\"btn"+id+"\" onclick=\"taskCheck("+id+")\"><i class=\"far fa-check-circle text-white\"></i></button><button type=\"button\" id=\"edit"+id+"\" class=\"bouton blue\" onclick=\"showEditModal("+id+")\"><i class=\"fas fa-pencil-alt text-white\"></i></button><button type=\"button\" class=\"bouton red\" onclick=\"deleteTask("+id+")\"><i class=\"far fa-trash-alt text-white\"></i></button></div></li>";

			$('#list').append(newTask);
		}
	})
}

function editTask(id) {
	var text = $('#inputNameModal').val();
	$.post('/todo/edit', {id:id, name:text}, function(data){
		if (data != 'error') {
			$('#name'+id).html(data);
			$('#editModal').modal('hide');
		}
	})
}

function showEditModal(id) {
	$('#editModal').modal('show');
	$('#editModal').on('shown.bs.modal', function (e) {
		$('#editButton').attr('onclick', 'editTask('+id+');');
		$('#inputNameModal').val($('#name'+id).html());
	});
	$('#editModal').on('hidden.bs.modal', function (e) {
		$('#editButton').removeAttr('onclick');
		$('#inputNameModal').val('');
	});
}

function taskCheck(id) {
	$.post('/todo/check', {id : id}, function(data){
		if (data == 'ok') {
			$('#checked'+id).html("<i class=\"fas fa-check text-success\"></i>");
			$('#btn'+id).remove();
			$('#edit'+id).remove();
		}
	})
}

function deleteTask(id) {
	if (confirm("Etes-vous sur de vouloir supprimer cette tâche ?")) {
		$.post('/todo/delete', {id:id}, function(data){
			if (data == 'ok') {
				$('#li'+id).remove();
			}
		})
	}
}