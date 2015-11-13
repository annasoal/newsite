$(function(){
    $('#selectTag').change(function () {
        setUrl();
    });

    function setUrl() {
        var url = $('#selectTag').find('option:selected').attr('data-url');
        $('#parent_url').html(url);
    }

    setUrl();
});