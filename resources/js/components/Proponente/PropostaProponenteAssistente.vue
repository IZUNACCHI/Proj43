<template>
  <div>
    <div v-show="isShowAssistente">

     <b-card no-body class="mb-1">
        <b-card-header header-tag="header" class="p-1" role="tab">
          <b-button block href="#" v-b-toggle.accordion-1 variant="dark">Assistente</b-button>
        </b-card-header>
        <b-collapse visible id="accordion-1" accordion="accordion" role="tabpanel">
          <b-card-body>
            <b-card-text>
      <b-form-group label="Regime de prestação de serviços">
        <b-form-radio-group
          v-model="propostaProponenteAssistente.regime_prestacao_servicos"
          :options="regimePrestacaoServicosArray"
          :state="!$v.propostaProponenteAssistente.regime_prestacao_servicos.$error && null"
          stacked
        ></b-form-radio-group>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A seleção do regime de prestaões de serviço é obrigatória!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Percentagem de tempo parcial"
        label-for="inputTempoParcial"
        v-if="propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60'"
      >
        <b-form-select
          id="inputTempoParcial"
          v-model="propostaProponenteAssistente.percentagem_prestacao_servicos"
          :state="!$v.propostaProponenteAssistente.percentagem_prestacao_servicos.$error && null"
          :options="percentagensArraySuperiorA60"
        ></b-form-select>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
      </b-form-group>
      <b-form-group
        label="Percentagem de tempo parcial"
        label-for="inputTempoParcial"
        v-if="propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial'"
      >
        <b-form-select
          id="inputTempoParcial"
          v-model="propostaProponenteAssistente.percentagem_prestacao_servicos"
          :state="!$v.propostaProponenteAssistente.percentagem_prestacao_servicos.$error && null"
          :options="percentagensArray"
        ></b-form-select>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
        <b-form-select
          id="inputTempoParcial"
          v-model="propostaProponenteAssistente.percentagem_prestacao_servicos_2"
          :state="null"
          :options="percentagensArray"
        ></b-form-select>
        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >A percentagem de tempo parcial é obrigatória!</b-form-invalid-feedback>
      
      </b-form-group>
       <div v-if= $store.state.editarProposta>
        <div>
              
                 <b-form-group label="Serviço Docente Atribuído (PDF)" 
                      v-if="(propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                            propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                            propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva')">
                <b-form-checkbox
                      v-if="(propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                            propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                             propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva') &&
                             $store.state.editarProposta"
                      id="checkBoxFundamentacao"
                      v-model="propostaProponenteAssistente.fundamentacao"
                      name="checkBoxFundamentacao"
                      value="1"
                      unchecked-value="0"
                      :state="null"
                      ><b>Fundamentação</b> <i>(cfr. acta do CTC - art. 5º, nº3) N.B Contrato e renovações não podem ter duração superior a 4 anos</i> </b-form-checkbox>
                    <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
                    <b-form-checkbox
                      v-if="$store.state.editarProposta && propostaProponenteAssistente.fundamentacao=='1'"


                      id="checkBoxAlterarFundamentacao"
                      v-model="alterar.fundamentacao"
                      name="checkBoxAlterar.fundamentacao"
                      value="1"
                      unchecked-value="0"
                      :state="null"
                    ><b>Alterar Ficheiro Fundamentação</b> </b-form-checkbox>
        
                    <b-form-file
                        v-if="alterar.fundamentacao==1"
                        v-model="ficheiroFundamentacaoAssistenteModel"
                        placeholder="Escolha um ficheiro"
                        drop-placeholder="Arraste para aqui um ficheiro"
                        accept=".pdf"
                        browse-text="Procurar"
                        name="ficheiroFundamentacaoAssistente"
                        :state="validateState('ficheiroFundamentacaoAssistente')"
                        @change="onFileSelected"
                    ></b-form-file>
                    <b-form-invalid-feedback id="input-1-live-feedback">O Ficheiro é obrigatório!</b-form-invalid-feedback>
                </b-form-group>
                <b-form-group>
                    <b-button
                        size="md"
                        variant="dark"
                        v-if="$store.state.editarProposta  && propostaProponenteAssistente.fundamentacao=='1'"
                        @click="downloadFicheiro(ficheiroFundamentacaoAssistente.proposta_id, 'Fundamentacao da Proposta Proponente')"
                    >
                    <i class="far fa-file-pdf"></i> Atual Fundamentação do Assistente
                    </b-button>
                </b-form-group>
                <b-form-group>
                   <b-button
                     size="md"
                     variant="dark"
                     v-if="!$store.state.editarProposta  && ficheiroFundamentacao"
                     @click="downloadFicheiro(ficheiroFundamentacao.proposta_id, 'Fundamentacao da Proposta Proponente')"
                   >
                   <i class="far fa-file-pdf"></i> Atual Fundamentação do Assistente
                   </b-button>
                 </b-form-group>
              </div></div>
       <div v-if= !$store.state.editarProposta>
       <div v-if="( propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva')">
       <b-form-group class="mt-5">
        <h2>Serviço Docente Atribuído (PDF)</h2>
        <b-form-checkbox
          v-if="(propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva') "
          id="checkBoxFundamentacao"
          v-model="propostaProponenteAssistente.fundamentacao"
          name="checkBoxFundamentacao"
          value="1"
          unchecked-value="0"
          :state="null"
        >
        <b>Fundamentação</b> <i>(cfr. acta do CTC - art. 5º, nº3) N.B Contrato e renovações não podem ter duração superior a 4 anos</i> </b-form-checkbox>
        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
        
        <b-form-group>
        <b-form-file
          v-if="(propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva') &&
                propostaProponenteAssistente.fundamentacao == '1'"
          v-model="ficheiroFundamentacaoAssistenteModel"
          placeholder="Escolha um ficheiro"
          drop-placeholder="Arraste para aqui um ficheiro"
          accept=".pdf"
          browse-text="Procurar"
          name="ficheiroFundamentacaoAssistente"
          v-validate="{ required: true }"
          :state="validateState('this.ficheiroFundamentacaoAssistente')"
          @change="onFileSelected"
        ></b-form-file>
        <b-form-invalid-feedback id="input-1-live-feedback">O Ficheiro é obrigatório!</b-form-invalid-feedback>
      </b-form-group>
      
      <b-form-group>
        <b-button
          size="md"
          variant="dark"
          v-if="(propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva') &&
                propostaProponenteAssistente.fundamentacao == '1' && ficheiroFundamentacao"
          @click="downloadFicheiro(ficheiroFundamentacao.proposta_id, 'Fundamentacao da Proposta Proponente')"
        >
        <i class="far fa-file-pdf"></i> Atual Fundamentação do Assistente
        </b-button>
      </b-form-group>
      </b-form-group>
      </div>
      </div>




      <!--
        <b-form-textarea
          v-model="propostaProponenteAssistente.fundamentacao"
          :state="!$v.propostaProponenteAssistente.fundamentacao.$error && null"
        ></b-form-textarea>
        <b-form-invalid-feedback id="input-1-live-feedback">A fundamentação é obrigatória!</b-form-invalid-feedback>-->
      </b-form-group>
      
      <b-form-group label="Duração do contrato" label-for="inputDuracaoContrato">
        <b-form-input
          id="inputDuracaoContrato"
          :state="!$v.propostaProponenteAssistente.duracao.$error && null"
          v-model="propostaProponenteAssistente.duracao"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">A duração do contrato é obrigatória!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group label="Periodo" label-for="inputPeriodo" description="Ex: 01/01/2022 a 31/12/2022">
        <b-form-input
          id="inputPeriodo"
          :state="!$v.propostaProponenteAssistente.periodo.$error && null"
          v-model="propostaProponenteAssistente.periodo"
        ></b-form-input>
        <b-form-invalid-feedback id="input-1-live-feedback">O periodo do contrato é obrigatório!</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group
        label="Avaliação período anterior"
        label-for="inputAvaliacao"
        v-if="proposta.tipo_contrato == 'renovacao' || proposta.tipo_contrato == 'alteracao'">
        <b-form-select
          id="inputAvaliacao"
          v-model="propostaProponenteAssistente.avaliacao_periodo_anterior"
          :state="null"
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
    <!--
                <b-form-group label="Categoria" label-for="inputEscalao">
                <b-form-input
                  id="inputEscalao"
                  :state="null"
                  v-model="propostaProponenteAssistente.descricao"
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
                      <td colspan="2">{{propostaProponenteAssistente.descricao}}</td>      
                    </tr>
                    <th>Remuneração</th>
                    <th>Indice</th>
                    <th>Escalão</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{propostaProponenteAssistente.remuneracao}}</td>
                      <td>{{propostaProponenteAssistente.indice}}</td>      
                      <td>{{propostaProponenteAssistente.escalao}}</td>
                      
                    </tr>
                  </tbody>
                </table>
              </div>
              </b-form-group>
        <!--      <b-form-group label="Remuneração" label-for="inputRemuneracao">
                <b-form-input
                  id="inputRemuneracao"
                  :state="null"
                  v-model="proposta.remuneracao"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira a remuneração em formato numérico!</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Escalão" label-for="inputEscalao">
                <b-form-input
                  id="inputEscalao"
                  :state="null"
                  v-model="proposta.escalao"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um escalão</b-form-invalid-feedback>
              </b-form-group>

              <b-form-group label="Índice" label-for="inputIndice">
                <b-form-input
                  id="inputIndice"
                  :state="null"
                  v-model="proposta.indice"
                ></b-form-input>
                <b-form-invalid-feedback id="input-1-live-feedback">Insira um índice</b-form-invalid-feedback>
              </b-form-group>-->
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
                  v-model="propostaProponenteAssistente.verificacao_outras_uo"
                  :options="verificacao_outras_uo_array"
                  stacked
                ></b-form-radio-group>
              </b-form-group>
              <b-form-group v-if="propostaProponenteAssistente.verificacao_outras_uo == 'sim'">
                <b-form-group
                    label="Indique o nome da Unidade Orgânica"
                    label-for="inputTempoParcial"
                    v-if="proposta.unidade_organica == 'ESECS'"
                >
                <b-form-select
                    id="inputTempoParcial"
                    v-model="propostaProponenteAssistente.nome_uo"
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
                    v-model="propostaProponenteAssistente.nome_uo"
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
                    v-model="propostaProponenteAssistente.nome_uo"
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
                    v-model="propostaProponenteAssistente.nome_uo"
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
                    v-model="propostaProponenteAssistente.nome_uo"
                    :state="null"
                    :options="UnidadeOrganicaESTM"
                ></b-form-select>
                <b-form-invalid-feedback
                    id="input-1-live-feedback"
                >Tem de escolher uma Unidade Organica!</b-form-invalid-feedback>
                </b-form-group>
            
            <b-form-group label="O docente esta a tempo Parcial?">
                <b-form-radio-group
                  v-model="propostaProponenteAssistente.verificacao_tempo_parcial"
                  :options="verificacao_tempo_parcial"
                  stacked
                ></b-form-radio-group>
              </b-form-group>

              <b-form-group
                label="Indique o tempo parcial"
                label-for="inputTempoParcial"
                v-if="propostaProponenteAssistente.verificacao_tempo_parcial == 'sim'">
                  <b-form-select
                  id="inputTempoParcial"
                  v-model="propostaProponenteAssistente.tempo_parcial_uo"
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
                    v-model="propostaProponenteAssistente.periodo_uo"
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
      :propostaProponenteAssistente="propostaProponenteAssistente"
      :alterar="alterar"
      :ficheiro="ficheiro"
      v-on:mostrarComponente="mostrarComponente"
      v-on:mostrarPropostaProponente_assistente="mostrarComponenteAssistente"
    ></resumo-proposta>
  </div>
