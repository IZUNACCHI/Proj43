<template>
  <div v-if="mostrarResumoProposta">
    <h2>
      <strong>Resumo da Proposta de contratação</strong>
    </h2>
    <br />
    <div class="jumbotron">
      <table width="100%" border="1px">
                <tr  bgcolor=#be5b59><th colspan="3"><font color=#ffffff>A preencher pelo/s proponente/s</font></th></tr>
                <tr>
                    <td><b>Nome Completo</b></td><td colspan="2">{{proposta.nome_completo}}</td>
                </tr>
                    <td><b>Departamento/Área Científica/Curso</b></td><td colspan="2" width="75%">{{proposta.departamento_curso}}</td>
                <tr><td><b>Serviço Docente Atribuido</b></td><td colspan="2">
                    <input type="checkbox" v-if="proposta.verificacao_serviço_docente_atribuido == 'sim'" id="scales" name="scales" onclick="return false;" checked>
                    <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">
                    Anexo à presente proposta</td></tr>
                <tr><th bgcolor=#be5b59 colspan="4"><font color=#ffffff>Habilitações Académicas</font></th></tr>
                <tr width="100%" v-if="proposta.grau.includes('doutoramento')">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Doutoramento</td>
                    <td><b>Curso: </b>{{proposta.curso_Doutoramento}}</td>
					<td><b>Area Cientifica: </b>{{proposta.area_cientificaDoutoramento}}</td>
                </tr>
				<tr width="100%" v-if="!proposta.grau.includes('doutoramento')">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Doutoramento</td>
                    <td><b>Curso: </b>{{proposta.curso_Doutoramento}}</td>
					<td><b>Area Cientifica: </b>{{proposta.area_cientificaDoutoramento}}</td>
                </tr>
				<tr width="100%" v-if="proposta.grau.includes('outro')">
					<td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Outro</td>
                    <td><b>Grau: </b>{{proposta.curso_Outro}}</td>
					<td><b>Area Cientifica: </b>{{proposta.area_cientificaOutro}}</td>
                </tr>
				<tr width="100%" v-if="!proposta.grau.includes('outro')">
					<td><input type="checkbox" id="scales" name="scales" onclick="return false;">Outro</td>
                    <td><b>Grau: </b>{{proposta.curso_Outro}}</td>
					<td><b>Area Cientifica: </b>{{proposta.area_cientificaOutro}}</td>
                </tr>
				<tr width="100%" v-if="proposta.grau.includes('em_formacao')">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Em Formação</td>
					<td><b>Grau: </b>{{proposta.curso_Formacao}}</td>
                    <td><b>Area Cientifica: </b>{{proposta.area_cientificaFormacao}}</td>
                </tr>
				<tr width="100%" v-if="!proposta.grau.includes('em_formacao')">
					<td><input type="checkbox" id="scales" name="scales" onclick="return false;">Em Formação</td>
					<td><b>Grau: </b>{{proposta.curso_Formacao}}</td>
                    <td><b>Area Cientifica: </b>{{proposta.area_cientificaFormacao}}</td>
                </tr>
          </table><br>


          <table v-if="proposta.role == 'professor'" width="100%" border="1px">
                <tr><th colspan="4" bgcolor=#be5b59><font color=#ffffff>Professor</font></th></tr>
                <tr>
                    <td colspan="3" v-if="propostaProponenteProfessor.role_professor == 'coordenador'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Visitante</label>
                    </td>
                    <td colspan="3" v-if="propostaProponenteProfessor.role_professor == 'adjunto'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Visitante</label>
                    </td>
                    <td colspan="3" v-if="propostaProponenteProfessor.role_professor == 'visitante'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Visitante</label>
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="propostaProponenteProfessor.avaliacao_periodo_anterior != null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>
                                {{propostaProponenteProfessor.avaliacao_periodo_anterior}}
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="propostaProponenteProfessor.avaliacao_periodo_anterior == null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>Não Aplicavel
                    </td>
                </tr><tr>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'contratacao_inicial'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label>
                    </td>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'renovacao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label>
                    </td>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'alteracao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Alteração</label></td>
                </tr><tr>
                    <td rowspan="2" v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_parcial'"><b>
                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;" checked> </b>{{propostaProponenteProfessor.percentagem_prestacao_servicos}}% {{propostaProponenteProfessor.percentagem_prestacao_servicos_2}}%</td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_parcial'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_parcial'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                    <td rowspan="2" v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_integral'"><b>
                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;"> </b></td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_integral'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='tempo_integral'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                        
                    <td rowspan="2" v-if="propostaProponenteProfessor.regime_prestacao_servicos=='dedicacao_exclusiva'"><b>
                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;"> </b></td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='dedicacao_exclusiva'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                    <td v-if="propostaProponenteProfessor.regime_prestacao_servicos=='dedicacao_exclusiva'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td></tr>

                   <tr> <td colspan="2"><b>Fundamentação</b>
                        <input type="checkbox" v-if="
                        propostaProponenteProfessor.regime_prestacao_servicos == 'tempo_integral' ||
                        propostaProponenteProfessor.regime_prestacao_servicos == 'dedicacao_exclusiva'" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">
                        (cfr. acta do CTC – art. 5.º, n.º 3)
                        N.B. Contrato e renovações não podem ter duração superior a 4 anos</td></tr>
                <tr><td><b>Duração:</b></td><td colspan="2">{{propostaProponenteProfessor.duracao}}</td></tr>
                <tr><td><b>Periodo:</b></td><td colspan="2">{{propostaProponenteProfessor.periodo}}</td></tr>
          </table>


          
          <table v-if="proposta.role == 'assistente'" width="100%" border="1px">
                <tr><th colspan="4" bgcolor=#be5b59><font color=#ffffff>Assistente</font></th></tr>
                <tr>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'contratacao_inicial'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label>
                    </td>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'renovacao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Contratação Unicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label>
                    </td>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'alteracao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Alteração</label>
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="propostaProponenteAssistente.avaliacao_periodo_anterior != null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>
                                {{propostaProponenteAssistente.avaliacao_periodo_anterior}}
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="propostaProponenteAssistente.avaliacao_periodo_anterior == null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>Não Aplicavel
                    </td>
                </tr><tr>
                    <td><b>Regime de prestação de serviços</b></td>
                    <td colspan="2" v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial'">Tempo Parcial
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        {{propostaProponenteAssistente.percentagem_prestacao_servicos}}%
                        {{propostaProponenteAssistente.percentagem_prestacao_servicos_2}}%</td>
                    <td colspan="2" v-if="propostaProponenteAssistente.regime_prestacao_servicos!='tempo_parcial'">Tempo Parcial
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">---%</td></tr>

                <tr>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial'"><b>
                        Tempo parcial igual ou superior a 60%
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial_60'"><b>
                        Tempo parcial igual ou superior a 60%
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked> </b>{{propostaProponenteAssistente.percentagem_prestacao_servicos}}%</td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial_60'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_parcial_60'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>


                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_integral'"><b>
                        Tempo parcial igual ou superior a 60%
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_integral'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='tempo_integral'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                        
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='dedicacao_exclusiva'"><b>
                        Tempo parcial igual ou superior a 60%
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='dedicacao_exclusiva'">Tempo Integral
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                    <td v-if="propostaProponenteAssistente.regime_prestacao_servicos=='dedicacao_exclusiva'">Dedicação Exclusiva
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td></tr>

                   <tr> <td colspan="3"><b>Fundamentação</b>
                        <input type="checkbox" v-if="
                        propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_parcial_60' ||
                        propostaProponenteAssistente.regime_prestacao_servicos == 'tempo_integral' ||
                        propostaProponenteAssistente.regime_prestacao_servicos == 'dedicacao_exclusiva'" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">
                        (cfr. acta do CTC – art. 5.º, n.º 3)
                        N.B. Contrato e renovações não podem ter duração superior a 4 anos</td></tr>
                <tr><td><b>Duração:</b></td><td colspan="2">{{propostaProponenteAssistente.duracao}}</td></tr>
                <tr><td><b>Periodo:</b></td><td colspan="2">{{propostaProponenteAssistente.periodo}}</td></tr>
          </table>



