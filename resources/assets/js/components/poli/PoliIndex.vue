<template>  
  <div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
      <p> <router-link :to="{name: 'createAnime'}" class="btn btn-primary">Tambah Anime</router-link></p>
      <div class="table table-responsive">
        <div class="pencarian">
          <input class="efek" type="text" name="pencarian" v-model="pencarian" placeholder="Pencarian..">
        </div>
        <table class="table table-striped">
          <thead>
            <th>Judul Anime</th>
            <th>Genre</th>
            <th>Waktu</th>
            <th>Aksi</th>
          </thead>
          <tbody v-if="animes.length > 0 && loading == false" class="data-ada">
            <tr v-for="anime, index in animes">
              <td>{{anime.judul}}</td>
              <td>{{anime.genre}}</td>
              <td>{{anime.created_at}}</td>
              <td><router-link :to="{name: 'editAnime', params: {id: anime.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + anime.id" >
                Edit 
              </router-link> 
              <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + anime.id" v-on:click="deleteEntry(anime.id, index,anime.judul)">
                Hapus
              </a></td>
            </tr>
          </tbody>

          <tbody v-else class="data-tidak-ada">
            <tr>
              <td colspan="2" class="text-center">Tidak Ada Data</td>
            </tr>
          </tbody>
        </table>
      </div>

      <vue-simple-spinner v-if="loading"></vue-simple-spinner>
      <div align="right">
        <pagination :data="animesData" v-on:pagination-change-page="getAnimes"></pagination>
      </div>

    </div>
  </div>
</template>


<script>
export default {
  data: function () {
    return {
      animes: [],
      animesData: {},
      pencarian: "",
      url : window.location.origin + (window.location.pathname).replace("home", "anime"),
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
    app.getAnimes();
  },
  methods: {
    getAnimes(page) {
      var app = this;
      if (typeof page === 'undefined') {
        page = 1;
      }

      axios.get(app.url+'/view?page='+page)
      .then(function (resp) {
        app.animes = resp.data.data;
        app.animesData = resp.data;
        app.loading = false;
      })
      .catch(function (resp) {
        alert("Could not load satuans");
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
        app.animes = resp.data.data;
        app.animesData = resp.data;
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
          app.getAnimes();
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