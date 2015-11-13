$(document).ready(function() {
    
	if($('#textArea').length > 0){
		CKEDITOR.replace('textArea', {
			filebrowserUploadUrl : '/admin/ajax/upload'
		});
	}
});