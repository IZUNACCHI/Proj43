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
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'ctc'">
      <button class="btn btn-danger" @click="voltarCTC">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'secretariado_direcao'">
      <button class="btn btn-danger" @click="voltarSecretariado">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Dowload</button>
      <h3>Resumo da proposta de contratação</h3>
    </div>

    <div v-if="this.$store.state.user.roleDB == 'recursos_humanos'">
      <h3>Resumo da proposta de contratação</h3>
      <button class="btn btn-danger" @click="voltarRecursosHumanos">Voltar</button>
      <button class="btn btn-danger" v-on:click.prevent="gerarPdfPropostaProponente()">Download</button>
    </div>
    <!--<div>
        <label><strong>Nome do Docente:</strong> {{ propostaSelecionada.id_proposta_proponente}} {{propostaSelecionada.grau}}</label>
    </div>
    {{this.numPages}}-->
    <div id="downloadPdf" class="total1" width="93%">
    <div  >
      <div  >
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
                    <td><b>Número de Funcionário:</b>{{propostaSelecionada.numero_funcionario}}{{contagemficheiro}}<br>
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
                        <input type="checkbox" v-if="ficheiroUnidadesCurriculares" id="scales" name="scales" onclick="return false;" checked>
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
                    <td rowspan="8" style='text-align:center' v-if="propostaSelecionada.tipo_contrato == 'contratacao_inicial'">
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
                        <input type="checkbox" v-if="ficheiroFundamentacao" id="scales" name="scales" onclick="return false;" checked>
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
                    <td rowspan="8" style='text-align:center' v-if="propostaSelecionada.tipo_contrato == 'contratacao_inicial'">
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
                    <td><b>Remuneração: </b>{{tipoPropostaRole.remuneracao}}€</td>
                    <td><b>Escalão: </b>{{tipoPropostaRole.escalao}}</td>
                    <td><b>Índice: </b>{{tipoPropostaRole.indice}}</td></tr>
          </table><br>
          <table width="100%" border="1px">
                <tr><th colspan="3" bgcolor=#be5b59> <font color=#ffffff>Contratação para mais do que uma UO do IPL</font></th></tr>
                <tr>
                    <td>O docente proposto já se econtra a exercer funções noutra UO do IPL?</td>
                    <td rowspan="2" v-if="tipoPropostaRole.verificacao_outras_uo=='sim'">
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        <b>Sim</b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;">
                        <b>Não</b>
                        <p v-if="tipoPropostaRole.verificacao_tempo_parcial=='sim'">Sim, UO <b>{{tipoPropostaRole.nome_uo}}</b> Tempo parcial <b>
                        <input type="checkbox" id="scales" name="scales" onclick="return false;" checked>
                        {{tipoPropostaRole.tempo_parcial_uo}}%</b><br>
                        Periodio <b>{{tipoPropostaRole.periodo_uo}}</b></p>
                        <p v-else>Sim, UO <b>{{tipoPropostaRole.nome_uo}}</b> Tempo parcial
                        <input type="checkbox" id="scales" name="scales" onclick="return false;"><br>
                        Periodio <b>{{tipoPropostaRole.periodo_uo}}</b></p></td>
                    <td rowspan="2" v-if="tipoPropostaRole.verificacao_outras_uo=='nao'">
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
                    <td v-if="propostaSelecionada.primeiro_proponente=='Coordenador de Departamento'">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                        <br><br><br><br><br><br>
                        <b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                    <td v-if="propostaSelecionada.segundo_proponente=='Coordenador de Departamento'">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_departamento}}</td>
                    <td v-if="propostaSelecionada.fundamentacao_coordenador_departamento == null">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_departamento }}</textarea><br>
                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> _________________
                        <b>Data:</b> _________________</td>
                    <td v-if="propostaSelecionada.segundo_proponente=='Coordenador de Curso'">
                    <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{propostaSelecionada.fundamentacao_coordenador_curso}}</textarea><br>
                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.segundo_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                    <td v-if="propostaSelecionada.primeiro_proponente=='Coordenador de Curso'">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{propostaSelecionada.fundamentacao_coordenador_curso}}</textarea><br>
                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> {{propostaSelecionada.primeiro_proponente}}
                        <b>Data:</b> {{propostaSelecionada.data_de_assinatura_coordenador_de_curso}}</td>
                    <td v-if="propostaSelecionada.fundamentacao_coordenador_curso == null">
                        <b>Reconheço o interesse e a necessidade da contratação inicial/renovação</b><br>
                        Fundamentação<br>
                        <textarea cols="50%" name="fundamentacao" readonly=“true” style="resize: none">{{ propostaSelecionada.fundamentacao_coordenador_curso }}</textarea><br>
                        <br><br><br><br><br><br><b>Ass.:</b> _______________________________<br>
                        <b>Nome:</b> _________________
                        <b>Data:</b> _________________</td>
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
                    <td rowspan="2" width="60%"><br><br><br><br><br><b>Assinatura: </b>____________________<br><b>Data: </b>{{propostaSelecionada.data_assinatura_uo}}</td>
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
                    <td rowspan="3"><br><br><br><br><br><b>Assinatura:</b>____________________<br><b>Data: </b>{{propostaSelecionada.data_assinatura_ctc}} </td>
                </tr><tr>
                    <td><b>Votos em branco: </b>{{propostaSelecionada.votos_brancos}}</td>
                    <td><b>Votos Nulos: </b>{{propostaSelecionada.votos_nulos}}</td>
                    </tr>
                <tr  v-if="propostaSelecionada.aprovacao=='Aprovado'">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Aprovado</td>
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Não Aprovado</td>
                    </tr>
                <tr v-if="propostaSelecionada.aprovacao=='Nao Aprovado'">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Aprovado</td>
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;" checked>Não Aprovado</td>
                    </tr>
                <tr v-if="!propostaSelecionada.aprovacao">
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Aprovado</td>
                    <td><input type="checkbox" id="scales" name="scales" onclick="return false;">Não Aprovado</td>
                    </tr>
          </table><br></div>
          
          <div class="tabelaRecursosHumanos2">
          <br>
          <div v-if="propostaSelecionada.role == 'monitor'">
            <br><br><br><br><br>
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
                        <input type="checkbox" v-else onclick="return false;">Cópia do IBAN/NIB<br>
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
          
        <div v-if="propostaSelecionada.status == 'finalizada'">
		
                <div v-if="ficheiroUnidadesCurriculares">
                    <pdf
			            :src="fichUnidadesCurriculares"
        	            @num-pages="pageCount101 = $event"
			            @page-loaded="currentPage1 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="aa in pageCount101"
			            :key="aa"
			            :src="fichUnidadesCurriculares"
			            :page="aa"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                    </div>
					<div v-if="ficheiroFundamentacao">
                    <pdf
			            :src="fichFundamentacao"
                        @num-pages="pageCount102 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="bb in pageCount102"
			            :key="bb"
			            :src="fichFundamentacao"
			            :page="bb"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                    <div v-if="ficheiroPropostaAssinadoUmProponente">
                    <pdf
			            :src="fichPropostaAssinadoCurso"
                        @num-pages="pageCount103 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="cc in pageCount103"
			            :key="cc"
			            :src="fichPropostaAssinadoCurso"
			            :page="cc"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroPropostaAssinado">
                    <pdf
			            :src="fichPropostaAssinadoDepartamento"
                
                        @num-pages="pageCount104 = $event"
	                    @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
	                ></pdf>
                    <pdf
	                    v-for="dd in pageCount104"
	                    :key="dd"
	                    :src="fichPropostaAssinadoDepartamento"
	                    :page="dd"
	                    style="display: inline-block; width: 100%"
	                ></pdf>
                </div>
                        
                <div v-if="ficheiroPropostaAssinadoUO">
                    <pdf
			            :src="fichPropostaAssinadoUO"
                
			            @num-pages="pageCount105 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="ee in pageCount105"
			            :key="ee"
			            :src="fichPropostaAssinadoUO"
			            :page="ee"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ataCTC">
                    <pdf
			            :src="fichAtaCTC"
                
			            @num-pages="pageCount105 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="ff in pageCount105"
			            :key="ff"
			            :src="fichAtaCTC"
			            :page="ff"
			            style="display: inline-block; width: 100%"
		            ></pdf>

                    


                        
                </div><div v-if="ficheiroPropostaAssinadoCTC">
                    <pdf
			            :src="fichPropostaAssinadoCTC"
                
						@num-pages="pageCount107 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="gg in pageCount107"
			            :key="gg"
			            :src="fichPropostaAssinadoCTC"
						:page="gg"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                    


                </div><div v-if="ficheiroCurriculo">
                    <pdf
			            :src="fichCurriculo"
                
			            @num-pages="pageCount108 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="hh in pageCount108"
			            :key="hh"
			            :src="fichCurriculo"
			            :page="hh"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroCertificadoHabilitacoes">
                    <pdf
			            :src="fichCertificadoHabilitacoes"
                
			            @num-pages="pageCount109 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="ii in pageCount109"
			            :key="ii"
			            :src="fichCertificadoHabilitacoes"
			            :page="ii"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                        
                </div><div v-if="ficheiroNIF">
                    <pdf
			            :src="fichNIF"
                
			            @num-pages="pageCount110 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="jj in pageCount110"
			            :key="jj"
			            :src="fichNIF"
			            :page="jj"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroCGA">
                    <pdf
			            :src="fichCGA"
                
			        @num-pages="pageCount111 = $event"
			        @page-loaded="currentPage2 = $event"
                    style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="ll in pageCount111"
			            :key="ll"
			            :src="fichCGA"
			            :page="ll"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                        
                </div><div v-if="ficheiroCC">
                    <pdf
			            :src="fichCC"
                
			            @num-pages="pageCount112 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="mm in pageCount112"
			            :key="mm"
			            :src="fichCC"
			            :page="mm"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroIBAN">
                    <pdf
			            :src="fichIBAN"
                
			            @num-pages="pageCount113 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="nn in pageCount113"
			            :key="nn"
			            :src="fichIBAN"
			            :page="nn"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroRegistoCriminal">
                    <pdf
			            :src="fichCertificadoRegistoCriminal"
                
			            @num-pages="pageCount114 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="oo in pageCount114"
			            :key="oo"
			            :src="fichCertificadoRegistoCriminal"
			            :page="oo"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroDeclaracaoRobustezFisica">
                    <pdf
                        :src="fichDeclaracaoRobustezFisica"
                
                        @num-pages="pageCount115 = $event"
                        @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
                    ></pdf>
                    <pdf
                        v-for="pp in pageCount115"
                        :key="pp"
                        :src="fichRobustezFisica"
                        :page="pp"
                        style="display: inline-block; width: 100%"
                    ></pdf>
                </div><div v-if="ficheiroBoletimVacinas">
                    <pdf
			            :src="fichBoletimVacinas"
                
			            @num-pages="pageCount116 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="qq in pageCount116"
			            :key="qq"
			            :src="fichBoletinVacinas"
			            :page="qq"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroIDentificacao">
                    <pdf
			            :src="fichFichaIdentificacao"
                
			            @num-pages="pageCount117 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="rr in pageCount117"
			            :key="rr"
			            :src="fichFichaIdentifcacao"
			            :page="rr"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroDeclaracaRenuncia">
                    <pdf
			            :src="fichDeclaracaoRenuncia"
                
			            @num-pages="pageCount118 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="ss in pageCount118"
			            :key="ss"
			            :src="fichDeclaracaoRenuncia"
			            :page="ss"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroArtigo999">
                    <pdf
			            :src="fichDeclaracaoArtigo99"
                
			            @num-pages="pageCount119 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="tt in pageCount119"
			            :key="tt"
			            :src="fichDeclaracaoArtigo99"
			            :page="tt"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroConsultaOutrasEscolas">
                    <pdf
			            :src="fichConsultaOutrasEscolas"
                
			            @num-pages="pageCount120 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="uu in pageCount120"
			            :key="uu"
			            :src="ficheiroConsultaOutrasEscolas"
			            :page="uu"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroContratacaoComunicada">
					<pdf
			            :src="fichContracaoComunicada"
                
			            @num-pages="pageCount121 = $event"
			            @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
		            ></pdf>
                    <pdf
			            v-for="uu in pageCount121"
			            :key="uu"
			            :src="fichContracaoComunicada"
			            :page="uu"
			            style="display: inline-block; width: 100%"
		            ></pdf>
                </div><div v-if="ficheiroContratoRedigido">
                    <pdf
                        :src="fichContratoRedigido"
                
                        @num-pages="pageCount122 = $event"
                        @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
                    ></pdf>
                    <pdf
                        v-for="uu in pageCount122"
                        :key="uu"
                        :src="fichContratoRedigido"
                        :page="uu"
                        style="display: inline-block; width: 100%"
                    ></pdf>
                </div><div v-if="ficheiroCessacaoSocial">
                    <pdf
                        :src="fichCessacaoSocial"
                
                        @num-pages="pageCount123 = $event"
                        @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
                    ></pdf>
                    <pdf
                        v-for="uu in pageCount123"
                        :key="uu"
                        :src="fichCessacaoSocial"
                        :page="uu"
                        style="display: inline-block; width: 100%"
                    ></pdf>
				</div><div v-if="ficheiroContrato">
                    <pdf
                        :src="fichContrato"
                
                        @num-pages="pageCount124 = $event"
                        @page-loaded="currentPage2 = $event"
                        style="display: inline-block; width: 1%; opacity: 0"
	                ></pdf>
                    <pdf
	                    v-for="uu in pageCount124"
	                    :key="uu"
	                    :src="fichContrato"
	                    :page="uu"
	                    style="display: inline-block; width: 100%"
	                ></pdf>
                </div>
                </div>
		</div>
   </div>
   </div>
   <div class="tabelasRestantes" v-if="propostaSelecionada.status != 'finalizada'"> 
   <div data-html2canvas-ignore="true">
           <table width="100%" border="1px" align=center>
                <tr><th colspan="3" bgcolor=#be5b59><font color=#ffffff>Ficheiros Adicionados</font></th></tr>
                <tr v-if="ficheiroUnidadesCurriculares">
                    <td> Ficheiro das Unidades Curriculares</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroUnidadesCurriculares.proposta_id, 'Ficheiro Unidades Curriculares do docente a ser contratado', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Ficheiro das Unidades Curriculares
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="uc = !uc"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="uc">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichUnidadesCurriculares"
        	                    @num-pages="pageCount101 = $event"
			                    @page-loaded="currentPage1 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="aa in pageCount101"
			                    :key="aa"
			                    :src="fichUnidadesCurriculares"
			                    :page="aa"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        </td></tr>
                <tr v-if="propostaSelecionada.verificacao_serviço_docente_atribuido=='nao'">
                    <td> Ficheiro das Unidades Curriculares</td>
                    <td v-if="uc1"><b-button class="botao"
                            variant="dark"
                            @click="gerarPdfServiçoDocenteAtribuído()">
                            <i class="far fa-file-pdf"></i> Ficheiro das Unidades Curriculares
                    </b-button></td><td v-if="!uc1">
                        <b-button class="botao"
                                variant="dark"
                                @click="gerarPdfServiçoDocenteAtribuído()"
                                disabled>
                                <i class="far fa-file-pdf"></i> Ficheiro das Unidades Curriculares
                        </b-button></td><td>
                        <b-button class="botao" v-on:click="uc1 = !uc1"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="uc1">
                        <div id="ServiçoDocenteAtribuído">
                        <p>Serviço Docente Atribuído</p>
                        <td colspan="3" style="height: 50%">
                            <table width="100%" border="1px" v-if="propostaSelecionada.verificacao_serviço_docente_atribuido=='nao'">
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
                                <tr v-for="uc in ucsDaPropostaSelecionada" :key="uc.ID">
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
                        </td></div></tr>
                
                </tr><tr v-if="ficheiroFundamentacao">
                    <td> Ficheiro da Fundamentação</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroFundamentacao.proposta_id, 'Fundamentacao da Proposta Proponente', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro da Fundamentação
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="fundamentacao = !fundamentacao"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="fundamentacao">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichFundamentacao"
                
			                    @num-pages="pageCount102 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="bb in pageCount102"
			                    :key="bb"
			                    :src="fichFundamentacao"
			                    :page="bb"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        </td></tr>
                    <tr v-if="ficheiroPropostaAssinadoUmProponente">
                    <td> Ficheiro Assinado Por Um Proponente</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroPropostaAssinadoUmProponente.proposta_id, 'Proposta Assinada Um Proponente', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="assinadoCurso = !assinadoCurso"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="assinadoCurso">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichPropostaAssinadoCurso"
                
			                    @num-pages="pageCount103 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="cc in pageCount103"
			                    :key="cc"
			                    :src="fichPropostaAssinadoCurso"
			                    :page="cc"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        </td></tr>
                </tr><tr v-if="ficheiroPropostaAssinado">
                    <td> Ficheiro Assinado</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroPropostaAssinado.proposta_id, 'Proposta Assinada', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="assinadoDepartamento = !assinadoDepartamento"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="assinadoDepartamento">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichPropostaAssinadoDepartamento"
                
			                    @num-pages="pageCount104 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="dd in pageCount104"
			                    :key="dd"
			                    :src="fichPropostaAssinadoDepartamento"
			                    :page="dd"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        </td></tr>
                        
                </tr><tr v-if="ficheiroPropostaAssinadoUO">
                    <td> Ficheiro Assinado Diretor UO</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroPropostaAssinadoUO.proposta_id, 'Proposta Assinado Coordenador Departamento', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="assinadoUO = !assinadoUO"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="assinadoUO">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichPropostaAssinadoUO"
                
			                    @num-pages="pageCount105 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="ee in pageCount105"
			                    :key="ee"
			                    :src="fichPropostaAssinadoUO"
			                    :page="ee"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
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
                            
                            <pdf
			                    :src="fichAtaCTC"
                
			                    @num-pages="pageCount105 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="ff in pageCount105"
			                    :key="ff"
			                    :src="fichAtaCTC"
			                    :page="ff"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>

                        </td></tr>



                        
                </tr><tr v-if="ficheiroPropostaAssinadoCTC">
                    <td> Ficheiro Assinado CTC</td>
                    <td><b-button class="botao"
                            variant="dark"
                            @click="downloadFicheiro(ficheiroPropostaAssinadoCTC.proposta_id, 'Proposta Assinado CTC ', propostaSelecionada.nome_completo)">
                            <i class="far fa-file-pdf"></i> Donwload do Ficheiro Assinado
                    </b-button></td><td>
                        <b-button class="botao" v-on:click="assinadoCTC = !assinadoCTC"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="assinadoCTC">
                        <td colspan="3" style="height: 50%">
                            <pdf
			                    :src="fichPropostaAssinadoCTC"
                
			                    @num-pages="pageCount107 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="gg in pageCount107"
			                    :key="gg"
			                    :src="fichPropostaAssinadoCTC"
			                    :page="gg"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        </td></tr>



                    <tr v-if="propostaSelecionada.convite!=null">
                    <td> Ficheiro das Unidades Curriculares</td>
                    <td v-if="conv"><b-button class="botao"
                            variant="dark"
                            @click="gerarPdfConvite()">
                            <i class="far fa-file-pdf"></i> Ficheiro do Convite
                    </b-button></td><td v-if="!conv">
                        <b-button class="botao"
                                variant="dark"
                                @click="gerarPdfConvite()"
                                disabled>
                                <i class="far fa-file-pdf"></i> Ficheiro do Convite
                        </b-button></td><td>
                        <b-button class="botao" v-on:click="conv = !conv"
                            variant="dark">
                            Visualizar
                        </b-button>
                     </td>
                    <tr v-if="conv">
                        <div id="Convite">
                        <p>Convite</p>
                        <td colspan="3" style="height: 50%">
                            {{propostaSelecionada.convite}}
                        </td></div></tr>
                



                    </tr><tr v-if="ficheiroCurriculo">
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
                            </b-button>
                         </td><tr v-if="curriculo" style="width: 100%">
                            <td colspan="3" style=" TABLE-LAYOUT: fixed; WORD-BREAK:BREAK-ALL;">
                                <pdf
			                        :src="fichCurriculo"
                
			                        @num-pages="pageCount108 = $event"
			                        @page-loaded="currentPage2 = $event"
                                    style="display: inline-block; width: 1%; opacity: 0"
		                        ></pdf>
                                <pdf
			                        v-for="hh in pageCount108"
			                        :key="hh"
			                        :src="fichCurriculo"
			                        :page="hh"
			                        style="display: inline-block; width: 100%"
		                        ></pdf>
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
                            <pdf
			                    :src="fichCertificadoHabilitacoes"
                
			                    @num-pages="pageCount109 = $event"
			                    @page-loaded="currentPage2 = $event"
                                style="display: inline-block; width: 1%; opacity: 0"
		                    ></pdf>
                            <pdf
			                    v-for="ii in pageCount109"
			                    :key="ii"
			                    :src="fichCertificadoHabilitacoes"
			                    :page="ii"
			                    style="display: inline-block; width: 100%"
		                    ></pdf>
                        
                            </td>
                        </tr>
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
                                    <pdf
			                            :src="fichNIF"
                
			                            @num-pages="pageCount110 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="jj in pageCount110"
			                            :key="jj"
			                            :src="fichNIF"
			                            :page="jj"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
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
                                    <pdf
			                            :src="fichCGA"
                
			                            @num-pages="pageCount111 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="ll in pageCount111"
			                            :key="ll"
			                            :src="fichCGA"
			                            :page="ll"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                </b-button>
                             </td></td>
                            <tr v-if="cc">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichCC"
                
			                            @num-pages="pageCount112 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="mm in pageCount112"
			                            :key="mm"
			                            :src="fichCC"
			                            :page="mm"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
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
                                </b-button>
                             </td>
                            <tr v-if="iban">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichIBAN"
                
			                            @num-pages="pageCount113 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="nn in pageCount113"
			                            :key="nn"
			                            :src="fichIBAN"
			                            :page="nn"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichCertificadoRegistoCriminal"
                
			                            @num-pages="pageCount114 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="oo in pageCount114"
			                            :key="oo"
			                            :src="fichCertificadoRegistoCriminal"
			                            :page="oo"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
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
                                    <pdf
			                            :src="fichDeclaracaoRobustezFisica"
                
			                            @num-pages="pageCount115 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="pp in pageCount115"
			                            :key="pp"
			                            :src="fichRobustezFisica"
			                            :page="pp"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichBoletimVacinas"
                
			                            @num-pages="pageCount116 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="qq in pageCount116"
			                            :key="qq"
			                            :src="fichBoletinVacinas"
			                            :page="qq"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichFichaIdentificacao"
                
			                            @num-pages="pageCount117 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="rr in pageCount117"
			                            :key="rr"
			                            :src="fichFichaIdentifcacao"
			                            :page="rr"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichDeclaracaoRenuncia"
                
			                            @num-pages="pageCount118 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="ss in pageCount118"
			                            :key="ss"
			                            :src="fichDeclaracaoRenuncia"
			                            :page="ss"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichDeclaracaoArtigo99"
                
			                            @num-pages="pageCount119 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="tt in pageCount119"
			                            :key="tt"
			                            :src="fichDeclaracaoArtigo99"
			                            :page="tt"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
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
                                    <pdf
			                            :src="fichConsultaOutrasEscolas"
                
			                            @num-pages="pageCount120 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="uu in pageCount120"
			                            :key="uu"
			                            :src="fichConsultaOutrasEscolas"
			                            :page="uu"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
                                </td></tr>


                        </tr><tr v-if="ficheiroContratacaoComunicada">
                            <td>Contratação Comunicada</td>
                            <td><b-button
                                    size="md"
                                    variant="dark"
                                    style="width:100%"
                                    click="downloadFicheiro(ficheiroConsultaOutrasEscolas.proposta_id, 'Ficheiro Contratação Comunicada', propostaSelecionada.nome_completo)">
                                    <i class="far fa-file-pdf"></i> Download do Ficheiro Contratação Comunicada
                            </b-button></td><td>
                                <b-button  v-on:click="contratacaoComunicada = !contratacaoComunicada"
                                    size="md"
                                    variant="dark"
                                    style="width:100%">
                                    Visualizar
                                </b-button>
                             </td>
                            <tr v-if="contratacaoComunicada">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichContratacaoComunicada"
                
			                            @num-pages="pageCount121 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="uu in pageCount121"
			                            :key="uu"
			                            :src="fichContratacaoComunicada"
			                            :page="uu"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
                                </td></tr>



                        </tr><tr v-if="ficheiroContratoRedigido">
                            <td>Contrato Redigido</td>
                            <td><b-button
                                    size="md"
                                    variant="dark"
                                    style="width:100%"
                                    click="downloadFicheiro(ficheiroConsultaOutrasEscolas.proposta_id, 'Ficheiro Contrato Redigido', propostaSelecionada.nome_completo)">
                                    <i class="far fa-file-pdf"></i> Download do Ficheiro do Contrato Redigido
                            </b-button></td><td>
                                <b-button  v-on:click="contratoRedigido = !contratoRedigido"
                                    size="md"
                                    variant="dark"
                                    style="width:100%">
                                    Visualizar
                                </b-button>
                             </td>
                            <tr v-if="contratoRedigido">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichContratoRedigido"
                
			                            @num-pages="pageCount122 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="uu in pageCount122"
			                            :key="uu"
			                            :src="fichContratoRedigido"
			                            :page="uu"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
                                </td></tr>


                        </tr><tr v-if="ficheiroCessacaoSocial">
                            <td>Cessação Social</td>
                            <td><b-button
                                    size="md"
                                    variant="dark"
                                    style="width:100%"
                                    click="downloadFicheiro(ficheiroConsultaOutrasEscolas.proposta_id, 'Ficheiro Cessação Social', propostaSelecionada.nome_completo)">
                                    <i class="far fa-file-pdf"></i> Download do Ficheiro Cessação Social
                            </b-button></td><td>
                                <b-button  v-on:click="cessacao = !cessacao"
                                    size="md"
                                    variant="dark"
                                    style="width:100%">
                                    Visualizar
                                </b-button>
                             </td>
                            <tr v-if="cessacao">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichCessacaoSocial"
                
			                            @num-pages="pageCount123 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="uu in pageCount123"
			                            :key="uu"
			                            :src="fichCessacaoSocial"
			                            :page="uu"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
                                </td></tr>


                        </tr><tr v-if="ficheiroContrato">
                            <td>Contrato Anexo</td>
                            <td><b-button
                                    size="md"
                                    variant="dark"
                                    style="width:100%"
                                    click="downloadFicheiro(ficheiroConsultaOutrasEscolas.proposta_id, 'Ficheiro Contrato', propostaSelecionada.nome_completo)">
                                    <i class="far fa-file-pdf"></i> Download do Ficheiro do Contrato
                            </b-button></td><td>
                                <b-button  v-on:click="contrato = !contrato"
                                    size="md"
                                    variant="dark"
                                    style="width:100%">
                                    Visualizar
                                </b-button>
                             </td>
                            <tr v-if="contrato">
                                <td colspan="3" style="height: 50%">
                                    <pdf
			                            :src="fichContrato"
                
			                            @num-pages="pageCount124 = $event"
			                            @page-loaded="currentPage2 = $event"
                                        style="display: inline-block; width: 1%; opacity: 0"
		                            ></pdf>
                                    <pdf
			                            v-for="uu in pageCount124"
			                            :key="uu"
			                            :src="fichContrato"
			                            :page="uu"
			                            style="display: inline-block; width: 100%"
		                            ></pdf>
                        
                                </td></tr>
                        








                        </tr><tr>

                </tr>
          </table>


       

          <br>
