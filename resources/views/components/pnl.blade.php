<div class="panel panel-flat {{$class ?? ''}}">
    @if(isset($name))
        <div class="panel-heading">
            <h5 class="panel-title">{{ $name ?? '' }}</h5>
        </div>
    @endif

    <div class="panel-body">
        {{$slot}}
    </div>
</div>