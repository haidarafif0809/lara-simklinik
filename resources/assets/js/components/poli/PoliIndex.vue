<template>  
 <div class="row">
    <div class="col-md-12">
      <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">poli</li>
      </ul>
 
      
         <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                       <i class="material-icons">account_circle</i>
                                </div>
                      <div class="card-content">
                         <h4 class="card-title"> poli </h4>
          
                       <div class="toolbar">
                       <p> <router-link :to="{name: 'createPoli'}" class="btn btn-primary">Tambah Poli</router-link></p>
                         </div>
                  
          <div class="table-responsive material-datatables">
            <table class="table table-striped table-hover ">
              <thead>
                <th>Nama Poli </th>
                <th>Aksi</th>
              </thead>
               <tbody v-if="polis.length" class="data-ada">
                  <tr v-for="poli, index in polis" >

                    <td>{{ poli.nama_poli }}</td>
                    <td> 
                     <router-link :to="{name: 'editPoli', params: {id: poli.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + poli.id" >
                      Edit 
                    </router-link> <a href="#"
                    class="btn btn-xs btn-danger" v-bind:id="'delete-' + poli.id"
                    v-on:click="deleteEntry(poli.id, index,poli.nama_poli)">
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
      polis: [],
      polisData: {},
      pencarian: "",
      url : window.location.origin + "/poli",
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
    app.getPoli();
  },
  methods: {
    getPoli(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'?page='+page)
      .then(function (resp) {
        app.polis = resp.data.data;
        app.polisData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load poli");
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
        app.polis = resp.data.data;
        app.polisData = resp.data;
        app.loading = false    
      })
      .catch(function (resp) {
        alert("Tidak dapat memuat poli..");
        app.loading = false;
      })
    },
    deleteEntry(id, index,judul) {
      if (confirm("Yakin Ingin Menghapus Poli "+judul+" ?")) {
        var app = this;
        axios.delete(app.url+'/' + id)
        .then(function (resp) {
          app.getPoli();
          app.alert("Berhasil Menghapus Poli "+judul)
        })
        .catch(function (resp) {
          alert("Tidak dapat menghapus Poli!");
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