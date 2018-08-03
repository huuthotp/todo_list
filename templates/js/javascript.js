function viewWorkSubmit(type) {
	var command = 'edit';
	if(type == 2) {
		command = 'delete';
	}
	document.getElementById("command").value = command;
	document.getElementById("formEdit").submit();
}