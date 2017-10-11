<div class="form-group{{ $errors->has('nama_pasien') ? ' has-error' : '' }}">
	{!! Form::label('nama_pasien', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_pasien', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama ']) !!}
		{!! $errors->first('nama_pasien', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('no_telp_pasien') ? ' has-error' : '' }}">
	{!! Form::label('no_telp_pasien', 'No Telp', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('no_telp_pasien', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'No Telp']) !!}
		{!! $errors->first('no_telp_pasien', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('alamat_pasien') ? ' has-error' : '' }}">
	{!! Form::label('alamat_pasien', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('alamat_pasien', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Alamat']) !!}
		{!! $errors->first('alamat_pasien', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
	{!! Form::label('jenis_kelamin', 'Jenis Kelamin', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('jenis_kelamin', ['laki-laki' => 'laki-laki','perempuan' => 'perempuan'],null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => 'Pilih Jenis Kelamin']) !!}
		{!! $errors->first('jenis_kelamin', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
