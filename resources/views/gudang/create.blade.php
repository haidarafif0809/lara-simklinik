@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }} ">Home</a></li>
				<li><a href="{{ url('/gudang') }}">gudang</a></li>
				<li class="active">Tambah gudang</li>
			</ul>
			  <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                   </div>
                      <div class="card-content">
                         <h4 class="card-title"> gudang </h4>
                      
					{!! Form::open(['url' => route('gudang.store'),'method' => 'post', 'class'=>'form-horizontal']) !!}
						@include('gudang._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection
