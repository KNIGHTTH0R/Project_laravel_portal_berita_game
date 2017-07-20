<div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
	{!! Form::label('judul', 'Judul', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('judul', null, ['class'=>'form-control']) !!}
		{!! $errors->first('judul', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('categori_id') ? ' has-error' : '' }}">
	{!! Form::label('categori_id', 'Categori', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('categori_id',[''=>'']+App\Categori::pluck('categori','id')->all(), null,['class'=>'form-control'])  !!}
		{!! $errors->first('categori_id', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
	{!! Form::label('deskripsi', 'Deskripsi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::textarea('deskripsi', null, ['class'=>'form-control']) !!}
		{!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
		<!-- @if (isset($book))
		<p class="help-block">{{$book->borrowed}}Buku sedang Dipinjam</p>
		@endif -->
	</div>
</div>

<div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
	{!! Form::label('cover','Cover',['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('cover',['class'=>'btn btn-default']) !!}

		@if(isset($berita) && $berita->cover)
		<p>
        {!! Html::image(asset('img/'.$book->cover.''),null,['class'=>'img-rounded img-responsive'])!!}
		</p>
		@endif


		{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		
		{!! Form::button('<i class="fa fa-save"></i> Simpan', ['type' => 'submit', 'class' => 'btn btn-primary btn-sm'] )  !!}
	</div>
</div>
