<form class="railway" action="<?php echo $id; ?>" method="post">
    <div class="stripes-block"
    <div class="line"
    </div>
    </div>
    <h3><?php echo $title; ?></h3>
    <div class="form-group">
        <label>Никнейм</label>
        <label>
            <input class="form-control" type="text" name="nickname">
        </label>
    </div>
    <div class="form-group">
        <label>Текст</label>
        <label>
            <textarea class="form-control" rows="3" name="text"></textarea>
        </label>
    </div>
    <div class="submit-block">
        <div class="submit-button">
            <button type="submit" class="btn btn-primary btn-block">Добавить</button>
        </div>
    </div>
</form>

