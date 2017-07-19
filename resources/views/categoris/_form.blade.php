<div class="form-group{{$errors->has('categori')?'has-error':''}}">
	{!! Form::label('categori','Categori',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('categori',null,['class'=>'form-control']) !!}
		{!! $errors->first('categori','<p class="help-block">message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="fa fa-save"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'] )  !!}
	</div>
</div>