<table v-if="proposta.role == 'monitor'" width="100%" border="1px">
                <tr><th colspan="5" bgcolor=#be5b59><font color=#ffffff>Monitor</font></th></tr>
                <tr>
                    <td colspan="5" v-if="proposta.tipo_contrato == 'contratacao_inicial'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label></td>
                    </td>
                    <td colspan="5" v-if="proposta.tipo_contrato == 'renovacao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label></td>
                    <td colspan="3" v-if="proposta.tipo_contrato == 'alteracao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Contratação Inicial</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Renovação</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Alteração</label></td>
                </tr><tr>
                    <td><b>Regime de prestação de serviços</b><br>
                        Tempo Parcial: {{propostaProponenteMonitor.percentagem_prestacao_servicos}}%</td>
                    <td><b>Duração: </b></td><td>{{propostaProponenteMonitor.duracao}}</td>
                    <td><b>Periodo: </b></td><td>{{propostaProponenteMonitor.periodo}}</td></tr>
          </table><br>

          <table width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Vencimento Aplicável</font></th></tr>
                <tr>
                    <td><b>Remuneração: </b>{{proposta.remuneracao}}€</td>
                    <td><b>Escalão: </b>{{proposta.escalao}}</td>
                    <td><b>Índice: </b>{{proposta.indice}}</td></tr>
          </table><br>
          <table width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59> <font color=#ffffff>Contratação para mais do que uma UO do IPL</font></th></tr>
                <tr>
                    <td>O docente proposto já se econtra a exercer funções noutra UO do IPL?</td>
                    <td rowspan="2" v-if="proposta.verificacao_outras_uo=='sim'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <b>Sim</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <b>Não</b>
                        <p v-if="proposta.verificacao_tempo_parcial=='sim'">Sim, UO <b>{{proposta.nome_uo}}</b> Tempo parcial <b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        {{proposta.tempo_parcial_uo}}%</b><br>
                        Periodio <b>{{proposta.periodo_uo}}</b></p>
                        <p v-else>Sim, UO <b>{{proposta.nome_uo}}</b> Tempo parcial
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                        Periodio <b>{{proposta.periodo_uo}}</b></p></td>
                    <td rowspan="2" v-if="proposta.verificacao_outras_uo=='nao'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <b>Sim</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <b>Não</b>
                        <p>Se sim, indique:, UO ___________________ Tempo parcial ____________________%<br>
                        Periodio ________________________________</p></td>
                </tr><tr>
                    <td>O docente já foi convidado para exercer funções noutro UO do IPL?</td></tr>
          </table>
          <br>
          <table border="1px" v-if="proposta.verificacao_serviço_docente_atribuido=='nao'">
               <thead><tr><th colspan="9" bgcolor=#be5b59> <font color=#ffffff>Unidades Curriculares</font></th></tr>
                <th>Codigo UC</th>
                <th>Nome UC</th>
                <th>Regime</th>
                <th>Turno</th>
                <th>Código Curso</th>
                <th>Nome Curso</th>
                <th>Horas</th>
                <th>Horas Semestrais</th>
                <th>Tipo</th>        
              </thead>
              <tbody>
                <tr v-for="uc in unidadesCurriculares" :key="uc.ID">
                  <td>{{ uc.codigo_uc }}</td>
                  <td>{{ uc.nome_uc }}</td>
                  <td>{{ uc.regime }}</td>
                  <td>{{ uc.turno }}</td>
                  <td>{{ uc.codigo_curso }}</td>
                  <td>{{ uc.nome_curso }}</td>
                  <td>{{ uc.horas }}</td>
                  <td>{{ uc.horas_semestrais }}</td>
                  <td>{{ uc.tipo }}</td>
                </tr>
              </tbody>
            </table>
    </div>

    <!-- Coordenador de curso -->
    <div v-if="this.$store.state.user.roleDB == 'proponente_curso'" class="mt-5">
      <b-form-group>
        <b-form-checkbox
          v-model="fundamentacaoCheck"
        >Reconheço o interesse e a necessidade da contratação inicial/renovação</b-form-checkbox>
      </b-form-group>


      <div v-if="fundamentacaoCheck">
        <b-form-group label="Fundamentação">
          <b-form-textarea v-model="proposta.fundamentacao_coordenador_curso" rows="3" max-rows="6"
          :state="!$v.proposta.fundamentacao_coordenador_curso.$error && null"></b-form-textarea>
        </b-form-group>
		  <button type="button" class="btn btn-info" @click="novaFundamentacao()">Guardar Fundamentação</button>
		<b-form-group label="Fundamentações guardadas">
		<b-form-select v-model="proposta.fundamentacao_coordenador_curso">
		<option selected></option>
		<option v-for="item in fundamentacoes">
			{{item.fundamentacao}}
		</option>
		</b-form-select>
		</b-form-group>
        <b-form-group label="Data" label-for="inputData">
          <b-form-input
            id="inputData"
            type="date"
            :state="!$v.proposta.data_de_assinatura_coordenador_de_curso.$error && null"
            v-model="proposta.data_de_assinatura_coordenador_de_curso"
          ></b-form-input>
        </b-form-group>
      </div>
    </div>

    <!-- Coordenador de departamento -->
    <div v-if="this.$store.state.user.roleDB == 'proponente_departamento'" class="mt-5">
      <b-form-group v-if="proposta.fundamentacao_coordenador_departamento!='null'">
        <b-form-checkbox
          v-model="fundamentacaoCheck"
          stacked
        >Reconheço o interesse e a necessidade da contratação inicial/renovação</b-form-checkbox>
      </b-form-group>

      <div v-if="fundamentacaoCheck">
        <b-form-group label="Fundamentação">
          <b-form-textarea
            v-model="proposta.fundamentacao_coordenador_departamento"
            rows="3"
            :state="!$v.proposta.fundamentacao_coordenador_departamento.$error && null"
            max-rows="6"
          ></b-form-textarea>
		  <button type="button" class="btn btn-info" @click="novaFundamentacao()">Guardar Fundamentação</button>
        </b-form-group>
		<b-form-group label="Fundamentações guardadas">
		<b-form-select v-model="proposta.fundamentacao_coordenador_departamento">
		<option selected></option>
		<option v-for="item in fundamentacoes">
			{{item.fundamentacao}}
		</option>
		</b-form-select>
		</b-form-group>
        <b-form-group label="Data" label-for="inputData">
          <b-form-input
            id="inputData"
            type="date"
            :state="!$v.proposta.data_de_assinatura_coordenador_departamento.$error && null"
            v-model="proposta.data_de_assinatura_coordenador_departamento"
          ></b-form-input>
        </b-form-group>
      </div>
    </div>

    <button class="btn btn-info" v-on:click.prevent="anterior">
      <i class="fas fa-arrow-left"></i> Anterior
    </button>

    <button
      type="button"
      class="btn btn-success"
      v-on:click="submeterPropostaProfessor(propostaProponenteProfessor)"
      @click="makeToast('success')"
      v-if="proposta.role=='professor'"
    >
      <i class="fas fa-save"></i> Submeter
    </button>
    <button
      type="button"
      class="btn btn-success"
      v-on:click="submeterPropostaAssistente(propostaProponenteAssistente)"
      @click="makeToast('success')"
      v-if="proposta.role=='assistente'"
    >
      <i class="fas fa-save"></i> Submeter
    </button>
    <button
      type="button"
      class="btn btn-success"
      v-on:click="submeterPropostaMonitor(propostaProponenteMonitor)"
      @click="makeToast('success')"
      v-if="proposta.role=='monitor'"
    >
      <i class="fas fa-save"></i> Submeter
    </button>
  </div>
