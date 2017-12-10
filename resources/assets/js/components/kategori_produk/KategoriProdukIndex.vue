<template>  
 <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Kategori Produk</li>
      </ul>
 
      
         <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> Kategori Produk </h4>
          
                       <div class="toolbar">
                       <p> <router-link :to="{name: 'createKategoriProduk'}" class="btn btn-primary">Tambah Kategori Produk</router-link></p>
                         </div>
                  
          <div class="table-responsive material-datatables">
            <table class="table table-striped table-hover ">
              <thead>
                <th>Nama Kategori Produk </th>
                <th>Aksi</th>
              </thead>
               <tbody v-if="kategoriProduks.length" class="data-ada">
                  <tr v-for="kategori, index in kategoriProduks" >

                    <td>{{ kategori.nama_kategori }}</td>
                    <td> 
                     <router-link :to="{name: 'editKategoriProduk', params: {id: kategori.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + kategori.id" >
                      Edit 
                    </router-link> <a href="#"
                    class="btn btn-xs btn-danger" v-bind:id="'delete-' + kategori.id"
                    v-on:click="deleteEntry(kategori.id, index,kategori.nama_kategori)">
                    Delete
                  </a></td>


                </tr>
              </tbody>
              <tbody class="data-tidak-ada" v-else>
                <tr ><td colspan="4"  class="text-center">Tidak Ada Data</td></tr>
              </tbody>
            </table>

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
      kategoriProduks: [],
      kategoriProduksData: {},
      pencarian: "",
      url : window.location.origin + "/kategori",
      loading : true
    }
  },
  watch: {
    pencarian: function (newQuestion) {
      this.searchData()
    }
  },
  mounted() {
    var app = this;
    app.getKategoriProduk();
  },
  methods: {
    getKategoriProduk(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'?page='+page)
      .then(function (resp) {
        app.kategoriProduks = resp.data.data;
        app.kategoriProduksData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load Kategori Produk");
        app.loading = false
      });
    },
    searchData(page) {
      var app = this;
      app.loading = true;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'/cari?pencarian='+app.pencarian+'&page='+page)
      .then(function (resp) {
        app.kategoriProduks = resp.data.data;
        app.kategoriProduksData = resp.data;
        app.loading = false    
      })
      .catch(function (resp) {
        alert("Tidak dapat memuat Kategori Produk..");
        app.loading = false;
      })
    },
    deleteEntry(id, index,judul) {
      if (confirm("Yakin Ingin Menghapus Kategori Produk "+judul+" ?")) {
        var app = this;
        axios.delete(app.url+'/' + id)
        .then(function (resp) {
          app.getKategoriProduk();
          app.alert("Berhasil Menghapus Kategori Produk "+judul)
        })
        .catch(function (resp) {
          alert("Tidak dapat menghapus Kategori Produk!");
        });
      }
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