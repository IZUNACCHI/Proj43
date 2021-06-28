<template>
  <div>
    <div v-if="this.$store.state.user.roleDB == 'proponente_departamento'">
      <button class="btn btn-danger" @click="voltarProponentes">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>
    <div v-if="this.$store.state.user.roleDB == 'proponente_curso'">
      <button class="btn btn-danger" @click="voltarProponentes">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Dowload</button>
      <h3 aling=right>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'diretor_uo'">
      <button class="btn btn-danger" @click="voltarDiretor">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfUo()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'ctc'">
      <button class="btn btn-danger" @click="voltarCTC">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfCtc()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'secretariado_direcao'">
      <button class="btn btn-danger" @click="voltarSecretariado">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="downloadFicheiro(ficheiroCurriculo.proposta_id, 'Proposta Contratação', propostaSelecionada.nome_completo)">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'recursos_humanos'">
      <h3>Resumo da proposta de contratação</h3>
      <button class="btn btn-danger" @click="voltarRecursosHumanos">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfRecursosHumanos()">Download</button>
    </div>
    <div>
        <label><strong>Nome do Docente:</strong> {{ propostaSelecionada.id_proposta_proponente}} {{propostaSelecionada.grau}}</label>
        </div>

   <div id="tes" class="total1">
   <div id="downloadPdf">
        <div class="tabelaCabecalho"><table>
            <td><img src="" alt="Instituto Politécnico de Leiria" class="pr-5">
        </td><td width="50%"><p style='text-align:center; font-size: 20px'><b>Proposta de contratação<br>
            Docentes convidados<br></b></p>

            <p style="font-size: 10px">Legislação: art. 8.º do ECPDESP na redacção que lhe foi dada pelo Decreto-Lei n.º
                207/2009, de 31 de Agosto, alterado pela Lei nº 7/2010, de 13 de Maio e
                Regulamento de Contratação de Pessoal Docente Especialmente Contratado ao
                abrigo do art. 8.º do ECPDESP, do IPL</p>
        </td></table></div>
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
                    <b>E-mail Pessoal:</b> {{propostaSelecionada.email_recursos_humanos}}</td>
                </tr><tr>
                 <td colspan="3"><b>Dados carregados/atualizadors no GIAF por </b>{{propostaSelecionada.dados_GIAF_carregados_por}} <b>Data: {{propostaSelecionada.data_carregamento_dados_GIAF}} </b></td>
                </tr>
           </table></div>
           <br>
           <div class="proponente" id="proponente">
           <table width="100%" border="1px">
                <tr  bgcolor=#be5b59><th colspan="3"><font color=#ffffff>A preencher pelo/s proponente/s</font></th></tr>
                <tr>
                    <td><b>Nome Completo</b></td><td colspan="2">{{propostaSelecionada.nome_completo}}</td>
                </tr>
                    <td><b>Departamento/Área Científica/Curso</b></td><td colspan="2" width="75%">{{propostaSelecionada.area_cientifica}}</td>
                <tr><td><b>Serviço Docente Atribuido</b></td>
                    <td colspan="2">
                        <input type="checkbox" v-if="ficheiroUnidadesCurriculares" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">Anexo à presente proposta</td></tr>
                <tr><th bgcolor=#be5b59 colspan="4"><font color=#ffffff>Habilitações Académicas</font></th></tr>
                <tr width="100%">
                    <td v-if="propostaSelecionada.grau=='doutoramento'"><b>Doutoramento</b></td>
                    <td v-if="propostaSelecionada.grau=='outro'"><b>Outro</b></td>
                    <td v-if="propostaSelecionada.grau=='em_formacao'"><b>Em Formação</b></td>
                    <td v-if="propostaSelecionada.grau=='doutoramento'"><b>Curso: </b>{{propostaSelecionada.curso}}</td>
                    <td v-if="propostaSelecionada.grau=='outro'"><b>Grau: </b>{{propostaSelecionada.curso}}</td>
                    <td v-if="propostaSelecionada.grau=='em_formacao'"><b>Grau: </b>{{propostaSelecionada.curos}}</td>
                    <td><b>Area Cientifica: </b>{{propostaSelecionada.area_cientifica}}</td>
                </tr>
          </table>
          <br>
          <table v-if="propostaSelecionada.role == 'professor'" width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Professor</font></th></tr>
                <tr>
                    <td colspan="2" v-if="tipoPropostaRole.role_professor == 'coordenador'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Visitante</label>
                    </td>
                    <td colspan="2" v-if="tipoPropostaRole.role_professor == 'adjunto'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Visitante</label>
                    </td>
                    <td colspan="2" v-if="tipoPropostaRole.role_professor == 'visitante'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Coordenador</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <label for="scales">Adjunto</label>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <label for="scales">Visitante</label>
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior != null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>
                                {{tipoPropostaRole.avaliacao_periodo_anterior}}
                    </td>
                    <td rowspan="7" style='text-align:center' v-if="tipoPropostaRole.avaliacao_periodo_anterior == null">
                                <b>Avaliação do desempenho no periodo anterior</b><br>Não Aplicavel
                    </td>
                </tr><tr>
                    <td rowspan="2"><b>Tempo Parcial: </b>{{tipoPropostaRole.percentagem_prestacao_servicos}}%</td>
                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'">Tempo Integral</td>
                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='contratacao_inicial'">Contratação inicial</td>
                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='adjunto'">Adjunto</td></tr>
                    <td><b>Fundamentação</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        (cfr. acta do CTC – art. 5.º, n.º 3)
                        N.B. Contrato e renovações não podem ter duração superior a 4 anos</td>
                <tr><td><b>Duração:</b></td><td>{{tipoPropostaRole.duracao}}</td></tr>
                <tr><td><b>Periodo:</b></td><td>{{tipoPropostaRole.periodo}}</td></tr>
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
                    <td v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial'"><b>Tempo Parcial: </b>{{tipoPropostaRole.percentagem_prestacao_servicos }} %</td>
                    <td v-if="tipoPropostaRole.regime_prestacao_servicos!='tempo_parcial'"><b>Tempo Parcial: </b>{{tipoPropostaRole.percentagem_prestacao_servicos }} ---%</td></tr>
                <tr><td>Tempo parcial igual ou superior a 60%
                        <input type="checkbox" v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_parcial_60'" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;"></td>
                    <td>Tempo Integral
                        <input type="checkbox" v-if="tipoPropostaRole.regime_prestacao_servicos=='tempo_integral'" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;"></td>
                    <td>Dedicação Exclusiva
                        <input type="checkbox" v-if="tipoPropostaRole.regime_prestacao_servicos=='dedicacao_exclusiva'" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;"></td>
                <tr><td colspan="3" style='text-align:center; font-size: 14px'><b>Fundamentação</b>
                        <input type="checkbox" v-if="ficheiroFundamentacao" id="scales" name="scales" onclick="return false;" checked>
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
                        <p>Sim, UO {{propostaSelecionada.nome_uo}} Tempo parcial {{propostaSelecionada.tempo_parcial_uo}}%<br>
                        Periodio</p></td>
                    <td rowspan="2" v-if="propostaSelecionada.verificacao_outras_uo=='não'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <b>Sim</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <b>Não</b>
                        <p>Sim, UO {{propostaSelecionada.nome_uo}} Tempo parcial {{propostaSelecionada.tempo_parcial_uo}}%<br>
                        Periodio</p></td>
                    <td rowspan="2" v-else>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <b>Sim</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
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
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                        <b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                    <td v-if="propostaSelecionada.segundo_proponente=='proponente_departamento'">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                        <b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                    <td>
                    <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{propostaSelecionada.fundamentacao_coordenador_curso}}</textarea><br>
                        <b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                    <td v-if="propostaSelecionada.primeiro_proponente=='proponente_curso'">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{propostaSelecionada.fundamentacao_coordenador_curso}}</textarea><br>
                        <b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                </tr>
          </table>
          <br></div>
          <div class="diretoruo">

          <table width="100%" border="1px">
                <tr><th colspan="2" bgcolor=#be5b59><font color=#ffffff>Diretor da UO</font></th></tr>
                <tr>
                    <td v-if="propostaSelecionada.reconhecimento=='1'"><b>Reconheço interesse e a necessidade da contratação/renovação</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                    </td>
                    <td v-else><b>Reconheço interesse e a necessidade da contratação/renovação</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                    </td>
                    <td rowspan="2" width="60%"><b>Data: </b>{{propostaSelecionada.data_assinatura_uo}}<br> <b>Assinatura: </b>____________________</td>
                </tr><tr>
                    
                    <td v-if="propostaSelecionada.parecer=='Favoravel'"><b>Parecer sobre o prazo da proposta de contratação/renovação</b><br>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Favorável
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">Desfavorável
                    </td>
                    <td v-else-if="propostaSelecionada.parecer=='Desfavoravel'"><b>Parecer sobre o prazo da proposta de contratação/renovação</b><br>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">Favorável
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Desfavorável
                    </td>
                    <td v-else><b>Parecer sobre o prazo da proposta de contratação/renovação</b><br>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">Favorável
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">Desfavorável
                    </td>
                </tr>
          </table>
          <br></div>


          <div class="ctc">
          <table width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Conselho Técnico Cientifico</font></th></tr>
                <tr>
                    <td><b>Votos a Favor: </b>{{propostaSelecionada.votos_a_favor}}</td>
                    <td><b>Votos Contra: </b>{{propostaSelecionada.votos_contra}}</td>
                    <td rowspan="3"><b>Data: </b>{{propostaSelecionada.data_assinatura_ctc}}  <br><b>Assinatura:</b>____________________</td>
                </tr><tr>
                    <td><b>Votos em branco: </b>{{propostaSelecionada.votos_brancos}}</td>
                    <td><b>Votos Nulos: </b>{{propostaSelecionada.votos_nulos}}</td>
                    </tr>
                <tr  v-if="propostaSelecionada.aprovacao=='Aprovado'">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Aprovado</td>
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Não Aprovado</td>
                    </tr>
                <tr v-if="propostaSelecionada.aprovacao=='nao aprovado'">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Aprovado</td>
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Não Aprovado</td>
                    </tr>
          </table><br></div>
          
          <div class="tabelaRecursosHumanos2">
          <br>
          <div>
          </div>
          <table width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Documentos obrigatorios a anexar à presente proposta</font></th></tr>
                <tr>
                    <td>
                        <input type="checkbox" v-if="propostaSelecionada.convite!=null" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Convite<br>
                        <input type="checkbox" v-if="ficheiroRelatorioProponentes" id="scales" name="scales" onclick="return false;" checked>
                        <input type="checkbox" v-else id="scales" name="scales" onclick="return false;">Relatório subscrito por dois professores<br>

                        <input type="checkbox" v-if="ataCTC" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Cópia da Ata do CTC<br>
                        <input type="checkbox" v-if="ficheiroUnidadesCurriculares" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Distribuição de serviço docente<br>
                        <input type="checkbox" onclick="return false;">Autorização da acumulação de funções públicas pelo serviço de origem<br>
                        <input type="checkbox" v-if="ficheiroCurriculo" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Curriculum Vitae (contratação inicial)
                    </td>
                    <td>
                        <input type="checkbox" v-if="ficheiroCertificadoHabilitacoes" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Cópia dos certificados de habilitações de todos os graus (contratação inicial)<br>
                        <input type="checkbox" v-if="ficheiroNIF" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Cópia do NIF<br>
                        <input type="checkbox" v-if="ficheiroCGA" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">N.º de CGA/SS<br>
                        <input type="checkbox" v-if="ficheiroCC" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Cópia do CC/BI<br>
                        <input type="checkbox" v-if="ficheiroIBAN" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">>Cópia do IBAN/NIB<br>
                        <input type="checkbox" v-if="ficheiroCertificadoRegistoCriminal" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Certificado de Registo Criminal<br>
                        <input type="checkbox" v-if="ficheiroDeclaracaoRobustezFisica" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Declaração de Robustez Física<br>
                    </td>
                    <td>
                        <input type="checkbox" v-if="ficheiroBoletimVacinas" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Cópia do Boletim de Vacinas<br>
                        <input type="checkbox" v-if="ficheiroFichaIdentificacao" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Ficha de Identificação<br>
                        <input type="checkbox" v-if="ficheiroDeclaracaoArtigo99" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Declaração Artº 99 do IRS<br>
                        <input type="checkbox" v-if="ficheiroDeclaracaoRenuncia" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Declaração Comunic.Direitos/Renúncia ADSE<br>
                        <input type="checkbox" v-if="ficheiroConsultaOutrasEscolas" onclick="return false;" checked>
                        <input type="checkbox" v-else onclick="return false;">Resposta à consulta das outras Escolas</td>
                </tr>
          </table>
          <p style='font-size: 8px'>Atualizado em 05/2020 – DSRH<p>
          <p><b>Os dados recolhidos no âmbito deste processo têm como finalidade a celebração de contrato de trabalho em funções públicas e serão objeto de
                tratamento nos termos da legislação de proteção de dados em vigor.</b></p>
          </div>
   </div>
   
   <div class="tabelasRestantes"> 
   <div >
           <table width="100%" border="1px" align=center>
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Ficheiros Adicionados</font></th></tr>
                <tr v-if="ficheiroCurriculo">
                    <td>Curriculum Vitae</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroCurriculo.proposta_id, 'Curriculo do docente a ser contratado', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do currículo
                         </b-button>
                    </td>
                    <td><b-button class="botao" v-on:click="curriculo = !curriculo"
                            variant="dark">
                            Visualizar
                            {{propostaSelecionada.id_proposta_proponente}}
                        </b-button>
                     </td><tr v-if="curriculo" style="width: 100%">
                        <td colspan="3" style=" TABLE-LAYOUT: fixed; WORD-BREAK:BREAK-ALL;">
                            <pdf :src="fichCurriculo"></pdf>
                        </td>
                    </tr>
                </tr><tr v-if="ficheiroCertificadoHabilitacoes">
                    <td>Cópia dos Certificados de Habilitações</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroCertificadoHabilitacoes.proposta_id, 'Habilitacoes do docente a ser contratado', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download dos Certificado de Habilitações 
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="habilitacoes = !habilitacoes"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td></td>
                    <tr v-if="habilitacoes">
                        <td colspan="3" style="height: 50%">
                            {{fichCurriculo}}
                            <pdf name="fade" :src="fichCertificadoHabilitacoes"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroRelatorioProponentes">
                    <td>Relatorio susbcrito pelos Proponentes</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroRelatorioProponentes.proposta_id, 'Relatorio dos 2 proponentes', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Relatório dos Proponentes
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="relatorio = !relatorio"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="relatorio">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichRelatorioProponentes"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroRelatorioProponentes">
                    <td>Relatorio susbcrito pelos Proponentes</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroRelatorioProponentes.proposta_id, 'Relatorio dos 2 proponentes', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Relatório dos Proponentes
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="relatorio = !relatorio"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="relatorio">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichRelatorioProponentes"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroUnidadesCurriculares">
                    <td> Ficheiro das Unidades Curriculares</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroRelatorioProponentes.proposta_id, 'Ficheiro Unidades Curriculares do docente a ser contratado', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Ficheiro das Unidades Curriculares
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="uc = !uc"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="uc">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichUnidadesCurriculares"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroFundamentacao">
                    <td> Ficheiro da Fundamentação</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroRelatorioProponentes.proposta_id, 'Fundamentacao da Proposta Proponente Assistente', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro da Fundamentação
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="fundamentacao = !fundamentacao"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="fundamentacao">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichFundamentacao"></pdf>
                        </td></tr>

                </tr><tr v-if="ficheiroAssinadoCoordenadorCurso">
                    <td> Ficheiro Assinado Coordenador de Curso</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroAssinadoCoordenadorCurso.proposta_id, 'Proposta Assinado Coordenador Curso', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="uc = !uc"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="uc">
                        <td colspan="3" style="height: 50%">
                            <!--<pdf name="fade" :src="fichAssinadoCoordenadorCurso"></pdf>-->
                        </td></tr>
                </tr><tr v-if="ficheiroAssinadoCoordenadorDepartamento">
                    <td> Ficheiro Assinado Coordenador Departamento</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroAssinadoCoordenadorDepartamento.proposta_id, 'Proposta Assinado Coordenador Departamento', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="fundamentacao = !fundamentacao"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="fundamentacao">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichFundamentacao"></pdf>
                        </td></tr>


                </tr><tr v-if="ataCTC">
                    <td>Cópia da Ata do CTC</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ataCTC.proposta_id, 'Ata do CTC', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download da Ata do CTC
                    </b-button><td>
                        <b-button  v-on:click="ata = !ata"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td></td>
                    <tr v-if="ata">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>






             </tr><tr v-if="ficheiroNIF">
                <td>Cópia do NIF</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroNIF.proposta_id, 'Ficheiro NIF', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download da Cópia do NIF
                    </b-button><td>
                        <b-button  v-on:click="nif = !nif"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td></td>
                    <tr v-if="nif">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroCGA">
                    <td>N.º de CGA/SS</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroCGA.proposta_id, 'Ficheiro Nº CGA/SS', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro CGA
                    </b-button><td>
                        <b-button  v-on:click="cga = !cga"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td></td>
                    <tr v-if="cga">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroCC">
                    <td>Cópia do Cartão Cidadão</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroCC.proposta_id, 'Ficheiro Cópia CC', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> DownloadFicheiro do Cartão Cidadão
                    </b-button><td>
                        <b-button  v-on:click="cc = !cc"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                            {{propostaSelecionada.id_proposta_proponente}}
                        </b-button>
                     </td></td>
                    <tr v-if="cc">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroIBAN">
                    <td>Cópia IBAM/NIB</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroIBAN.proposta_id, 'Ficheiro Cópia IBAN', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro Cópia IBAN
                         </b-button>
                     </td><td>
                        <b-button  v-on:click="iban = !iban"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                            {{propostaSelecionada.id_proposta_proponente}}
                        </b-button>
                     </td>
                    <tr v-if="iban">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroCertificadoRegistoCriminal">
                    <td>Certificado de Registo Criminal</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroCertificadoRegistoCriminal.proposta_id, 'Ficheiro Registo Criminal', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download Ficheiro do Registo Criminal
                    </b-button></td><td>
                        <b-button  v-on:click="criminal = !criminal"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="criminal">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroDeclaracaoRobustezFisica">
                    <td>Declaração de Robustez Física</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroDeclaracaoRobustezFisica.proposta_id, 'Ficheiro Robustez Física', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro de Robustez Física
                    </b-button></td><td>
                        <b-button  v-on:click="robustez = !robustez"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="robustez">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroBoletimVacinas">
                    <td>Cópia do Boletim Vacinas</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroBoletimVacinas.proposta_id, 'Ficheiro Boletim Vacinas', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro do Boletim Vacinas
                    </b-button></td><td>
                        <b-button  v-on:click="vacinas = !vacinas"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="vacinas">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroFichaIdentificacao">
                    <td>Ficha Identificacao</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroFichaIdentificacao.proposta_id, 'Ficheiro Ficha Identificacao', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro da Ficha Identificacao
                    </b-button></td><td>
                        <b-button  v-on:click="identificacao = !identificacao"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="identificacao">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroDeclaracaoRenuncia">
                    <td>DCD/Renuncia ADSE</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroDeclaracaoRenuncia.proposta_id, 'Ficheiro Renuncia ADSE', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro da Renuncia ADSE
                    </b-button></td><td>
                        <b-button  v-on:click="adse = !adse"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="adse">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroDeclaracaoArtigo99">
                    <td>Declaracao Artº 99 do IRS</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            @click="downloadFicheiro(ficheiroDeclaracaoArtigo99.proposta_id, 'Ficheiro Declaracao IRS', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro da Declaracao IRS
                    </b-button></td><td>
                        <b-button  v-on:click="artigo = !artigo"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="artigo">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroConsultaOutrasEscolas">
                    <td>Resposta à Consulta das Outras Escolas</td>
                    <td><b-button
                            size="md"
                            variant="dark"
                            style="width:100%"
                            click="downloadFicheiro(ficheiroConsultaOutrasEscolas.proposta_id, 'Ficheiro Resposta Consulta Outras Escolas', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Download do Ficheiro da Resposta Consulta Outras Escolas
                    </b-button></td><td>
                        <b-button  v-on:click="consulta = !consulta"
                            size="md"
                            variant="dark"
                            style="width:100%">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="consulta">
                        <td colspan="3" style="height: 50%">
                            <pdf name="fade" :src="fichCurriculo"></pdf>
                        </td></tr>
                </tr><tr>

                </tr>
          </table><br>
