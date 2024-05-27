<?php
use yii\helpers\Url;
?>

<a href="<?php echo Url::to(['site/catalog']) ?>" class="btn btn-primary" style="display: flex; width: 150px; margin-top: 2%">Вернуться назад</a>

<br>

    <?php foreach ($pro as $f):
        ?>
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <img src="../img/<?php echo $f->img ?>" class="card-img-top" alt="..." >
                <h5 class="card-title"><?php echo $f['title']?></h5>
                <p class="card-text"><?php echo $f['body']?></p>
            </div>
        </div>
    <?php endforeach;?>
