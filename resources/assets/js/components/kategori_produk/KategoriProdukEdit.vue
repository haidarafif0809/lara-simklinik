
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexKategoriProduk'}">Kategori Produk</router-link></li>
                <li class="active">Edit Kategori Produk</li>
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
                            <input class="form-control" required autocomplete="off" placeholder="Nama Kategori Produk" type="text" v-model="kategori.nama_kategori"  autofocus="" name="nama_kategori">
                            <span v-if="errors.nama_kategori" class="label label-danger">{{ errors.nama_kategori[0] }}</span>
                            
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
    mounted() {
        this.getkategori();
    },
    data: function () {
        return {
            kategoriId: null,
            kategori: {
                nama_kategori: '',
            },
            url : window.location.origin+(window.location.pathname)+ "/kategori",
            errors: []
        }
    },
    methods: {
        saveForm() {
            var app = this;
            var newkategori = app.kategori;
            axios.patch(app.url+'/' + app.kategoriId, newkategori)
            .then(function (resp) {
                app.alert();
                app.$router.replace('/kategori-produk/');
            })
            .catch(function (resp) {
                console.log(resp);
                app.errors = resp.response.data.errors;
                alert("Could not create your kategori");
            });
        }
        ,
        alert() {
          this.$swal({
              title: "Berhasil Mengubah kategori!",
              icon: "success",
          });
      },
      getkategori(){
        let app = this;
        let id = app.$route.params.id;
        app.kategoriId = id;

        axios.get(app.url+'/' + id)
        .then(function (resp) {
            app.kategori = resp.data;
        })
        .catch(function () {
            alert("Could not load your kategori")
        });
      }
  }
}
</script>