<template>
  
    <div>
      <div class="separator">
        <b-tabs content-class="mt-3" align="left">
          <b-tab title="Curso" active>
            
            <b-form-group label="Código de Curso" label-for="inputCodigoCurso">
              <b-form-input
                id="inputCodigoCurso"
                :state="$v.curso.codigo.$dirty ? !$v.curso.codigo.$error : null"
                v-model="curso.codigo"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">Código de curso obrigatorio</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Nome do Curso" label-for="inputNomeCurso">
              <b-form-input
                id="inputNomeCurso"
                :state="$v.curso.nome_curso.$dirty ? !$v.curso.nome_curso.$error : null"
                v-model="curso.nome_curso"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">Nome de curso obrigatorio</b-form-invalid-feedback>
            </b-form-group>

            <button class="btn btn-success mt-3 font-weight-bold" @click="voltar">Voltar</button>
            <button class="btn btn-success mt-3 font-weight-bold" v-on:click.prevent="criarCurso(curso)">Submeter
              <i class="fas fa-arrow-right"></i></button>
        </b-tab>
        <b-tab title="Unidade Curricular">
            <b-form-group label="Curso" label-for="inputCurso">
                <b-form-select
                    id="inputCurso"
                    v-model="unidadeCurricular.codigo_curso"
                    :state="!$v.unidadeCurricular.codigo_curso.$error && null"
                    :options="cursos"
                ></b-form-select>
                <b-form-invalid-feedback id="input-1-live-feedback">O Curso é obrigatório!</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Nome da Unidade Curricular" label-for="inputNomeUC">
              <b-form-input
                id="inputNomeUC"
                :state="$v.unidadeCurricular.nome.$dirty ? !$v.unidadeCurricular.nome.$error : null"
                v-model="unidadeCurricular.nome"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">Nome de UC obrigatorio</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Codigo da UC" label-for="inputCodigoUC">
              <b-form-input
                id="inputCodigoUC"
                :state="$v.unidadeCurricular.codigo.$dirty ? !$v.unidadeCurricular.codigo.$error : null"
                v-model="unidadeCurricular.codigo"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">Codigo de UC obrigatorio</b-form-invalid-feedback>
            </b-form-group>
             
             <button class="btn btn-success mt-3 font-weight-bold" @click="voltar">Voltar</button>
             <button class="btn btn-success mt-3 font-weight-bold" v-on:click.prevent="criarUC(unidadeCurricular)">Submeter
              <i class="fas fa-arrow-right"></i></button>
        </b-tab>  
        </b-tabs>
      </div>
	  <div>
			
    </div>
	</div>
</template>
<script>
import { required } from "vuelidate/lib/validators";

export default {
   data() {
        return {
            curso:{
                codigo:"",
                nome_curso:"",
            },
            unidadeCurricular:{
                codigo:"",
                nome:"",
                codigo_curso:"",
            },
            cursos:[]
        }
    },
    validations:{
        curso :{
            codigo:{ required },
            nome_curso: { required },
        },
        unidadeCurricular:{
            codigo: { required },
            nome:{ required },
            codigo_curso:{ required },
        }
    },
  methods: {
        voltar(){
            window.location.reload();
            console.log("olad");
            this.$emit('voltar');
            this.$emit("voltar", this.proposta);
        },
        criarCurso(curso){
            axios.post('/api/criarCurso', this.curso).then(response => {
                this.$swal('Sucesso', 'Curso criado com sucesso', 'success')
                this.$emit('fecharCurso');

            })
            .catch(error => {
                this.$swal('Erro', 'Já existe um curso com esse nome ou código', 'error')
            })
        },

        criarUC(unidadeCurricular){
            axios.post('/api/criarUC', unidadeCurricular).then(response => {
                this.$swal('Sucesso', 'UC criada com sucesso', 'success')
                this.$emit('fecharUcs');
            })
            .catch(error => {
                this.$swal('Erro', 'Já existe uma UC com esse nome ou código', 'error')
            });
        }
	},
  mounted(){
        axios.get("/api/cursosDisponiveis").then(response => {
            response.data.forEach(curso => {
                this.cursos.push({
                value: curso.codigo,
                text: curso.nome_curso
                });
            });
        });
    }
  }
</script>
<!--
<style lang="scss" scoped>
.main {
  font-size: 20px;
  font-family: "Montserrat", sans-serif;
}
</style>
