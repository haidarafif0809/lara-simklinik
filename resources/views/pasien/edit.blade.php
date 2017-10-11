@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/pasien') }}">pasien</a></li>
					<li class="active">Edit pasien</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> pasien </h4>
                      
						{!! Form::model($pasien, ['url' => route('pasien.update', $pasien->id), 'method' => 'put', 'files'=>'true','class'=>'form-horizontal']) !!}
							@include('pasien._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	