<div class="form-group{{ $errors->has('nama_suplier') ? ' has-error' : '' }}">
	{!! Form::label('nama_suplier', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_suplier', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama ']) !!}
		{!! $errors->first('nama_suplier', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('alamat_suplier') ? ' has-error' : '' }}">
	{!! Form::label('alamat_suplier', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('alamat_suplier', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Alamat']) !!}
		{!! $errors->first('alamat_suplier', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('no_telp_suplier') ? ' has-error' : '' }}">
	{!! Form::label('no_telp_suplier', 'No Telp', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('no_telp_suplier', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'No Telp ']) !!}
		{!! $errors->first('no_telp_suplier', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
