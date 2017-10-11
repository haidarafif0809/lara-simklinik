<div class="form-group{{ $errors->has('nama_penjamin') ? ' has-error' : '' }}">
	{!! Form::label('nama_penjamin', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_penjamin', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama ']) !!}
		{!! $errors->first('nama_penjamin', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('alamat_penjamin') ? ' has-error' : '' }}">
	{!! Form::label('alamat_penjamin', 'Alamat_penjamin', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('alamat_penjamin', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Alamat ']) !!}
		{!! $errors->first('alamat_penjamin', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('no_telp_penjamin') ? ' has-error' : '' }}">
	{!! Form::label('no_telp_penjamin', 'No Telp', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('no_telp_penjamin', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'No Telp ']) !!}
		{!! $errors->first('no_telp_penjamin', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('level_harga') ? ' has-error' : '' }}">
	{!! Form::label('level_harga', 'Level Harga', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('level_harga', ['1' => 'Level 1','2' => 'Level 2' ,'3' => 'Level 3'],null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => 'Pilih Level Harga']) !!}
		{!! $errors->first('level_harga', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
