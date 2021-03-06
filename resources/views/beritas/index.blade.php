@extends('layouts.app')

@section('content')

	<div class="container" >
		<div class="row">
			<div class="col-md-12" >
				<ul class="breadcrumb"> 
				<li> <a href="{{url('/home')}}">Dashboard</a> </li>
				<li class="active"> Berita </li>
				</ul>
				<div class="panel" style="background-color: rgba(255,255,255,0.9);">
					<div class="panel-heading">
						<h2 class="panel-title">Berita</h2>
					</div>
					<div class="panel-body">
					<p><a class="btn btn-primary" href="{{url('admin/beritas/create')}}">
					<i class="fa fa-btn fa-plus-circle"></i> Tambah</a></p>
					{!! $html->table(['class'=>'table-striped']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
 	{!! $html->scripts() !!}
 @endsection