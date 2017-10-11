@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/poli') }}">poli</a></li>
					<li class="active">Edit poli</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> poli </h4>
                      
						{!! Form::model($poli, ['url' => route('poli.update', $poli->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('poli._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	