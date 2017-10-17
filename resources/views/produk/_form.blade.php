<div class="form-group{{ $errors->has('kode_produk') ? ' has-error' : '' }}">
	{!! Form::label('kode_produk', 'Kode Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('kode_produk', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Kode Produk ']) !!}
		{!! $errors->first('kode_produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('nama_produk') ? ' has-error' : '' }}">
	{!! Form::label('nama_produk', 'Nama Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama_produk', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama Produk ']) !!}
		{!! $errors->first('nama_produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('tipe_produk') ? ' has-error' : '' }}">
	{!! Form::label('tipe_produk', 'Tipe Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">

		@if(isset($produk))
		{!! Form::select('tipe_produk', ['1' => 'Barang','2' => 'Jasa' ],$produk->tipe_produk, ['class'=>' js-selectize-reguler', 'placeholder' => 'Tipe Produk']) !!}

		@else 
			{!! Form::select('tipe_produk', ['1' => 'Barang','2' => 'Jasa' ],null, ['class'=>' js-selectize-reguler', 'placeholder' => 'Tipe Produk']) !!}

		@endif
		{!! $errors->first('tipe_produk', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('satuan') ? ' has-error' : '' }}">
	{!! Form::label('satuan', 'Satuan ', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('satuan', 
		[''=>'']+App\Satuan::pluck('nama_satuan','id')->all(),
		null, ['class'=>' js-selectize-reguler', 'placeholder' => 'Silahkan Pilih','id'=>'pilih_satuan_barang']) !!}
		{!! $errors->first('satuan', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
	{!! Form::label('kategori', 'Kategori Produk', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('kategori', 
		[''=>'']+App\KategoriProduk::pluck('nama_kategori','id')->all(),
		null, ['class'=>'js-selectize-reguler', 'placeholder' => 'Silahkan Pilih','id'=>'pilih_kategori_barang']) !!}
		{!! $errors->first('kategori', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('harga_beli') ? ' has-error' : '' }}">
	{!! Form::label('harga_beli', 'Harga Beli', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_beli', null, ['class'=>'form-control','autocomplete'=>'off', 'placeholder' => 'Harga Beli ']) !!}
		{!! $errors->first('harga_beli', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('harga_jual_1') ? ' has-error' : '' }}">
	{!! Form::label('harga_jual_1', 'Harga Jual 1', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_jual_1', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Harga Jual 1 ']) !!}
		{!! $errors->first('harga_jual_1', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('harga_jual_2') ? ' has-error' : '' }}">
	{!! Form::label('harga_jual_2', 'Harga Jual 2', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_jual_2', null, ['class'=>'form-control','autocomplete'=>'off', 'placeholder' => 'Harga Jual 2 ']) !!}
		{!! $errors->first('harga_jual_2', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('harga_jual_3') ? ' has-error' : '' }}">
	{!! Form::label('harga_jual_3', 'Harga Jual 3', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga_jual_3', null, ['class'=>'form-control','autocomplete'=>'off', 'placeholder' => 'Harga Jual 3 ']) !!}
		{!! $errors->first('harga_jual_3', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('status_aktif') ? ' has-error' : '' }}">
	{!! Form::label('status_aktif', 'Status Aktif', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::select('status_aktif', ['1' => 'Aktif','0' => 'Tidak Aktif' ],null, ['class'=>'js-selectize-reguler', 'placeholder' => 'Status Aktif']) !!}
		{!! $errors->first('status_aktif', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('over_stok') ? ' has-error' : '' }}">
	{!! Form::label('over_stok', 'Over Stok', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('over_stok', null, ['class'=>'form-control','autocomplete'=>'off', 'placeholder' => 'Over Stok ']) !!}
		{!! $errors->first('over_stok', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group{{ $errors->has('limit_stok') ? ' has-error' : '' }}">
	{!! Form::label('limit_stok', 'Limit Stok', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('limit_stok', null, ['class'=>'form-control','autocomplete'=>'off', 'placeholder' => 'Limit Stok ']) !!}
		{!! $errors->first('limit_stok', '<p class="help-block">:message</p>') !!}
	</div>
</div>





<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::button('<i class="material-icons">save</i>Simpan', ['class'=>'btn btn-primary','type'=>'submit']) !!}

	</div>
</div>
