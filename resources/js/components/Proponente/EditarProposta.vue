<template>
  <div>
    <button class="btn btn-danger" @click="voltar">Voltar</button>
    <br><br>
    <!--
      <b-form-group label="Propostas existentes" description="Campo opcional">
        <b-form-select
          :options="propostasExistentes"
          v-model="propostaExistente"
          @change="associarProposta()"
        >
          <template slot="first">
            <option
              :value="null"
              disabled
            >-- Por favor selecione uma proposta existente, caso exista --</option>
          </template>
        </b-form-select>
      </b-form-group>-->
    <b-form-group
      description="Legislação: art. 8.º do ECPDESP na redacção que lhe foi dada pelo Decreto-Lei
      n.º 207/2009, de 31 de Agosto, alterado pela Lei nº 7/2010, de 13 de Maio e
      Regulamento de Contratação de Pessoal Docente Especialmente Contratado ao
      abrigo do art. 8.º do ECPDESP, do IPL"
    ><h3>Proposta de contratação</h3></b-form-group>
    <div v-if="isShow">

      
    <b-form-group label="Unidade Orgânica" label-for="inputTempoParcial">
          <b-form-select
            id="inputTempoParcial"
            readonly="true"
            v-model="propostaSelecionada.unidade_organica"
            :state="null"
            :options="UnidadeOrganica"
          ></b-form-select>
          <b-form-invalid-feedback
            id="input-1-live-feedback"
          >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
    </b-form-group>
      <b-form-group label="Nome completo">
        <b-form-input
          :state="null"
          v-model="propostaSelecionada.nome_completo"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O Nome completo é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group label="Departamento/Área Científica/ Curso">
        <b-form-input
          :state="null"
          v-model="propostaSelecionada.departamento_curso"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O Nome Departamento/Área Científica/ Curso é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      
      <b-form-group label="Email" label-for="inputEmail">
        <b-form-input
          id="inputEmail"
          :state="null"
          v-model="propostaSelecionada.email"
        ></b-form-input>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >O Email é obrigatório e deve ser um email válido!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Numero Telefone" label-for="inputNumeroTelefone">
        <b-form-input
          id="inputNumeroTelefone"
          :state="null"
          v-model="propostaSelecionada.numero_telefone"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O Numero de telefone é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-1 variant="dark">Serviço Docente Atribuído</b-button>
        </b-card-header>
        <b-collapse id="accordion-1" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
              <h3 class="pb-4">Serviço Docente Atribuído</h3>

               <b-form-group label="Deseja fazer upload do ficheiro de serviço do docente atribuido?">
                <b-form-radio-group
                  v-model="propostaSelecionada.verificacao_serviço_docente_atribuido"
                  :options="verificacao_serviço_docente_atribuido"
                  stacked
                ></b-form-radio-group>
              </b-form-group>


              <b-form-group v-if="propostaSelecionada.verificacao_serviço_docente_atribuido == 'nao'">
               
              <b-form-group label="Curso" label-for="inputCurso">
                <b-form-select
                  id="inputCurso"
                  v-model="unidadeCurricular.codigo_curso"
                  :state="!$v.unidadeCurricular.codigo_curso.$error && null"
                  :options="cursos"
                  @change="getUcsDeCurso(unidadeCurricular.codigo_curso)"
                ></b-form-select>
                <b-form-invalid-feedback id="input-1-live-feedback">O Curso é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Unidade Curricular" label-for="inputNomeUC">
                <b-form-select
                  id="inputNomeUC"
                  v-model="unidadeCurricular.codigo_uc"
                  :state="!$v.unidadeCurricular.codigo_uc.$error && null"
                  :options="ucs"
                ></b-form-select>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Nome da Unidade Curricular é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Regime">
                <b-form-select
                  v-model="unidadeCurricular.regime"
                  :state="!$v.unidadeCurricular.regime.$error && null"
                  :options="regimesParaUC"
                ></b-form-select>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Regime da Unidade Curricular é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Tipo">
                <b-form-select
                  v-model="unidadeCurricular.tipo"
                  :state="!$v.unidadeCurricular.tipo.$error && null"
                  :options="tiposParaUC"
                ></b-form-select>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Tipo da Unidade Curricular é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Turno">
                <b-form-input
                  :state="!$v.unidadeCurricular.turno.$error && null"
                  v-model="unidadeCurricular.turno"
                ></b-form-input>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Turno da Unidade Curricular é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Número de horas" label-for="inputNumeroHoras">
                <b-form-input
                  id="inputNumeroHoras"
                  :state="!$v.unidadeCurricular.horas.$error && null"
                  v-model="unidadeCurricular.horas"
                ></b-form-input>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Número de horas semanais é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group
                label="Número de horas (semestrais)"
                label-for="inputNumeroHorasSemestrais"
              >
                <b-form-input
                  id="inputNumeroHorasSemestrais"
                  :state="!$v.unidadeCurricular.horas_semestrais.$error && null"
                  v-model="unidadeCurricular.horas_semestrais"
                ></b-form-input>
                <b-form-invalid-feedback
                  id="input-1-live-feedback"
                >O Número de horas semestrais é obrigatório!</b-form-invalid-feedback>
              </b-form-group>

              <button
                class="btn btn-success mt-3 font-weight-bold"
                v-on:click.prevent="adicionarUC"
              >
                <i class="fas fa-plus"></i> Adicionar UC
              </button>

              <div v-if="unidadesCurriculares.length">
                <table class="table mt-3">
                  <thead>
                    <th>Código UC</th>
                    <th>Nome UC</th>
                    <th>Regime</th>
                    <th>Turno</th>
                    <th>Código Curso</th>
                    <th>Nome Curso</th>
                    <th>Horas</th>
                    <th>Horas Semestrais</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                  </thead>
                  <tbody>
                    <tr v-for="(ucAUX, index) in unidadesCurriculares" :key="ucAUX.id">
                      <td>{{ucAUX.codigo_uc.toString()}}</td>
                      <td>{{ucAUX.nome_uc}}</td>      
                      <td>{{ucAUX.regime}}</td>
                      <td>{{ucAUX.turno}}</td>
                      <td>{{ucAUX.codigo_curso}}</td>
                      <td>{{ucAUX.nome_curso}}</td>
                      <td>{{ucAUX.horas}}</td>
                      <td>{{ucAUX.horas_semestrais}}</td>
                      <td>{{ucAUX.tipo}}</td>
                      <td>
                        <button
                          type="button"
                          class="btn btn-danger"
                          v-on:click="removerUC(ucAUX, index)"
                        >Remover UC</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <br /></b-form-group>
              <div v-if="$store.state.editarProposta">
              
                 <b-form-group label="Serviço Docente Atribuído (PDF)">
                    <b-form-checkbox
                      id="checkBoxFundamentacao"
                      v-model="alterar.unidadesCurriculares"
                      name="checkBoxAlterar"
                      value="1"
                      unchecked-value="0"
                      :state="null"
                    >Alterar Ficheiro Serviço Docente Atribuído</b-form-checkbox>
                    <b-form-file
                        v-if="alterar.unidadesCurriculares==1"
                        v-model="ficheiroUnidadesCurricularesModel"
                        placeholder="Escolha um ficheiro"
                        drop-placeholder="Arraste para aqui um ficheiro"
                        accept=".pdf"
                        browse-text="Procurar"
                        name="ficheiroUnidadesCurriculares"
                        :state="validateState('ficheiroUnidadesCurriculares')"
                        @change="onFileSelected"
                    ></b-form-file>
                    <b-form-invalid-feedback id="input-1-live-feedback">O Ficheiro é obrigatório!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group>
                    <b-button
                        size="md"
                        variant="dark"
                        v-if="ficheiroUnidadesCurriculares"
                        @click="downloadFicheiro(ficheiroUnidadesCurriculares.proposta_id, 'Serviço do Docente Atribuído')"
                    >
                    <i class="far fa-file-pdf"></i> Atual Unidades Curriculares
                    </b-button>
                </b-form-group>
             
              </div>
              <div v-if="propostaSelecionada.verificacao_serviço_docente_atribuido == 'sim' && !$store.state.editarProposta">
              <b-form-group label="Serviço Docente Atribuído (PDF)">
                    <b-form-file
                        v-model="ficheiroUnidadesCurricularesModel"
                        placeholder="Escolha um ficheiro"
                        drop-placeholder="Arraste para aqui um ficheiro"
                        accept=".pdf"
                        browse-text="Procurar"
                        name="ficheiroUnidadesCurriculares"
                        :state="validateState('ficheiroUnidadesCurriculares')"
                        @change="onFileSelected"
                    ></b-form-file>
                    <b-form-invalid-feedback id="input-1-live-feedback">O Ficheiro é obrigatório!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group>
                    <b-button
                        size="md"
                        variant="dark"
                        v-if="ficheiroUnidadesCurriculares"
                        @click="downloadFicheiro(ficheiroUnidadesCurriculares.proposta_id, 'Serviço do Docente Atribuído')"
                    >
                    <i class="far fa-file-pdf"></i> Atual Unidades Curriculares
                    </b-button>
                </b-form-group>
                </div>
            </b-card-text>
          </b-card-body>
        </b-collapse>
      </b-card>

      <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-2 variant="dark">Habilitações Literárias</b-button>
        </b-card-header>
        <b-collapse id="accordion-2" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
              <h3 class="pb-4">Habilitações Literárias</h3>
              
                <table border="0px">
                    <tr>
                         <button
                            class="btn btn-success mt-3 font-weight-bold"
                            v-on:click="grauTestDoutoramento = !grauTestDoutoramento">Selecionar
                          </button>
                    </td>
                    <td v-if="grauTestDoutoramento">
                      <br>
			          <b-form-group>
                        <b-form-checkbox 
                        >Doutoramento</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td>
                    <td v-if="!grauTestDoutoramento">
                      <b-form-group>
                        <br>
                        <b-form-checkbox
                          v-model="grauTestDoutoramento"
                          value="false"
                        >Doutoramento</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td></tr>
                </table>
			  <b-form-group label="Curso" label-for="inputCursoHabilitacoesLiterariasDoutoramento"
                v-if="!grauTestDoutoramento">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasDoutoramento"
                 
                  v-model="propostaSelecionada.curso_Doutoramento"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Curso é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  <b-form-group
                label="Área Científica"
                label-for="inputAreaCientificaHabilitacoesLiterariasDoutoramento"
				v-if="!grauTestDoutoramento"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasDoutoramento"
                  v-model="propostaSelecionada.area_cientificaDoutoramento"
                  ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">A Área Científica é obrigatória!</b-form-invalid-feedback>
			  </b-form-group>
			  
              <table border="0px">
                    <tr>
                         <button
                            class="btn btn-success mt-3 font-weight-bold"
                            v-on:click="grauTestOutro = !grauTestOutro">Selecionar
                          </button>
                    </td>
                    <td v-if="grauTestOutro">
                      <br>
			          <b-form-group>
                        <b-form-checkbox 
                        >Outro</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td>
                    <td v-if="!grauTestOutro">
                      <b-form-group>
                        <br>
                        <b-form-checkbox
                          v-model="grauTestOutro"
                          value="false"
                        >Outro</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td></tr>
                </table>
              <b-form-group label="Grau" label-for="inputCursoHabilitacoesLiterariasOutro"
                v-if="!grauTestOutro">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasOutro"
                  v-model="propostaSelecionada.curso_Outro"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  <b-form-group
                label="Área Científica"
                label-for="inputAreaCientificaHabilitacoesLiterariasOutro"
				v-if="!grauTestOutro"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasOutro"
                  v-model="propostaSelecionada.area_cientificaOutro"
                  ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">A Área Científica é obrigatória!</b-form-invalid-feedback>
			  </b-form-group>
			  <table border="0px">
                    <tr>
                         <button
                            class="btn btn-success mt-3 font-weight-bold"
                            v-on:click="grauTestFormacao = !grauTestFormacao">Selecionar
                          </button>
                    </td>
                    <td v-if="grauTestFormacao">
                      <br>
			          <b-form-group>
                        <b-form-checkbox 
                        >Formação</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td>
                    <td v-if="!grauTestFormacao">
                      <b-form-group>
                        <br>
                        <b-form-checkbox
                          v-model="grauTestFormacao"
                          value="false"
                        >Formação</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
                      </b-form-group>
                    </td></tr>
                </table>
			  <b-form-group label="Grau" label-for="inputCursoHabilitacoesLiterariasFormacao"
                v-if="!grauTestFormacao">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasFormacao"
                  v-model="propostaSelecionada.curso_Formacao"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
              <b-form-group
                label="Área Científica"
                label-for="inputAreaCientificaHabilitacoesLiterariasFormacao"
				v-if="!grauTestFormacao"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasFormacao"
                  v-model="propostaSelecionada.area_cientificaFormacao"
                  ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">A Área Científica é obrigatória!</b-form-invalid-feedback>
              </b-form-group>
            </b-card-text>
          </b-card-body>
        </b-collapse>
      </b-card>
      

      <b-form-group
        label="Qual será o papel a desempenhar pelo docente a ser contratado?"
        class="mt-5"
      >
        <b-form-radio-group
          v-model="propostaSelecionada.role"
          :options="rolesArray"
          :state="null"
          stacked
        ></b-form-radio-group>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A seleção de uma unidade orgânica é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Tipo de Proposta" v-show="isShow">
          <b-form-radio-group
            v-model="propostaSelecionada.tipo_contrato"
            :options="tipoContratosArray"
            stacked
          ></b-form-radio-group>
          <b-form-invalid-feedback id="input-1-live-feedback">O Tipo da Proposta é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <button
        class="btn btn-success mt-3 font-weight-bold"
        v-on:click.prevent="avancar(propostaSelecionada, unidadesCurriculares)"
      >
        Seguinte
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>

    <proposta-proponente-professor
      :proposta="propostaSelecionada"
      :unidadesCurriculares="unidadesCurriculares"
      :ficheiro="ficheiro"
      :alterar="alterar"
      v-on:mostrarProponente="showComponent"
      v-on:incrementarBarraProgresso="progresso.valor++"
      v-on:decrementarBarraProgresso="progresso.valor--"
      v-if="roleSelecionado == 'professor' && isFinalized"
    ></proposta-proponente-professor>

    <proposta-proponente-assistente
      :proposta="propostaSelecionada"
      :unidadesCurriculares="unidadesCurriculares"
      :alterar="alterar"
      v-on:mostrarProponente="showComponent"
      :ficheiro="ficheiro"
      v-on:incrementarBarraProgresso="progresso.valor++"
      v-on:decrementarBarraProgresso="progresso.valor--"
      v-if="roleSelecionado == 'assistente' && isFinalized"
    ></proposta-proponente-assistente>

    <proposta-proponente-monitor
      :proposta="propostaSelecionada"
      :unidadesCurriculares="unidadesCurriculares"
      :alterar="alterar"
      v-on:mostrarProponente="showComponent"
      v-on:incrementarBarraProgresso="progresso.valor++"
      v-on:decrementarBarraProgresso="progresso.valor--"
      :ficheiro="ficheiro"
      v-if="roleSelecionado == 'monitor' && isFinalized"
    ></proposta-proponente-monitor>

    <b-progress class="mt-3" :max="progresso.max" height="2rem">
      <b-progress-bar :value="progresso.valor" variant="success">
        Progresso:
        <strong>{{ progresso.valor }} / {{ progresso.max }}</strong>
      </b-progress-bar>
    </b-progress>
    <br />
     Os dados recolhidos no âmbito deste processo têm como finalidade a celebração de contrato de trabalho em funções públicas e serão objeto de
