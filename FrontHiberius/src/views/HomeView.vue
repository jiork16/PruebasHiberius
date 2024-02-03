<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavbarView from "../views/Layouts/NavbarView.vue";
</script>
<template>
  <NavbarView></NavbarView>
  <!-- About-->
  <section >
      <div>
        <h1 class="mb-0">
          Jordan
          <span class="text-primary">Rodriguez</span>
        </h1>
        <div class="subheading mb-5">
          +593986052309 • Guayaquil, Guayas
          <a href="mailto:name@email.com">jordan_r_a@hotmail.es</a>
        </div>
        <p class="lead mb-5">Ingeniero en sistemas con sólida formación y amplia experiencia en programación, generación de códigos y desarrollo de procesos transaccionales para interfaces windows, web. He formado parte de proyectos líderes en innovación tecnológica lo que ha permitido el desarrollo de las habilidades y conocimientos necesarios para dar solución a problemas tecnológicos complejos. Proactivo, con facilidad de adaptación y alto sentido de responsabilidad, lo que me permite desarrollarme apropiadamente en equipos de todo tipo, incluidos equipos de alto desempeño. Interesado en nuevos retos laborales que permitan mi crecimiento y contribución para el desarrollo óptimo de software; dispuesto a aportar, con mis conocimientos teóricometodológicos, al alcance de los objetivos y metas alineado con la planificación estratégica de la organización.        </p>
      </div>
    </section>
    <hr class="m-0" />
    <!-- Experience-->
    <section >
      <div >
        <h2 class="mb-5">HISTORIAL LABORAL</h2>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="flex-grow-1">
            <h3 class="mb-0">DEVELOPER FULL STACK</h3>
            <div class="subheading mb-3">
              KACHIN S.A             
            </div>
            <p>-Análisis y Desarrollo de Requerimientos:<br>
                Lideré el análisis detallado de requerimientos, trabajando en estrecha colaboración con los equipos de negocio para comprender y documentar sus necesidades, garantizando una comprensión completa de los objetivos del proyecto.<br>
              -Metodología TDD y DDD:<br>
                Implementé prácticas de Desarrollo Dirigido por Pruebas (TDD) y Desarrollo Dirigido por Dominio (DDD) para asegurar la calidad del código y una arquitectura flexible y sostenible.<br>
              -Creación de Microservicios:<br>
                Diseñé y desarrollé microservicios utilizando la tecnología ABP Framework, aprovechando sus capacidades para garantizar la modularidad y la escalabilidad de las aplicaciones.<br>
              -Tecnologías Utilizadas:<br>
                Aplicación de las últimas tecnologías, incluyendo Blazor Server, para la creación eficiente de interfaces de usuario interactivas y la mejora de la experiencia del usuario.
            </p>
          </div>
          <div class="flex-shrink-0">
            <span class="text-primary">05/2023 – Hasta la Actualidad</span>
          </div>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="flex-grow-1">
            <h3 class="mb-0">DEVELOPER FULL STACK</h3>
            <div class="subheading mb-3">
              ESTUDIO JURÍDICO ROMERO D & ASOCIADOS             
            </div>
            <p>-Encargado de realizar levantamiento de información, análisis y desarrollo de requerimientos con sus respectivos testing.
              -Ejecutar mantenimiento de softwares con tecnologías como: PHP Laravel, VB.Net, C#, MVC, Java Form y Vue.js
              -Optimizar el sistema de cobranzas -cobros-, basado en Vb.Net y SQL Server
              -Creación de aplicativos externos que permitan aligerar la carga operativa del personal.
              -Replicación y monitoreo de BD Sql Server.
            </p>
          </div>
          <div class="flex-shrink-0">
            <span class="text-primary">05/2019 – 05/2023 </span>
          </div>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="flex-grow-1">
            <h3 class="mb-0">ANALISTA DEARROLLADOR</h3>
            <div class="subheading mb-3">GENERAL AIR S.A</div>
            <p>-Hacer más eficiente el sistema de pesaje, basado en VB.Net, C# y MySQL
              -Consumo de WS, que permiten enviar informe de la carga procesada a las aduanas del Ecuador.
              -Creación de reportes correspondiente a los procesos realizados.
              -Crear un Sistema de Control de Temperatura basado en Arduino, VB.Net y MySQL
              -Implementar mejoras en el sistema de marcación con reconocimiento facial, el cual se basa en APIs de integración de RF de Microsoft</p>
          </div>
          <div class="flex-shrink-0">
            <span class="text-primary"> 10/2017 – 05/2019</span>
          </div>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="flex-grow-1">
            <h3 class="mb-0">INGENIERO TÉCNICO</h3>
            <div class="subheading mb-3">Shout! Media Productions</div>
            <p>-Realizar el levantamiento de información, análisis y desarrollo de requerimientos.<br>
              -Optimizar procesos de PLSQL.<br>
              -Crear bash para la ejecución paralela de procesos en PLSQL.<br>
              -Crear reportes en Oracle Forms para análisis del área de Cobranzas y Facturación.</p>
          </div>
          <div class="flex-shrink-0">
            <span class="text-primary">10/2013 - 10/2017</span>
          </div>
        </div>
      </div>
    </section>
    <hr class="m-0" />
    <!-- Education-->
    <section >
      <div >
        <h2 class="mb-5">Educacion</h2>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
          <div class="flex-grow-1">
            <h3 class="mb-0">Universidad de Estatal de Guayaquil</h3>
            <div>Ingeniería en Sistemas Administrativos Computarizados</div>
          </div>
          <div class="flex-shrink-0">
            <span class="text-primary">2014</span>
          </div>
        </div>
      </div>
    </section>
    <hr class="m-0" />
    <!-- Skills-->
    <section >
      <div >
        <h2 class="mb-5">Skills</h2>
        <div class="subheading mb-3">Programming Languages & Tools</div>
        <ul>
          <li>VB.Net (Form).</li>
          <li>PHP(Laravel/Codeigniter).</li>
          <li>C# (MVC).</li>
          <li>Vue</li>
          <li>Javascript.</li>
          <li>SQL Server.</li>
          <li>MySql.</li>
          <li>PL-SQL (BD: Oracle10G)</li>
        </ul>
      </div>
    </section>
    <!-- Awards-->
    <section >
      <div>
        <h2 class="mb-5">FORMACIÓN COMPLEMENTARIA Y OTROS CONOCIMIENTOS</h2>
        <ul class="mb-0">
          <li>
            Scrum Foundation Professional Certificate (SFPC)
          </li>
          <li>
            Scrum Master Professional Certificate (SMPC®).
          </li>
          <li>
            C# Fundamentals with NET Core 2.1
          </li>
          <li>
            Introduction to Laravel.
          </li>
          <li>
            PHP course with Composer
          </li>
          <li>
            Laravel 6 Introduction Course
          </li>
          <li>
            Laravel 8 Introduction Course.
          </li>
          <li>
            REST API course with PHP.
          </li>
          <li>
            Laravel Data Management with Eloquent ORM.
          </li>
          <li>
            Vue.js Basic Course 2.
          </li>
          <li>
            Python Fundamentals Course.
          </li>
          <li>
            Python Course: Comprehensions, Functions and Error Handling.
          </li>
          <li>
            Python Hands-on Course: Creating a CRUD.
          </li>          
        </ul>
      </div>
    </section>
 <RouterView></RouterView>
</template>