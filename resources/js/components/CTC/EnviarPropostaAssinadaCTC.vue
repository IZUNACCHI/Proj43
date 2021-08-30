<template>
  <div>
      <h2>Assinatura Externa</h2>    
              <div class="separator">
               <b-progress-bar :value="value" :max="max" height="2rem">
                        <span style="text-align: center">Progresso: <strong>{{ progresso }} / 5</strong></span>
               </b-progress-bar>
               <b-tabs content-class="mt-3" align="left" v-model="tabIndex" small card>
                  <b-tab title="Introdução" v-bind:disabled="tabDisabled.introducao" active >
                    <p>A assinatura externa permite ao titular de certificado e por vontade própria, através de ferramentas externas à aplicação, assinar documentos PDF.</p>
                    
                    <div style="background-color: black; text-align: right">                        
                        <button class="btn" style="color: white" @click="avancar">Avançar <i class="fas fa-arrow-right"></i></button>
                        <button class="btn" style="color: white" @click="voltar">Cancelar <i class="fas fa-times"></i></button>
                    </div>
                  </b-tab>
                  <b-tab title="Descarregar Documento" v-bind:disabled="tabDisabled.descarregar">
                  <button class="btn btn-danger"
                            v-on:click.prevent="gerarPdf()">Gerar</button>
                    <div id="downloadPdf" class="total1" width="93%">
                      <div>
                        <div class="tabelaCabecalho"><table>
                            <td><!--<img src="images/logo.svg" alt="Instituto Politécnico de Leiria" class="pr-5">-->
                        </td><td width="50%"><p style='text-align:center; font-size: 20px'><b>Proposta de contratação<br>
                            Docentes convidados<br></b></p>

                            <p style="font-size: 10px">Legislação: art. 8.º do ECPDESP na redacção que lhe foi dada pelo Decreto-Lei n.º
                                207/2009, de 31 de Agosto, alterado pela Lei nº 7/2010, de 13 de Maio e
                                Regulamento de Contratação de Pessoal Docente Especialmente Contratado ao
                                abrigo do art. 8.º do ECPDESP, do IPL</p>
                        </td></table></div>
                        <div><table style='margin:auto'><td>
                            <b v-if="propostaSelecionada.unidade_organica=='ESECS'"><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>ESECS</b>
                            <b v-if="propostaSelecionada.unidade_organica!='ESECS'"><input type="checkbox" id="scales" name="scales" onclick="return false;" >ESECS</b>
                            <b v-if="propostaSelecionada.unidade_organica=='ESTG'"><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>ESTG</b>
                            <b v-if="propostaSelecionada.unidade_organica!='ESTG'"><input type="checkbox" id="scales" name="scales" onclick="return false;">ESTG</b>
                            <b v-if="propostaSelecionada.unidade_organica=='ESAD.CR'"><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>ESAD.CR</b>
                            <b v-if="propostaSelecionada.unidade_organica!='ESAD.CR'"><input type="checkbox" id="scales" name="scales" onclick="return false;">ESAD.CR</b>
                            <b v-if="propostaSelecionada.unidade_organica=='ESTM'"><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>ESTM</b>
                            <b v-if="propostaSelecionada.unidade_organica!='ESTM'"><input type="checkbox" id="scales" name="scales" onclick="return false;">ESTM</b>
                            <b v-if="propostaSelecionada.unidade_organica=='ESSLei'"><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>ESSLei</b>
                            <b v-if="propostaSelecionada.unidade_organica!='ESSLei'"><input type="checkbox" id="scales" name="scales" onclick="return false;">ESSLei</b></td>
                        </table></div>
                        <div class="tabelaRecursosHumanos">
                            <table width="100%" border="1px">
                                <tr bgcolor=#be5b59>
                                   <th colspan="3"><font color=#ffffff>A Preencher pelo DSRH</font></th>
                                </tr>
                                <tr>
                                    <td><b>Número de Funcionário:</b>{{propostaSelecionada.numero_funcionario}}<br>
                                    <b>Contratação Comunidada</b>
                                        <input v-if="propostaSelecionada.contratacao_comunicada == '1'" type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <input v-else type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                                    <b>Inscrição na Seg. Social (quando aplicável)</b>
                                        <input v-if="propostaSelecionada.inscricao == '1'" type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <input v-else type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                                    <b>Despacho do Sr.Presidente do IPL: </b>{{propostaSelecionada.despacho_presidente_ipl}}</td>
                                    <td><b>Contrato Redigido</b>
                                        <input v-if="propostaSelecionada.contrato_redigido == '1'" type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <input v-else type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                                    <b>Contrato Anexo</b>
                                        <input v-if="propostaSelecionada.contrato_anexo == '1'" type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <input v-else type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                                    <b>Cessação Social</b>
                                        <input v-if="propostaSelecionada.cessacao_social == '1'" type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <input v-else type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td><b>NISS ou Nº CGA </b>{{propostaSelecionada.NISS_ou_numero_CGA}}<br>
                                    <b>Data de Nascimento: </b>{{propostaSelecionada.data_nascimento}}<br>
                                    <b>Nº CC: </b>{{propostaSelecionada.numero_CC}}<br>
                                    <b>E-mail Pessoal:</b> {{propostaSelecionada.email}}</td>
                                </tr><tr>
                                 <td colspan="3"><b>Dados carregados/atualizadors no GIAF por </b>{{propostaSelecionada.dados_GIAF_carregados_por}} <b>Data: </b>{{propostaSelecionada.data_carregamento_dados_GIAF}}</td>
                                </tr>
                           </table></div>
                           <br>
                           <div class="proponente" id="proponente">
                           <table width="100%" border="1px">
                                <tr  bgcolor=#be5b59><th colspan="3"><font color=#ffffff>A preencher pelo/s proponente/s</font></th></tr>
                                <tr>
                                    <td><b>Nome Completo</b></td><td colspan="2">{{propostaSelecionada.nome_completo}}</td>
                                </tr>
                                    <td><b>Departamento/Área Científica/Curso</b></td><td colspan="2" width="75%">{{propostaSelecionada.departamento_curso}}</td>
                                <tr><td><b>Serviço Docente Atribuido</b></td>
                                    <td colspan="2">
                                        <input type="checkbox" v-if="this.propostaSelecionada.verificacao_serviço_docente_atribuido == 'sim'" id="scales" name="scales" onclick="return false;" checked>
                                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">Anexo à presente proposta</td></tr>
                                <tr><th bgcolor=#be5b59 colspan="4"><font color=#ffffff>Habilitações Académicas</font></th></tr>
                                <tr width="100%" v-if="propostaSelecionada.grau.includes('doutoramento')">
                                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Doutoramento</td>
                                    <td><b>Curso: </b>{{propostaSelecionada.curso_Doutoramento}}</td>
					                <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaDoutoramento}}</td>
                                </tr>
				                <tr width="100%" v-if="!propostaSelecionada.grau.includes('doutoramento')">
                                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Doutoramento</td>
                                    <td><b>Curso: </b>{{propostaSelecionada.curso_Doutoramento}}</td>
					                <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaDoutoramento}}</td>
                                </tr>
				                <tr width="100%" v-if="propostaSelecionada.grau.includes('outro')">
					                <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Outro</td>
                                    <td><b>Grau: </b>{{propostaSelecionada.curso_Outro}}</td>
					                <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaOutro}}</td>
                                </tr>
				                <tr width="100%" v-if="!propostaSelecionada.grau.includes('outro')">
					                <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Outro</td>
                                    <td><b>Grau: </b>{{propostaSelecionada.curso_Outro}}</td>
					                <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaOutro}}</td>
                                </tr>
				                <tr width="100%" v-if="propostaSelecionada.grau.includes('em_formacao')">
                                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Em Formação</td>
					                <td><b>Grau: </b>{{propostaSelecionada.curso_Formacao}}</td>
                                    <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaFormacao}}</td>
                                </tr>
				                <tr width="100%" v-if="!propostaSelecionada.grau.includes('em_formacao')">
					                <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Em Formação</td>
					                <td><b>Grau: </b>{{propostaSelecionada.curso_Formacao}}</td>
                                    <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientificaFormacao}}</td>
                                </tr>
                          </table>
                          <br>
                          <table v-if="propostaSelecionada.role == 'professor'" width="100%" border="1px">
                                <tr><th colspan="4" bgcolor=#be5b59><font color=#ffffff>Professor</font></th></tr>
                                <tr>
                                    <td colspan="3" v-if="tipoPropostaRole.role_professor == 'coordenador'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Coordenador</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Adjunto</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Visitante</label>
                                    </td>
                                    <td colspan="3" v-if="tipoPropostaRole.role_professor == 'adjunto'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Coordenador</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Adjunto</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Visitante</label>
                                    </td>
                                    <td colspan="3" v-if="tipoPropostaRole.role_professor == 'visitante'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Coordenador</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Adjunto</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Visitante</label>
                                    </td>
                                    <td rowspan="8" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior != null">
                                                <b>Avaliação do desempenho no periodo anterior</b><br>
                                                {{tipoPropostaRole.avaliacao_periodo_anterior}}
                                    </td>
                                    <td rowspan="8" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior == null">
                                                <b>Avaliação do desempenho no periodo anterior</b><br>Não Aplicavel
                                    </td>
                                </tr><tr>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'contratacao_inicial'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label>
                                    </td>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'renovacao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Coordenador</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Adjunto</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label>
                                    </td>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'alteracao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Alteração</label></td>
                                </tr><tr>
                                    <td rowspan="2" v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'"><b>
                                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;" checked> </b>{{tipoPropostaRole.percentagem_prestacao_servicos}}% {{tipoPropostaRole.percentagem_prestacao_servicos_2}}%</td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                                    <td rowspan="2" v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'"><b>
                                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;"> </b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                </tr><tr>        
                                    <td rowspan="3" v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'"><b>
                                        Tempo Parcial <input type="checkbox" id="scales" name="scales" onclick="return false;"> </b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td>
                                </tr><tr>
                                    <td colspan="3"><b>Fundamentação</b>
                                        <input type="checkbox" v-if="this.propostaSelecionada.fundamentacao == '1'" id="scales" name="scales" onclick="return false;" checked>
                                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">
                                        (cfr. acta do CTC – art. 5.º, n.º 3)
                                        N.B. Contrato e renovações não podem ter duração superior a 4 anos</td></tr>
                                <tr><td><b>Duração:</b></td><td colspan="2">{{tipoPropostaRole.duracao}}</td></tr>
                                <tr><td><b>Periodo:</b></td><td colspan="2">{{tipoPropostaRole.periodo}}</td></tr>
                          </table>

                          <table v-if="propostaSelecionada.role == 'assistente'" width="100%" border="1px">
                
                                <tr><th colspan="4" bgcolor=#be5b59><font color=#ffffff>Assistente</font></th></tr>
                                <tr>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'contratacao_inicial'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label>
                                    </td>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'renovacao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label></td>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'alteracao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Contratação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label></td>
                                    <td rowspan="8" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior == 'positiva'">
                                        <b>Avaliação do desempenho no periodo anterior</b><br>
                                        <input type="checkbox" onclick="return false;"  checked> Positiva
                                        <input type="checkbox" onclick="return false;"> Negativa
                                    </td>
                                    <td rowspan="8" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior == 'negativa'">
                                        <b>Avaliação do desempenho no periodo anterior</b><br>
                                        <input type="checkbox" onclick="return false;"> Positiva
                                        <input type="checkbox" onclick="return false;" checked> Negativa
                                    </td>
                                    <td rowspan="8" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior == null">
                                        <b>Avaliação do desempenho no periodo anterior</b><br>
                                        Não Aplicavel
                                    </td>
                                </tr><tr>
                                    <td colspan="2"><b>Regime de prestação de serviços</b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'"><b>Tempo Parcial: </b>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        {{tipoPropostaRole.percentagem_prestacao_servicos}}%
                                        {{tipoPropostaRole.percentagem_prestacao_servicos_2}}%</td>

                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos!='tempo_parcial'"><b>Tempo Parcial: </b>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">---%</td></tr>
                                <tr>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'"><b>
                                        Tempo parcial igual ou superior a 60%
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>

                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial_60'"><b>
                                        Tempo parcial igual ou superior a 60%
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked> </b>{{tipoPropostaRole.percentagem_prestacao_servicos}}%</td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial_60'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial_60'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>


                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'"><b>
                                        Tempo parcial igual ou superior a 60%
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td></tr>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'"><b>
                                        Tempo parcial igual ou superior a 60%
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></b></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'">Tempo Integral
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"></td>
                                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'">Dedicação Exclusiva
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked></td></tr>
                                <tr> <td colspan="3"><b>Fundamentação</b>
                                        <input type="checkbox" v-if="this.propostaSelecionada.verificacao_serviço_docente_atribuido == '1'" id="scales" name="scales" onclick="return false;" checked>
                                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">
                                        (cfr. acta do CTC – art. 5.º, n.º 3)
                                        N.B. Contrato e renovações não podem ter duração superior a 4 anos</td>
                                <tr><td><b>Duração:</b></td><td colspan="2">{{tipoPropostaRole.duracao}}</td></tr>
                                <tr><td><b>Periodo:</b></td><td colspan="2">{{tipoPropostaRole.periodo}}</td></tr>
                          </table>
                          <table v-if="propostaSelecionada.role == 'monitor'" width="100%" border="1px">
                                <tr><th colspan="5" bgcolor=#be5b59><font color=#ffffff>Monitor</font></th></tr>
                                <tr>
                                    <td colspan="5" v-if="propostaSelecionada.tipo_contrato == 'contratacao_inicial'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label></td>
                                    </td>
                                    <td colspan="5" v-if="propostaSelecionada.tipo_contrato == 'renovacao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label></td>
                                    <td colspan="3" v-if="propostaSelecionada.tipo_contrato == 'alteracao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Contratação Inicial</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <label for="scales">Renovação</label>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <label for="scales">Alteração</label></td>
                                </tr><tr>
                                    <td><b>Regime de prestação de serviços</b><br>
                                        Tempo Parcial: {{tipoPropostaRole.percentagem_prestacao_servicos}}%</td>
                                    <td><b>Duração: </b></td><td>{{tipoPropostaRole.duracao}}</td>
                                    <td><b>Periodo: </b></td><td>{{tipoPropostaRole.periodo}}</td></tr>
                          </table><br>
                          <table width="100%" border="1px">
                                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Vencimento Aplicável</font></th></tr>
                                <tr>
                                    <td><b>Remuneração: </b>{{propostaSelecionada.remuneracao}}€</td>
                                    <td><b>Escalão: </b>{{propostaSelecionada.escalao}}</td>
                                    <td><b>Índice: </b>{{propostaSelecionada.indice}}</td></tr>
                          </table><br>
                          <table width="100%" border="1px">
                                <tr><th colspan="3" bgcolor=#be5b59> <font color=#ffffff>Contratação para mais do que uma UO do IPL</font></th></tr>
                                <tr>
                                    <td>O docente proposto já se econtra a exercer funções noutra UO do IPL?</td>
                                    <td rowspan="2" v-if="propostaSelecionada.verificacao_outras_uo=='sim'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <b>Sim</b>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <b>Não</b>
                                        <p v-if="propostaSelecionada.verificacao_tempo_parcial=='sim'">Sim, UO <b>{{propostaSelecionada.nome_uo}}</b> Tempo parcial <b>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        {{propostaSelecionada.tempo_parcial_uo}}%</b><br>
                                        Periodio <b>{{propostaSelecionada.periodo_uo}}</b></p>
                                        <p v-else>Sim, UO <b>{{propostaSelecionada.nome_uo}}</b> Tempo parcial
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                                        Periodio <b>{{propostaSelecionada.periodo_uo}}</b></p></td>
                                    <td rowspan="2" v-if="propostaSelecionada.verificacao_outras_uo=='nao'">
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                                        <b>Sim</b>
                                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                                        <b>Não</b>
                                       <p>Se sim, indique:, UO ___________________ Tempo parcial ____________________%<br>
                                        Periodio ________________________________</p></td>
                                </tr><tr>
                                    <td>O docente já foi convidado para exercer funções noutro UO do IPL?</td></tr>
                          </table><br>


                          <table width="100%" border="1px">
                                <tr><th colspan="2" bgcolor=#be5b59><font color=#ffffff>Proponente/s</font></th></tr>
                                <tr bgcolor=#be5b59>
                                    <td><font color=#ffffff>Coordenador de Departamento/Unidade Funcional</font></td>
                                    <td><font color=#ffffff>Coordenador de Curso</font></td>
                                </tr><tr>
                                    <td>
                                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                                        Fundamentação
                                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                                        <br><br><br><br><br><br>
                                        <b>Ass.:</b> _______________________________<br>
                                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                                    <td v-if="propostaSelecionada.segundo_proponente=='proponente_departamento'">
                                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                                        Fundamentação<br>
                                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                                    <td>
                                    <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                                        Fundamentação
                                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_curso }}</textarea><br>
                                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                                    <td v-if="propostaSelecionada.primeiro_proponente=='proponente_curso'">
                                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                                        Fundamentação<br>
                                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{propostaSelecionada.fundamentacao_coordenador_curso}}</textarea><br>
                                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                                </tr>
                          </table>
                          <br></div>
                      </div>
                    </div>
                    <div style="background-color: black; text-align: right">                        
                        <button class="btn" style="color: white" @click="recuar"><i class="fas fa-arrow-left"></i> Anterior</button>
                        <button class="btn" style="color: white" @click="avancar">Avançar <i class="fas fa-arrow-right"></i></button>
                        <button class="btn" style="color: white" @click="voltar">Cancelar <i class="fas fa-times"></i></button>
                    </div>
                  </b-tab>
                  <b-tab title="Assinar Documento" v-bind:disabled="tabDisabled.assinar">
                    <p>Para assinar um documento eletrónico com o cartão Cidadão, é necessário:
	                    <li>Instalar a aplicação informática</li>
	                    <li>Ligar o leitor do cartao de cidadao ao computador</li>
                        Após ser redigido e gravado o documento, deve, de seguida, selecionar o certificado de assinatura,
                        digitar o seu código de assinatura e confirmar no fim a posição do certificado de assinatura no
                        documento.</p>
                    <div style="background-color: black; text-align: right">                        
                        <button class="btn" style="color: white" @click="recuar"><i class="fas fa-arrow-left"></i> Anterior</button>
                        <button class="btn" style="color: white" @click="avancar">Avançar <i class="fas fa-arrow-right"></i></button>
                        <button class="btn" style="color: white" @click="voltar">Cancelar <i class="fas fa-times"></i></button>
                    </div>
                  </b-tab>
                  <b-tab title="Carregar Documento" v-bind:disabled="tabDisabled.carregar">
                  <h2 class="pb-4"> Ficheiros a inserir</h2>
                    <b-form-group label="Carregar o Documento Assinado" class="mt-3" description="">
                        <b-form-file
                          v-model="ficheirosAInserir.fileAssinado"
                          placeholder="Escolha um ficheiro"
                          drop-placeholder="Arraste para aqui um ficheiro"
                          accept=".pdf"
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
                          @click="downloadFicheiro(ficheiroAssinado.proposta_id, 'Proposta Assinado CTC')"
                        >
                          <i class="far fa-file-pdf"></i> Atual Ficheiro Assinado
                        </b-button>
                      </b-form-group>
                    <b-form-group class="mt-5">
                        <b-form-checkbox
                          id="checkBoxIncricao"
                          v-model="propostaProponente.contrato_assinado_ctc"
                          name="checkBoxContratoAssinadoCTC"
                          value="1"
                          unchecked-value="0"
                          :state="$v.propostaProponente.contrato_assinado_ctc.$dirty ? !$v.propostaProponente.contrato_assinado_curso.$error : null"
                        >Tomei Conhecimento que a proposta fica Definitiva</b-form-checkbox>
                        <b-form-invalid-feedback id="input-1-live-feedback">Tem de selecionar este campo</b-form-invalid-feedback>
                    </b-form-group>
                    <!--{{propostaProponente.contrato_assinado_ctc}}-->
                    <div style="background-color: black; text-align: right">                        
                        <button class="btn" style="color: white" @click="recuar"><i class="fas fa-arrow-left"></i> Anterior</button>
                        <button class="btn" style="color: white" @click="submeter(ficheirosAInserir)">Avançar <i class="fas fa-arrow-right"></i></button>
                        <button class="btn" style="color: white" @click="voltar">Cancelar <i class="fas fa-times"></i></button>
                    </div>

                  </b-tab>
                  <b-tab title="Documento Assinado" v-bind:disabled="tabDisabled.assinado">
                    <p><i class="fas fa-check"></i>Proposta finalizada com sucesso</p>
                    <div style="background-color: black">                        
                       <button class="btn" style="color: white; text-align: right" @click="voltar">Voltar <i class="fas fa-times"></i></button>
                    </div>

                  </b-tab>
                  
                  <!-- Control buttons-->
                  <!--<div class="text-center">
                    <div class="text-muted">Current Tab: {{ tabIndex }}</div>
                  </div>-->
               </b-tabs>
             </div>
        </div>
  </div>
