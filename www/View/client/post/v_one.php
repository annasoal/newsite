<div class="jumbotron">
    <h2><?php echo $post['title']; ?> </h2>
    <br>
    <article>
        <?php echo $post['text'];?>
        <br>
        <img src="<? echo $post['file'];?>" alt="">

        <?php if(!empty($tags)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">Теги</div>
                <div class="panel-body">
                    <?php foreach ($tags as $tag): ?>
                        <div><a href="/<?=ADMIN_URL?>/post/tag/<?php echo $tag['id_tag']; ?>"><?php echo $tag['name']; ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <? endif; ?>

        <aside role="complementary">
            <div class="panel panel-default">
                <div class="panel-heading">Комментарии</div>
                    <? foreach($comments as $c): ?>
                    <div class="panel-body">
                        <p><?php echo $c['text']; ?></p>
                        <p><?php echo $c['name']; ?></p>
                    </div>
                    <? endforeach;?>
                </div>
            </div>
            <? if($active_user != null): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Добавить комментарий</div>
                    <div class="panel-body">
                        <form method="post">
                            <fieldset>
                                <legend>Ваш комментарий</legend>
                                <textarea recizable class="form-control" rows="3" id="textArea" name="text"><?php echo
                                    $fields['text'];?></textarea>
                                <br>
                            <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success" name="add">Отправить</button>
                                </div>
                            </div>
                            </fieldset>
                        </form>
                        <? foreach($errors as $e): ?>
                            <p class="error"><?php echo $e; ?></p>
                        <? endforeach;?>
                    </div>
                </div>
                    <? endif; ?>

        </aside>
    </article>


</div>