</div>
</div>          
        <div class="total" data-html2canvas-ignore="true" v-if="this.$store.state.user.roleDB != 'recursos_humanos'" style ="width:120%; left:-30.2 ;">
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
    currentPage1: 0,
		currentPage2: 0,
		currentPage3: 0,
		currentPage4: 0,
		currentPage5: 0,
		currentPage6: 0,
		currentPage7: 0,
		currentPage8: 0,
		currentPage9: 0,
		currentPage10: 0,
		currentPage11: 0,
		currentPage12: 0,
		currentPage13: 0,
		currentPage14: 0,
		currentPage15: 0,
		currentPage16: 0,
	  pageCount1: 0,
      pageCount2: 0,
      pageCount3: 0,
      pageCount4: 0,
      pageCount5: 0,
      pageCount6: 0,
      pageCount7: 0,
      pageCount8: 0,
      pageCount9: 0,
      pageCount10: 0,
      pageCount11: 0,
      contagemficheiro: 0,
      pageCount12: 0,
      pageCount16: 0,
      pageCount13: 0,
      pageCount14: 0,
      pageCount15: 0,
      pageCount101: 0,
      pageCount102: 0,
      pageCount103: 0,
      pageCount104: 0,
      pageCount105: 0,
      pageCount106: 0,
      pageCount107: 0,
      pageCount108: 0,
      pageCount109: 0,
      pageCount110: 0,
      pageCount111: 0,
      pageCount112: 0,
      pageCount116: 0,
      pageCount113: 0,
      pageCount114: 0,
      pageCount115: 0,
      //src: pdf.createLoadingTask('storage/ficheiros/exemplo.pdf'),
	  numPages: undefined,
      curriculo: false,
      habilitacoes: false,
      relatorio: false,
      uc: false,
      uc1: false,
      conv: false,
      fundamentacao: false,
      assinadoCurso: false,
      assinadoDepartamento: false,
      assinadoUO: false,
      assinadoCTC: false,
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
      contratacaoComunicada: false,
      contratoRedigido: false,
      cessacao: false,
      contrato: false,


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
      ficheiroPropostaAssinadoUO: "",
      ficheiroPropostaAssinadoUmProponente: "",
      ficheiroPropostaAssinado: "",
      ficheiroPropostaAssinadoCTC: "",
      ficheiroContratacaoComunicada: "",
      ficheiroContratoRedigido: "",
      ficheiroCessacaoSocial:"",
      ficheiroContrato: "",
      
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
      fichUnidadesCurriculares:"",
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
      var doc = new jsPDF('p', 'pt', 'a4');
      doc.fromHTML($("#proposta").get(0), 20, 20);
      doc.save("Proposta Contratação " + this.propostaSelecionada.nome_completo+".pdf");
    },

    gerarPdfServiçoDocenteAtribuído(){
        if(this.uc1){
            var doc = new jsPDF('p', 'pt', 'a4');
            //Introduz um elemento html para o pdf
            doc.setFont('PTSans');
            doc.setFontSize(10);
            doc.setFont("Roboto-Regular");
            doc.html(ServiçoDocenteAtribuído, { 
                    html2canvas: {
                        scale: 0.7,
                        scrollY: 0
                    },
                    x: 5,
                    y: 0, 
                    callback: function (doc) {
                    doc.save("Serviço DOcente Atribuido.pdf");
                    }
                });
        }
    },

    
    gerarPdfConvite(){
        if(this.conv){
            var doc = new jsPDF('p', 'pt', 'a4');
            //Introduz um elemento html para o pdf
            doc.setFont('PTSans');
            doc.setFontSize(10);
            doc.setFont("Roboto-Regular");
            doc.html(Convite, { 
                    html2canvas: {
                        scale: 0.7,
                        scrollY: 0
                    },
                    x: 5,
                    y: 0, 
                    callback: function (doc) {
                    doc.save("Convite.pdf");
                    }
                });
        }
    },


    gerarPdfPropostaProponente(){
        var doc = new jsPDF('p', 'pt', 'a4');
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.5,
                    scrollY: 0
                },
                x: 10,
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
        
    },

    
    gerarPdfCtc(){
		
        var doc = new jsPDF('p', 'pt', 'a4');
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.395,
                    scrollY: 0
                },
                x: 15,
                y: 0, 
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
    },

    gerarPdfRecursosHumanos(){
        var doc = new jsPDF('p', 'pt', 'a4');
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.395,
                    scrollY: 0
                },
                x: 15,
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
    },

    
    gerarPdfUo(){
        var doc = new jsPDF('p', 'pt', 'a4');
        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.5,
                    scrollY: 0
                },
                x: 10,
                y: 0, 
                callback: function (doc) {
                doc.save("Proposta Contratação.pdf");
                }
            });
        
        
    },

  },
  mounted() {
    //this.$swal('Atenção', 'Tem apenas uma oportunidade de submeter corretamente o ficheiro assinado', 'info')
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
    
         if(this.propostaSelecionada.verificacao_serviço_docente_atribuido == "sim"){
            this.ficheiroUnidadesCurriculares = this.ficheiros[this.contagemficheiro];
            this.fichUnidadesCurriculares = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Unidades_Curriculares_do_docente_a_ser_contratado.pdf";
	        this.contagemficheiro=this.contagemficheiro+1;
         }
         if(this.tipoPropostaRole.regime_prestacao_servicos=="dedicacao_exclusiva" ||
            this.tipoPropostaRole.regime_prestacao_servicos=="tempo_integral" ||
            this.tipoPropostaRole.regime_prestacao_servicos=="tempo_parcial_60"){
            this.ficheiroFundamentacao = this.ficheiros[this.contagemficheiro];
            this.fichFundamentacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Fundamentacao_da_Proposta_Proponente.pdf",
	        this.contagemficheiro=this.contagemficheiro+1;
         }
         this.ficheiroPropostaAssinadoUmProponente = this.ficheiros[this.contagemficheiro];
         this.fichPropostaAssinadoDepartamento = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinada_Um_Proponente.pdf";
         this.contagemficheiro=this.contagemficheiro+1;

         this.ficheiroPropostaAssinado = this.ficheiros[this.contagemficheiro];
         this.fichPropostaAssinadoCurso = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinada.pdf";
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroPropostaAssinadoUO = this.ficheiros[this.contagemficheiro];
         this.fichPropostaAssinadoUO = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinado_Diretor_UO.pdf";
         this.contagemficheiro=this.contagemficheiro+1;

         this.ataCTC = this.ficheiros[this.contagemficheiro];
         this.fichAtaCTC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ata_do_CTC.pdf";
         this.contagemficheiro=this.contagemficheiro+1;

         this.ficheiroPropostaAssinadoCTC = this.ficheiros[this.contagemficheiro];
         this.fichPropostaAssinadoCTC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ata_do_CTC.pdf";
         this.contagemficheiro=this.contagemficheiro+1;

         if(this.propostaSelecionada.tipo_contrato == "contratacao_inicial"){
            this.ficheiroCurriculo = this.ficheiros[this.contagemficheiro];
            this.fichCurriculo = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Curriculo_do_docente_a_ser_contratado.pdf";vi
            this.contagemficheiro=this.contagemficheiro+1;
            this.ficheiroCertificadoHabilitacoes = this.ficheiros[this.contagemficheiro];
            this.fichCertificadoHabilitacoes = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Habilitacoes_do_docente_a_ser_contratado.pdf";
            this.contagemficheiro=this.contagemficheiro+1;
         }

         this.ficheiroNIF = this.ficheiros[this.contagemficheiro];
         this.fichNIF = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_NIF.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroCGA = this.ficheiros[this.contagemficheiro];
         this.fichCGA = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_N_CGA_SS.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroCC = this.ficheiros[this.contagemficheiro];
         this.fichCC = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Copia_CC.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroIBAN = this.ficheiros[this.contagemficheiro];
         this.fichIBAN = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Copia_IBAN.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroCertificadoRegistoCriminal = this.ficheiros[this.contagemficheiro];
         this.fichCertificadoRegstoCriminal = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Registo_Criminal.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroDeclaracaoRobustezFisica = this.ficheiros[this.contagemficheiro];
         this.fichDeclaracaoRobustezFisica = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Robustez_Fisica.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroBoletimVacinas = this.ficheiros[this.contagemficheiro];
         this.fichBoletimVacinas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Boletim_Vacinas.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroFichaIdentificacao = this.ficheiros[this.contagemficheiro];
         this.fichFichaIdentificacao = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Ficha_Identificacao.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroDeclaracaoArtigo99 = this.ficheiros[this.contagemficheiro];
         this.fichDeclaracaoArtigo99 = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Declaracao_IRS.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroDeclaracaoRenuncia = this.ficheiros[this.contagemficheiro];
         this.fichDeclaracaoRenuncia = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Renuncia_ADSE.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroConsultaOutrasEscolas = this.ficheiros[this.contagemficheiro];
         this.fichConsultaOutrasEscolas = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Ficheiro_Resposta_Consulta_Outras_Escolas.pdf";
         this.contagemficheiro=this.contagemficheiro+1;

         
         this.ficheiroContratacaoComunicada = this.ficheiros[this.contagemficheiro];
         this.fichContratacaoComunicada = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Contratacao_Comunicada.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroContratoRedigido = this.ficheiros[this.contagemficheiro];
         this.fichContratoRedigido = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Contrato_Redigido.pdf",
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroCessacaoSocial = this.ficheiros[this.contagemficheiro];
         this.fichCessacaoSocial = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Cessacao_Social.pdf";
         this.contagemficheiro=this.contagemficheiro+1;
         this.ficheiroContrato = this.ficheiros[this.contagemficheiro];
         this.fichContrato = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Contrato.pdf";
         this.contagemficheiro=this.contagemficheiro+1;
          
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
   /* this.src.then(pdf => {
		this.numPages = 1;
        console.log(this.numPages);
    });    */
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
 top: 0%;
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
 width: 10%;
 left: -30.2 ;
}
.total2{
 padding: 2%;
 position: absolute;
bottom: 0;
z-index: 50;
}*/



</style>
