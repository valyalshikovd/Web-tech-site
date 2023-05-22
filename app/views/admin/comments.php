<?php if (empty($list)): ?>
    <p>Комментарий нет</p>
<?php else: ?>
    <?php foreach ($list as $val): ?>
        <div>
            <div class="post-preview">
                <h2><?php echo htmlspecialchars($val['nickname'], ENT_QUOTES); ?></h2>
                <h5><?php echo htmlspecialchars($val['text'], ENT_QUOTES); ?></h5>
                <p>id <?php echo $val['id']; ?></p>
            </div>
            <div>
                <a href="/admin/deleteComment/<?php echo $val['id']; ?>" class="btn btn-danger">Удалить</a>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

