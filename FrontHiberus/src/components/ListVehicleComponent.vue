<template>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Marca</th>
      <th scope="col">Modelo</th>
      <th scope="col">Licencia</th>
      <th scope="col">Accion</th>
    </tr>
  </thead>
  <tbody>
    <template v-for="item in vehicles" :key="item.id">
      <tr>
        <th scope="row">{{ item.id }}</th>
        <td>{{ item.brand }}</td>
        <td>{{ item.model }}</td>
        <td>{{ item.license}}</td>
        <td>
          <button type="button" class="btn btn-warning" @click="setDatainput(item)">Editar</button>
          <button type="button" class="btn btn-danger" @click="deleteVehicle(item.id)">Eliminar</button>
        </td>
      </tr>
    </template>
  </tbody>
</table>
</template>
<script>
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
    name: "ListVehicleComponent",
    components: {    
    },
    props: {
      refresh_data: {
        type: Boolean,
        required: false,
        default: false
      }
    },
    data: () => ({
      vehicles:[]
    }),
    created() {
    this.getListVehicles ();
  },
  watch: {
    refresh_data: {
      handler: function(newVal) {
        if (newVal === true) {
          this.getListVehicles();
        }      
      }
    }
  },
    methods: {
      setDatainput(item) {
        this.$emit("setDatainputParent",item)
      },
      getListVehicles() {
        axiosInstance.get(import.meta.env.VITE_API_URL+"vehicles").then((response) => {
          this.vehicles=response.data.Vehicles;
        }).catch((error) =>{
          console.log(error);
        });
      },
      deleteVehicle(id) {
        axiosInstance.delete(import.meta.env.VITE_API_URL+"vehicles/"+id).then((response) => {
          alert("Registro Eliminao con Existo")
          this.getListVehicles();
        }).catch((error) =>{
          console.log(error);
        });
      }
    }
  }
  </script>
<style>
</style>
