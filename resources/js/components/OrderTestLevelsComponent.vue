<template>
    <div class="container">
        <strong>Primer caso de prueba en ser ejecutado</strong>

        <draggable v-model="myArray" ghost-class="ghost" @end="onEnd">
            <transition-group type="transition" name="flip-list">
                <div class="sortable card mt-1 mr-2 ml-2 mb-0" :id="element.id" v-for="element in myArray" :key="element.id">
                    <div class="card-body">
                        <h5> {{'P' + element.ident_caso}}{{ '-' + element.nombre}}</h5>
                        <p> {{ 'Descripción: ' + element.descripcion}}</p>
                    </div>
                </div>
            </transition-group>
        </draggable>

        <strong>Último caso de prueba en ser ejecutado</strong>

        <div class="row text-right">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <button class="btn btn-success mt-3 text-center" type="button" @click="enviarDatosOrdenados"> <i class="fas fa-save"></i> Guardar orden</button>
            </div>

        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'

    export default {
        name: "OrderTestLevelsComponent",
        components:{
            draggable
        },
        props:{
            id_plan: Number
        },
        data() {
            return {
                myArray: [],
                oldIndex: '',
                newIndex: ''
            }
        },
        mounted(){
            axios
                .get('http://localhost/proy_tit_gepp/public/casos_de_prueba/get/' + this.id_plan)
                .then(response => (this.myArray = response.data))
        },
        methods: {
            onEnd: function (evt) {
                console.log(evt);
                this.oldIndex = evt.oldIndex;
                this.newIndex = evt.newIndex;
            },
            enviarDatosOrdenados: function(){

                axios
                    .post('http://localhost/proy_tit_gepp/public/casos_de_prueba/post/1', this.myArray)
                    .then(function(response) {
                        if(response)
                        {
                            window.location.href = response.data.url;
                        }
                    });
            }
        }
    }
</script>

<style scoped>
    .sortable{
        cursor: move;
    }
    .flip-list-move{
        transition: transform 0.5s;
    }

    .ghost{
        border-left: 6px solid rgb(0,183,255);
        box-shadow: 10px 10px 5px -1px rgba(0,0,0,0.14);
        font-weight: bold;
    }
</style>