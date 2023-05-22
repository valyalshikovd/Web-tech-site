
<div class="textik">
            <p><?php echo htmlspecialchars($data['text'], ENT_QUOTES); ?></p>
</div>
<div class="textik">
            <?php if (empty($list)): ?>
                <p>Список комментарий пуст</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">

                            <h2 class="post-title"><?php echo htmlspecialchars($val['nickname'], ENT_QUOTES); ?></h2>
                            <h5 class="post-subtitle"><?php echo htmlspecialchars($val['text'], ENT_QUOTES); ?></h5>

                        <p>id  <?php echo $val['id']; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>
<div class="buttonf">
    <a href="/comment/<?php echo $data['id']; ?>">Комментировать</a>
    <p><?php
        if(isset($_COOKIE['counter'])){
            echo "Вы посещали посты на этом сайте: ".$_COOKIE['counter']." раз!";
        } ?></p>
</div>
