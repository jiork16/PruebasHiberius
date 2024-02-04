<template>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Licencia</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <template v-for="item in drivers" :key="item.id">
        <tr>
          <th scope="row">{{ item.id }}</th>
          <td>{{ item.name }}</td>
          <td>{{ item.surname }}</td>
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
      name: "ListDriverComponent",
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
        drivers:[]
      }),
      created() {
      this.getListDrivers ();
    },
    watch: {
      refresh_data: {
        handler: function(newVal) {
          if (newVal === true) {
            this.getListDrivers();
          }      
        }
      }
    },
      methods: {
        setDatainput(item) {
          this.$emit("setDatainputParent",item)
        },
        getListDrivers() {
          axiosInstance.get(import.meta.env.VITE_API_URL+"drivers").then((response) => {
            this.drivers=response.data.Drivers;
          }).catch((error) =>{
            console.log(error);
          });
        },
        deleteVehicle(id) {
          axiosInstance.delete(import.meta.env.VITE_API_URL+"drivers/"+id).then((response) => {
            alert("Registro Eliminao con Existo")
            this.getListDrivers();
          }).catch((error) =>{
            console.log(error);
          });
        }
      }
    }
    </script>
  <style>
  </style>
  