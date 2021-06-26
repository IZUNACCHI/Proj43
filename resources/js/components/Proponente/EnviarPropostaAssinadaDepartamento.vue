<template>
  <div>
    <h2 class="pb-4"> Ficheiros a inserir</h2>
    <h4 class="pb-4"> Por favor, insira os seguintes ficheiros para dar continuidade à proposta
        de contratação/renovação/alteração
    </h4>
    <b-form-group label="Ficheiro da Proposta Assinada" class="mt-3">
        <b-form-file
          v-model="ficheirosAInserir.fileAssinado"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          browse-text="Procurar"
          name="ficheiroAssinado"
          v-validate="{ required: true }"
          :state="validateState('ficheiroAssinado')"
          @change="onFileSelected"
        ></b-form-file>
      </b-form-group>
      <b-form-group>
        <b-button
          size="md"
          variant="dark"
          v-if="ficheiroAssinado"
          @click="downloadFicheiro(ficheiroAssinado.proposta_id, 'Proposta Assinado Coordenador Departamento')"
        >
          <i class="far fa-file-pdf"></i> Atual Ficheiro Assinado
        </b-button>
      </b-form-group>
    <b-form-group class="mt-5">
        <b-form-checkbox
          id="checkBoxIncricao"
          v-model="propostaProponente.contrato_assinado_departamento""
          name="checkBoxContratoAssinadoDepartamento"
          value="1"
          unchecked-value="0"
          :state="$v.propostaProponente.contrato_assinado_departamento.$dirty ? !$v.propostaProponente.contrato_assinado_departamento.$error : null"
        >Tomei Conhecimento que a proposta fica Definitiva</b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
    </b-form-group>
    <button
        class="btn btn-success mt-3 font-weight-bold"
        v-on:click.prevent="submeter(ficheirosAInserir)">
        Submeter Ficheiros
    </button>
    <button class="btn btn-success mt-3 font-weight-bold"
        @click="voltar">Voltar</button>
  </div>
</template>
<script>
import { required, email, minLength } from "vuelidate/lib/validators";
export default {
  props: ["propostaSelecionada"],
  data() {
    return {
      proposta:"",
      propostaProponente: {
        contrato_assinado_departamento: ""
      },
      ficheirosAInserir:{
        fileAssinado:{},
      },
      ficheiros:[],
      ficheiroAssinado:"",
      };
  },
  validations: {
    propostaProponente: {
      contrato_assinado_departamento: { required },
    }
  },
  methods: {
  
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
    voltar(){
      this.$emit('voltar');
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_departamento != null){
        this.$emit("voltar", this.proposta);
      }
    },
    submeter(ficheirosAInserir){
      this.$swal.fire({title:'Tem a certeza que pretende submeter estes dados?',
                        text: 'Não poderá realizar mais nenhuma alteração',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não'}).then((result) => {
          if(result.value){
              this.ficheirosAInserir.fileAssinado = new FormData();
              this.ficheirosAInserir.fileAssinado.append(
                "file",
                this.ficheiros["ficheiroAssinado"]
              );
              this.ficheirosAInserir.fileAssinado.append(
                "descricao",
                "Proposta Assinado Coordenador Departamento "
              );
              this.ficheirosAInserir.fileAssinado.append(
                "proposta_id",
                this.propostaSelecionada.id_proposta_proponente
              );

              axios.post('/api/ficheiro', this.ficheirosAInserir.fileAssinado).then(response => {
                axios.put('/api/propostaProponente/propostaAssinadaDepartamento/'+
                    this.propostaSelecionada.id_proposta_proponente, this.propostaProponente).then(response => {
                    this.$swal(
                        "Sucesso",
                        "Proposta concluida com sucesso!!",
                        "success"
                    )});
                    this.$emit('voltar');
                        if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_departamento != null){
                            this.$emit("voltar", this.proposta);
                        }
               });
          }
      });
    }
  },
  mounted() {
    this.$swal('Atenção', 'Tem apenas uma oportunidade de submeter corretamente todos os ficheiros necessários', 'info')
    }
};

</script>
