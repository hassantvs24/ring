<div class="input-group mb-15">
    @if(isset($addon))
        <span class="input-group-addon">{{$addon}}</span>
    @endif
        <select id="{{$id ?? ''}}" name="{{$name ?? ''}}" class="form-control {{$class ?? ''}}"  {{$rest ?? ''}} @if($required == 'required') required @endif >
            {{$slot}}
        </select>
    @if(isset($btn))
        <span class="input-group-btn">
            {{$btn}}
        </span>
    @endif
</div>
@error($name)
<span class="help-block">{{ $message }}</span>
@enderror