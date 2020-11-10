<template>

   <div class="container" id="accordion">

        <div v-for="(actividad, index) in actividades" class="card mb-2">
            <div class="card-header" v-bind:id="'heading' + index">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="'#collapse' + index" aria-expanded="true" v-bind:aria-controls="'collapse' + index">
                        {{actividad.titulo}}
                    </button>
                </h5>
            </div>

            <div v-bind:id="'collapse' + index" class="collapse" v-bind:aria-labelledby="'heading' + index"  data-parent="#accordion">

                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h6><b>Actividad</b></h6>
                        <p>{{actividad.actividad}}</p>
                    </div>

                    <input type="radio" :id="'rd_act_one_' + index" :name="'datos_ejecucion['+index+'][act][estado]'" value="0" >
                    <label :for="'rd_one_' + index">Completado sin observaciones</label>
                    <br>
                    <input type="radio" :id="'rd_act_two_' + index" :name="'datos_ejecucion['+index+'][act][estado]'" value="1" >
                    <label :for="'rd_two_' + index">Completado con observaciones</label>
                    <br>
                    <input type="radio" :id="'rd_act_three_' + index" :name="'datos_ejecucion['+index+'][act][estado]'" value="2" >
                    <label :for="'rd_three_' + index">No se pudo completar</label>

                    <textarea v-bind:hidden="true" class="form-control" name="datos_ejecucion[][act][error]" rows="3" placeholder="Comente aquí el error encontrado al ejecutar la actividad"></textarea>
                </div>

                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h6><b>Respuesta del Sistema</b></h6>
                        <p>{{actividad.respuesta_sistema}}</p>
                    </div>

                    <input type="radio" :id="'rd_resp_one_' + index" :name="'datos_ejecucion['+index+'][resp][estado]'" value="0" >
                    <label :for="'rd_one_' + index">Completado sin observaciones</label>
                    <br>
                    <input type="radio" :id="'rd_resp_two_' + index" :name="'datos_ejecucion['+index+'][resp][estado]'" value="1" >
                    <label :for="'rd_two_' + index">Completado con observaciones</label>
                    <br>
                    <input type="radio" :id="'rd_resp_three_' + index" :name="'datos_ejecucion['+index+'][resp][estado]'" value="2" >
                    <label :for="'rd_three_' + index">No se pudo completar</label>

                    <textarea v-bind:hidden="true" class="form-control" name="datos_ejecucion[][resp][error]" rows="3" placeholder="Comente aquí el error relacionado a la respuesta esperada del sistema"></textarea>
                </div>

            </div>
        </div>
       <div class="row">
           <div class="col"></div>
           <div class="col"></div>
           <div class="col">
               <button class="btn btn-success" type="submit">Guardar</button>
           </div>
       </div>
   </div>


</template>

<script>
    export default {
        name: "LevelExecutionComponent",
        props: {
            id_caso: Number
        },
        data() {
            return {
               actividades: []
            }
        },
        mounted() {
            axios
                .get('http://localhost/proy_tit_gepp/public/ejecucion_prueba/actividades_respuestas/get/' + this.id_caso)
                .then(response => (this.actividades = response.data))
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>