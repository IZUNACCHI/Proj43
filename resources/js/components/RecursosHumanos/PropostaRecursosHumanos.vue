<template>
  <div>
    <div class="jumbotron">
      <h3>Finalização da Proposta (Recursos Humanos)</h3>
        <b-form-group label="Categoria" description="Campo Opcional">
		    <b-form-select
                id="inputCategoria"
                readonly="true"
                v-model="propostaExistente"
                @change="associarProposta()"
                :state="!propostaExistente.$error && null"
                :options="listaVencimentos"
                >
                <template slot="first">
                <option
                  :value="null"
                  disabled
                >-- Por favor selecione --</option>
              </template>
            </b-form-select>
        </b-form-group>
              <!--
              <b-form-group label="Categoria" label-for="inputEscalao">
                <b-form-input
                  id="inputEscalao"
                  :state="null"
                  v-model="tipoPropostaRole.descricao"
                  disabled
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um escalão</b-form-invalid-feedback>
              </b-form-group>-->

              <b-form-group label="Vencimentos" label-for="inputTabelaVencimentos">
              <div class="table-responsive">
                <table class="table mt-3" width="100%">
                  <thead>
                    <tr>
                      <td><b>Descricao</b></td>
                      <td colspan="2">{{tipoPropostaRole.descricao}}</td>      
                    </tr>
                    <th>Remuneração</th>
                    <th>Indice</th>
                    <th>Escalão</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{tipoPropostaRole.remuneracao}}</td>
                      <td>{{tipoPropostaRole.indice}}</td>      
                      <td>{{tipoPropostaRole.escalao}}</td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              </b-form-group>

      <!--
      <b-form-group label="Remuneração" label-for="inputRemuneracao">
        <b-form-input
          id="inputRemuneracao"
          :state=" null"
          v-model="propostaSelecionada.remuneracao"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira a remuneração em formato numérico!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Escalão" label-for="inputEscalao">
        <b-form-input
          id="inputEscalao"
          :state="null"
          v-model="propostaSelecionada.escalao"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira um escalão</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Índice" label-for="inputIndice">
        <b-form-input
          id="inputIndice"
          :state="null"
          v-model="propostaSelecionada.indice"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira um índice</b-form-invalid-feedback>
      </b-form-group>
      -->
      <b-form-group label="Número de funcionário" label-for="inputNumero">
        <b-form-input
          id="inputNumero"
          :state="null"
          v-model="propostaRecursosHumanos.numero_funcionario"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Insira um número para o funcionario</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group class="mt-5">
        <b-form-checkbox
          id="checkboxContratacaoComunicada"
          v-model="propostaRecursosHumanos.contratacao_comunicada"
          name="checkboxContratacaoComunicada"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Contratação comunicada</b></b-form-checkbox>
        <div label="Ficheiro de Contratação Comunicada (PDF)" v-if="propostaRecursosHumanos.contratacao_comunicada=='1'">
        <b-form-file
          v-model="contratacaoComunicada"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          name="contratacaoComunicada"
          v-validate="{ required: true }"
          :state="validateState('contratacaoComunicada')"
          @change="onFileSelected"
        ></b-form-file>
        <br><br>
        </div>
        <b-form-checkbox
          id="checkBoxIncricao"
          v-model="propostaRecursosHumanos.inscricao""
          name="checkBoxInscricao"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Inscrição na Seg. Social (quando aplicável)</b></b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>

        <b-form-file
          label="Ficheiro da inscrição da Segurança Social (PDF)" v-if="propostaRecursosHumanos.inscricao=='1'"
          v-model="incricaoSSocial"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          name="incricaoSSocial"
          v-validate="{ required: true }"
          :state="validateState('incricaoSSocial')"
          @change="onFileSelected"
        ></b-form-file>
      </b-form-group>


      <!--
      <b-form-group label="O docente proposto já se encontra/ja foi convidado a exercer funções numa outra UO do IPL?">
        <b-form-radio-group
          v-model="propostaRecursosHumanos.verificacao_outras_uo"
          :options="verificacao_outras_uo_array"
          stacked
        ></b-form-radio-group>
      </b-form-group>

      <b-form-group v-if="propostaRecursosHumanos.verificacao_outras_uo == 'sim'">
        <b-form-group label="Indique o nome da Unidade Orgânica" label-for="inputNomeUO">
          <b-form-input
            id="inputNomeUO"
            v-model="propostaRecursosHumanos.nome_uo"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Indique o tempo parcial" label-for="inputTempoParcial">
          <b-form-input
            id="inputTempoParcial"
            v-model="propostaRecursosHumanos.tempo_parcial_uo"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Indique o período" label-for="inputPeriodo">
          <b-form-input
            id="inputPeriodo"
            v-model="propostaRecursosHumanos.periodo_uo"
          ></b-form-input>
        </b-form-group>
      </b-form-group>
      -->
      

      
      <b-form-group label="Despacho do Sr.Presidente do IPL" label-for="inputDespacho">
        <b-form-input
          type="date"
          id="inputDespacho"
          :state="$v.propostaRecursosHumanos.despacho_presidente_ipl.$dirty ? !$v.propostaRecursosHumanos.despacho_presidente_ipl.$error : null"
          v-model="propostaRecursosHumanos.despacho_presidente_ipl"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group class="mt-5">
        <b-form-checkbox
          id="checkBoxContratoRedigido"
          v-model="propostaRecursosHumanos.contrato_redigido"
          name="checkBoxContratoRedigido"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Contrato redigido</b></b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
        <div label="Contrato Redigido (PDF)" v-if="propostaRecursosHumanos.contrato_redigido=='1'">
        <b-form-file
          v-model="contratoRedigido"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          name="contratoRedigido"
          v-validate="{ required: true }"
          :state="validateState('contratoRedigido')"
          @change="onFileSelected"
        ></b-form-file>
        <br><br>
        </div>
        <b-form-checkbox
          id="checkBoxContratoAnexo"
          v-model="propostaRecursosHumanos.contrato_anexo"
          name="checkBoxContratoAnexo"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Contrato anexo</b></b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
        <div label="Introduza o Contrato (PDF)" v-if="propostaRecursosHumanos.contrato_anexo=='1'">
        <b-form-file
          v-model="contratoAnexo"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          name="contratoAnexo"
          v-validate="{ required: true }"
          :state="validateState('contratoAnexo')"
          @change="onFileSelected"
        ></b-form-file>
        <br><br>
        </div>
        <b-form-checkbox
          id="checkBoxContratoCessacaoSocial"
          v-model="propostaRecursosHumanos.cessacao_social"
          name="checkBoxContratoCessacaoSocial"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Cessação Social</b></b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
        <b-form-file
          label="Introdução da Cessação social (PDF)" v-if="propostaRecursosHumanos.cessacao_social=='1'"
          v-model="cessacaoSocial"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          name="cessacaoSocial"
          v-validate="{ required: true }"
          :state="validateState('cessacaoSocial')"
          @change="onFileSelected"
        ></b-form-file>
      </b-form-group>


      <b-form-group label="NISS ou nº Caixa Geral Aposentações" label-for="inputNissOuCGA">
        <b-form-input
          id="inputNissOuCGA"
          :state="null"
          v-model="propostaRecursosHumanos.NISS_ou_numero_CGA"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Data de nascimento" label-for="inputDataNascimento">
        <b-form-input
          type="date"
          id="inputDataNascimento"
          :state="null"
          v-model="propostaRecursosHumanos.data_nascimento"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Número cartão de cidadão" label-for="inputCC">
        <b-form-input
          id="inputCC"
          :state="null"
          v-model="propostaRecursosHumanos.numero_CC"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>
      <!--
      <b-form-group label="E-mail pessoal" label-for="inputEmailPessoal">
        <b-form-input
          id="inputEmailPessoal"
          :state="null"
          v-model="propostaRecursosHumanos.email_recursos_humanos"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>-->

      <b-form-group label="Dados carregados/atualizados no GIAF por:" label-for="inputDadosGIAF">
        <b-form-input
          id="inputDadosGIAF"
          :state="null"
          v-model="propostaRecursosHumanos.dados_GIAF_carregados_por"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Data" label-for="inputDataGIAF">
        <b-form-input
          type="date"
          id="inputDataGIAF"
          :state="null"
          v-model="propostaRecursosHumanos.data_carregamento_dados_GIAF"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de preencher este campo</b-form-invalid-feedback>
      </b-form-group>

      <button class="btn btn-success mt-3 font-weight-bold"
        v-on:click.prevent="finalizarPropostaRecursosHumanos(propostaRecursosHumanos)">Finalizar
        <i class="fas fa-arrow-right"></i>
      </button>
      
    </div>
  </div>
