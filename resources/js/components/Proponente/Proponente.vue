<template>
  <div>
    <!--<button class="btn btn-danger" @click="voltar" v-if="voltarVar">Voltar</button>-->
    <br><br>
    <div v-if="isShow">
    <b-form-group
      description="Legislação: art. 8.º do ECPDESP na redacção que lhe foi dada pelo Decreto-Lei
n.º 207/2009, de 31 de Agosto, alterado pela Lei nº 7/2010, de 13 de Maio e
Regulamento de Contratação de Pessoal Docente Especialmente Contratado ao
abrigo do art. 8.º do ECPDESP, do IPL"
    ><h3>Proposta de contratação</h3></b-form-group>
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
      </b-form-group>
    <!--<b-form-group label="">
        <b-form-input :readonly="true" v-model="proposta.unidade_organica"></b-form-input>-->
    </b-form-group>
    <b-form-group label="Unidade Orgânica" label-for="inputTempoParcial">
          <b-form-select
            id="inputTempoParcial"
            readonly="true"
            v-model="proposta.unidade_organica"
            :state="!$v.proposta.unidade_organica.$error && null"
            :options="UnidadeOrganica"
          ></b-form-select>
          <b-form-invalid-feedback
            id="input-1-live-feedback"
          >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

      <b-form-group label="Nome completo">
        <b-form-input
          :state="!$v.proposta.nome_completo.$error && null"
          v-model="proposta.nome_completo"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O Nome completo é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group label="Departamento/Área Científica/ Curso">
        <b-form-input
          :state="!$v.proposta.departamento_curso.$error && null"
          v-model="proposta.departamento_curso"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O Nome Departamento/Área Científica/ Curso é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group label="Email" label-for="inputEmail">
        <b-form-input
          id="inputEmail"
          :state="!$v.proposta.email.$error && null"
          v-model="proposta.email"
        ></b-form-input>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >O Email é obrigatório e deve ser um email válido!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group label="Numero Telefone" label-for="inputNumeroTelefone">
        <b-form-input
          id="inputNumeroTelefone"
          :state="!$v.proposta.numero_telefone.$error && null"
          v-model="proposta.numero_telefone"
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
                  v-model="proposta.verificacao_serviço_docente_atribuido"
                  :options="verificacao_serviço_docente_atribuido"
                  stacked
                ></b-form-radio-group>
              </b-form-group>


              <b-form-group v-if="proposta.verificacao_serviço_docente_atribuido == 'nao'">
               
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

              <b-form-group>
              <div class="table-responsive">
                <table class="table mt-3" width="100%" v-if="unidadesCurriculares.length">
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
              </b-form-group>
              <br /></b-form-group>
              <div v-if="proposta.verificacao_serviço_docente_atribuido == 'sim'">
              <b-form-group label="Serviço Docente Atribuído (PDF)">
                    <b-form-file
                        v-model="ficheiroUnidadesCurricularesModel"
                        placeholder="Escolha um ficheiro"
                        drop-placeholder="Arraste para aqui um ficheiro"
                        browse-text="Procurar"
                        name="ficheiroUnidadesCurriculares"
                        v-validate="{ required: true }"
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
                        @click="downloadFicheiro(ficheiroUnidadesCurriculares.proposta_id, 'Ficheiro Unidades Curriculares do docente a ser contratado')"
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

              <b-form-group>
                <b-form-checkbox
                  v-model="grauTestDoutoramento"
                  value="doutoramento"
				  unchecked-value=""
                >Doutoramento</b-form-checkbox>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  
			  <b-form-group label="Curso do Doutoramento" label-for="inputCursoHabilitacoesLiterariasDoutoramento"
                v-if="grauTestDoutoramento">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasDoutoramento"
                 
                  v-model="proposta.curso_Doutoramento"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Curso é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  <b-form-group
                label="Área Científica Doutoramento"
                label-for="inputAreaCientificaHabilitacoesLiterariasDoutoramento"
				v-if="grauTestDoutoramento"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasDoutoramento"
                  v-model="proposta.area_cientificaDoutoramento"
                  ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">A Área Científica é obrigatória!</b-form-invalid-feedback>
			  </b-form-group>
			  
			  <b-form-group>
                <b-form-checkbox
                  v-model="grauTestOutro"
                  value="outro"
				  unchecked-value=""
                >Outro</b-form-checkbox>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
              <b-form-group label="Grau Outro" label-for="inputCursoHabilitacoesLiterariasOutro"
                v-if="grauTestOutro">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasOutro"
                  v-model="proposta.curso_Outro"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  <b-form-group
                label="Área Científica Outro"
                label-for="inputAreaCientificaHabilitacoesLiterariasOutro"
				v-if="grauTestOutro"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasOutro"
                  v-model="proposta.area_cientificaOutro"
                  ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">A Área Científica é obrigatória!</b-form-invalid-feedback>
			  </b-form-group>
			  
			  <b-form-group>
                <b-form-checkbox
                  v-model="grauTestFormacao"
                  value="em_formacao"
				  unchecked-value=""
                >Formação</b-form-checkbox>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
			  
			  <b-form-group label="Grau Formação" label-for="inputCursoHabilitacoesLiterariasFormacao"
                v-if="grauTestFormacao">
                <b-form-input
                  id="inputCursoHabilitacoesLiterariasFormacao"
                  v-model="proposta.curso_Formacao"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">O Grau é obrigatório!</b-form-invalid-feedback>
              </b-form-group>
              
              <b-form-group
                label="Área Científica Formação"
                label-for="inputAreaCientificaHabilitacoesLiterariasFormacao"
				v-if="grauTestFormacao"
              >
                <b-form-input
                  id="inputAreaCientificaHabilitacoesLiterariasFormacao"
                  v-model="proposta.area_cientificaFormacao"
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
          v-model="proposta.role"
          :options="rolesArray"
          :state="!$v.proposta.role.$error && null"
          stacked
        ></b-form-radio-group>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A seleção de uma unidade orgânica é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Tipo de Proposta" v-show="isShow">
      <b-form-radio-group
        v-model="proposta.tipo_contrato"
        :options="tipoContratosArray"
        :state="!$v.proposta.tipo_contrato.$error && null"
        stacked
      ></b-form-radio-group>
      <b-form-invalid-feedback id="input-1-live-feedback">O Tipo da Proposta é obrigatória!</b-form-invalid-feedback>
    </b-form-group>

      <button class="btn btn-danger mt-3 font-weight-bold" v-on:click.prevent="voltar" v-if="voltarVar"> Cancelar
      </button>

      <button
        class="btn btn-success mt-3 font-weight-bold"
        v-on:click.prevent="avancar(proposta)"
      >
        Seguinte
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>

    <proposta-proponente-professor
      :proposta="proposta"
      :unidadesCurriculares="unidadesCurriculares"
      :ficheiro="ficheiro"
      v-on:mostrarProponente="showComponent"
      v-on:incrementarBarraProgresso="progresso.valor++"
      v-on:decrementarBarraProgresso="progresso.valor--"
      v-if="roleSelecionado == 'professor' && isFinalized"
    ></proposta-proponente-professor>

    <proposta-proponente-assistente
      :proposta="proposta"
      :unidadesCurriculares="unidadesCurriculares"
      v-on:mostrarProponente="showComponent"
      :ficheiro="ficheiro"
      v-on:incrementarBarraProgresso="progresso.valor++"
      v-on:decrementarBarraProgresso="progresso.valor--"
      v-if="roleSelecionado == 'assistente' && isFinalized"
    ></proposta-proponente-assistente>

    <proposta-proponente-monitor
      :proposta="proposta"
      :unidadesCurriculares="unidadesCurriculares"
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
    <!-----------------------------FIM CONTRATAÇÃO INICIAL-------------------------------------->
  </div>
