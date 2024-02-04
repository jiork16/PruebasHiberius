<template>
  <NavbarView></NavbarView>
  <form>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label>Marca</label>
        <input type="text" class="form-control" 
        v-model="form.brand"
        placeholder="Nombre" required>
      </div>
      <div class="col-md-4 mb-3">
        <label>Modelo</label>
        <input type="text" class="form-control" 
        v-model="form.model"
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
      <button type="button"  @click.prevent="saveVehicle()" class="btn btn-outline-primary">Guardar</button>
      <button type="button" @click.prevent="cleanData()" class="btn btn-outline-info">Nuevo</button>
    </div>
  </form>
  <ListVehicleComponent :refresh_data="refresh_data_child" @setDatainputParent="setDatainput" :is_report="false"></ListVehicleComponent>
  </template>
  
  <script>
  import NavbarView from "@/views/Layouts/NavbarView.vue";
  import ListVehicleComponent from "@/components/ListVehicleComponent.vue";
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
    name: "Vehicle",
    components: {
      NavbarView,
      ListVehicleComponent
    },
    data: () => ({
      form: {
        id  :     null,
        name:     null,
        surname:  null,
        license:  null
      },
      refresh_data_child: false
    }),
    created() {
  
    },
    methods: {
      setDatainput(data) {
        this.form.id=data.id
        this.form.brand=data.brand
        this.form.model=data.model
        this.form.license=data.license
      },
      cleanData(){
        this.form.brand=null
        this.form.model=null
        this.form.license=null
      },
      saveVehicle(){
        if (this.form.brand === null || (this.form.brand).length==0 ) {
          alert("Ingrese Marca")
          return
        }
        if (this.form.model === null || (this.form.model).length==0 ) {
          alert("Ingrese Modelo")
          return
        }
        if (this.form.license === null || (this.form.license).length==0 ) {
          alert("Ingrese Licencia")
          return
        }
        if (this.form.id===null || this.form.id===0) {
          this.postSaveVehicle();
        }else{
          this.updateModifyVehicle();
          this.form.id=null
        }
      },
      postSaveVehicle() {
        this.refresh_data_child=false
        axiosInstance.post(import.meta.env.VITE_API_URL+"vehicles",this.form).then((response) => {
          this.refresh_data_child=true
          alert(response.data.message);
          this.cleanData();
        }).catch((error) =>{
          console.log(error);
          this.refresh_data_child=false;
        });
      },
      updateModifyVehicle() {
        this.refresh_data_child=false
        axiosInstance.put(import.meta.env.VITE_API_URL+"vehicles/"+this.form.id,this.form).then((response) => {
          this.refresh_data_child=true
          alert(response.data.message);
          this.cleanData();
        }).catch((error) =>{
          console.log(error);
          this.refresh_data_child=false;
        });
      },
      deleteVehicle() {
        this.refresh_data_child=false
        axiosInstance.delete(import.meta.env.VITE_API_URL+"vehicles/"+this.form.id).then((response) => {
          this.refresh_data_child=true
          alert(response.data.message);
        }).catch((error) =>{
          console.log(error);
          this.refresh_data_child=false;
        });
      }
    }
  }
  </script>
  