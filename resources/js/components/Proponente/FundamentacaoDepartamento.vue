<template>
  <div>
    <div class="jumbotron">
      <h2>Fundamentação Coordenador Departamento</h2>
      <b-form-group
        label="Fundamentação"
        label-for="inputFundCoordDepartamento"
      >
        <!--<b-form-input
          id="inputFundCoordDepartamento"
          :state="$v.propostaProponente.fundamentacao_coordenador_departamento.$dirty ? 
        !$v.propostaProponente.fundamentacao_coordenador_departamento.$error : null"
          v-model="propostaProponente.fundamentacao_coordenador_departamento"
        ></b-form-input>-->
        <b-form-textarea
            v-model="propostaProponente.fundamentacao_coordenador_departamento"
            rows="3"
            :state="!$v.propostaProponente.fundamentacao_coordenador_departamento.$error && null"
            max-rows="6"
        ></b-form-textarea>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira a fundamentação</b-form-invalid-feedback>
          <button type="button" class="btn btn-info" @click="novaFundamentacao()">Guardar Fundamentação</button>
        </b-form-group>
		   <b-form-group label="Modelo de Fundamentações">
		    <b-form-select v-model="propostaProponente.fundamentacao_coordenador_departamento">
		        <option selected></option>
		        <option v-for="item in fundamentacoes">
			        {{item.fundamentacao}}
		        </option>
		    </b-form-select>
		</b-form-group>
      <b-form-group label="Data de assinatura" label-for="inputData">
      <b-form-input id="inputData" type="date" v-model="propostaProponente.data_de_assinatura_coordenador_departamento">

      </b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">Tem de introduzir a data</b-form-invalid-feedback>
    </b-form-group>

    <button
      class="btn btn-success mt-3 font-weight-bold"
      v-on:click.prevent="inserirFundamentacao(propostaProponente)"
    >
      Submeter
      <i class="fas fa-arrow-right"></i>
    </button>
    </div>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
  props: ["propostaSelecionada"],
  data() {
    return {
      fundamentacoes: [],
	  selectedFundamentação: null,
	  fundamentacoes: [],
      propostaProponente: {
        fundamentacao_coordenador_departamento: "",
        data_de_assinatura_coordenador_departamento:"",
        primeiro_proponente: this.propostaSelecionada.primeiro_proponente,
        segundo_proponente: this.$store.state.user.name,
      }
    };
  },
  validations: {
    propostaProponente: {
      fundamentacao_coordenador_departamento: { required },
      data_de_assinatura_coordenador_departamento: { required },
    },
  },
  methods: {
	getFundamentacoes(){
		axios.get("/api/fundamentacoes/" + this.$store.state.user.id).then(response => {
		this.fundamentacoes = response.data;
		});
	},
    novaFundamentacao() {
		let newfundamentacao = '';
		if(this.$store.state.user.roleDB == 'proponente_departamento'){
			newfundamentacao = this.propostaProponente.fundamentacao_coordenador_departamento;
		}
		axios.post('/api/fundamentacoes/create/' + this.$store.state.user.id + '/'+ newfundamentacao).then(response => {
		this.$swal("Success", "Fundamentação guardada!", "success");});
		this.$nextTick(() => {this.getFundamentacoes();});
	},
    inserirFundamentacao(propostaProponente){
        this.$v.propostaProponente.$touch();
        if(this.propostaSelecionada.primeiro_proponente == 'Secretariado da Direção'){
            this.propostaProponente.primeiro_proponente= this.$store.state.user.name;
            this.propostaProponente.segundo_proponente= "";
        }if(this.propostaSelecionada.primeiro_proponente != 'Secretariado da Direção'){
            propostaProponente.segundo_proponente= this.$store.state.user.name;
        }
        if (!this.$v.propostaProponente.$invalid) {
          this.$swal.fire({title:'Tem a certeza que pretende submeter estes dados?',
                        text: 'Não poderá realizar mais nenhuma alteração',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'}).then((result) => {
          if(result.value){
            axios.put('/api/propostaProponente/fundamentacaoCoordenadorDepartamento/'+
                this.propostaSelecionada.id_proposta_proponente, this.propostaProponente).then(response => {
                this.$swal('Sucesso', 'Fundamentação inserida com sucesso', 'success');
                this.$socket.emit("email-diretor", {
                          msg: "Pedido de email enviado..."
                        });
                this.$emit('voltarProponentes');
            });
          }
        });
      }
    },
	mounted(){
		this.getFundamentacoes();
	}
  },
  mounted(){
	this.getFundamentacoes();

  }
};
</script>