</div></div>          
        <div class="total" v-if="this.$store.state.user.roleDB != 'recursos_humanos'" style ="width:120%; left:-30.2 ;">
            <pdf :src="fichAssinado"></pdf><br>
        </div>
    
    <fundamentacao-departamento
      v-if="this.$store.state.user.roleDB == 'proponente_departamento' &&
      this.propostaSelecionada.fundamentacao_coordenador_departamento == null"
      :propostaSelecionada="propostaSelecionada"
      v-on:voltarProponentes="voltarProponentes"
    ></fundamentacao-departamento>

    <fundamentacao-curso
      v-if="this.$store.state.user.roleDB == 'proponente_curso' &&
            this.propostaSelecionada.fundamentacao_coordenador_curso == null"
      :propostaSelecionada="propostaSelecionada"
      v-on:voltarProponentes="voltarProponentes"
    ></fundamentacao-curso>

    

    <diretor
      v-if="this.$store.state.user.roleDB == 'diretor_uo' && this.propostaSelecionada.proposta_diretor_uo_id == null"
      :propostaSelecionada="propostaSelecionada"
       v-on:mostrarDiretor="voltarDiretor"
    ></diretor>
    <ctc
      v-if="propostaSelecionada.proposta_ctc_id == null && this.$store.state.user.roleDB == 'ctc'"
      :propostaSelecionada="propostaSelecionada"
      v-on:mostrarCTC="voltarCTC"
    ></ctc>
    <proposta-secretariado
      v-if="propostaSelecionada.proposta_secretariado_direcao_id == null &&this.$store.state.user.roleDB == 'secretariado_direcao'"
      :propostaSelecionada="propostaSelecionada"
      v-on:mostrarSecretariado="voltarSecretariado"
    ></proposta-secretariado>
    <proposta-recursos
      v-if="this.propostaSelecionada.proposta_recursos_humanos_id == null &&
       this.$store.state.user.roleDB == 'recursos_humanos'"
      :propostaSelecionada="propostaSelecionada"
      v-on:mostrarRh="voltarRecursosHumanos"
    ></proposta-recursos>

    </tr>   

    </table>












    </div>



    </div>






