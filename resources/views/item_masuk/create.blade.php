@extends('layouts.app')

@section('content')


  

<!-- MODAL TOMBOL SELESAI -->
  <div class="modal" id="modal_selesai" role="dialog" data-backdrop="">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
				  <div class="alert-icon">
					<i class="material-icons">info_outline</i> <b>Anda Yakin Ingin Menyelesaikan Transaksi Ini ?</b>
				</div>
		</h4>
        </div>

        {!! Form::open(['url' => route('item-masuk.store'),'method' => 'post', 'class'=>'form-horizontal']) !!}
	        <div class="modal-body">
	        	<textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" rows="5"></textarea>
	        </div>
	        <div class="modal-footer"> 
	    		<button type="submit"  id="btn-simpan-item-masuk" class="btn btn-success"><i class="material-icons">save</i> Simpan</button>
	    		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
	        </div>
	    {!! Form::close() !!}
      </div>
      
    </div>
  </div>
<!-- / MODAL TOMBOL SELESAI -->

	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }} ">Home</a></li>
				<li style="color: purple">Persediaan</li>
				<li><a href="{{ url('/item-masuk') }}">Item Masuk</a></li>
				<li class="active">Tambah Item Masuk</li>
			</ul>

			<div class="card">
			   	<div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                  <div class="card-content">
                         <h4 class="card-title"> Item Masuk </h4>
					<div class="row">
						
						<div class="col-md-7">

					{!! Form::open(['url' => route('item-masuk.proses_tambah_tbs_item_masuk'),'method' => 'post', 'class'=>'form-inline','id' => 'form-produk']) !!}
	          <div class="form-group {{ $errors->has('id_produk') ? ' has-error' : '' }}">
				
				
						{!! Form::select('id_produk', []+App\Produk::where('status_aktif',1)->select([DB::raw('CONCAT(kode_produk, " - ", nama_produk) AS data_produk'),'id'])->pluck('data_produk','id')->all(), null, ['class'=>'', 'placeholder' => '-- PILIH PRODUK --', 'id'=>'pilih_produk','autofocus' => 'true']) !!}
						{!! $errors->first('id_produk', '<p class="help-block">:message</p>') !!}
				
				</div>

						{!! Form::hidden('jumlah_produk', null, ['class'=>'form-control','placeholder'=>'Jumlah Produk','required','autocomplete'=>'off', 'id'=>'jumlah_produk']) !!}
						{!! $errors->first('jumlah_produk', '<p class="help-block" id="eror_jumlah_produk">:message</p>') !!}
					
				 <button type="submit" class="btn btn-success" id="btn-submit-produk"><i class="material-icons">done</i> Submit Produk</button>
		 {!! Form::close() !!} 
        				</div> 
        				<!-- / col md 7 -->
        				<div class="col-md-2"></div>
						<div class="col-md-3">
							<!-- TOMBOL BATAL -->
							{!! Form::open(['url' => route('item-masuk.proses_hapus_semua_tbs_item_masuk'),'method' => 'post', 'class' => 'form-group js-confirm', 'data-confirm' => 'Apakah Anda Ingin Membatalkan Item masuk ?']) !!} 						       		
						    <!--- TOMBOL SELESAI -->
						       	<button type="button" class="btn btn-primary" id="btnSelesai" data-toggle="modal" data-target="#modal_selesai"><i class="material-icons">send</i> Selesai (F8)</button>

						       	<button type="submit" class="btn btn-danger" id="btnBatal"><i class="material-icons">cancel</i> Batal (F10)</button>

							{!! Form::close() !!}
						</div>

					<!--TOMBOL SELESAI & BATAL -->
						<div class="col-md-4">
								<div class="form-group col-md-3">
					       			 
					       			  	
								</div>
								<div class="form-group col-md-2">												       			   
					       			
								</div>										
						</div>

					</div>
					<!--TABEL TBS ITEM 	MASUK -->
					<div class="table-responsive">
			         {!! $html->table(['class'=>'table-striped table']) !!} 
					</div>
				</div><!-- / PANEL BODY -->

			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! $html->scripts() !!}

	<script type="text/javascript">
		$(document).ready(function(){


    	// initialize the Selectize control
		var $select = $('#pilih_produk').selectize({
						 sortField: 'text'
						});
		// fetch the instance
		 $select[0].selectize.focus();
		
		$("#form-produk").submit(function(){

		 	var produk = $("#pilih_produk").val();
		 	var jumlah = $("#jumlah_produk").val();
		 	if (produk == "") {
		 		swal('Oops...','Produk Harus Dipilih Dahulu !','error')

		 		return false;

		 	}
		 	else if(jumlah == ""){



		 		swal({
				  title: 'Jumlah Produk',
				  input: 'number',
				  inputPlaceholder : 'Jumlah Produk',
				
				  type: 'question',
				  html:'Berapa Jumlah Yang akan di Masukkan?',
				  animation: false,
				  showCloseButton: true,
				  showCancelButton: true,
				  focusConfirm: true,
				  confirmButtonText:
				    '<i class="fa fa-thumbs-up"></i> Submit',
				  confirmButtonAriaLabel: 'Thumbs up, great!',
				  cancelButtonText:
				  'Batal',
				  closeOnConfirm: true,

				  cancelButtonAriaLabel: 'Thumbs down',
				    inputValidator : function (value) {
				    return new Promise(function (resolve, reject) {
				      if (value) {
				        resolve()
				      } else {

				        reject('Jumlah Harus Di isi!')
				        
				      }
				    })
				  }
				}).then(function (jumlah) {

					if (jumlah != "0")  {
						$("#jumlah_produk").val(jumlah);

						$("#form-produk").submit();
					}
					else {
						swal(
						  'Oops...',
						  'Jumlah Tidak Boleh 0 !',
						  'error'
						)

						return false;
					}
					
				}); //end swal jumlah 

				return false;
		 	}
		 	//jika produk dan jumlah sudah di isi maka form di submit
		 	else if (jumlah != "" && produk != ""){
		 		return true;
		 	}
		 	
		 }); 
		 // end btn submit produk click

		});
	</script>

	<script type="text/javascript">
	// Konfirmasi Penghapusan
		$(document.body).on('submit', '.js-confirm', function () {
			var $btnHapus = $(this)
			var text = $btnHapus.data('confirm') ? $btnHapus.data('confirm') : 'Anda yakin melakukan tindakan ini ?'
			var pesan_konfirmasi = confirm(text);
			return pesan_konfirmasi;
		});  
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			var pesan_error = $("#eror_jumlah_produk").text();

			if (pesan_error != "") {				
				$("#modal_produk").modal('show');
				$("#jumlah_produk").focus();
			}
			else{
				$("#modal_produk").modal('hide');
			}
		});	
	</script>


 	<script type="text/javascript">
 	//TOMBOL CARI
 	shortcut.add("f1", function() {
        $("#cari_produk").click();
    })
    
 	//TOMBOL SUBMIT BARCODE
 	shortcut.add("f2", function() {
        $("#btnBarcode").click();
    })
    
 	//TOMBOL SELESAI
 	shortcut.add("f8", function() {
        $("#btnSelesai").click();
    })
    
 	//TOMBOL BATAL
 	shortcut.add("f10", function() {
        $("#btnBatal").click();
    })
 	</script>
<!-- js untuk tombol shortcut -->
@endsection