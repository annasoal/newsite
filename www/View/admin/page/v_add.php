<script>
    window.onload = function(){
        $('#selectTag').change(function(){
            setUrl();
        });
        
        function setUrl(){
            var url = $('#selectTag').find('option:selected').attr('data-url');
            $('#parent_url').html(url);
        }
        
        setUrl();
    }
</script>
<?php 
	function print_tree($pages, $id_page, $shift = 0)
	{
		if(!empty($pages))
		{
			foreach($pages as $page)
			{
				?><option value="<?=$page['id_page']?>" data-url="<?=$page['full_url']?>"
                   <?php if($page['id_page'] == $id_page) echo 'selected' ?>
                >
				<? for($i = 0; $i < $shift; $i++)echo '&nbsp;';?>
				<?=$page['title']?></option><?
				print_tree($page['children'], $id_page, $shift + 5); 
			}
		}
	}
?>
<br>
 <? if($errors != null):
 foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<? endif;?>
<form class="form-horizontal" method="post">
    <fieldset>
        <legend>Добавить страницу</legend>
        <div class="form-group">
            <label for="selectTag" class="col-lg-2 control-label">Раздел</label>
            <div class="col-lg-10">
                <select id="selectTag" class="form-control" name="id_parent">
                    <option value="0">Без раздела</option>
                    <? print_tree($pages, $fields['id_parent']) ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="url" class="col-lg-2 control-label">Url</label>

            <div class="col-lg-10">
                <span id="parent_url"></span><input type="text" class="form-control" id="url" name="url" value="<?php echo $fields['url'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputTitle" class="col-lg-2 control-label">Заголовок</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $fields['title'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="content" class="col-lg-2 control-label">Новый пост</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="5" id="content" name="content"><?php echo $fields['content'];?></textarea>
                <span class="help-block">Новое событие</span>
            </div>
        </div>

        

        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success" name="add">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>