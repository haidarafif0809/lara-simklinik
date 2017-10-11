<div class="form-group{{ $errors->has('produk') ? ' has-error' : '' }}">
	{!! Form::label('produk', 'Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('produk', [''=>'']+App\Produk::pluck('nama_produk','id')->all(),null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => ' Produk']) !!}
		{!! $errors->first('produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('petugas') ? ' has-error' : '' }}">
	{!! Form::label('petugas', 'Petugas ', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('petugas', 
		[''=>'']+App\User::pluck('name','id')->all(),
		null, ['class'=>'form-control js-selectize-reguler', 'placeholder' => 'Petugas','id'=>'pilih_petugas_barang']) !!}
		{!! $errors->first('petugas', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('prosentase') ? ' has-error' : '' }}">
	{!! Form::label('prosentase', 'Prosentase', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('prosentase', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Prosentase']) !!}
		{!! $errors->first('prosentase', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
	{!! Form::label('nominal', 'Nominal', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nominal', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nominal']) !!}
		{!! $errors->first('nominal', '<p class="help-block">:message</p>') !!}
	</div>
</div>




<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
