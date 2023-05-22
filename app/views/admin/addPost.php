<form class="railway" action="/admin/addPost" method="post">
    <div class="stripes-block"
    <div class="line"
    </div>
    </div>
    <h3><?php echo $title; ?></h3>
    <div class="form-group">
        <label>Название</label>
        <label>
            <input class="form-control" type="text" name="name">
        </label>
        <label>Описание</label>
        <label>
            <input class="form-control" type="text" name="description">
        </label>
        <label>Текст</label>
        <label>
            <textarea class="form-control" rows="3" name="text"></textarea>
        </label>
<!--        <label>Изображение</label>-->
<!--        <input class="form-control" type="file" name="img">-->
    </div>
    <div class="submit-block">
        <div class="submit-button">
            <button type="submit" >Добавить</button>
        </div>
    </div>
</form>
