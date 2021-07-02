<template>
  <div>
    <div v-show="isShowProfessor">
      <h2 class="pb-4">Professor</h2>
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
      <b-form-group
        label="Fundamentação"
        description="(cfr. acta do CTC - art. 5º, nº3) N.B Contracto e renovações não podem ter duração superior a 4 anos"
        v-if="propostaProponenteProfessor.regime_prestacao_servicos == 'tempo_integral' ||
        propostaProponenteProfessor.regime_prestacao_servicos == 'dedicacao_exclusiva'"
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
                        v-if="ficheiro"
                        @click="downloadFicheiro(proposta.id_proposta_proponente, 'Fundamentacao da Proposta Proponente')"
                    >
                    <i class="far fa-file-pdf"></i> Atual Ficheiro de Fundamentação
                    </b-button>
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

      <b-form-group label="Periodo" label-for="inputPeriodo"  description="Ex: 13/03/2000 a 28/07/2000">
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
        fundamentacao: "",
        duracao: "",
        periodo: "",
        proposta_proponente_id: "",
        avaliacao_periodo_anterior:"",
      },
      ficheiroProponenteProfessor: {
        fileRelatorio: {},
        fileFundamentacao: {}
      },
      ficheirosProfessor: [],
      ficheiroFun: "",
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
            if (this.proposta.regime_prestacao_servicos == "tempo_integral" ||
                this.proposta.regime_prestacao_servicos == "dedicacao_exclusiva"){
                if(ficheiro.descricao == "Fundamentacao da Proposta Proponente"){
                    this.ficheiroFun = ficheiro;
                }
            }
      });
    }
  }
};
</script>