tratamento nos termos da legislação de proteção de dados em vigor. 

  </div>
</template>

<script>
import { required, email, minLength, numeric } from "vuelidate/lib/validators";
export default {
  props: ["propostaSelecionada"],
  data() {
    return {
	  grauTest: [], 
      grauTestDoutoramento: 'true',
      grauTestFormacao: 'true',
	  grauTestOutro: 'true',
      //? Array de Objetos para Radio Buttons
      UnidadeOrganica: [
        { text: "ESECS", value: "ESECS" },
        { text: "ESTG", value: "ESTG" },
        { text: "SAD.CR", value: "ESAD.CR" },
        { text: "ESSLei", value: "ESSLei" },
        { text: "ESTM", value: "ESTM"}
      ],
      grausArray: [
        { text: "Doutoramento", value: "doutoramento" },
        { text: "Outro", value: "outro" },
        { text: "Em Formação", value: "em_formacao" }
      ],
      tipoContratosArray: [
        { text: "Contratação Inicial", value: "contratacao_inicial" },
        { text: "Renovação", value: "renovacao" },
        { text: "Alteração", value: "alteracao" }
      ],
      grausArray: [
        { text: "Doutoramento", value: "doutoramento" },
        { text: "Outro", value: "outro" },
        { text: "Em Formação", value: "em_formacao" }
      ],
      rolesArray: [
        { text: "Professor", value: "professor" },
        { text: "Assistente", value: "assistente" },
        { text: "Monitor", value: "monitor" }
      ],
      regimesParaUC: [
        { text: "Diurno", value: "Diurno" },
        { text: "Pós-laboral", value: "Pos-Laboral" }
      ],
      tiposParaUC: [
        { text: "Semestral", value: "Semestral" },
        { text: "Anual", value: "Anual" }
      ],
      verificacao_serviço_docente_atribuido: [
        { text: "Sim", value: "sim" },
        { text: "Não", value: "nao" }
      ],
     proposta: {
        tipo_contrato: "",
        unidade_organica: this.$store.state.user.unidade_organica,
        nome_completo: "",
        email: "",
        departamento_curso: "",
        numero_telefone: "",
        role: "",
        data_de_assinatura_coordenador_departamento: "",
        data_de_assinatura_coordenador_de_curso: "",
        fundamentacao_coordenador_curso: "",
        fundamentacao_coordenador_departamento: "",
        contrato_assinado_departamento:"",
        grau: "",
        area_cientificaDoutoramento: "",
		area_cientificaOutro: "",
		area_cientificaFormacao: "",
        curso_Doutoramento: "",
		curso_Outro: "",
		curso_Formacao: "",
        primeiro_proponente: this.$store.state.user.name,
		verificacao_area_cientifica: "sim",
		verificacao_curso: "sim",
      },
      propostaExistente: {},
      unidadeCurricular: {
        codigo_uc: "",
        nome_uc:"",
        regime: "",
        horas: "",
        horas_semestrais: "",
        codigo_curso: "",
        nome_curso: "",
        codigo_curso: "",
        turno: "",
        tipo: ""
      },
      unidadesCurriculares: [],
      habilitacoes: [],
      cursos: [],
      ucs: [],
      roleSelecionado: "",
      isFinalized: false,
      isShow: true,
      propostasExistentes: [],
      progresso: {
        valor: 1,
        max: 3
      },
      ficheiro: {
        fileRelatorio: {},
        fileUnidadesCurriculares: {},
        fileFundamentacao: {}
      },
      ficheiroTemporario: {
        fileRelatorioTemporario: {},
        fileUnidadesCurricularesTemporario: {},
        fileFundamentacaoTemporario: {}
      },
      ficheiros: [],
      ficheiroUnidadesCurriculares: "",
      alterar:{
        unidadesCurriculares: 0,
        fundamentacao: 0,
      },
      ficheiroUnidadesCurricularesTemporario: "",
      ficheiroUnidadesCurriculares: "",
      ficheiroUnidadesCurricularesModel: "",
    }
  },
  //? Validations Vuelidate
 validations() {
	
	if(this.proposta.grau.includes("doutoramento")){
      return {
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },
		  curso_Doutoramento: { required },
		  area_cientificaDoutoramento: { required },
      
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  }else if(this.proposta.grau.includes("outro")){
      return {
		
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },

          curso_Outro: { required },
		  area_cientificaOutro: { required },
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  } else{
      return {
		
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },
		  curso_Formacao: { required },
		  area_cientificaFormacao: { required },
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  }
      if(this.proposta.grau.includes("doutoramento")){
      return {
		
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },
		  curso_Doutoramento: { required },
		  area_cientificaDoutoramento: { required },
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  }else if(this.proposta.grau.includes("outro")){
      return {
		
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },

          curso_Outro: { required },
		  area_cientificaOutro: { required },
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  }else{
        return {
		
        proposta: {
          tipo_contrato: { required },
          unidade_organica: { required },
          nome_completo: { required },
          email: { required, email },
          departamento_curso: {required},
          numero_telefone: { required, minLength: minLength(9) },
          grau: { required },
          role: { required },
		  curso_Formacao: { required },
		  area_cientificaFormacao: { required },
        },
        unidadeCurricular: {
          codigo_curso: { required },
          codigo_uc: { required },
          regime: { required },
          tipo: { required },
          turno: { required },
          horas: { required },
          horas_semestrais: { required }
        }
      };
	  }
	  
  },
  methods: {
    voltar() {
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.$emit("voltar", this.proposta);
      }
    },
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
    },
    onFileSelected(event) {
      this.ficheiros[event.target.name] = event.target.files[0];
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
    getUcsDeCurso(codigo_curso) {
      this.ucs = [];

      axios
        .get("/api/unidadesCurricularesDoCursoSelecionado/" + codigo_curso)
        .then(response => {
          response.data.forEach(uc => {
            this.ucs.push({ text: uc.nome, value: uc.codigo });
          });
        });
    },
    showComponent() {
      this.isShow = true;
      this.isFinalized = false;
      this.progresso.valor--;
      this.voltarVar = true;

       if(this.propostaSelecionada.fundamentacao_coordenador_departamento != null || this.propostaSelecionada.fundamentacao_coordenador_curso != null){
         this.voltar();
       }
    },
    adicionarUC() {
      this.$v.unidadeCurricular.$touch();

      if (!this.$v.unidadeCurricular.$invalid) {
        axios.get('/api/unidadeCurricularNome/'+ this.unidadeCurricular.codigo_uc).then(response => {
          this.unidadeCurricular.nome_uc = response.data;
          axios.get('/api/getNomeCurso/' + this.unidadeCurricular.codigo_curso).then(response => {
            this.unidadeCurricular.nome_curso = response.data;
            this.unidadesCurriculares.push(this.unidadeCurricular);
            this.$v.unidadeCurricular.$reset();
        
            //* Colocar os campos vazios
            this.unidadeCurricular = {};
            this.ucs = [];
          });
        });
      }
    },
    removerUC(index) {
      delete this.unidadesCurriculares[index];
      this.unidadesCurriculares.splice(index, 1);
    },
    associarProposta() {
      //* Limpar Objectos
      this.unidadesCurriculares = [];
      Object.assign(this.propostaExistente, {});

      //* Associar proposta atual à proposta existente selecionada
      Object.assign(this.propostaSelecionada, this.propostaExistente);
      this.propostaSelecionada.data_de_assinatura_coordenador_de_curso = null;
      this.propostaSelecionada.data_de_assinatura_coordenador_departamento = null;
      this.propostaSelecionada.fundamentacao_coordenador_curso = null;
      this.propostaSelecionada.fundamentacao_coordenador_departamento = null;

      axios
        .get("/api/ficheiros/" + this.propostaExistente.id_proposta_proponente)
        .then(response => {
          response.data.forEach(ficheiro => {
            if (ficheiro.descricao == "Fundamentacao da Proposta Proponente"){
              this.ficheiroFundamentacao = ficheiro;
            }

            if (ficheiro.descricao == "Ficheiro Unidades Curriculares do docente a ser contratado"){
              this.ficheiroUnidadesCurriculares = ficheiro;
            }
            if (
              this.propostaSelecionada.tipo_contrato == "contratacao_inicial" &&
              ficheiro.descricao == "Habilitacoes do docente a ser contratado"
            ) {
              this.ficheiroHabilitacoes = ficheiro;
            }
          });
        });

      axios
        .get("/api/getUcsPropostaProponente/" + this.propostaExistente.id_proposta_proponente)
        .then(response => {
          response.data.forEach(uc => {
            this.unidadesCurriculares.push(uc);
          });
        });

        this.$store.commit('setPropostaExistente');
    },
    avancar: function(proposta, unidadesCurriculares) {
	    //proposta.grau= this.grauTest[0] + this.grauTest[1] + this.grauTest[2];
        
       if(!this.grauTestDoutoramento && !this.grauTestOutro && !this.grauTestFormacao){
                proposta.grau="doutoramentooutroem_formacao";
       }if(!this.grauTestDoutoramento && !this.grauTestOutro && this.grauTestFormacao){
                proposta.grau="doutoramentooutro";
                this.proposta.curso_Formacao = null;
                this.proposta.area_cientificaFormacao = null;
       }if(!this.grauTestDoutoramento && this.grauTestOutro && !this.grauTestFormacao){
                proposta.grau="doutoramentoem_formacao";
                this.proposta.curso_Outro = null;
                this.proposta.area_cientificaOutro = null;
       }if(!this.grauTestDoutoramento && this.grauTestOutro && this.grauTestFormacao){
                proposta.grau="doutoramento";
                this.proposta.curso_Formacao = null;
                this.proposta.area_cientificaFormacao = null;
                this.proposta.curso_Outro = null;
                this.proposta.area_cientificaOutro = null;
          
       }if(this.grauTestDoutoramento && !this.grauTestOutro && !this.grauTestFormacao){
                proposta.grau="outroem_formacao";
                this.proposta.curso_Doutoramento = null;
                this.proposta.area_cientificaDoutoramento = null;
       }if(this.grauTestDoutoramento && !this.grauTestOutro && this.grauTestFormacao){
                proposta.grau="outro";
                this.proposta.curso_Doutoramento = null;
                this.proposta.area_cientificaDoutoramento = null;
                this.proposta.curso_Formacao = null;
                this.proposta.area_cientificaFormacao = null;
       }if(this.grauTestDoutoramento && this.grauTestOutro && !this.grauTestFormacao){
                proposta.grau="em_formacao";
                this.proposta.curso_Doutoramento = null;
                this.proposta.area_cientificaDoutoramento = null;
                this.proposta.curso_Outro = null;
                this.proposta.area_cientificaOutro = null;
        }if(this.grauTestDoutoramento && this.grauTestOutro && this.grauTestFormacao){
                proposta.grau= null;
                this.proposta.curso_Doutoramento = null;
                this.proposta.area_cientificaDoutoramento = null;
                this.proposta.curso_Outro = null;
                this.proposta.area_cientificaOutro = null;
                this.proposta.curso_Formacao = null;
                this.proposta.area_cientificaFormacao = null;


        }
        
        if(proposta.verificacao_serviço_docente_atribuido == "sim"){
            this.unidadesCurriculares == null;
            
        }


        axios.delete("/api/deleteFicheirosTemporarios").then(response => {});
        //? Necessário o FormData para passar a informção do ficheiro para o backend "Laravel"
        this.ficheiro.fileUnidadesCurriculares = new FormData();
        this.ficheiro.fileUnidadesCurriculares.append(
            "file",
            this.ficheiros["ficheiroUnidadesCurriculares"]
        );
        this.ficheiro.fileUnidadesCurriculares.append(
            "descricao",
            "Ficheiro Unidades Curriculares do docente a ser contratado"
        );
        if(this.alterar.unidadesCurriculares==1){
         //? Necessário o FormData para passar a informção do ficheiro para o backend "Laravel"
         this.ficheiroTemporario.fileUnidadesCurricularesTemporario = new FormData();
         this.ficheiroTemporario.fileUnidadesCurricularesTemporario.append(
            "file",
            this.ficheiros["ficheiroUnidadesCurriculares"]
         );
         this.ficheiroTemporario.fileUnidadesCurricularesTemporario.append(
            "descricao",
            "UnidadesCurriculares"
         );

        axios.post("/api/ficheiroTemporario", this.ficheiroTemporario.fileUnidadesCurricularesTemporario).then(response => {});
        }
        this.roleSelecionado = proposta.role;
        //this.$v.propostaSelecionada.$touch();
        this.$validator.validateAll().then(result => {
            if (result) {
            //if (!this.$v.propostaSelecionada.$invalid && unidadesCurriculares.length > 0) {
                this.$store.commit("setProposta", proposta);
                this.isFinalized = true;
                this.isShow = false;
                this.progresso.valor++;
                this.voltarVar = false;
            //}
            } else {
                this.$bvToast.toast('O formulário possui erros, por favor verifique!', {
                title: 'Mensagem de Erro',
                variant: 'danger',
                appendToast: true,
                solid: true
                })
            }
        });
    },
  },
  mounted() {
    this.$store.commit('setEditarProposta');

    axios.get("/api/cursosDisponiveis").then(response => {
      response.data.forEach(curso => {
        this.cursos.push({
          value: curso.codigo,
          text: curso.nome_curso
        });
      });
    });

    axios.get("/api/allPropostasProponente").then(response => {
      response.data.forEach(proposta => {
        this.propostasExistentes.push({
          value: proposta,
          text:
            proposta.unidade_organica +
            " - " +
            proposta.nome_completo +
            " - " +
            proposta.role +
            " - " +
            proposta.tipo_contrato
        });
      });
    });

    axios
        .get("/api/getUcsPropostaProponente/" + this.propostaSelecionada.id_proposta_proponente)
        .then(response => {
          response.data.forEach(uc => {
            this.unidadesCurriculares.push(uc);
          });
        });

    axios
        .get("/api/ficheiros/" + this.propostaSelecionada.id_proposta_proponente)
        .then(response => {
          response.data.forEach(ficheiro => {
            if (this.propostaSelecionada.verificacao_serviço_docente_atribuido == "sim"){
                if (ficheiro.descricao == "Ficheiro Unidades Curriculares do docente a ser contratado"){
                  this.ficheiroUnidadesCurriculares = ficheiro;
                }   
            }
            if (this.propostaSelecionada.regime_prestacao_servicos == "tempo_integral" ||
                this.propostaSelecionada.regime_prestacao_servicos == "dedicacao_exclusiva"){
                if(ficheiro.descricao == "Fundamentacao da Proposta Proponente"){
                    this.ficheiroFundamentacao = ficheiro;
                }
            }
          });
        });
        if(this.propostaSelecionada.grau=="doutoramento" || this.propostaSelecionada.grau=="doutoramentooutro" || this.propostaSelecionada.grau=="doutoramentoem_formacao" || this.propostaSelecionada.grau=="doutoramentooutroem_formacao"){
            if(this.grauTestDoutoramento == "true"){
                this.grauTestDoutoramento = !this.grauTestDoutoramento;
            }
        }
        if(this.propostaSelecionada.grau=="outro" || this.propostaSelecionada.grau=="doutoramentooutro" || this.propostaSelecionada.grau=="outroem_formacao" || this.propostaSelecionada.grau=="doutoramentooutroem_formacao"){
            if(this.grauTestOutro == "true"){
                this.grauTestOutro = !this.grauTestOutro;
            }
        }
        if(this.propostaSelecionada.grau=="em_formacao" || this.propostaSelecionada.grau=="doutoramentoem_formacao" || this.propostaSelecionada.grau=="outroem_formacao" || this.propostaSelecionada.grau=="doutoramentooutroem_formacao"){
            if(this.grauTestFormacao == "true"){
                this.grauTestFormacao = !this.grauTestFormacao;
            }
        }
  }
}
</script>
