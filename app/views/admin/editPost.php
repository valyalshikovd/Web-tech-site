<form class="railway" method="post">
    <div class="stripes-block"
    <div class="line"
    </div>
    </div>
    <h3><?php echo $title; ?></h3>
    <div class="form-group">
        <label>Название</label>
        <input class="form-control" type="text" value="<?php echo htmlspecialchars($data[0]['name'], ENT_QUOTES); ?>"
               name="name">
    </div>
    <div class="form-group">
        <label>Описание</label>
        <input class="form-control" type="text"
               value="<?php echo htmlspecialchars($data[0]['description'], ENT_QUOTES); ?>"
               name="description">
    </div>
    <div class="form-group">
        <label>Текст</label>
        <textarea class="form-control" rows="3"
                  name="text"> <?php echo htmlspecialchars($data[0]['text'], ENT_QUOTES); ?></textarea>
    </div>
    <div class="submit-block">
        <div class="submit-button">
            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
        </div>
    </div>
</form>

