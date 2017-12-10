
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexSuplier'}">Suplier</router-link></li>
                <li class="active">Edit Suplier</li>
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
                            <input class="form-control" required autocomplete="off" placeholder="Nama Suplier" type="text" v-model="suplier.nama_suplier"  autofocus="" name="nama_suplier">
                            <span v-if="errors.nama_suplier" class="label label-danger">{{ errors.nama_suplier[0] }}</span>
                            
                        </div>
                    </div>   
                     <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Alamat Suplier</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Alamat Suplier" type="text" v-model="suplier.alamat_suplier"  autofocus="" name="alamat_suplier">
                            <span v-if="errors.alamat_suplier" class="label label-danger">{{ errors.alamat_suplier[0] }}</span>
                            
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">No Telepon Suplier</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="No Telepon Suplier" type="text" v-model="suplier.no_telp_suplier"  autofocus="" name="no_telp_suplier">
                            <span v-if="errors.no_telp_suplier" class="label label-danger">{{ errors.no_telp_suplier[0] }}</span>
                            
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
    mounted() {
        this.getSuplier();
    },
    data: function () {
        return {
            suplierId: null,
            suplier: {
                nama_suplier: '',
                alamat_suplier: '',
                no_telp_suplier: '',
            },
            url : window.location.origin+(window.location.pathname)+ "/suplier",
            errors: []
        }
    },
    methods: {
        saveForm() {
            var app = this;
            var newsuplier = app.suplier;
            axios.patch(app.url+'/' + app.suplierId, newsuplier)
            .then(function (resp) {
                app.alert();
                app.$router.replace('/suplier/');
            })
            .catch(function (resp) {
                console.log(resp);
                app.errors = resp.response.data.errors;
                alert("Could not create your suplier");
            });
        }
        ,
        alert() {
          this.$swal({
              title: "Berhasil Mengubah suplier!",
              icon: "success",
          });
      },
      getSuplier(){
        let app = this;
        let id = app.$route.params.id;
        app.suplierId = id;

        axios.get(app.url+'/' + id)
        .then(function (resp) {
            app.suplier = resp.data;
        })
        .catch(function () {
            alert("Could not load your suplier")
        });
      }
  }
}
</script>