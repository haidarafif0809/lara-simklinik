<div class="form-group{{ $errors->has('nama_poli') ? ' has-error' : '' }}">
	{!! Form::label('nama_poli', 'Nama Poli', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_poli', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama Poli']) !!}
		{!! $errors->first('nama_poli', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
