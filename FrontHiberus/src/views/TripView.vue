<template>
  <NavbarView></NavbarView>
  <form>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="example-datepicker">Choose a date</label>
        <b-form-datepicker id="example-datepicker" v-model="form.date" class="mb-2"></b-form-datepicker>
      </div>
      <div class="col-md-4 mb-3">
        <label>Vehiculo</label>
        <div class="form-group">
          <select class="custom-select" v-model="selectedVehicle" required>
            <option disabled value="0">Seleccione un Vehiculo</option>
            <option v-for="item in vehicle" v-bind:value="item.id">
              {{ item.brand }} - {{ item.model }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <label>Conductor</label>
        <div class="form-group">
          <select class="custom-select" v-model="selectedDrive" required>
            <option disabled value="0">Seleccione un Conductor</option>
            <option v-for="item in driver" v-bind:value="item.id">
              {{ item.name }}-{{ item.surname }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div>
      <button type="button"  @click.prevent="saveTrip()" class="btn btn-outline-primary">Guardar</button>
      <button type="button" @click.prevent="cleanData()" class="btn btn-outline-info">Nuevo</button>
    </div>
  </form>
  <ListTripComponent :refresh_data="refresh_data_child"></ListTripComponent>
  </template>
  
  <script>
  import NavbarView from "@/views/Layouts/NavbarView.vue";
  import ListTripComponent from "@/components/ListTripComponent.vue";
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
    name: "Trip",
    components: {
      NavbarView,
      ListTripComponent
    },
    data: () => ({
      form: {
        vehicle_id:    null,
        driver_id:     null,
        date:          null
      },
      vehicle:[],
      driver:[],
      selectedVehicle:0,
      selectedDrive:0,
      refresh_data_child: false,
      Trip:[]
    }),
    created() {
  
    },
    methods: {
      cleanData(){
        this.form.date=null;
        this.form.driver_id=null;
        this.form.vehicle_id=null;
        this.selectedVehicle=0;
        this.selectedDrive=0;
        this.vehicle=null;
        this.driver=null;
      },
      saveTrip(){
        if (this.selectedVehicle === null || (this.selectedVehicle).length==0 ) {
          alert("Seleccione un vehiculo")
          return
        }
        if (this.selectedDrive === null || (this.selectedDrive).length==0 ) {
          alert("Seleccione un conductor")
          return
        }
        if (this.form.date === null || (this.form.date).length==0 ) {
          alert("Seleccione una fecha")
          return
        }
        this.postSaveTrip();
      },
      postSaveTrip(){
        this.refresh_data_child=false
        this.form.driver_id= this.selectedDrive;
        this.form.vehicle_id= this.selectedVehicle;
        axiosInstance.post(import.meta.env.VITE_API_URL+"trips",this.form).then((response) => {
          this.cleanData();
          this.refresh_data_child=true
          alert("Registro Ingresado con Exito");          
        }).catch((error) =>{
          this.refresh_data_child=false
          console.log(error)
        });
      },
      getVehicle() {
        axiosInstance.get(import.meta.env.VITE_API_URL+"vehicles/free/"+this.form.date).then((response) => {
          this.vehicle=response.data.vehicles;
        }).catch((error) =>{
          console.log(error)
          this.refresh_data_child=false;
        });
      },
      getDrivers(license) {
        axiosInstance.get(import.meta.env.VITE_API_URL+"drivers/free/"+ license + "/" + this.form.date).then((response) => {
          this.driver=response.data.drivers;
        }).catch((error) =>{
          this.refresh_data_child=false
          alert(error.response.data.detail);
        });
      }
    },
    watch: {
      "form.date": {
        handler: function(newVal) {
          if (newVal!=null) {
            this.getVehicle(newVal);   
          }
        }
      },
      selectedVehicle: {
        handler: function(newVal) {
          if (newVal!=0) {
            const found = this.vehicle.find((element) => element.id == newVal);
            if (found.license != null && (found.license).length !=0 ) {
              this.getDrivers(found.license); 
            } 
          }
        }
      },
    },
  }
  </script>
  