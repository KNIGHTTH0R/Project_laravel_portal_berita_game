@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ url('/admin/categoris') }}">Categori</a></li>
					<li class="active">Ubah Catrgori</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Ubah Categori</h2>
					</div>
						<div class="panel-body">
						{!! Form::model($categori, ['url' => route('categoris.update', $categori->id),
						'method'=>'put', 'class'=>'form-horizontal']) !!}
						@include('categoris._form')
						{!! Form::close() !!}
						</div>
				</div>
			</div>
		</div>
	</div>
@endsection