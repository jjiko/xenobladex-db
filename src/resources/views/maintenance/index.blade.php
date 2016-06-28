<!doctype html>
<link rel="stylesheet" href="/css/main.css">
<ul>
    @foreach($collection as $model)
        @if($model->bestiary->count() < 1)
            <li>(<?php echo $model->bestiary->count() ?>) <?php echo $model->name; ?></li>
        @endif
    @endforeach
</ul>
<table class="table">
    @foreach($collection2 as $model)
        @if($model->drops->count() < 1)
            <tr>
                <td><?php echo $model->drops->count() ?></td>
                <td><?php echo $model->name ?></td>
                <td><?php echo $model->drop_1 ?></td>
                <td><?php echo $model->drop_2 ?></td>
                <td><?php echo $model->drop_3 ?></td>
                <td><?php echo $model->drop_4 ?></td>
                <td><?php echo $model->drop_5 ?></td>
                <td><?php echo $model->drop_6 ?></td>
                <td><?php echo $model->drop_7 ?></td>
            </tr>
        @endif
    @endforeach
</table>