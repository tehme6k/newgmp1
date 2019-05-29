<?php $box = App\Box::first() ?>

@can('add', $box)
    You can browse boxes
@endcan