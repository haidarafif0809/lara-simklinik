<style scoped>
.pencarian {
  color: red;
 
  float: right;
  padding-bottom: 10px;
}
</style>

<template>  
 <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Supplier</li>
      </ul>
 
      
         <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> Supplier </h4>
          
                       <div class="toolbar">
                       <p> <router-link :to="{name: 'createSuplier'}" class="btn btn-primary">Tambah Supplier</router-link>
                       </p>

                         </div>
                             
                  
          <div class="table-responsive material-datatables">
            <table class="table table-striped table-hover ">
              <thead>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Aksi</th>
              </thead>
               <tbody v-if="suppliers.length" class="data-ada">
                  <tr v-for="suplier, index in suppliers" >

                    <td>{{ suplier.nama_suplier }}</td>
                    <td>{{ suplier.alamat_suplier }}</td>
                    <td>{{ suplier.no_telp_suplier }}</td>
                    <td> 
                     <router-link :to="{name: 'editSuplier', params: {id: suplier.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + suplier.id" >
                      Edit 
                    </router-link> <a href="#"
                    class="btn btn-xs btn-danger" v-bind:id="'delete-' + suplier.id"
                    v-on:click="deleteEntry(suplier.id, index,suplier.nama_suplier)">
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
      suppliers: [],
      suppliersData: {},
      pencarian: "",
      url : window.location.origin + "/suplier",
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
    app.getSupplier();
  },
  methods: {
    getSupplier(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'?page='+page)
      .then(function (resp) {
        app.suppliers = resp.data.data;
        app.suppliersData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load suplier");
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
        app.suppliers = resp.data.data;
        app.suppliersData = resp.data;
        app.loading = false    
      })
      .catch(function (resp) {
        alert("Tidak dapat memuat supplier..");
        app.loading = false;
      })
    },
    deleteEntry(id, index,judul) {
      if (confirm("Yakin Ingin Menghapus supplier "+judul+" ?")) {
        var app = this;
        axios.delete(app.url+'/' + id)
        .then(function (resp) {
          app.getSupplier();
          app.alert("Berhasil Menghapus supplier "+judul)
        })
        .catch(function (resp) {
          alert("Tidak dapat menghapus supplier!");
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