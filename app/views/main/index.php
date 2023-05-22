<div class="basic">
    <div class="posts">
            <h1>Посты</h1>
    </div>
        <div>
            <?php if (empty($list)): ?>
                <p>Список постов пуст</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <a class="link-post" href="/post/<?php echo $val['id']; ?>">
                            <h2><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></h2>
                            <h5><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></h5>
                        </a>
                        <p class="post-meta">Идентфикатор этого поста <?php echo $val['id']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
    </div>
</div>