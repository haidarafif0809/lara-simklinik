
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexKategoriProduk'}">Kategori Produk</router-link></li>
                <li class="active">Tambah Kategori Produk</li>
            </ul>
            <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                 <i class="material-icons">dns</i>
             </div>
             <div class="card-content">
               <h4 class="card-title"> Kategori Produk </h4>
               <div>
                <form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Nama Kategori Produk</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Nama Kategori Produk" type="text" v-model="kategori.nama_kategori" name="nama_kategori"  autofocus="">
                            <span v-if="errors.nama_kategori" id="nama_kategori_error" class="label label-danger">{{ errors.nama_kategori[0] }}</span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button class="btn btn-primary" id="btnSimpankategori" type="submit"><i class="material-icons">send</i> Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
</template>

<script>
export default {
    data: function () {
        return {
            errors: [],
            url : window.location.origin+(window.location.pathname) +"/kategori",
            kategori: {
                nama_kategori: '',
            },
            message : ''
        }
        
    },
    methods: {
        saveForm() {
            var app = this;
            var newkategori = app.kategori;
            axios.post(app.url, newkategori)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Menambah kategori '+ app.kategori.nama_kategori;
                app.alert(app.message);
                app.kategori.nama_kategori = ''
                app.errors = '';
                app.$router.replace('/kategori-produk/');

            })
            .catch(function (resp) {
                app.success = false;
                app.errors = resp.response.data.errors;
            });
        },
        alert(pesan) {
          this.$swal({
              title: "Berhasil!",
              text: pesan,
              icon: "success",
          });
      }

  }
}
</script>
