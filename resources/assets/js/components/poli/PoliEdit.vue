
<template>
    <div class="row" >
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href=" ">Home</a></li>
                <li><router-link :to="{name: 'indexPoli'}">Poli</router-link></li>
                <li class="active">Edit Poli</li>
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
                            <input class="form-control" required autocomplete="off" placeholder="Nama Poli" type="text" v-model="poli.nama_poli"  autofocus="" name="nama_poli">
                            <span v-if="errors.nama_poli" class="label label-danger">{{ errors.nama_poli[0] }}</span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <button class="btn btn-primary" id="btnSimpanpoli" type="submit"><i class="material-icons">send</i> Submit</button>
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
        this.getPoli();
    },
    data: function () {
        return {
            poliId: null,
            poli: {
                nama_poli: '',
            },
            url : window.location.origin+(window.location.pathname)+ "/poli",
            errors: []
        }
    },
    methods: {
        saveForm() {
            var app = this;
            var newpoli = app.poli;
            axios.patch(app.url+'/' + app.poliId, newpoli)
            .then(function (resp) {
                app.alert();
                app.$router.replace('/poli/');
            })
            .catch(function (resp) {
                console.log(resp);
                app.errors = resp.response.data.errors;
                alert("Could not create your poli");
            });
        }
        ,
        alert() {
          this.$swal({
              title: "Berhasil Mengubah poli!",
              icon: "success",
          });
      },
      getPoli(){
        let app = this;
        let id = app.$route.params.id;
        app.poliId = id;

        axios.get(app.url+'/' + id)
        .then(function (resp) {
            app.poli = resp.data;
        })
        .catch(function () {
            alert("Could not load your poli")
        });
      }
  }
}
</script>