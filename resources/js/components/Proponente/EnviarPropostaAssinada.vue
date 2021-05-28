<template>
  <div>
    <h2 class="pb-4">Ficheiro a inserir</h2>
    <h4 class="pb-4"> Por favor, insira o ficheiro para dar continuidade à proposta
        de contratação/renovação/alteração </h4>
    <label><strong>Nome do Docente:</strong> {{ propostaSelecionada.nome_completo}}</label>
      <b-form-group label="Ficheiro da Proposta Assinada" class="mt-3">
        <b-form-file
          v-model="ficheiroAInserir.filePropostaAssinada"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          browse-text="Procurar"
          name="ficheiroPropostaAssinada"
          v-validate="{ required: true }"
          :state="validateState('ficheiroPropostaAssinada')"
          @change="onFileSelected"
        ></b-form-file>
      </b-form-group>
      <b-form-group>
        <b-button
          size="md"
          variant="dark"
          v-if="ficheiroPropostaAssinada"
          @click="downloadFicheiro(ficheiroPropostaAssinada.proposta_id, 'Proposta Assinada')">
          <i class="far fa-file-pdf"></i> Atual Proposta Assinada
        </b-button>
      </b-form-group>
    <button
        class="btn btn-success mt-3 font-weight-bold"
        v-on:click.prevent="submeter(ficheiroAInserir)">
        Submeter Ficheiro</button>
    <button class="btn btn-success mt-3 font-weight-bold"
        @click="voltar">Voltar</button>

  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
  props: ["propostaSelecionada"],
  data() {
    return {
      propostaDesteProponente:"",
      proposta:"",
      ficheiroAInserir:{
       filePropostaAssinada:{},
      },
      ficheiros:[],
      ficheiroPropostaAssinada:"",
    };
  },
  methods: {
    voltar(){
      this.$emit('voltar');
    },
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
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
    onFileSelected(event) {
      this.ficheiros[event.target.name] = event.target.files[0];
    },
    submeter(ficheiroAInserir){
        this.ficheiroAInserir.filePropostaAssinada = new FormData();
        let proposta_proponente_id = this.propostaSelecionada.id_proposta_proponente;
        
        this.ficheiroAInserir.filePropostaAssinada.append("file",this.ficheiros["ficheiropropostaAssinada"]);
        this.ficheiroAInserir.filePropostaAssinada.append("descricao","Proposta Assinada");
        this.ficheiroAInserir.filePropostaAssinada.append("proposta_id", proposta_proponente_id);
                
        if(result.value){
        axios.post('/api/ficheiro', this.ficheiroAInserir.filePropostaAssinada).then(response => {});
            this.$swal(
                "Sucesso",
                "Proposta assinada com sucesso!!",
                "success"
            );
            this.isLoading = false;
            this.voltar();
        }
    }
  },
};
</script>
