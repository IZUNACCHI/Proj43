<template>
  <div>
    <div v-show="isShowProfessor">
      <!--<h2 class="pb-4">Professor</h2>-->

       <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-1 variant="dark">Professor</b-button>
        </b-card-header>
        <b-collapse visible id="accordion-1" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
     
      <b-form-group label="Categoria específica do professor a ser contratado">
        <b-form-radio-group
          v-model="propostaProponenteProfessor.role_professor"
          :options="categoriaArray"
          :state="!$v.propostaProponenteProfessor.role_professor.$error && null"
          stacked
        ></b-form-radio-group>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A seleção de uma categoria é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Regime de prestação de serviços">
        <b-form-radio-group
          v-model="propostaProponenteProfessor.regime_prestacao_servicos"
          :options="regimePrestacaoServicosArray"
          :state="!$v.propostaProponenteProfessor.regime_prestacao_servicos.$error && null"
          stacked
        ></b-form-radio-group>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A seleção do regime de prestações de serviço é obrigatória!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Percentagem de tempo parcial"
        label-for="inputTempoParcial"
        v-if="propostaProponenteProfessor.regime_prestacao_servicos == 'tempo_parcial'">
          <b-form-select
            id="inputTempoParcial"
            v-model="propostaProponenteProfessor.percentagem_prestacao_servicos"
            :state="!$v.propostaProponenteProfessor.percentagem_prestacao_servicos.$error && null"
            :options="percentagensArray"
          ></b-form-select>
          <b-form-invalid-feedback
            id="input-1-live-feedback"
          >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
          <b-form-select
            width="100%"
            id="inputTempoParcial"
            v-model="propostaProponenteProfessor.percentagem_prestacao_servicos_2"
            :state="null"
            :options="percentagensArray"
          ></b-form-select>
      </b-form-group>
      <b-form-group class="mt-5">
        <b-form-checkbox
          v-if="propostaProponenteProfessor.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteProfessor.regime_prestacao_servicos == 'dedicacao_exclusiva' "
          id="checkBoxFundamentacao"
          v-model="propostaProponenteProfessor.fundamentacao"
          name="checkBoxFundamentacao"
          value="1"
          unchecked-value="0"
          :state="null"
        ><b>Fundamentação</b> <i>(cfr. acta do CTC - art. 5º, nº3) N.B Contrato e renovações não podem ter duração superior a 4 anos</i> </b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
        
        
      
      <b-form-group
        v-if="propostaProponenteProfessor.fundamentacao == '1'"
      >

        <b-form-group>
        <b-form-file
          v-model="ficheiroFundamentacaoProfessorModel"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          browse-text="Procurar"
          name="ficheiroFundamentacaoProfessor"
          v-validate="{ required: true }"
          :state="validateState('ficheiroFundamentacaoProfessor')"
          @change="onFileSelected"
        ></b-form-file>
        <b-form-invalid-feedback id="input-1-live-feedback">O Ficheiro é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group>
        <b-button
         size="md"
         variant="dark"
         v-if="ficheiroFundamentacao"
         @click="downloadFicheiro(ficheiroFundamentacao.proposta_id, 'Fundamentacao da Proposta Proponente')"
        >
          <i class="far fa-file-pdf"></i> Atual Ficheiro de Fundamentação
                    </b-button>
                </b-form-group>

      </b-form-group>

      <!--
        <b-form-textarea
          v-model="propostaProponenteProfessor.fundamentacao"
          :state="!$v.propostaProponenteProfessor.fundamentacao.$error && null"
        ></b-form-textarea>
        <b-form-invalid-feedback id="input-1-live-feedback">A fundamentação é obrigatória!</b-form-invalid-feedback>-->
      </b-form-group>
      
      <b-form-group label="Duração do contrato" label-for="inputDuracaoContrato">
        <b-form-input
          id="inputDuracaoContrato"
          :state="!$v.propostaProponenteProfessor.duracao.$error && null"
          v-model="propostaProponenteProfessor.duracao"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">A duração do contrato é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Periodo" label-for="inputPeriodo"  description="Ex: 01/01/2022 a 31/12/2022">
        <b-form-input
          id="inputPeriodo"
          :state="!$v.propostaProponenteProfessor.periodo.$error && null"
          v-model="propostaProponenteProfessor.periodo"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O periodo do contrato é obrigatório!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group
        label="Avaliação período anterior"
        label-for="inputAvaliacao"
        v-if="proposta.tipo_contrato == 'renovacao' || proposta.tipo_contrato == 'alteracao'">
        <b-form-select
          id="inputAvaliacao"
          v-model="propostaProponenteProfessor.avaliacao_periodo_anterior"
          :options="avaliacao_periodo_anterior_array"
        ></b-form-select>
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
    
                <b-form-group label="Categoria" label-for="inputEscalao">
                <b-form-input
                  id="inputEscalao"
                  :state="null"
                  v-model="proposta.descricao"
                  disabled
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um escalão</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Remuneração" label-for="inputRemuneracao">
                <b-form-input
                  id="inputRenumeracao"
                  :state="null"
                  v-model="proposta.renumeracao"
                  disabled
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira a remuneração em formato numérico!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Escalão" label-for="inputEscalao">
                <b-form-input
                  id="inputEscalao"
                  :state="null"
                  v-model="proposta.escalao"
                  disabled
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um escalão</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Índice" label-for="inputIndice">
                <b-form-input
                  id="inputIndice"
                  :state="null"
                  v-model="proposta.indice"
                  disabled
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um índice</b-form-invalid-feedback>
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
              <b-form-group label="O docente proposto já se encontra/ja foi convidado a exercer funções numa outra UO do IPL?">
                <b-form-radio-group
                  v-model="proposta.verificacao_outras_uo"
                  :options="verificacao_outras_uo_array"
                  stacked
                ></b-form-radio-group>
              </b-form-group>
              <b-form-group v-if="proposta.verificacao_outras_uo == 'sim'">
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESECS'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="proposta.nome_uo"
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
                    v-model="proposta.nome_uo"
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
                    v-model="proposta.nome_uo"
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
                    v-model="proposta.nome_uo"
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
                    v-model="proposta.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESTM"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
            
            <b-form-group label="O docente esta a tempo Parcial?">
                <b-form-radio-group
                  v-model="proposta.verificacao_tempo_parcial"
                  :options="verificacao_tempo_parcial"
                  stacked
                ></b-form-radio-group>
              </b-form-group>

             
               


                <b-form-group
                    label="Indique o tempo parcial"
                    label-for="inputTempoParcial"
                    v-if="proposta.verificacao_tempo_parcial == 'sim'">
                      <b-form-select
                        id="inputTempoParcial"
                        v-model="proposta.tempo_parcial_uo"
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
                    v-model="proposta.periodo_uo"
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
      :propostaProponenteProfessor="propostaProponenteProfessor"
      :ficheiro="ficheiro"
      v-on:mostrarComponente="mostrarComponente"
      v-on:mostrarPropostaProponente_professor="mostrarComponenteProfessor"
    ></resumo-proposta>
  </div>
