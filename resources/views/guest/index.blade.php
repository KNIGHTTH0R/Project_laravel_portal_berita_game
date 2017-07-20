@extends('layouts.app')

@section('content')
@include('layouts.slide') 
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel" style="background-color: rgba(255,255,255,0.9);">
					<div class="panel-heading">
						<h2 class="panel-title">Daftar Categori</h2>
					</div>
					<div class="panel-body">
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