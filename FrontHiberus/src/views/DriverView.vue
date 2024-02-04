<template>
<NavbarView></NavbarView>
<form>
  <div class="row">
    <div class="col-md-4 mb-3">
      <label>Nombre</label>
      <input type="text" class="form-control" 
      v-model="form.name"
      placeholder="Nombre" required>
    </div>
    <div class="col-md-4 mb-3">
      <label>Apellido</label>
      <input type="text" class="form-control" 
      v-model="form.surname"
      placeholder="Apellido" required>
    </div>
    <div class="col-md-4 mb-3">
      <label>Licencia</label>
      <input type="text" class="form-control" 
      v-model="form.license"
      placeholder="Licencia" required>
    </div>
  </div>
  <div>
    <button type="button"  @click.prevent="saveDriver()" class="btn btn-outline-primary">Guardar</button>
    <button type="button" @click.prevent="cleanData()" class="btn btn-outline-info">Nuevo</button>
  </div>
</form>
<ListDriverComponent :refresh_data="refresh_data_child" @setDatainputParent="setDatainput" :is_report="false"></ListDriverComponent>
</template>

<script>
import NavbarView from "@/views/Layouts/NavbarView.vue";
import ListDriverComponent from "@/components/ListDriverComponent.vue";
import axios from "axios";
  // * @author Jordan Rodriguez
  // * constante que contine la instacia creada para peticiones http
const axiosInstance = axios.create({
  headers: {
    "Access-Control-Allow-Origin": "*",
    "Content-Type": "	application/json"
  }
});
export default {
  name: "Driver",
  components: {
    NavbarView,
    ListDriverComponent
  },
  data: () => ({
    form: {
      id  :     null,
      name:     null,
      surname:  null,
      license:  null
    },
    selected:0,
    refresh_data_child: false,
    category:[]
  }),
  created() {

  },
  methods: {
    setDatainput(data) {
      this.form.id=data.id
      this.form.name=data.name
      this.form.surname=data.surname
      this.form.license=data.license
    },
    cleanData(){
      this.form.name=null
      this.form.surname=null
      this.form.license=null
    },
    saveDriver(){
      if (this.form.name === null || (this.form.surname).length==0 ) {
        alert("Ingrese Codigo")
        return
      }
      if (this.form.surname === null || (this.form.surname).length==0 ) {
        alert("Ingrese Nombre")
        return
      }
      if (this.form.license === null || (this.form.license).length==0 ) {
        alert("Ingrese Nombre")
        return
      }
      if (this.form.id===null || this.form.id===0) {
        this.postSaveDriver();
      }else{
        this.updateModifyDriver();
        this.form.id=null
      }
    },
    postSaveDriver() {
      this.form.category_id= this.selected;
      this.refresh_data_child=false
      axiosInstance.post(import.meta.env.VITE_API_URL+"drivers",this.form).then((response) => {
        this.refresh_data_child=true
        alert(response.data.message);
        this.cleanData();
      }).catch((error) =>{
        this.refresh_data_child=false;
      });
    },
    updateModifyDriver() {
      this.form.category_id= this.selected;
      this.refresh_data_child=false
      axiosInstance.put(import.meta.env.VITE_API_URL+"drivers/"+ this.form.id,this.form).then((response) => {
        this.refresh_data_child=true
        alert(response.data.message);
        this.cleanData();
      }).catch((error) =>{
        console.log(error);
        this.refresh_data_child=false;
      });
    }
  }
}
</script>
