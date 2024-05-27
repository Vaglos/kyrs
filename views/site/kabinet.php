<h2>Ваши Заявки:</h2>
<?php foreach ($zayv as $f): ?>
    <div class="card" style="width: 40rem; margin-top: 10px;">
        <div class="card-body">
            <img src="../img/<?php echo $f->img?>" class="card-img-top" alt="..." >
            <h5 class="card-title">Название: <?php echo $f['name']?></h5>
            <p class="card-text">Описание: <?php echo $f['body']?></p>
            <p class="card-text">Номер Тел: <?php echo $f['ph']?></p>
            <p class="card-text">Категория: <?php echo $f['category_id']?></p>
        </div>
    </div>
<br>
<?php endforeach;?>