</template>
<script>
import { required, email, minLength } from "vuelidate/lib/validators";
import VuePdfApp from "vue-pdf-app"
// import this to use default icons for buttons
import "vue-pdf-app/dist/icons/main.css"
import pdf from 'vue-pdf'
import jsPDF from 'jspdf'
export default {

  props: ["propostaSelecionada"],
  data() {
    return {
      tabDisabled:{
        introducao: false,
        descarregar: true,
        assinar: true,
        carregar: true,
        assinado: true,
      },
      value: 20,
      max: 100,
      tabIndex: 1,
      progresso: 1,
      tipoPropostaRole: [],

      proposta:"",
      propostaProponente: {
        contrato_assinado_ctc: ""
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
      contrato_assinado_ctc: { required },
    }
  },
  methods: {
    avancar() {
        if(this.tabIndex=="0"){
            this.tabDisabled.introducao = true,
            this.tabDisabled.descarregar = false}
        if(this.tabIndex=="1"){
            this.tabDisabled.descarregar = true,
            this.tabDisabled.assinar = false}
        if(this.tabIndex=="2"){
            this.tabDisabled.assinar = true,
            this.tabDisabled.carregar = false}
        if(this.tabIndex=="3"){
            this.tabDisabled.carregar = true,
            this.tabDisabled.assinado = false}
        if(this.tabIndex=="4"){
            this.tabDisabled.assinado = true}
        //this.value = Math.random() * this.max,
        this.value = this.value+20,
        this.tabIndex++,
        this.progresso++
    },
    recuar() {
        if(this.tabIndex=="1"){
            this.tabDisabled.introducao = false,
            this.tabDisabled.descarregar = true}
        if(this.tabIndex=="2"){
            this.tabDisabled.descarregar = false,
            this.tabDisabled.assinar = true}
        if(this.tabIndex=="3"){
            this.tabDisabled.assinar = false,
            this.tabDisabled.carregar = true}
        //this.value = Math.random() * this.max,
        this.value = this.value-20,
        this.tabIndex--,
        this.progresso--

    },
    validateState(ref) {
      return this.veeErrors.has(ref) ? false : null;
    },
    onFileSelected(event) {
      this.ficheiros[event.target.name] = event.target.files[0];
    },
    voltar(){
    window.location.reload();
      this.$emit("mostrarCTC");
     // this.$emit("mostrar-ctc", this.proposta);
      
    },
    gerarPdf(){
        var doc = new jsPDF('p', 'pt', 'a4');
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.65,
                    scrollY: 0
                },
                x: 5,
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
        
    },
    submeter(ficheirosAInserir){
        //this.$v.propostaDiretor.$touch();
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
                "Proposta Assinado CTC"
              );
              this.ficheirosAInserir.fileAssinado.append(
                "proposta_id",
                this.propostaSelecionada.id
              );

              axios.post('/api/ficheiro', this.ficheirosAInserir.fileAssinado).then(response => {
                axios.put('/api/ctc/propostaAssinada/'+
                    this.propostaSelecionada.id_proposta_ctc, this.propostaProponente).then(response => {
                    /*this.$swal(
                        "Sucesso",
                        "Proposta assinada com sucesso!!",
                        "success"
                    )*/
                    this.$swal('Sucesso', 'Parecer enviado com sucesso', 'success')
                    this.$emit("mostrarCTC");
                });
                /*this.$emit('voltar');
                this.$emit("voltar", this.proposta);*/
                
                this.tabDisabled.carregar = true;
                this.tabDisabled.assinado = false;
                 
                this.value = this.value+20;
                this.tabIndex++,
                this.progresso++
              });
          }
        });
    }
  },
  /*mounted() {
    this.$swal('Atenção', 'Tem apenas uma oportunidade de submeter corretamente todos os ficheiros necessários', 'info')
  }*/
};

</script>
