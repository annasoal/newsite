$(document).ready(function() {
    
	if($('#textArea').length > 0){
		CKEDITOR.replace('textArea', {
			filebrowserUploadUrl : '/' + _PHP.admin_url + '/ajax/upload'
		});
	}
});