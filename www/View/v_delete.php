<div class="jumbotron">
    <form class="form-horizontal" action="/admin/delete/<?php echo $id_post ?>" method="post">
        <fieldset>
            <legend>Вы уверены, что хотите удалить пост (информация будет удалена безвозвратно)?</legend>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-danger" name="undoDelete">Отменить удаление</button>
                    <button type="submit" class="btn btn-success" name="delete">Удалить окончательно</button>
                </div>
            </div>
        </fieldset>
    </form>


</div>