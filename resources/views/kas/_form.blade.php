
<div class="form-group{{ $errors->has('kode_kas') ? ' has-error' : '' }}">
	{!! Form::label('kode_kas', 'Kode', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('kode_kas', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Kode ']) !!}
		{!! $errors->first('kode_kas', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('nama_kas') ? ' has-error' : '' }}">
	{!! Form::label('nama_kas', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_kas', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama ']) !!}
		{!! $errors->first('nama_kas', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
