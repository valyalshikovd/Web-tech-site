<div>Посты</div>
<div>
    <?php if (empty($list)): ?>
        <p>Список постов пуст</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Название</th>
                <th>Редактировать</th>
                <th>Удалить</th>
                <th>Просмотреть комментарии</th>
            </tr>
            <?php foreach ($list as $val): ?>
                <tr>
                    <td><?php echo htmlspecialchars($val['name'], ENT_QUOTES); ?></td>
                    <td><a href="/admin/editPost/<?php echo $val['id']; ?>" class="btn btn-primary">Редактировать</a>
                    </td>
                    <td><a href="/admin/deletePost/<?php echo $val['id']; ?>" class="btn btn-danger">Удалить</a></td>
                    <td><a href="/admin/comments/<?php echo $val['id']; ?>" class="btn btn-danger">Комментарии</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