</template>
<script>
import { required } from "vuelidate/lib/validators";

export default {
  props: ["proposta", "unidadesCurriculares", "ficheiro"],
  data() {
    return {
    
      listaVencimentos:[],
      verificacao_fundamentacao: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      verificacao_outras_uo_array: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      verificacao_tempo_parcial: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
      verificacao_serviço_docente_atribuido: [
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
      categoriaArray: [
        { text: "Coordenador", value: "coordenador" },
        { text: "Adjunto", value: "adjunto" },
        { text: "Visitante", value: "visitante" }
      ],
      regimePrestacaoServicosArray: [
        { text: "Tempo Integral", value: "tempo_integral" },
        { text: "Tempo Parcial", value: "tempo_parcial" },
        { text: "Dedicação Exclusiva", value: "dedicacao_exclusiva" }
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
      avaliacao_periodo_anterior_array: [
        { text: "Positiva", value: "positiva"},
        { text: "Negativa", value: "negativa"},
      ],
      propostaProponenteProfessor: {
        role_professor: "",
        regime_prestacao_servicos: "",
        percentagem_prestacao_servicos: "",
        percentagem_prestacao_servicos_2: "",
        duracao: "",
        periodo: "",
        proposta_proponente_id: "",
        avaliacao_periodo_anterior:"",
        fundamentacao: 0,
     /*   remuneracao: "",
        escalao: "",
        indice: "",
        verificacao_outras_uo:"",
        nome_uo:"",
        tempo_parcial_uo:"",
        periodo_uo:"",
       */ primeiro_proponente: this.$store.state.user.name,
      },
      ficheiroProponenteProfessor: {
        fileRelatorio: {},
        fileFundamentacao: {}
      },
      propostaExistente: {},
      ficheirosProfessor: [],
      ficheiroFundamentacao: "",
      ficheiroFundamentacaoProfessor: "",
      ficheiroFundamentacaoProfessorModel: "",
      
      avancar: false,
      isShowProfessor: true
    };
  },
  //? Validations Vuelidate
  validations() {
    // if(this.proposta.tipo_contrato == 'renovacao' || this.proposta.tipo_contrato == 'alteracao'){
    //   return{
    //     propostaProponenteProfessor: {
    //       avaliacao_periodo_anterior: { required },
    //     }
    //   };
    // }
     if (
      this.propostaProponenteProfessor.regime_prestacao_servicos ==
        "tempo_integral" ||
      this.propostaProponenteProfessor.regime_prestacao_servicos ==
        "dedicacao_exclusiva"
    ) {
      return {
        propostaProponenteProfessor: {
          role_professor: { required },
          regime_prestacao_servicos: { required },
          //fundamentacao: { required },
          duracao: { required },
          periodo: { required }
        }
      };
    } else {
      return {
        propostaProponenteProfessor: {
          role_professor: { required },
          regime_prestacao_servicos: { required },
          percentagem_prestacao_servicos: { required },
          duracao: { required },
          periodo: { required }
        }
      };
    
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
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
    },
    onFileSelected(event) {
      this.ficheirosProfessor[event.target.name] = event.target.files[0];
    },
    downloadFicheiro(proposta_id, descricao) {
      axios
        .get("/api/downloadFicheiro/" + proposta_id + "/" + descricao, {
          responseType: "arraybuffer"
        })
        .then(response => {
          let blob = new Blob([response.data]);
          let link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          link.download = descricao + ".pdf";
          link.click();
        });
    },
    seguinte() {
      //* Mudar para o componente Resumo Proposta
      this.$v.$touch();
      if (!this.$v.$invalid) {
        if (
          this.propostaProponenteProfessor.regime_prestacao_servicos ==
            "tempo_integral" ||
          this.propostaProponenteProfessor.regime_prestacao_servicos ==
            "dedicacao_exclusiva"
        ) {
          this.propostaProponenteProfessor.percentagem_prestacao_servicos =
            "100";
        }
            //if(this.propostaProponenteProfessor.fundamentacao=='1'){
            //? Necessário o FormData para passar a informção do ficheiro para o backend "Laravel"
            this.ficheiroProponenteProfessor.fileFundamentacao = new FormData();
            this.ficheiroProponenteProfessor.fileFundamentacao.append(
                "file",
                this.ficheirosProfessor["ficheiroFundamentacaoProfessor"]
            );
            this.ficheiroProponenteProfessor.fileFundamentacao.append(
                "descricao",
                "Fundamentacao da Proposta Proponente"
            );

            this.ficheiro.fileFundamentacao = new FormData();
            this.ficheiro.fileFundamentacao.append(
                "file",
                this.ficheirosProfessor["ficheiroFundamentacaoProfessor"]
            );
            this.ficheiro.fileFundamentacao.append(
                "descricao",
                "Fundamentacao da Proposta Proponente"
            );

        //}


        this.avancar = true;
        this.isShowProfessor = false;
        this.$emit("incrementarBarraProgresso");
        this.$store.commit("setPropostaProponenteProfessor", this.propostaProponenteProfessor);
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
      this.isShowProfessor = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.anterior();
      }
    },
    mostrarComponenteProfessor() {
      this.isShowProfessor = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
    },
    associarProposta() {
      //* Limpar Objectos
      Object.assign(this.propostaExistente, {});
      //* Associar vencimento à proposta
      Object.assign(this.proposta, this.propostaExistente);
      }
  },
  mounted() {
    Object.assign(this.propostaProponenteProfessor, this.$store.state.propostaProponenteProfessor);

    //? Se selecionou uma proposta existente
    if (this.proposta.role == "professor" && (this.$store.state.propostaExistente || this.$store.state.editarProposta)) {
      axios
        .get("/api/propostaProponenteProfessor/" + this.proposta.id_proposta_proponente)
        .then(response => {
          Object.assign(this.propostaProponenteProfessor, response.data);
        });
      axios
        .get("/api/ficheiros/" + this.proposta.id_proposta_proponente)
        .then(response => {
          response.data.forEach(ficheiro => {
            if (ficheiro.descricao == "Fundamentacao da Proposta Proponente"){
              this.ficheiroFundamentacao = ficheiro;
            }
          });
        });
      this.propostaExistente=this.proposta.descricao;
    }
	this.getVencimentos();
	
  }
};
</script>