</template>
<script src="/socket.io/socket.io.js">
</script>

<script>
import { required } from "vuelidate/lib/validators";
export default {
  props: [
    "proposta",
    "unidadesCurriculares",
    "propostaProponenteProfessor",
    "propostaProponenteAssistente",
    "propostaProponenteMonitor",
    "ficheiroProponenteProfessor",
    "ficheiroProponenteAssistente",
    "ficheiro"
  ],
  data() {
    return {
	  fundamentacoes: [],
      idParaUcsPropostaProponente: "",
      fundamentacaoCheck: false,
      user: this.$store.state.user,
      mostrarResumoProposta: true,
      isLoading: false,
      successMessage: ""
    };
  },
  validations() {
    if (this.$store.state.user.roleDB == "proponente_departamento") {
      return {
        fundamentacaoCheck: { required },
        proposta: {
          data_de_assinatura_coordenador_departamento: { required },
          fundamentacao_coordenador_departamento: { required },
        },
      };
    } 
    if(this.$store.state.user.roleDB == "proponente_curso") {
      return {
        fundamentacaoCheck: { required },
        proposta: {
          data_de_assinatura_coordenador_de_curso: { required },
          fundamentacao_coordenador_curso: { required },
        },
      };
    }
  },
  methods: {
	novaFundamentacao() {
		let newfundamentacao = '';
		if(this.$store.state.user.roleDB == 'proponente_departamento'){
			newfundamentacao = this.proposta.fundamentacao_coordenador_departamento;
		}else if(this.$store.state.user.roleDB == 'proponente_curso'){
			newfundamentacao = this.proposta.fundamentacao_coordenador_curso;
		}
		axios.post('/api/fundamentacoes/create/' + this.$store.state.user.id + '/'+ newfundamentacao).then(response => {
		this.$swal("Success", "Fundamentação guardada!", "success");});
		this.$nextTick(() => {this.getFundamentacoes();});
		
	},
	getFundamentacoes(){
		axios.get("/api/fundamentacoes/" + this.$store.state.user.id).then(response => {
		this.fundamentacoes = response.data;
		});
		 
	},
    voltar() {
      this.$emit("mostrarComponente", this.proposta);
      this.mostrarResumoProposta = false;
      this.$swal.fire({
            title: "TeVamos voltar?",
          })
    },
    submeterPropostaProfessor(propostaProponenteProfessor) {
      if (this.unidadesCurriculares.length > 0) {
         this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal.fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    //? Eliminar UCs Proponentes  Antigas
                    axios.get('api/getUcsPropostaProponente/' + this.proposta.id_proposta_proponente)
                    .then(response => {
                      response.data.forEach(unidadeCurricular => {
                        axios.delete("/api/ucsPropostaProponente/" + unidadeCurricular.id_ucs_proposta_proponente).then(response => {});
                      });
                    })
                    //? Criar UCs Proponentes Novas
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      axios
                        .post("/api/ucsPropostaProponente", unidadeCurricular)
                        .then(response => {});
                      this.propostaProponenteProfessor.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Professor
                    axios.get("/api/propostaProponenteProfessor/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_professor) {
                        axios
                      .put("/api/updatePropostaProponenteProfessor/" + response.data.id_proposta_proponente_professor, this.propostaProponenteProfessor)
                      .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteProfessor", this.propostaProponenteProfessor).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      /*this.ficheiro.fileCurriculo.append("proposta_id", response.data.id);
                            if (this.proposta.tipo_contrato == "contratacao_inicial") {
                            this.ficheiro.fileHabilitacoes.append( "proposta_id", response.data.id);
                          }
                      this.ficheiro.fileRelatorio.append("proposta_id", response.data.id);*/

                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            //this.ficheiroProponenteProfessor.fileFundamentacao.append("proposta_id", response.data.id);
                            this.ficheiro.fileFundamentacao.append("proposta_id", response.data.id);
                      }
                      axios.delete("/api/deleteFicheiros/" + response.data.id).then(response => {});
                      //axios.post("/api/ficheiro", this.ficheiro.fileRelatorio).then(response => {});
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                        //axios.post("/api/ficheiro", this.ficheiroProponenteProfessor.fileFundamentacao).then(response => {});
                        axios.post("/api/ficheiro", this.ficheiro.fileFundamentacao).then(response => {});
                      }
                      /*axios.post("/api/ficheiro", this.ficheiro.fileCurriculo).then(response => {});
                      if (this.proposta.tipo_contrato == "contratacao_inicial") {
                        axios.post("/api/ficheiro", this.ficheiro.fileHabilitacoes) .then(response => {});
                      }*/
                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
                  });
              } else {
                this.isLoading = true;
                axios
                  .post("/api/propostaProponente", this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      axios
                        .post("/api/ucsPropostaProponente", unidadeCurricular)
                        .then(response => {});
                      this.propostaProponenteProfessor.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    axios
                      .post(
                        "/api/propostaProponenteProfessor",
                        this.propostaProponenteProfessor
                      )
                      .then(response => {});
                    axios
                      .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                      .then(response => {
                        /*this.ficheiro.fileCurriculo.append(
                          "proposta_id",
                          response.data
                        );
                        if (
                          this.proposta.tipo_contrato == "contratacao_inicial"
                        ) {
                          this.ficheiro.fileHabilitacoes.append(
                            "proposta_id",
                            response.data
                          );
                        }
                        this.ficheiro.fileRelatorio.append(
                          "proposta_id",
                          response.data
                        );*/
                        if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append(
                          "proposta_id",
                          response.data
                        );
                        }
                        if(propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                           propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append(
                              "proposta_id",
                              response.data
                            );
                            /*this.ficheiroProponenteProfessor.fileFundamentacao.append(
                              "proposta_id",
                              response.data
                            );*/
                        }
                       /* axios
                          .post("/api/ficheiro", this.ficheiro.fileRelatorio)
                          .then(response => {});*/
                        
                        if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios
                          .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                          .then(response => {});
                        }
                        if(propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                           propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            axios
                              .post("/api/ficheiro", this.ficheiro.fileFundamentacao)
                              .then(response => {
                                  this.$swal(
                                    "Sucesso",
                                    "Proposta criada com sucesso!!",
                                    "success"
                                  );
                                  this.isLoading = false;
                                  this.voltar();
                                });
                         }
                         this.isLoading = false;
                         this.voltar();
                        /*axios
                          .post("/api/ficheiro", this.ficheiroProponenteProfessor.fileFundamentacao)
                          .then(response => {});
                        axios
                          .post("/api/ficheiro", this.ficheiro.fileCurriculo)
                          .then(response => {});
                        if (
                          this.proposta.tipo_contrato == "contratacao_inicial"
                        ) {
                          axios
                            .post(
                              "/api/ficheiro",
                              this.ficheiro.fileHabilitacoes
                            )
                            .then(response => {
                              this.$swal(
                                "Sucesso",
                                "Proposta criada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                            });*/
                        //}
                      });
                  });
              }
            }
          });
        }
      }
      else {
         this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal.fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    this.propostaProponenteProfessor.proposta_proponente_id = response.data.id_proposta_proponente;
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Professor
                    axios.get("/api/propostaProponenteProfessor/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_professor) {
                        axios
                      .put("/api/updatePropostaProponenteProfessor/" + response.data.id_proposta_proponente_professor, this.propostaProponenteProfessor)
                      .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteProfessor", this.propostaProponenteProfessor).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            //this.ficheiroProponenteProfessor.fileFundamentacao.append("proposta_id", response.data.id);
                            this.ficheiro.fileFundamentacao.append("proposta_id", response.data.id);
                      }
                      axios.delete("/api/deleteFicheiros/" + response.data.id).then(response => {});
                      //axios.post("/api/ficheiro", this.ficheiro.fileRelatorio).then(response => {});
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            //axios.post("/api/ficheiro", this.ficheiroProponenteProfessor.fileFundamentacao).then(response => {});
                            axios.post("/api/ficheiro", this.ficheiro.fileFundamentacao).then(response => {});
                      }
                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
                  });
              } else {
                this.isLoading = true;
                axios
                  .post("/api/propostaProponente", this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    this.propostaProponenteProfessor.proposta_proponente_id = response.data.id_proposta_proponente;
                    axios
                      .post(
                        "/api/propostaProponenteProfessor",
                        this.propostaProponenteProfessor
                      )
                      .then(response => {});
                    axios
                      .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                      .then(response => {
                        if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append(
                          "proposta_id",
                          response.data
                        );
                        }
                        if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append(
                              "proposta_id",
                              response.data
                            );
                        }
                        if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios
                          .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                          .then(response => {});
                        }
                        if (propostaProponenteProfessor.regime_prestacao_servicos =="tempo_integral" ||
                          propostaProponenteProfessor.regime_prestacao_servicos =="dedicacao_exclusiva") {
                            axios
                              .post("/api/ficheiro", this.ficheiro.fileFundamentacao)
                              .then(response => {})//;
                        }
                      });
                  });
              }
            }
          });
        }
      }

    },
    submeterPropostaAssistente(propostaProponenteAssistente) {
      if (this.unidadesCurriculares.length > 0) {
         this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal
          .fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    //? Eliminar UCs Proponentes  Antigas
                    axios.get('api/getUcsPropostaProponente/' + this.proposta.id_proposta_proponente)
                    .then(response => {
                      response.data.forEach(unidadeCurricular => {
                        axios.delete("/api/ucsPropostaProponente/" + unidadeCurricular.id_ucs_proposta_proponente).then(response => {});
                      });
                    })
                    //? Criar UCs Proponentes Novas
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                     axios
                        .post("/api/ucsPropostaProponente", unidadeCurricular)
                        .then(response => {});
                      this.propostaProponenteAssistente.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Assistente
                    axios.get("/api/propostaProponenteAssistente/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_assistente) {
                        axios
                          .put("/api/updatePropostaProponenteAssistente/" + response.data.id_proposta_proponente_assistente, this.propostaProponenteAssistente)
                          .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteAssistente", this.propostaProponenteAssistente).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      /*this.ficheiro.fileCurriculo.append("proposta_id", response.data.id);
                    
                      if (this.proposta.tipo_contrato == "contratacao_inicial") {
                        this.ficheiro.fileHabilitacoes.append( "proposta_id", response.data.id);
                      }
                      this.ficheiro.fileRelatorio.append("proposta_id", response.data.id);
                      */
                      if(propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append("proposta_id", response.data.id);
                            //this.ficheiroProponenteAssistente.fileFundamentacao.append( "proposta_id", response.data.id);
                      }

                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      //axios.delete("/api/deleteFicheiros/" + response.data.id).then(response => {});
                      //axios.post("/api/ficheiro", this.ficheiro.fileRelatorio).then(response => {});
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      /*axios.post("/api/ficheiro", this.ficheiro.fileCurriculo).then(response => {});
                      if (this.proposta.tipo_contrato == "contratacao_inicial") {
                        axios.post("/api/ficheiro", this.ficheiro.fileHabilitacoes) .then(response => {});
                      }*/

                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            axios.post("/api/ficheiro", this.ficheiro.fileFundamentacao) .then(response => {});
                            //axios.post("/api/ficheiro", this.ficheiroProponenteAssistente.fileFundamentacao) .then(response => {});
                      }

                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
                  });
              } else {
              axios
                .post("/api/propostaProponente", this.proposta)
                .then(response => {
                  this.idParaUcsPropostaProponente =
                    response.data.id_proposta_proponente;
                  this.unidadesCurriculares.forEach(unidadeCurricular => {
                    unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                  });
                  this.unidadesCurriculares.forEach(unidadeCurricular => {
                    axios
                      .post("/api/ucsPropostaProponente", unidadeCurricular)
                      .then(response => {});
                    this.propostaProponenteAssistente.proposta_proponente_id = this.idParaUcsPropostaProponente;
                  });
                  axios
                    .post(
                      "/api/propostaProponenteAssistente",
                      propostaProponenteAssistente
                    )
                    .then(response => {});
                  axios
                    .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                    .then(response => {
                      /*this.ficheiro.fileCurriculo.append(
                        "proposta_id",
                        response.data
                      );
                      if (
                        this.proposta.tipo_contrato == "contratacao_inicial"
                      ) {
                        this.ficheiro.fileHabilitacoes.append(
                          "proposta_id",
                          response.data
                        );
                      }
                      this.ficheiro.fileRelatorio.append(
                        "proposta_id",
                        response.data
                      );*/
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      this.ficheiro.fileUnidadesCurriculares.append(
                        "proposta_id",
                        response.data
                      );
                      }
                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append(
                                "proposta_id",
                                response.data
                            );
                         
                            /*this.ficheiroProponenteAssistente.fileFundamentacao.append(
                                "proposta_id",
                                response.data
                            );*/
                       }
                      
                     /* axios
                        .post("/api/ficheiro", this.ficheiro.fileCurriculo)
                        .then(response => {});
                      axios
                        .post("/api/ficheiro", this.ficheiro.fileRelatorio)
                        .then(response => {});
                      */
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      axios
                        .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                        .then(response => {});
                      }
                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            axios
                                .post("/api/ficheiro", this.ficheiro.fileFundamentacao)
                                .then(response => {})//;
                            /*axios
                                .post("/api/ficheiro", this.ficheiroProponenteAssistente.fileFundamentacao)
                                .then(response => {});
                            */
                      //}

                     /* if (
                        this.proposta.tipo_contrato == "contratacao_inicial"
                      ) {
                        axios
                          .post("/api/ficheiro", this.ficheiro.fileHabilitacoes)*/
                          .then(response => {
                            this.$swal(
                              "Sucesso",
                              "Proposta criada com sucesso!!",
                              "success"
                            );
                            this.isLoading = false;
                            this.voltar();
                          });
                      }
                    });
                });
            }
          }
          });
        }
      }else {
         this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal
          .fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    })
                    this.propostaProponenteAssistente.proposta_proponente_id = response.data.id_proposta_proponente;
                    
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Assistente
                    axios.get("/api/propostaProponenteAssistente/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_assistente) {
                        axios
                          .put("/api/updatePropostaProponenteAssistente/" + response.data.id_proposta_proponente_assistente, this.propostaProponenteAssistente)
                          .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteAssistente", this.propostaProponenteAssistente).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      
                      if (this.proposta.tipo_contrato == "contratacao_inicial") {
                        this.ficheiro.fileHabilitacoes.append( "proposta_id", response.data.id);
                      }
                      this.ficheiro.fileRelatorio.append("proposta_id", response.data.id);
                      if(propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append("proposta_id", response.data.id);
                      }

                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      
                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            axios.post("/api/ficheiro", this.ficheiro.fileFundamentacao) .then(response => {});
                      }

                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
              } else {
              axios
                .post("/api/propostaProponente", this.proposta)
                .then(response => {
                  this.idParaUcsPropostaProponente =
                    response.data.id_proposta_proponente;
                  this.propostaProponenteAssistente.proposta_proponente_id = response.data.id_proposta_proponente;
                  axios
                    .post(
                      "/api/propostaProponenteAssistente",
                      propostaProponenteAssistente
                    )
                    .then(response => {});
                  axios
                    .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                    .then(response => {
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      this.ficheiro.fileUnidadesCurriculares.append(
                        "proposta_id",
                        response.data
                      );
                      }
                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            this.ficheiro.fileFundamentacao.append(
                                "proposta_id",
                                response.data
                            );
                         
                      }
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      axios
                        .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                        .then(response => {});
                      }
                      if(this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_integral" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "tempo_parcial_60" ||
                         this.propostaProponenteAssistente.regime_prestacao_servicos == "dedicacao_exclusiva") {
                            axios
                                .post("/api/ficheiro", this.ficheiro.fileFundamentacao)
                                .then(response => {
                                    this.$swal(
                                        "Sucesso",
                                        "Proposta criada com sucesso!!",
                                        "success"
                                    );
                                    this.isLoading = false;
                                    this.voltar();
                            });
                      }
                    });
                });
            }
          }
          });
        }
      }
    },
    submeterPropostaMonitor(propostaProponenteMonitor) {
      if (this.unidadesCurriculares.length > 0) {
        this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal
          .fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    //-----------------------------------
                    //? Eliminar UCs Proponentes  Antigas
                    axios.get('api/getUcsPropostaProponente/' + this.proposta.id_proposta_proponente)
                    .then(response => {
                      response.data.forEach(unidadeCurricular => {
                        axios.delete("/api/ucsPropostaProponente/" + unidadeCurricular.id_ucs_proposta_proponente).then(response => {});
                      });
                    })
                    //? Criar UCs Proponentes Novas
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      axios
                        .post("/api/ucsPropostaProponente", unidadeCurricular)
                        .then(response => {});
                      this.propostaProponenteMonitor.proposta_proponente_id = this.idParaUcsPropostaProponente;
                    });
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Monitor
                    axios.get("/api/propostaProponenteMonitor/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_monitor) {
                        axios
                          .put("/api/updatePropostaProponenteMonitor/" + response.data.id_proposta_proponente_monitor, this.propostaProponenteMonitor)
                          .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteMonitor", this.propostaProponenteMonitor).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      /*this.ficheiro.fileCurriculo.append("proposta_id", response.data.id);
                    
                      if (this.proposta.tipo_contrato == "contratacao_inicial") {
                        this.ficheiro.fileHabilitacoes.append( "proposta_id", response.data.id);
                      }
                      this.ficheiro.fileRelatorio.append("proposta_id", response.data.id);*/
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      //----------
                      /*if (this.proposta.tipo_contrato == "renovacao") {
                        axios.delete("/api/deleteFicheiros/" + response.data.id).then(response => {});
                      }*/
                      //axios.post("/api/ficheiro", this.ficheiro.fileRelatorio).then(response => {});
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      /**/
                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
                  });
              } else {
              this.isLoading = true;
              axios
                .post("/api/propostaProponente", this.proposta)
                .then(response => {
                  this.idParaUcsPropostaProponente =
                    response.data.id_proposta_proponente;
                  this.unidadesCurriculares.forEach(unidadeCurricular => {
                    unidadeCurricular.proposta_proponente_id = this.idParaUcsPropostaProponente;
                  });
                  this.unidadesCurriculares.forEach(unidadeCurricular => {
                    axios
                      .post("/api/ucsPropostaProponente", unidadeCurricular)
                      .then(response => {});
                    this.propostaProponenteMonitor.proposta_proponente_id = this.idParaUcsPropostaProponente;
                  });
                  axios
                    .post(
                      "/api/propostaProponenteMonitor",
                      propostaProponenteMonitor
                    )
                    .then(response => {});
                  axios
                    .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                    .then(response => {
                      /*this.ficheiro.fileCurriculo.append(
                        "proposta_id",
                        response.data
                      );
                      if (
                        this.proposta.tipo_contrato == "contratacao_inicial"
                      ) {
                        this.ficheiro.fileHabilitacoes.append(
                          "proposta_id",
                          response.data
                        );
                      }
                      this.ficheiro.fileRelatorio.append(
                        "proposta_id",
                        response.data
                      );*/
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      this.ficheiro.fileUnidadesCurriculares.append(
                        "proposta_id",
                        response.data
                      );
                      }
                      /*axios
                        .post("/api/ficheiro", this.ficheiro.fileRelatorio)
                        .then(response => {});*/
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      axios
                        .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                        //.then(response => {});
                      
                     /* axios
                        .post("/api/ficheiro", this.ficheiro.fileCurriculo)
                        .then(response => {});
                      if (
                        this.proposta.tipo_contrato == "contratacao_inicial"
                      ) {
                        axios
                          .post("/api/ficheiro", this.ficheiro.fileHabilitacoes)*/
                          .then(response => {
                            this.$swal(
                              "Sucesso",
                              "Proposta criada com sucesso!!",
                              "success"
                            );
                            this.isLoading = false;
                            this.voltar();
                          });}
                     // }
                    });
                });
            }
            }
          });
        }
      }else {
        this.$v.$touch();
        if (!this.$v.$invalid) {
        this.$swal
          .fire({
            title: "Tem a certeza que pretende submeter estes dados?",
            text: "Não poderá realizar mais nenhuma alteração",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Não"
          })
          .then(result => {
            if (result.value) {
              if (this.$store.state.editarProposta) {
                //? Update Proposta Proponente
                axios.put("/api/updatePropostaProponente/" + this.proposta.id_proposta_proponente, this.proposta)
                  .then(response => {
                    this.idParaUcsPropostaProponente = response.data.id_proposta_proponente;
                    //-----------------------------------
                    
                    this.unidadesCurriculares.forEach(unidadeCurricular => {
                      this.propostaProponenteMonitor.proposta_proponente_id = response.data.id_proposta_proponente;
                    });
                    //? Apagar Propostas Proponente de todas as roles
                    axios.put('/api/apagarPropostasProponente/'+this.idParaUcsPropostaProponente, this.proposta).then(response => {});
                    //? Update Proposta Proponente Monitor
                    axios.get("/api/propostaProponenteMonitor/" + this.idParaUcsPropostaProponente).then(response => {
                      if(response.data.id_proposta_proponente_monitor) {
                        axios
                          .put("/api/updatePropostaProponenteMonitor/" + response.data.id_proposta_proponente_monitor, this.propostaProponenteMonitor)
                          .then(response => {});
                      } else {
                        axios.post("/api/propostaProponenteMonitor", this.propostaProponenteMonitor).then(response => {});
                      }
                    });
                    //? Update ficheiros
                    axios.get("/api/propostaDePropostaProponente/" + this.idParaUcsPropostaProponente).then(response => {
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        this.ficheiro.fileUnidadesCurriculares.append("proposta_id", response.data.id);
                      }
                      //----------
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                        axios.post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares).then(response => {});
                      }
                      /**/
                      this.$swal(
                                "Sucesso",
                                "Proposta editada com sucesso!!",
                                "success"
                              );
                              this.isLoading = false;
                              this.voltar();
                    })
                  });
              } else {
              this.isLoading = true;
              axios
                .post("/api/propostaProponente", this.proposta)
                .then(response => {
                  this.idParaUcsPropostaProponente =
                    response.data.id_proposta_proponente;
                    this.propostaProponenteMonitor.proposta_proponente_id = response.data.id_proposta_proponente;
                  axios
                    .post(
                      "/api/propostaProponenteMonitor",
                      propostaProponenteMonitor
                    )
                    .then(response => {});
                  axios
                    .post("/api/proposta/" + this.idParaUcsPropostaProponente)
                    .then(response => {
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      this.ficheiro.fileUnidadesCurriculares.append(
                        "proposta_id",
                        response.data
                      );
                      }
                      
                      if(this.proposta.verificacao_serviço_docente_atribuido == 'sim'){
                      axios
                        .post("/api/ficheiro", this.ficheiro.fileUnidadesCurriculares)
                        .then(response => {
                            this.$swal(
                              "Sucesso",
                              "Proposta criada com sucesso!!",
                              "success"
                            );
                            this.isLoading = false;
                            this.voltar();
                          });
                      }
                    });
                });
            }
            }
          });
        }
      }
    },
    makeToast(variant = null) {
      this.$bvToast.toast("", {
        title: `O Diretor da ${this.proposta.unidade_organica} foi notificado via email!`,
        variant: variant,
        solid: true,
        toaster: "b-toaster-top-right"
      });
    },
    anterior() {
      //* Mudar para o componente PropostaProponente_role*
	  if(this.proposta.role="professor"){
		this.$emit("mostrarPropostaProponente_professor");
	  }else if(this.proposta.role="monitor"){
		this.$emit("mostrarPropostaProponente_monitor");
	  }else{
		this.$emit("mostrarPropostaProponente_assistente");
		}
	  
    }
  },
  mounted(){
	this.getFundamentacoes();
  }
};
</script>