</template>
<script>
import { required, numeric } from "vuelidate/lib/validators";

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
      percentagensArray: [
        { text: "55% (7 horas)", value: "55" },
        { text: "50% (6 horas)", value: "50" },
        { text: "40% (5 horas)", value: "40" },
        { text: "30% (4 horas)", value: "30" },
        { text: "20% (3 horas)", value: "20" },
        { text: "15% (2 horas)", value: "15" }
      ],
      percentagensArraySuperiorA60: [
        { text: "80% (10 horas)", value: "80" },
        { text: "70% (9 horas)", value: "70" },
        { text: "60% (8 horas)", value: "60" }
      ],
      regimePrestacaoServicosArray: [
        { text: "Tempo Parcial", value: "tempo_parcial" },
        {
          text: "Tempo Parcial igual ou superior a 60% ",
          value: "tempo_parcial_60"
        },
        { text: "Tempo Integral", value: "tempo_integral" },
        { text: "Dedicação Exclusiva", value: "dedicacao_exclusiva" }
      ],
      avaliacao_periodo_anterior_array: [
        { text: "Positiva", value: "positiva"},
        { text: "Negativa", value: "negativa"},
      ],
      propostaProponenteAssistente: {
        regime_prestacao_servicos: "",
        percentagem_prestacao_servicos: "",
        percentagem_prestacao_servicos_2: "",
        fundamentacao: 0,
        duracao: "",
        periodo: "",
        avaliacao_periodo_anterior:"",
         remuneracao: "",
        escalao: "",
        indice: "",
        verificacao_outras_uo:"",
        nome_uo:"",
        tempo_parcial_uo:"",
        periodo_uo:"",
        verificacao_tempo_parcial:"",
        primeiro_proponente: this.$store.state.user.name,
        proposta_proponente_id: ""
      },
      
      propostaExistente: {},
      ficheiroProponenteAssistente: {
        fileRelatorio: {},
        fileFundamentacao: {}
      },
      ficheiroProponenteAssistenteTemporario: {
        fileRelatorioTemporario: {},
        fileFundamentacaoTemporario: {}
      },
      ficheirosAssistente: [],
      ficheiroFundamentacao: "",
      ficheiroFundamentacaoAssistente: "",
      ficheiroFundamentacaoAssistenteModel: "",
      
      avancar: false,
      isShowAssistente: true
    };
  },
  //? Validations Vuelidate
  validations() {
     /*if(this.proposta.tipo_contrato == 'renovacao' || this.proposta.tipo_contrato == 'alteracao'){
       return{
         propostaProponenteAssistente: {
           avaliacao_periodo_anterior: { required },
         }
       };
     }*/
    if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
       this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
      return {
        propostaProponenteAssistente: {
          regime_prestacao_servicos: { required },
          duracao: { required },
          periodo: { required },
          verificacao_outras_uo: { required },
          /*if(this.propostaProponenteAssistente.verificacao_outras_uo == "sim" ) {
            nome_uo: { required },
            tempo_parcial_uo: { required },
            periodo_uo: { required },
          }*/
        }
      };
    } if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60") {
        return {
          propostaProponenteAssistente: {
            regime_prestacao_servicos: { required },
            //fundamentacao: { required },
            percentagem_prestacao_servicos: { required },
            duracao: { required },
            periodo: { required },
            verificacao_outras_uo: { required },
            /*if(this.proposta.verificacao_outras_uo == "sim" ) {
                nome_uo: { required },
                tempo_parcial_uo: { required },
                periodo_uo: { required },
            }*/
          }
        };
      } else {
        return {
          propostaProponenteAssistente: {
            regime_prestacao_servicos: { required },
            percentagem_prestacao_servicos: { required },
            duracao: { required },
            periodo: { required },
            verificacao_outras_uo: { required },
            /*if(this.proposta.verificacao_outras_uo == "sim" ) {
                nome_uo: { required },
                tempo_parcial_uo: { required },
                periodo_uo: { required },
            }*/
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
      this.ficheirosAssistente[event.target.name] = event.target.files[0];
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
          this.propostaProponenteAssistente.regime_prestacao_servicos ==
            "tempo_integral" ||
          this.propostaProponenteAssistente.regime_prestacao_servicos ==
            "dedicacao_exclusiva"
        ) {
          this.propostaProponenteAssistente.percentagem_prestacao_servicos =
            "100";
        }
        
        if (this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
            this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
            this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
          this.propostaProponenteAssistente.percentagem_prestacao_servicos == null;
          this.propostaProponenteAssistente.percentagem_prestacao_servicos_2 == null;
        }
        if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial"){
          this.propostaProponenteAssistente.fundamentacao == '0';
        }
        if (this.propostaProponenteAssistente.verificacao_tempo_parcial == "nao") {
          this.propostaProponenteAssistente.tempo_parcial_uo == null;
        }
        if (this.propostaProponenteAssistente.verificacao_outras_uo == "nao") {
          this.propostaProponenteAssistente.nome_uo == null;
          this.propostaProponenteAssistente.verificacao_tempo_parcial == null;
          this.propostaProponenteAssistente.tempo_parcial_uo == null;
          this.propostaProponenteAssistente.periodo_uo == null;
        }

            

            this.ficheiro.fileFundamentacao = new FormData();
            this.ficheiro.fileFundamentacao.append(
                "file",
                this.ficheirosAssistente["ficheiroFundamentacaoAssistente"]
            );
            this.ficheiro.fileFundamentacao.append(
                "descricao",
                "Fundamentacao da Proposta Proponente"
            );

        //}

        if(this.alterar.fundamentacao==1 || !this.$store.state.editarProposta){
        
        this.ficheiroProponenteAssistente.fundamentacao = '1';
        //? Necessário o FormData para passar a informção do ficheiro para o backend "Laravel"
            this.ficheiroProponenteAssistente.fileFundamentacao = new FormData();
            this.ficheiroProponenteAssistente.fileFundamentacao.append(
                "file",
                this.ficheirosAssistente["ficheiroFundamentacaoAssistente"]
            );
            this.ficheiroProponenteAssistente.fileFundamentacao.append(
                "descricao",
                "Fundamentacao"
            );

        axios.post("/api/ficheiroTemporario", this.ficheiroProponenteAssistente.fileFundamentacao).then(response => {});
        
        }

        this.avancar = true;
        this.isShowAssistente = false;
        this.$emit("incrementarBarraProgresso");
        this.$store.commit("setPropostaProponenteAssistente", this.propostaProponenteAssistente);
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
      this.isShowAssistente = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
	   if(this.proposta.fundamentacao_coordenador_departamento != null || this.proposta.fundamentacao_coordenador_curso != null){
        this.anterior();
      }
    },
    mostrarComponenteAssistente() {
      this.isShowAssistente = true;
      this.avancar = false;
      this.$emit("decrementarBarraProgresso");
    },
    associarProposta() {
      //* Limpar Objectos
      Object.assign(this.propostaExistente, {});
      //* Associar vencimento à proposta
      Object.assign(this.propostaProponenteAssistente, this.propostaExistente);
    }
  },
  mounted() {
    Object.assign(this.propostaProponenteAssistente, this.$store.state.propostaProponenteAssistente);

    //? Se selecionou uma proposta existente
    if (this.proposta.role == "assistente" && (this.$store.state.propostaExistente || this.$store.state.editarProposta)) {
      axios
        .get("/api/propostaProponenteAssistente/" + this.proposta.id_proposta_proponente)
        .then(response => {
          Object.assign(this.propostaProponenteAssistente, response.data);
        });

         axios
        .get("/api/ficheiros/" + this.proposta.id_proposta_proponente)
        .then(response => {
          response.data.forEach(ficheiro => {
            if (ficheiro.descricao == "Fundamentacao da Proposta Proponente" /*&& (propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva')*/){
              this.ficheiroFundamentacao = ficheiro;
            }
          });
        });
     
    }this.getVencimentos();
  }
};
</script>
