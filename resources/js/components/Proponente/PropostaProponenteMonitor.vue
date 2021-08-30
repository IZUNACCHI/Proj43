<template>
  <div>
    <div v-show="isShowMonitor">

    <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-1 variant="dark">Assistente</b-button>
        </b-card-header>
        <b-collapse visible id="accordion-1" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
      
	  <h2 class="pb-4">Monitor</h2>
    <h5>Tempo Parcial</h5>
    <b-form-group label="Ciclo do docente a ser contratado">
      <b-form-radio-group
        v-model="propostaProponenteMonitor.ciclo"
        :options="ciclo"
        :state="!$v.propostaProponenteMonitor.ciclo.$error && null"
      ></b-form-radio-group>
      <b-form-invalid-feedback id="input-1-live-feedback">A seleção de um ciclo é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group
      label="Percentagem de tempo parcial"
      label-for="inputTempoParcial"
      v-if="propostaProponenteMonitor.ciclo == '1ciclo'"
    >
      <b-form-select
        id="inputTempoParcial"
        v-model="propostaProponenteMonitor.percentagem_prestacao_servicos"
        :state="!$v.propostaProponenteMonitor.percentagem_prestacao_servicos.$error && null"
        :options="percentagensArray1Ciclo"
      ></b-form-select>
      <b-form-invalid-feedback
        id="input-1-live-feedback"
      >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group
      label="Percentagem de tempo parcial"
      label-for="inputTempoParcial"
      v-if="propostaProponenteMonitor.ciclo == '2ciclo'"
    >
      <b-form-select
        id="inputTempoParcial"
        v-model="propostaProponenteMonitor.percentagem_prestacao_servicos"
        :state="!$v.propostaProponenteMonitor.percentagem_prestacao_servicos.$error && null"
        :options="percentagensArray2Ciclo"
      ></b-form-select>
      <b-form-invalid-feedback
        id="input-1-live-feedback"
      >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group label="Duração do contrato" label-for="inputDuracaoContrato">
      <b-form-input
        id="inputDuracaoContrato"
        :state="!$v.propostaProponenteMonitor.duracao.$error && null"
        v-model="propostaProponenteMonitor.duracao"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">A duração do contrato é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

    <b-form-group label="Periodo" label-for="inputPeriodo"  description="Ex: 13/03/2000 a 28/07/2000">
      <b-form-input
        id="inputPeriodo"
        :state="!$v.propostaProponenteMonitor.periodo.$error && null"
        v-model="propostaProponenteMonitor.periodo"
      ></b-form-input>
      <b-form-invalid-feedback id="input-1-live-feedback">O periodo do contrato é obrigatório!</b-form-invalid-feedback>
    </b-form-group>
	  
	  
	  
	  </b-card-text>
          </b-card-body>
        </b-collapse>
      </b-card>
       <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-3 variant="dark">Vencimento aplicável</b-button>
        </b-card-header>



        <b-collapse id="accordion-3" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>

            
            
        
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
                  v-model="propostaProponenteMonitor.descricao"
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
                      <td colspan="2">{{propostaProponenteMonitor.descricao}}</td>      
                    </tr>
                    <th>Remuneração</th>
                    <th>Indice</th>
                    <th>Escalão</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{propostaProponenteMonitor.remuneracao}}</td>
                      <td>{{propostaProponenteMonitor.indice}}</td>      
                      <td>{{propostaProponenteMonitor.escalao}}</td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              </b-form-group>
            </b-card-text>
          </b-card-body>
        </b-collapse>
      </b-card>

      <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-4 variant="dark">Contratação para mais do que uma UO do IPL</b-button>
        </b-card-header>
        <b-collapse id="accordion-4" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
              <h2 class="pb-4"></h2>
              <b-form-group label="O docente proposto já se encontra/já foi convidado a exercer funções numa outra UO do IPL?">
                <b-form-radio-group
                  v-model="propostaProponenteMonitor.verificacao_outras_uo"
                  :options="verificacao_outras_uo_array"
                  stacked
                ></b-form-radio-group>
              </b-form-group>
              <b-form-group v-if="propostaProponenteMonitor.verificacao_outras_uo == 'sim'">
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESECS'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteMonitor.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESECS"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESTG'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteMonitor.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESTG"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESAD.CR'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteMonitor.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaSAD.CR"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESSLei'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteMonitor.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESSLei"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESTM'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteMonitor.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESTM"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
            
            <b-form-group label="O docente esta a tempo Parcial?">
                <b-form-radio-group
                  v-model="propostaProponenteMonitor.verificacao_tempo_parcial"
                  :options="verificacao_tempo_parcial"
                  stacked
                ></b-form-radio-group>
              </b-form-group>

              <b-form-group
                label="Indique o tempo parcial"
                label-for="inputTempoParcial"
                v-if="propostaProponenteMonitor.verificacao_tempo_parcial == 'sim'">
                  <b-form-select
                  id="inputTempoParcial"
                  v-model="propostaProponenteMonitor.tempo_parcial_uo"
                  :state="null"
                  :options="percentagensArray"
              ></b-form-select>
              <b-form-invalid-feedback
                  id="input-1-live-feedback"
              >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
              </b-form-group>
                <b-form-group label="Indique o período" label-for="inputPeriodo"  description="Ex: 01/01/2022 a 31/12/2022">
                  <b-form-input
                    id="inputPeriodo"
                    v-model="propostaProponenteMonitor.periodo_uo"
                  ></b-form-input>
                </b-form-group>
              </b-form-group>
            </b-card-text>
          </b-card-body>
        </b-collapse>
      </b-card>






    <button class="btn btn-info mt-3 font-weight-bold" v-on:click.prevent="anterior">
      <i class="fas fa-arrow-left"></i> Anterior
    </button>

    <button class="btn btn-success mt-3 font-weight-bold" v-on:click.prevent="seguinte">
      Seguinte
      <i class="fas fa-arrow-right"></i>
    </button>
    </div>
    <resumo-proposta
      v-if="avancar"
      :proposta="proposta"
      :unidadesCurriculares="unidadesCurriculares"
      :alterar="alterar"
      :propostaProponenteMonitor="propostaProponenteMonitor"
      :ficheiro="ficheiro"
      v-on:mostrarComponente="mostrarComponente"
      v-on:mostrarPropostaProponente_monitor="mostrarComponenteMonitor"
    ></resumo-proposta>
  </div>
