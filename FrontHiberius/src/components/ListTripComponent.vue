<template>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Vehiculo</th>
        <th scope="col">Conductor</th>
        <th scope="col">Licencia</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <template v-for="item in trips" :key="item.id">
        <tr>
          <th scope="row">{{ item.id }}</th>
          <td>{{ item.date}}</td>
          <td>{{ item.vehicle.brand }} - {{ item.vehicle.model }}</td>
          <td>{{ item.driver.name }} - {{ item.driver.surname }} </td>
          <td>{{ item.vehicle.license}}</td>
          <td>
            <button type="button" class="btn btn-danger" @click="deleteTrip(item)">Eliminar</button>
          </td>
        </tr>
      </template>
    </tbody>
  </table>
  </template>
  <script>
    import axios from "axios";
    const axiosInstance = axios.create({
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Content-Type": "	application/json"
      }
    });
    export default {
      name: "ListTripComponent",
      components: {    
      },
      props: {
        refresh_data: {
          type: Boolean,
          required: false,
          default: false
        },
        form_search: {
          type: Object,
          required: false,
          default: () => {}
        }
      },
      data: () => ({
        trips:[]
      }),
      created() {
      this.getListTrips ();
    },
    watch: {
      refresh_data: {
        handler: function(newVal) {
          if (newVal === true) {
            this.getListTrips();
          }      
        }
      }
    },
      methods: {
        getListTrips() {
          axiosInstance.get(import.meta.env.VITE_API_URL+"trips").then((response) => {
            this.trips=response.data.Trips;
          }).catch((error) =>{
            console.log(error);
          });
        },
        deleteTrip(item){
        axiosInstance.delete(import.meta.env.VITE_API_URL+"trips/"+item.vehicle_id+"/"+item.driver_id+"/"+item.date).then((response) => {
          this.getListTrips ();
          alert("Registro Ingresado con Exito");
          
        }).catch((error) =>{
          console.log(error);
          this.refresh_data_child=false;
        });
      },
      }
    }
    </script>
  <style>
  </style>
  