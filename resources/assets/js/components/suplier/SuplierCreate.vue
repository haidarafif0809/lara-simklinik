
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexSuplier'}">Suplier</router-link></li>
                <li class="active">Tambah Suplier</li>
            </ul>
            <div class="card">
             <div class="card-header card-header-icon" data-background-color="purple">
                 <i class="material-icons">dns</i>
             </div>
             <div class="card-content">
               <h4 class="card-title"> Suplier </h4>
               <div>
                <form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Nama Suplier</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Nama Suplier" type="text" v-model="suplier.nama_suplier" name="nama_suplier"  autofocus="">
                            <span v-if="errors.nama_suplier" id="nama_suplier_error" class="label label-danger">{{ errors.nama_suplier[0] }}</span>
                            
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Alamat Suplier</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Alamat Suplier" type="text" v-model="suplier.alamat_suplier" name="alamat_suplier"  autofocus="">
                            <span v-if="errors.alamat_suplier" id="alamat_suplier_error" class="label label-danger">{{ errors.alamat_suplier[0] }}</span>
                            
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">No Telepon Suplier</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="No Telepon Suplier" type="text" v-model="suplier.no_telp_suplier" name="no_telp_suplier"  autofocus="">
                            <span v-if="errors.no_telp_suplier" id="no_telp_suplier_error" class="label label-danger">{{ errors.no_telp_suplier[0] }}</span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button class="btn btn-primary" id="btnSimpansuplier" type="submit"><i class="material-icons">send</i> Submit</button>
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
            url : window.location.origin+(window.location.pathname) +"/suplier",
            suplier: {
                nama_suplier: '',
            },
            message : ''
        }
        
    },
    methods: {
        saveForm() {
            var app = this;
            var newsuplier = app.suplier;
            axios.post(app.url, newsuplier)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Menambah suplier '+ app.suplier.nama_suplier;
                app.alert(app.message);
                app.suplier.nama_suplier = ''
                app.errors = '';
                app.$router.replace('/suplier/');

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
