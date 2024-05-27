<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="allblocks" style="display:flex; flex-direction: column; align-items: center">
    <div class="b1" style="width: 600px;" ><h2>Что же предлагает наша мастерская?</h2></div>

    <div class="container-fluid">
        <div class="card-group">
            <div class="row row-cols-1 row-cols-md-2 g-5">
                <?php foreach ($cart as $c):?>
                    <div class="col">
                        <div class="card border-success mb-1" style="height:800px">
                            <img src="../img/<?php echo $c->img ?>" class="card-img-top" alt="..."  style="object-fit: cover; min-height: 500px; max-height: 500px">
                            <div class="card-body">
                                <h5 class="card-title" ><?php echo $c['title']?></h5>
                                <p class="card-text"><?php echo $c['opis']?></p>
                            </div>
                            <a href="<?php echo Url::to(['site/podrob', 'id' => $c->id]) ?>" class="btn btn-outline-success">Подробнее</a>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>
        </div>
    </div>