</template>
<script>
import { required, numeric } from "vuelidate/lib/validators";
export default {
  props:["propostaSelecionada"],
  data() {
    return {
      listaVencimentos:[],
      /*inscricao_array: [
        { text: "Segurança Social", value: "seguranca_social" },
        { text: "Caixa Geral de Aposentações", value: "CGA" }
      ],*/
      verificacao_outras_uo_array: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      ficheiro: {
        incricao_social: {},
        contratacao_comunicada: {},
        contrato_redigido: {},
        contrato_anexo: {},
        cessacao_social: {},
      },
      
      propostaExistente: {},
      
      tipoPropostaRole: [],
      ficheiros:[],
      incricaoSSocial: "",
      contratacaoComunicada: "",
      contratoRedigido: "",
      contratoAnexo: "",
      cessacaoSocial: "",
      propostaProponente: {
        remuneracao: "",
        escalao: "",
        indice: ""
        },
      id_professor_assistente_monitor: "",
      propostaRecursosHumanos: {
        /*remuneracao: "",
        escalao: "",
        indice: "",*/
        /*verificacao_outras_uo:"",
        nome_uo:"",
        tempo_parcial_uo:"",
        periodo_uo:"",*/
        numero_funcionario: "",
        contratacao_comunicada: 0,
        inscricao: 0,
        despacho_presidente_ipl: "",
        contrato_redigido: 0,
        contrato_anexo: 0,
        cessacao_social: 0,
        NISS_ou_numero_CGA: "",
        data_nascimento: "",
        numero_CC: "",
        //email_recursos_humanos: "",
        dados_GIAF_carregados_por: "",
        data_carregamento_dados_GIAF: "",
        recursos_humanos_id: this.$store.state.user.id
      }
    };
  },
  validations: {
    propostaProponente: {
      remuneracao: { required, numeric },
      escalao: { required },
      indice: { required },
    },
    propostaRecursosHumanos: {
      /*remuneracao: { required, numeric },
      escalao: { required },
      indice: { required },*/
      //verificacao_outras_uo: { required },
      numero_funcionario: { required },
      despacho_presidente_ipl: { required },
      NISS_ou_numero_CGA: { required },
      data_nascimento: { required },
      numero_CC: { required },
      //email_recursos_humanos: { required },
      dados_GIAF_carregados_por: { required },
      data_carregamento_dados_GIAF: { required }
    }
  },
  methods: {
    getVencimentos(){
		axios.get("/api/vencimentos").then(response => {
		    response.data.forEach(proposta => {
              this.listaVencimentos.push({
                text: proposta.descricao,
                value: proposta,
                
              });
		    });
		});
	},
    onFileSelected(event) {
      this.ficheiros[event.target.name] = event.target.files[0];
    },
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
    },
    finalizarPropostaRecursosHumanos(propostaRecursosHumanos){
      
      this.$v.propostaRecursosHumanos.$touch();
      if (!this.$v.propostaRecursosHumanos.$invalid) {
        this.$swal.fire({title:'Tem a certeza que pretende submeter estes dados?',
                        text: 'Não poderá realizar mais nenhuma alteração',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'}).then((result) => {
          if(result.value){
            if(propostaRecursosHumanos.incricao=='1'){
                this.ficheiro.incricao_social = new FormData();
                this.ficheiro.incricao_social.append("file", this.ficheiros["incricaoSSocial"]);
                this.ficheiro.incricao_social.append("descricao", "Inscrição Segurança Social");
            }if(propostaRecursosHumanos.contratacao_comunicada=='1'){
                this.ficheiro.contratacao_comunicada = new FormData();
                this.ficheiro.contratacao_comunicada.append("file", this.ficheiros["contratacaoComunicada"]);
                this.ficheiro.contratacao_comunicada.append("descricao", "Contratacao Comunicada");
            }if(propostaRecursosHumanos.contrato_redigido=='1'){
                this.ficheiro.contrato_redigido = new FormData();
                this.ficheiro.contrato_redigido.append("file", this.ficheiros["contratoRedigido"]);
                this.ficheiro.contrato_redigido.append("descricao", "Contrato Redigido");
             }if(propostaRecursosHumanos.contrato_anexo=='1'){
                this.ficheiro.contrato_anexo = new FormData();
                this.ficheiro.contrato_anexo.append("file", this.ficheiros["contratoAnexo"]);
                this.ficheiro.contrato_anexo.append("descricao", "Contrato");
            }if(propostaRecursosHumanos.cessacao_social=='1'){
                this.ficheiro.cessacao_social = new FormData();
                this.ficheiro.cessacao_social.append("file", this.ficheiros["cessacaoSocial"]);
                this.ficheiro.cessacao_social.append("descricao", "Cessacao Social");
            }
            if(this.propostaSelecionada.role=="assistente"){
                this.id_professor_assistente_monitor = this.tipoPropostaRole.id_proposta_proponente_assistente;
            }
            if(this.propostaSelecionada.role=="professor"){
                this.id_professor_assistente_monitor = this.tipoPropostaRole.id_proposta_proponente_professor;
            }
            if(this.propostaSelecionada.role=="monitor"){
                this.id_professor_assistente_monitor = this.tipoPropostaRole.id_proposta_proponente_monitor;
            }
            console.log(this.propostaSelecionada.role);
            console.log(this.tipoPropostaRole.id_proposta_proponente_monitor);

            axios.put('/api/'+this.propostaSelecionada.role+'/atualizarPropostaRemuneracao/'+
                this.id_professor_assistente_monitor, this.tipoPropostaRole).then(response => {
                axios.post('/api/recursosHumanos/propostaRecursosHumanos', propostaRecursosHumanos)
                    .then(response => {
                      let idPropostaRecursosHumanos = response.data.id_proposta_recursos_humanos;
                      let proposta_proponente_id = this.propostaSelecionada.id_proposta_proponente;

                      if(propostaRecursosHumanos.incricao=='1'){
                          this.ficheiro.incricao_social.append("proposta_id", proposta_proponente_id);
                          axios.post('/api/ficheiro', this.ficheiro.incricao_social).then(response => {});
                      }if(propostaRecursosHumanos.contratacao_comunicada=='1'){
                          this.ficheiro.contratacao_comunicada.append("proposta_id", proposta_proponente_id);
                          axios.post('/api/ficheiro', this.ficheiro.contratacao_comunicada).then(response => {});
                      }if(propostaRecursosHumanos.contrato_redigido=='1'){
                          this.ficheiro.contrato_redigido.append("proposta_id", proposta_proponente_id);
                          axios.post('/api/ficheiro', this.ficheiro.contrato_redigido).then(response => {});
                      }if(propostaRecursosHumanos.contrato_anexo=='1'){
                          this.ficheiro.contrato_anexo.append("proposta_id", proposta_proponente_id);
                          axios.post('/api/ficheiro', this.ficheiro.contrato_anexo).then(response => {});
                      }if(propostaRecursosHumanos.cessacao_social=='1'){
                          this.ficheiro.cessacao_social.append("proposta_id", proposta_proponente_id);
                          axios.post('/api/ficheiro', this.ficheiro.cessacao_social).then(response => {});
                      }
                    axios.patch('/api/propostaRecursosHumanos/' + idPropostaRecursosHumanos
                      + "/" 
                      + this.propostaSelecionada.id).then(response => {
                        this.$swal('Sucesso', 'Proposta Finalizada', 'success')
                        this.$emit("mostrarRh");
                        this.$socket.emit("email-recursos-humanos", {
                          msg: "Pedido de email enviado..."
                        });
                      });
                    });
                })
          }
        })
      }
    },
    associarProposta() {
      //* Limpar Objectos
      Object.assign(this.propostaExistente, {});
      //* Associar vencimento à proposta
      Object.assign(this.tipoPropostaRole, this.propostaExistente);
      }
  },
  mounted() {
  this.$store.commit('setEditarProposta');
   
  
  /*axios.get("/api/allPropostasProponente").then(response => {
      //* Associar proposta atual à proposta existente selecionada
      Object.assign(this.proposta, response.data);
      });*/
      axios
      .get(
        "/api/diretorUO/getPropostaProponente/" +
          this.propostaSelecionada.role +
          "/" +
          this.propostaSelecionada.id_proposta_proponente
      )
      .then(response => {
        this.tipoPropostaRole = response.data[0];
      });

	this.getVencimentos();
   }
};
</script>