</template>
<script>
import { required, between } from "vuelidate/lib/validators";

export default {
  props: ["proposta", "unidadesCurriculares", "ficheiro", "alterar"],
  data() {
    return {
      listaVencimentos:[],
      verificacao_outras_uo_array: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      verificacao_tempo_parcial: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      percentagensArray: [
        { text: "80% (10 horas)", value: "80" },
        { text: "70% (9 horas)", value: "70" },
        { text: "60% (8 horas)", value: "60" },
        { text: "55% (7 horas)", value: "55" },
        { text: "50% (6 horas)", value: "50" },
        { text: "40% (5 horas)", value: "40" },
        { text: "30% (4 horas)", value: "30" },
        { text: "20% (3 horas)", value: "20" },
        { text: "15% (2 horas)", value: "15" }
      ],
      UnidadeOrganicaESSLei: [
        { text: "SECS", value: "SECS" },
        { text: "ESTG", value: "ESTG" },
        { text: "SAD.CR", value: "SADCR" },
        { text: "ESTM", value: "ESTM" }
      ],
      UnidadeOrganicaESECS: [
        { text: "ESTG", value: "ESTG" },
        { text: "SAD.CR", value: "SADCR" },
        { text: "ESTM", value: "ESTM" },
        { text: "ESSLei", value: "ESSLei" }
      ],UnidadeOrganicaESTG: [
        { text: "ESECS", value: "ESECS" },
        { text: "SAD.CR", value: "ESAD.CR" },
        { text: "ESTM", value: "ESTM" },
        { text: "ESSLei", value: "ESSLei" }
      ],UnidadeOrganicaSADCR: [
        { text: "ESECS", value: "ESECS" },
        { text: "ESTG", value: "ESTG" },
        { text: "ESTM", value: "ESTM" },
        { text: "ESSLei", value: "ESSLei" }
      ],UnidadeOrganicaESTM: [
        { text: "ESECS", value: "ESECS" },
        { text: "ESTG", value: "ESTG" },
        { text: "SAD.CR", value: "ESAD.CR" },
        { text: "ESSLei", value: "ESSLei" }
      ],UnidadeOrganica: [
        { text: "ESECS", value: "ESECS" },
        { text: "ESTG", value: "ESTG" },
        { text: "SAD.CR", value: "ESAD.CR" },
        { text: "ESSLei", value: "ESSLei" },
        { text: "ESTM", value: "ESTM"}
      ],
      
      ciclo: [
        { text: "1º Ciclo", value: "1ciclo" },
        { text: "2º Ciclo", value: "2ciclo" }
      ],
      percentagensArray1Ciclo: [
        { text: "40% (5 horas)", value: "40" },
        { text: "30% (4 horas)", value: "30" },
        { text: "20% (3 horas)", value: "20" },
        { text: "15% (2 horas)", value: "15" }
      ],
      percentagensArray2Ciclo: [
        { text: "60% (8 horas)", value: "60" },
        { text: "55% (7 horas)", value: "55" },
        { text: "50% (6 horas)", value: "50" },
        { text: "40% (5 horas)", value: "40" },
        { text: "30% (4 horas)", value: "30" },
        { text: "20% (3 horas)", value: "20" },
        { text: "15% (2 horas)", value: "15" }
      ],
      propostaProponenteMonitor: {
        regime_prestacao_servicos: "tempo_parcial",
        percentagem_prestacao_servicos: "",
        duracao: "",
        periodo: "",
        proposta_proponente_id: "",
        ciclo: "",
         remuneracao: "",
        escalao: "",
        indice: "",
        verificacao_outras_uo:"",
        nome_uo:"",
        tempo_parcial_uo:"",
        periodo_uo:"",

        primeiro_proponente: this.$store.state.user.name
      },
      propostaExistente: {},
      dataFimContratoText: "",
      avancar: false,
      isShowMonitor: true
    };
  },
  //? Validations Vuelidate
  validations: {
    propostaProponenteMonitor: {
      percentagem_prestacao_servicos: { between: between(1, 100) },
      duracao: { required },
      periodo: { required },
      ciclo: { required }
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
    seguinte() {
      //* Mudar para o componente Resumo Proposta
      this.$v.$touch();
        if (this.propostaProponenteMonitor.verificacao_tempo_parcial == "nao") {
          this.propostaProponenteMonitor.tempo_parcial_uo == null;
        }
        if (this.propostaProponenteMonitor.verificacao_outras_uo == "nao") {
          this.propostaProponenteMonitor.nome_uo == null;
          this.propostaProponenteMonitor.verificacao_tempo_parcial == null;
          this.propostaProponenteMonitor.tempo_parcial_uo == null;
          this.propostaProponenteMonitor.periodo_uo == null;
        }

      if (!this.$v.$invalid) {
        this.avancar = true;
        this.isShowMonitor = false;
        this.$emit("incrementarBarraProgresso");
        this.$store.commit("setPropostaProponenteMonitor", this.propostaProponenteMonitor);
      }
    },
    anterior() {
      //* Mudar para o componente Proponente
       if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.$emit("mostrarProponente", this.proposta);
      }else{
		this.$emit("mostrarProponente");
	  }
    },
    mostrarComponente() {
      this.isShowMonitor = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.anterior();
      }
    },
    mostrarComponenteMonitor() {
      this.isShowMonitor = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
    },
    associarProposta() {
      //* Limpar Objectos
      Object.assign(this.propostaExistente, {});
      //* Associar vencimento à proposta
      Object.assign(this.propostaProponenteMonitor, this.propostaExistente);
    }
  },
  mounted() {
    Object.assign(this.propostaProponenteMonitor, this.$store.state.propostaProponenteMonitor);

    if (this.proposta.role == "monitor" && (this.$store.state.propostaExistente || this.$store.state.editarProposta)) {
      axios
        .get("/api/propostaProponenteMonitor/" + this.proposta.id_proposta_proponente)
        .then(response => {
          Object.assign(this.propostaProponenteMonitor, response.data);
        });
    }this.getVencimentos();
  }
};
</script>
