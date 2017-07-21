@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li> <a href="{{url('/home')}}"> Dashboard </a> </li>
					<li> <a href="{{url('/admin/beritas')}}">berita</a> </li>
					<li class="active">Detail {{ $berita->judul }}</li>
				</ul>

				<div class="panel" style="background-color: rgba(255,255,255,0.9);" >
					<div class="panel-heading">
						<h2 class="panel-title">Detail {{ $berita->judul }}</h2>
						<div class="panel-body">
							<center> <h1> {{ $berita->judul }} </h1> </center> <br>
							@if(isset($berita) && $berita->cover)
							<p>
					        {!! Html::image(asset('img/'.$berita->cover.''),null,['class'=>'img-rounded img-responsive'])!!}
							</p>
							@endif <br>
							<p> {{ $berita->deskripsi }} </p>
						</div>
					</div>
			  	</div>
			</div>
		</div>
	</div>
@endsection
