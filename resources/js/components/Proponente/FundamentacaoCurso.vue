<template>
  <div v-if="mostrarFundamentacaoCurso">
    <div class="jumbotron">
      <h2>Fundamentação Coordenador Curso</h2>
      
      <b-form-group label="Fundamentação" label-for="inputFundCoordCurso">
        <!--<b-form-input
          id="inputFundCoordCurso"
          :state="$v.propostaProponente.fundamentacao_coordenador_curso.$dirty ? 
            !$v.propostaProponente.fundamentacao_coordenador_curso.$error : null"
          v-model="propostaProponente.fundamentacao_coordenador_curso"
        ></b-form-input>-->
        <b-form-textarea
            id="inputFundCoordCurso"
            v-model="propostaProponente.fundamentacao_coordenador_curso"
            rows="3"
            :state="!$v.propostaProponente.fundamentacao_coordenador_curso.$error && null"
            max-rows="6"
          ></b-form-textarea>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira a fundamentação</b-form-invalid-feedback>
      </b-form-group>
      <button type="button" class="btn btn-info" @click="novaFundamentacao()">Guardar Fundamentação</button>

     <b-form-group label="Modelos de Fundamentações">
		<b-form-select v-model="propostaProponente.fundamentacao_coordenador_curso">
		    <option selected></option>
		        <option v-for="item in fundamentacoes">
			        {{item.fundamentacao}}
		        </option>
		    </b-form-select>
		</b-form-group>
        
      <b-form-group label="Data de assinatura" label-for="inputData">
        <b-form-input
          id="inputData"
          type="date"
          v-model="propostaProponente.data_de_assinatura_coordenador_de_curso"
        ></b-form-input>
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
      propostaProponente: {
        fundamentacao_coordenador_curso: "",
        data_de_assinatura_coordenador_de_curso:"",
        segundo_proponente: this.$store.state.user.name,
      },
      mostrarFundamentacaoCurso:true,
      ficheiro: {
        proposta: {},
      },
      ficheiros:[],
      propostaAssinada:"",
      
    };
  },
  validations: {
    propostaProponente: {
      fundamentacao_coordenador_curso: { required },
      data_de_assinatura_coordenador_de_curso: { required },
      
    }
  },
  methods: {
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
    },
    onFileSelected(event) {
      this.ficheiros[event.target.name] = event.target.files[0];
    },
    novaFundamentacao() {
		let newfundamentacao = '';
		if(this.$store.state.user.roleDB == 'proponente_curso'){
			newfundamentacao = this.propostaProponente.fundamentacao_coordenador_curso;
		}
		axios.post('/api/fundamentacoes/create/' + this.$store.state.user.id + '/'+ newfundamentacao).then(response => {
		this.$swal("Success", "Fundamentação guardada!", "success");});
		this.$nextTick(() => {this.getFundamentacoes();});
	},
	getFundamentacoes(){
		axios.get("/api/fundamentacoes/" + this.$store.state.user.id).then(response => {
		this.fundamentacoes = response.data;
		});
		 
	},
    inserirFundamentacao(propostaProponente){
      /*this.ficheiro.proposta = new FormData();
      this.ficheiro.proposta.append("file", this.ficheiros["PropostaAssinada"]);
      this.ficheiro.proposta.append("descricao", "Proposta Assinada");*/
      this.$v.propostaProponente.$touch();
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
          axios.put('/api/propostaProponente/fundamentacaoCoordenadorCurso/'+
          this.propostaSelecionada.id_proposta_proponente, this.propostaProponente).then(response => {
            this.mostrarFundamentacaoCurso=false;
            //this.$swal('Sucesso', 'Fundamentação inserida com sucesso', 'success');
            this.$socket.emit("email-diretor", {
                          msg: "Pedido de email enviado..."
                        });
            this.$emit("voltarProponentes", this.propostaProponente);
            /*axios.post("/api/ficheiro", this.ficheiro.proposta).then(response => {});   
                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
            */ 
          });
          }
        });
          
        }
      
    }
  },
  mounted(){
	this.getFundamentacoes();

  }
};
</script>
