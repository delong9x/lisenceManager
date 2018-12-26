
@if ($option->type == 'text')
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">{{$option->label}}</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has($option->key) ? 'has-error' : '' }}">
                <input type="text" name="{{$option->key}}" class="form-control" value="{{$option->value}}">
            </div>
            @if ($errors->has($option->key))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first($option->key) }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
@endif

@if ($option->type == 'boolean')
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">{{$option->label}}</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has($option->key) ? 'has-error' : '' }}">
                <label class="ratio-btn">
                    <input type="radio" name="{{$option->key}}" @if($option->value == '1') checked @endif value="1">
                    <span>Có</span>
                </label>
                <label class="ratio-btn">
                    <input type="radio" name="{{$option->key}}" @if($option->value == '0') checked @endif value="0">
                    <span>Không</span>
                </label>
            </div>
            @if ($errors->has($option->key))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first($option->key) }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
@endif
