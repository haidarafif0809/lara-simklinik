<template>  
 <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Satuan</li>
      </ul>
 
      
         <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> Satuan </h4>
          
                       <div class="toolbar">
                       <p> <router-link :to="{name: 'createSatuan'}" class="btn btn-primary">Tambah Satuan</router-link></p>
                         </div>
                  
          <div class="table-responsive material-datatables">
            <table class="table table-striped table-hover ">
              <thead>
                <th>Nama Satuan </th>
                <th>Aksi</th>
              </thead>
               <tbody v-if="satuans.length" class="data-ada">
                  <tr v-for="satuan, index in satuans" >

                    <td>{{ satuan.nama_satuan }}</td>
                    <td> 
                     <router-link :to="{name: 'editSatuan', params: {id: satuan.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + satuan.id" >
                      Edit 
                    </router-link> <a href="#"
                    class="btn btn-xs btn-danger" v-bind:id="'delete-' + satuan.id"
                    v-on:click="deleteEntry(satuan.id, index,satuan.nama_satuan)">
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
      satuans: [],
      satuansData: {},
      pencarian: "",
      url : window.location.origin + "/satuan",
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
    app.getSatuan();
  },
  methods: {
    getSatuan(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'?page='+page)
      .then(function (resp) {
        app.satuans = resp.data.data;
        app.satuansData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load satuan");
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
        app.satuans = resp.data.data;
        app.satuansData = resp.data;
        app.loading = false    
      })
      .catch(function (resp) {
        alert("Tidak dapat memuat satuan..");
        app.loading = false;
      })
    },
    deleteEntry(id, index,judul) {
      if (confirm("Yakin Ingin Menghapus satuan "+judul+" ?")) {
        var app = this;
        axios.delete(app.url+'/' + id)
        .then(function (resp) {
          app.getSatuan();
          app.alert("Berhasil Menghapus satuan "+judul)
        })
        .catch(function (resp) {
          alert("Tidak dapat menghapus satuan!");
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