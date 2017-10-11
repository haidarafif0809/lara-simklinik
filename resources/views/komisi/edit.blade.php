@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }} ">Home</a></li>
					<li><a href="{{ url('/komisi') }}">komisi</a></li>
					<li class="active">Edit komisi</li>
				</ul>

		 <div class="card">
			   	   <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> komisi </h4>
                      
						{!! Form::model($komisi, ['url' => route('komisi.update', $komisi->id_komisi), 'method' => 'put', 'class'=>'form-horizontal']) !!}
							@include('komisi._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
@endsection
	