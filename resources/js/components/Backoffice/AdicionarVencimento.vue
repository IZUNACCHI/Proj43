<template>
    <div>

   <<!-- <b-form-group label="Descrição" label-for="inputCurso">
        <b-form-select
            id="inputCurso"
            :options="categoriaDescricao"
            v-model="vencimento.descricao"
            :state="null"
        ></b-form-select>
       -- <b-form-input
        id="inputDescricaoVencimento"
        :state="null"
        v-model="vencimento.descricao"
      ></b-form-input>--

        <b-form-invalid-feedback id="input-1-live-feedback">O Curso é obrigatório!</b-form-invalid-feedback>
    </b-form-group>-->
    <b-form-group label="Descrição" label-for="inputCodigoUC">
      <b-form-input
        id="inputDescricaoVencimento"
        :state="null"
        v-model="vencimento.descricao"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">Categoria obrigatorio</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group label="Renumeração" label-for="inputNomeUC">
      <b-form-input
        id="inputRenumeracaoVencimento"
        :state="null"
        v-model="vencimento.renumeracao"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">Nome de UC obrigatorio</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group label="Indice" label-for="inputCodigoUC">
      <b-form-input
        id="inputIndiceVencimento"
        :state="null"
        v-model="vencimento.indice"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">Codigo de UC obrigatorio</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group label="Escalão" label-for="inputCodigoUC">
      <b-form-input
        id="inputEscalaoVencimento"
        :state="null"
        v-model="vencimento.escalao"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">Codigo de UC obrigatorio</b-form-invalid-feedback>
    </b-form-group>

     <button class="btn btn-success mt-3 font-weight-bold" v-on:click.prevent="criarVencimento(vencimento)">Submeter
      <i class="fas fa-arrow-right"></i></button>
    </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            vencimento:{
                descricao:"",
                renumeracao:"",
                indice:"",
                escalao:"",
            },
            categoriaDescricao: [
                { text: "Professor Coordenador Principal", value: "professor_coordenador" },
                { text: "Professor Coordenador c/ agregação", value: "professor_coordenador_agregacao" },
                { text: "Professor Adjunto", value: "professor_adjunto" },
                { text: "Assistente do 2º Triénio (Mestres ou Doutores)", value: "assistente_2MD" },
                { text: "Assistente do 2º Triénio", value: "assistente_2" },
                { text: "Assistente do 1º Triénio", value: "assistente_1" }
            ],
        }
    },
    validations:{
        vencimento:{
            renumeracao: { required },
            indice:{ required },
            escalao:{ required },
        }
    },
    methods:{
        criarVencimento(vencimento){
            /*axios.get('/api/verificarSeJaExistemCategoriaVencimento/' + vencimento.descricao)
            .then(response => {
            if(!response.data){
        */
                axios.post('/api/vencimento/criarVencimento', vencimento).then(response => {
                    this.$swal('Sucesso', 'Vencimento criado com sucesso', 'success')
                    this.$emit('fecharCurso');

                })
              /*  .catch(error => {
                    this.$swal('Erro', 'Já existe um Vencimento com essa discrição', 'error')
                });*/
                //}
           // });
        }
    },
    mounted(){
        axios.get("api/vencimentos").then(response => {
            this.lisVencimentos = response.data;
        });
        /*axios.get("/api/discricaoDisponiveis").then(response => {
            response.data.forEach(curso => {
                this.cursos.push({
                text: vencimento.descricao,
                value: vencimento.renumeracao,
                value: vencimento.indice,
                value: vencimento.escalao
                });
            });
        });*/
    }
}
</script>
