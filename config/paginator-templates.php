<?php
return [
    'nextActive' => '<li class="next page-item"><a rel="next" class="page-link" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="next page-item disabled"><a href="" class="page-link" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="prev page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="prev page-item disabled "><a href="" class="page-link" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="first page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'last' => '<li class="last page-item"><a href="{{url}}" class="page-link">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a href="" class="page-link">{{text}}</a></li>',
    'ellipsis' => '<li class="ellipsis">&hellip;</li>',
    'sort' => '<a href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
    'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>'
];
?>