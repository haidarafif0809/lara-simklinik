@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/penjamin') }}">penjamin</a></li>
					<li class="active">Edit penjamin</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> penjamin </h4>
                      
						{!! Form::model($penjamin, ['url' => route('penjamin.update', $penjamin->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('penjamin._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	