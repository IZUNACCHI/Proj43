<template>
  <div>
    <div class="jumbotron">


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
      :propostaProponenteMonitor="propostaProponenteMonitor"
      :ficheiro="ficheiro"
      v-on:mostrarComponente="mostrarComponente"
      v-on:mostrarPropostaProponente_vencimento="mostrarComponenteVencimento"
    ></resumo-proposta>

    </div>
  </div>
</template>
<script>
import { required, numeric } from "vuelidate/lib/validators";
export default {
  props:["propostaSelecionada"],
  data() {
    return {

    propostaRecursosHumanos: {
        
      }
    };
  },
  validations: {
    propostaProponente: {
      
      }
  },
  methods: {
    seguinte() {
      //* Mudar para o componente Resumo Proposta
      this.$v.$touch();
      if (!this.$v.$invalid) {
        this.avancar = true;
        this.isShowMonitor = false;
        this.$emit("incrementarBarraProgresso");
        this.$store.commit("setPropostaProponenteMonitor", this.propostaProponenteMonitor);
      }
    },
    anterior() {
      //* Mudar para o componente PropostaProponente*
      this.$emit("mostrarPropostaProponente_" + this.proposta.role);
    },
    mostrarComponente() {
      this.isShowVencimento = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.anterior();
      }
    },
    mostrarComponenteVencimento() {
      this.isShowVencimento = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
    } 
  }
};
</script>
