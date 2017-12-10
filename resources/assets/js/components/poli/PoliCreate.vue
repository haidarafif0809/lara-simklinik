
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexPoli'}">Poli</router-link></li>
                <li class="active">Tambah Poli</li>
            </ul>
            <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                 <i class="material-icons">dns</i>
             </div>
             <div class="card-content">
               <h4 class="card-title"> Poli </h4>
               <div>
                <form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Nama Poli</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Nama Poli" type="text" v-model="poli.nama_poli" name="nama_poli"  autofocus="">
                            <span v-if="errors.nama_poli" id="nama_poli_error" class="label label-danger">{{ errors.nama_poli[0] }}</span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button class="btn btn-primary" id="btnSimpanPoli" type="submit"><i class="material-icons">send</i> Submit</button>
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
            url : window.location.origin+(window.location.pathname) +"/poli",
            poli: {
                nama_poli: '',
            },
            message : ''
        }
        
    },
    methods: {
        saveForm() {
            var app = this;
            var newpoli = app.poli;
            axios.post(app.url, newpoli)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Menambah poli '+ app.poli.nama_poli;
                app.alert(app.message);
                app.poli.nama_poli = ''
                app.errors = '';
                app.$router.replace('/poli/');

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
