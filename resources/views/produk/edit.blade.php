@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/produk') }}">produk</a></li>
					<li class="active">Edit produk</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> produk </h4>
                      
						{!! Form::model($produk, ['url' => route('produk.update', $produk->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('produk._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	