</template>
<script>
import VuePdfApp from "vue-pdf-app"
// import this to use default icons for buttons
import "vue-pdf-app/dist/icons/main.css"
import pdf from 'vue-pdf'
import jsPDF from 'jspdf'
export default {
  components: {
    VuePdfApp,
    pdf
  },
  props: ["propostaSelecionada"],
  data() {
    return {
      curriculo: false,
      habilitacoes: false,
      relatorio: false,
      uc: false,
      fundamentacao: false,
      assCurso: false,
      assDepartemento: false,
      ata: false,
      nif: false,
      cga: false,
      cc: false,
      iban: false,
      criminal: false,
      robustez: false,
      vacinas: false,
      identificacao: false,
      adse: false,
      artigo: false,
      consulta: false,


      isDashboardVisible: true,
      isNovaPropostaVisible: false,
      isActiveProponente: false,
      isActiveDiretorUO: false,
      isActiveCTC: false,
      isActiveSD: false,
      isActiveRH: false,
      isEditarPropostaVisible: false,
      isEnviarPropostaVisible: false,
      propostaSel: "",
      tipoPropostaRole: [],
      ucsDaPropostaSelecionada: [],
      ficheiros: [],
      ficheiroCurriculo: "",
      ficheiroRelatorioProponentes: "",
      ficheiroCertificadoHabilitacoes: "",
      ficheiroUnidadesCurriculares: "",
      ficheiroFundamentacao: "",
      ficheiroAssinadoCoordenadorCurso: "",
      ficheiroAssinadoCoordenadorDepartamento: "",
      
      ataCTC: "",
      ficheiroNIF:"",
      ficheiroCGA:"",
      ficheiroCC:"",
      ficheiroIBAN:"",
      ficheiroCertificadoRegistoCriminal:"",
      ficheiroDeclaracaoRobustezFisica:"",
      ficheiroBoletimVacinas:"",
      ficheiroFichaIdentificacao:"",
      ficheiroDeclaracaoArtigo99:"",
      ficheiroDeclaracaoRenuncia:"",
      ficheiroConsultaOutrasEscolas:"",
      fichRelatorioProponentes:"",
      ficheiroAssinado:"",
      fichCurriculo:"",
      fichCertificadoHabilitacoes:"",
      fichAtaCTC:"",
      fichNIF:"",
      fichCGA:"",
      fichCC:"",
      fichIBAN:"",
      fichCertificadoRegstoCriminal:"",
      fichDeclaracaoRobustezFisica:"",
      fichBoletimVacinas:"",
      fichFichaIdentificacao:"",
      fichDeclaracaoArtigo99:"",
      fichDeclaracaoRenuncia:"",
      fichConsultaOutrasEscolas:"",
      fichAssinado:"",


      ver: "0",
      fichCurriculo:"",
      propostaID: ""

    };
  },
  methods: {
    voltarProponentes() {
      this.$emit("mostrarProponentes", this.propostaSelecionada);
    },
    voltarDiretor() {
      this.$emit("mostrar-diretor");
    },
    voltarCTC() {
      this.$emit("mostrar-ctc");
    },
    voltarSecretariado() {
      this.$emit("mostrar-secretariado");
    },
    voltarRecursosHumanos() {
      this.$emit("mostrar-recursos");
    },

    downloadFicheiro(proposta_id, descricao, proposta_nome) {
      axios
        .get("/api/downloadFicheiro/" + proposta_id + "/" + descricao, {
          responseType: "arraybuffer"
        })
        .then(response => {
          let blob = new Blob([response.data]);
          let link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          link.download = descricao + " " + proposta_nome + ".pdf";
          link.click();
        });
    },
    downloadFich(proposta_id, descricao) {
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
    exportarPDF() {
      var doc = new jsPDF();
      doc.fromHTML($("#proposta").get(0), 20, 20);
      doc.save("Proposta Contratação " + this.propostaSelecionada.nome_completo+".pdf");
    },
    
    gerarPdfPropostaProponente(){
      
        var doc = new jsPDF();
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.226,
                    scrollY:0
                },
                x: 10,
                y: 10, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
        
    },

    
    gerarPdfCtc(){
        var doc = new jsPDF();
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(ctcPdf, { 
                html2canvas: {
                    scale: 0.226,
                    scrollY:0
                },
                x: 0,
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });  
    },

    gerarPdfRecursosHumanos(){
        var doc = new jsPDF();
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(recursosHumanos, { 
                html2canvas: {
                    scale: 0.226,
                    scrollY:0
                },
                x: 10,
                y: 10, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });  
    },

    
    gerarPdfUo(){
        var doc = new jsPDF();
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(Uo, { 
                html2canvas: {
                    scale: 0.226,
                    scrollY:0
                },
                x: 5,
                y: 10, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
        
    },
  },
  mounted() {
    this.$swal('Atenção', 'Tem apenas uma oportunidade de submeter corretamente o ficheiro assinado', 'info')
    /*axios.get('/api/getPropostaParaNovoDocente/'+this.$store.state.user.email).then(response => {
      this.propostaDesteProponente = response.data[0];
      console.log(this.propostaDesteProponente.id_proposta_proponente);
      axios.get('/api/propostaDePropostaProponente/'+this.propostaDesteProponente.id_proposta_proponente)
      .then(response => {
        this.proposta = response.data;
      })
    });*/
    axios
      .get(
        "/api/propostaDePropostaProponente/" +
          this.propostaSelecionada.id_proposta_proponente
      )
      .then(response => {
        this.propostaID = response.data.id;
        console.log(this.propostaID)
        axios.get("/api/ficheiros/" + this.propostaID).then(response => {

          this.ficheiros = response.data;
          this.ficheiroUnidadesCurriculares = this.ficheiros[0];
          this.fichUnidadesCurriculares = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Unidades_Curriculares_do_docente_a_ser_contratado.pdf";

          if(this.tipoPropostaRole.regime_prestacao_servicos=="dedicacao_exclusiva" ||
             this.tipoPropostaRole.regime_prestacao_servicos=="tempo_integral" ||
             this.tipoPropostaRole.regime_prestacao_servicos=="tempo_parcial_60"){
                this.ficheiroFundamentacao = this.ficheiros[1];
                this.fichFundamentacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Fundamentacao_da_Proposta_Proponente_Assistente.pdf",

                this.ataCTC = this.ficheiros[2];
                this.fichAtaCTC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
         
                if(this.propostaSelecionada.tipo_contrato == "contratacao_inicial"){
                    this.ficheiroCurriculo = this.ficheiros[3];
                    this.fichCurriculo = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoHabilitacoes = this.ficheiros[4];
                    this.fichCertificadoHabilitacoes = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Habilitacoes_do_docente_a_ser_contratado.pdf",

                    this.ficheiroNIF = this.ficheiros[5];
                    this.fichNIF = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCGA = this.ficheiros[6];
                    this.fichCGA = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCC = this.ficheiros[7];
                    this.fichCC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroIBAN = this.ficheiros[8];
                    this.fichIBAN = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoRegistoCriminal = this.ficheiros[9];
                    this.fichCertificadoRegstoCriminal = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRobustezFisica = this.ficheiros[10];
                    this.fichDeclaracaoRobustezFisica = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroBoletimVacinas = this.ficheiros[11];
                    this.fichBoletimVacinas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroFichaIdentificacao = this.ficheiros[12];
                    this.fichFichaIdentificacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoArtigo99 = this.ficheiros[13];
                    this.fichDeclaracaoArtigo99 = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRenuncia = this.ficheiros[14];
                    this.fichDeclaracaoRenuncia = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroConsultaOutrasEscolas = this.ficheiros[15];
                    this.fichConsultaOutrasEscolas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
                }else{
                    this.ficheiroNIF = this.ficheiros[3];
                    this.fichNIF = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCGA = this.ficheiros[4];
                    this.fichCGA = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCC = this.ficheiros[5];
                    this.fichCC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroIBAN = this.ficheiros[6];
                    this.fichIBAN = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoRegistoCriminal = this.ficheiros[7];
                    this.fichCertificadoRegstoCriminal = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRobustezFisica = this.ficheiros[8];
                    this.fichDeclaracaoRobustezFisica = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroBoletimVacinas = this.ficheiros[9];
                    this.fichBoletimVacinas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroFichaIdentificacao = this.ficheiros[10];
                    this.fichFichaIdentificacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoArtigo99 = this.ficheiros[11];
                    this.fichDeclaracaoArtigo99 = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRenuncia = this.ficheiros[12];
                    this.fichDeclaracaoRenuncia = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroConsultaOutrasEscolas = this.ficheiros[13];
                    this.fichConsultaOutrasEscolas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
                }
          }else{
                this.ataCTC = this.ficheiros[1];
                this.fichAtaCTC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
         
                if(this.propostaSelecionada.tipo_contrato == "contratacao_inicial"){
                    this.ficheiroCurriculo = this.ficheiros[2];
                    this.fichCurriculo = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoHabilitacoes = this.ficheiros[3];
                    this.fichCertificadoHabilitacoes = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Habilitacoes_do_docente_a_ser_contratado.pdf",

                    this.ficheiroNIF = this.ficheiros[4];
                    this.fichNIF = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCGA = this.ficheiros[5];
                    this.fichCGA = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCC = this.ficheiros[6];
                    this.fichCC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroIBAN = this.ficheiros[7];
                    this.fichIBAN = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoRegistoCriminal = this.ficheiros[8];
                    this.fichCertificadoRegstoCriminal = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRobustezFisica = this.ficheiros[9];
                    this.fichDeclaracaoRobustezFisica = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroBoletimVacinas = this.ficheiros[10];
                    this.fichBoletimVacinas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroFichaIdentificacao = this.ficheiros[11];
                    this.fichFichaIdentificacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoArtigo99 = this.ficheiros[12];
                    this.fichDeclaracaoArtigo99 = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRenuncia = this.ficheiros[13];
                    this.fichDeclaracaoRenuncia = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroConsultaOutrasEscolas = this.ficheiros[14];
                    this.fichConsultaOutrasEscolas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
                }else{
                    this.ficheiroNIF = this.ficheiros[2];
                    this.fichNIF = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCGA = this.ficheiros[3];
                    this.fichCGA = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCC = this.ficheiros[4];
                    this.fichCC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroIBAN = this.ficheiros[5];
                    this.fichIBAN = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroCertificadoRegistoCriminal = this.ficheiros[6];
                    this.fichCertificadoRegstoCriminal = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRobustezFisica = this.ficheiros[7];
                    this.fichDeclaracaoRobustezFisica = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroBoletimVacinas = this.ficheiros[8];
                    this.fichBoletimVacinas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroFichaIdentificacao = this.ficheiros[9];
                    this.fichFichaIdentificacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoArtigo99 = this.ficheiros[10];
                    this.fichDeclaracaoArtigo99 = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroDeclaracaoRenuncia = this.ficheiros[11];
                    this.fichDeclaracaoRenuncia = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf",
                    this.ficheiroConsultaOutrasEscolas = this.ficheiros[12];
                    this.fichConsultaOutrasEscolas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";
                }
          
          }


          
          /*this.ficheiroRelatorioProponentes = this.ficheiros[0];
          this.fichRelatorioProponentes = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Relatorio_dos_2_proponentes.pdf",
          */

          /*this.ficheiroAssinadoCoordenadorCurso = this.ficheiros[5];
          this.fichAssinadoCoordenadorCurso = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinado_Coordenador_Curso.pdf",
          this.ficheiroAssinadoCoordenadorDepartamento = this.ficheiros[6];
          this.fichAssinadoCoordenadorDepartamento = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinado_Coordenador_Departamento.pdf",
          
          */
          //this.fichAssinado = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/Proposta Contratação.pdf";
          
        });
      });
    axios
      .get(
        "/api/diretorUO/getPropostaProponente/" +
          this.propostaSelecionada.role +
          "/" +
          this.propostaSelecionada.id_proposta_proponente
      )
      .then(response => {
        this.tipoPropostaRole = response.data[0];
      });

    axios
      .get(
        "api/diretorUO/getUCSPropostaSelecionada/" +
          this.propostaSelecionada.id_proposta_proponente
      )
      .then(response => {
        this.ucsDaPropostaSelecionada = response.data;
      });
      this.ucsDaPropostaSelecionada.forEach(uc => {
          axios.get('/api/unidadeCurricularNome/'+uc.codigo_uc).then(response => {
            console.log(response);
          })
      });
        
  }
};
</script>




<style lang="scss">
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
  opacity: 0;
}

.botao{
  size: md;
  width: 100%;
}
   /*                         
.proponente{
 padding: 5%;
 top: 7.7%;
 left: 3.2%;
 width: 96.5%;
}


.diretoruo{
 padding: 10%;
 left: 6.8%;
 width: 108%;
}

.uoPdfTabela{
 padding: 5%;
 top: 58%;
 left: -0.5%;
 width: 104%;
}

.tc{
 padding: 5%;
 top: 58%;
 left: 2%;
 width: 96.5%;
}

.tcPdf{
 padding: 5%;
 top: 40%;
 left: 2%;
 width: 96.5%;
}

.ctcPdfTabela{
 padding: 5%;
 top: 66%;
 left: 6%;
 width: 87.5%;
}

.tabelaCabecalho{
 padding: 5%;
 top: 12%;
 left: 6%;
 width: 87.5%;
}

.tabelaRecursosHumanos{
 padding: 5%;
 top: 25.5%;
 left: 7%;
 width: 87.5%;
}

.pdfRecursosHumanos{
 padding: 5%;
 top: 27.5%;
 left: -5%;
 width: 106.5%;
}

.tabelaRecursosHumanos2{
 padding: 5%;
 top: 79.5%;
 left: 6%;
 width: 87.5%;
}

.downloadPdfRecursosHumanos{
 padding: 5%;
 top: 25%;
 width: 87.5%;
}

.downloadPdfRecursosHumanos3{
 padding: 5%;
 top: 25%;
 width: 87.5%;  
}

.downloadPdfRecursosHumanos3{
 padding: 5%;
 top: 80%;
 width: 87.5%;  
}

.downloadpdf{
 width: 96.5%;
}

.tabelasRestantes{
 padding: 5%;
 left: 3.2%;
 width: 96.5%;
}

.abelaFicheiro{
 padding: 5%;
 top: 110%;
 left: 3.2%;
 width: 96.5%;

}

.total{
 width: 120%;
 left: -30.2 ;
}
.total2{
 padding: 2%;
 position: absolute;
bottom: 0;
z-index: 50;
}*/



</style>