</template>
<script>
import { required, email, minLength, numeric } from "vuelidate/lib/validators";
export default {
  data() {
    return {
	  grauTest: [],
      grauTestDoutoramento: '',
		grauTestFormacao: '',
		grauTestOutro: '',
      //? Array de Objetos para Radio Buttons
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
        descricao: "",
        remuneracao: "",
        escalao: "",
        indice: "",
        verificacao_outras_uo:"",
        nome_uo:"",
        tempo_parcial_uo:"",
        periodo_uo:"",
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
      ficheiros: [],
      ficheiroUnidadesCurriculares: "",
      ficheiroHabilitacoes: "",
      ficheiroRelatorio: "",
      ficheiroUnidadesCurricularesModel: "",
      ficheiroRelatorioModel: "",
      voltarVar:true,
    };
  },
  //? Validations Vuelidate
  validations() {
	
    if (proposta.verificacao_outras_uo == "sim" ) {
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
      
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
          verificacao_serviço_docente_atribuido: {required},
      
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
    } else {
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
      
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
          verificacao_serviço_docente_atribuido: {required},

          curso_Outro: { required },
		  area_cientificaOutro: { required },
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
      
          remuneracao: { required, numeric },
          escalao: { required },
          indice: { required },
          verificacao_outras_uo: { required },
          nome_uo: { required },
          tempo_parcial_uo: { required },
          periodo_uo: { required },
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
	  }
  },
  methods: {
    voltar(){
      this.$emit('voltar');
      if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.$emit("voltar", this.proposta);
      }
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
    avancar: function(proposta, unidadesCurriculares) {
      //proposta.grau= this.grauTest[0] + this.grauTest[1] + this.grauTest[2];
		proposta.grau= this.grauTestDoutoramento + this.grauTestOutro + this.grauTestFormacao;
      
      axios.get('/api/verificarSeJaExistemPropostasAtivasParaDocenteASerContratado/' + proposta.email)
        .then(response => {
        if(!response.data){
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
        this.roleSelecionado = proposta.role;
        this.$v.proposta.$touch();
        this.$validator.validateAll().then(result => {
        if (result) {
          //if (!this.$v.proposta.$invalid) {
            this.$store.commit("setProposta", proposta);
            this.isFinalized = true;
            this.isShow = false;
            this.progresso.valor++;
            this.voltarVar = false;
          //}
        } else {
        //   this.$bvToast.toast('O formulário possui erros, por favor verifique!', {
        //   title: 'Mensagem de Erro',
        //   variant: 'danger',
        //   appendToast: true,
        //   solid: true
        // })
        }
      });
        }
        else{
          this.$swal('Erro', 'Já existe uma proposta pendente com esse email, por favor insira um email diferente', 'error');
        }
      })
      
          
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
    showComponent() {
      this.isShow = true;
      this.isFinalized = false;
      this.progresso.valor--;
      this.voltarVar = true;
       /*if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
         this.voltar();
       }*/
    },
    associarProposta() {
      //* Limpar Objectos
      this.unidadesCurriculares = [];
      Object.assign(this.propostaExistente, {});
      //* Associar proposta atual à proposta existente selecionada
      Object.assign(this.proposta, this.propostaExistente);
      this.proposta.data_de_assinatura_coordenador_de_curso = null;
      this.proposta.data_de_assinatura_coordenador_departamento = null;
      this.proposta.fundamentacao_coordenador_curso = null;
      this.proposta.fundamentacao_coordenador_departamento = null;
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
    }
  },
  mounted() {
    this.$store.commit('resetPropostaExistente');
    this.$store.commit('resetEditarProposta');
    
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
  }
};
</script>

<style >
.col-form-label,
.label,
.d-block {
  font-size: 20px;
  font-weight: 600;
}
.form-control:focus,
.custom-select:focus {
  color: #1a1a1a;
  background-color: #fff;
  border-color: #1a1a1a;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0);
}
.btn-dark {
  background-color: #1a1a1a;
}
</style>
