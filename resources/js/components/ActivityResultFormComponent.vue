<template>
    <div class="container">

        <button class="btn btn-success" type="button" @click="agregarForm()"> <i class="fas fa-plus-circle"> </i> {{'Agregar Actividad y Respuesta'}}</button>

        <div class="card mb-3 mt-3" v-for="(actividad, index) in actividades">
            <div class="card-body">
                                <span class="float-right" style="cursor:pointer"
                                      @click="eliminarForm(index)">
                                    X
                                </span>

                <h4 class="card-title"> Actividad y Respuesta del Sistema #{{index +1}}</h4>

                <div class="actividad-form">
                    <textarea name= "actividades[act][]" v-model="actividad.activ" class="form-control" placeholder="Actividad"></textarea>
                    <textarea name= "actividades[resp][]" v-model="actividad.respuesta" class="form-control" placeholder="Respuesta del Sistema"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ActivityResultFormComponent",
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return{
                actividades: [
                    {
                        activ: '',
                        respuesta: ''
                    }
                ]
            };
        },
        methods: {
            agregarForm(){
                console.log('diste click');
                this.actividades.push({
                    activ: '',
                    respuesta: ''
                });
            },
            eliminarForm(index){
                this.actividades.splice(index,1);
            }
        }
    }
</script>
