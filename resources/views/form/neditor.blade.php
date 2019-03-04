<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="ssi_ueditor_{{ $id }}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">

        @include('admin::form.error')

        <textarea class="{{ $class }}" id="ssi_ueditor_{{ $id }}" name="{{$name}}" placeholder="{{ $placeholder }}" {!! $attributes !!} >
        {{ old($column, $value) }}
        </textarea>
        @include('admin::form.help-block')

    </div>
</div>