<template>
  <div>
    <b-navbar toggleable="lg" type="light" variant="light">
      <b-navbar-brand>
        <img src="../../assets/logo.svg" alt="Instituto Politécnico de Leiria" class="pr-5" @click="home">Plataforma de Gestão de Contratações
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right>
            <template slot="button-content">{{ user.name }}</template>
			<b-dropdown-item v-on:click.prevent="mostrarFundamentacoes">
              <i class="fas fa-sign-out-alt"></i> Fundamentações
            </b-dropdown-item>
            <b-dropdown-item v-on:click.prevent="logout">
              <i class="fas fa-sign-out-alt"></i> Logout
            </b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <div class="row no-gutters">
      <div class="col-lg-3 d-md-none d-lg-block">
        <div class="sidebar-item" v-bind:class="{ active: isActiveProponente }">PROPONENTE</div>
        <div class="sidebar-item" v-bind:class="{ active: isActiveDiretorUO }">DIRETOR DA UO</div>
        <div class="sidebar-item" v-bind:class="{ active: isActiveCTC }">CONSELHO TÉCNICO-CIENTÍFICO</div>
        <div class="sidebar-item" v-bind:class="{ active: isActiveSD }">SECRETARIADO DA DIREÇÃO</div>
        <div class="sidebar-item" v-bind:class="{ active: isActiveRH }">RECURSOS HUMANOS</div>
      </div>
      <div class="col-lg-9">
        <div class="main">
          <button
            class="btn btn-success mb-4 font-weight-bold"
            v-on:click.prevent="novaProposta"
            v-if="isDashboardVisible && (this.$store.state.user.roleDB == 'proponente_departamento'
            ||this.$store.state.user.roleDB == 'proponente_curso'||
            this.$store.state.user.roleDB == 'secretariado_direcao')"
          >
            <i class="fas fa-plus"></i> Nova Proposta
          </button>
		  <fundamentacao v-if="isFundamentacaoVisible"></fundamentacao>
          <tabela-diretor v-if="isDashboardVisible"></tabela-diretor>
          <proponente v-if="isNovaPropostaVisible" v-on:voltar="mostrarProponentes"></proponente>
          <tabela-ctc v-if="user.roleDB == 'ctc'"></tabela-ctc>
          <tabela-secretariado v-if="user.roleDB == 'secretariado_direcao'"></tabela-secretariado>
          <ficheiros-docente v-if="user.roleDB == 'docente_temp'"></ficheiros-docente>
          <tabela-recursos v-if="user.roleDB == 'recursos_humanos'"></tabela-recursos>
          <resumo-geral v-if="isResumoPropostaVisible" :propostaSelecionada="propostaSelecionada"
            v-on:mostrarProponentes="mostrarProponentes"></resumo-geral>

          <editarProposta v-if="isEditarPropostaVisible" :propostaSelecionada="propostaSelecionada"
            v-on:voltar="mostrarProponentes"></editarProposta>
          <assinarPropostaCurso v-if="isEnviarPropostaCursoVisible" :propostaSelecionada="propostaSelecionada"
            v-on:voltar="mostrarProponentes"></assinarPropostaCurso>
          <assinarPropostaDepartamento v-if="isEnviarPropostaDepartamentoVisible" :propostaSelecionada="propostaSelecionada"
            v-on:voltar="mostrarProponentes"></assinarPropostaDepartamento>

          <div id="proposta">

          


          <div v-if="mostrarTabela">
            <div v-if="user.roleDB == 'proponente_departamento' && !isNovaPropostaVisible">
              COORDENADOR DEPARTAMENTO
              <div class="separator">
                <b-tabs content-class="mt-3" align="left">
                  <b-tab title="Propostas Pendentes" active>
                    <table class="table">
                      <thead>
                        <th>Nome docente a ser contratado</th>
                        <th>Tipo contrato</th>
                        <th>Role</th>
                        <th>Ações</th>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(propostaPendenteDiretorDepartamento, index) in propostasPendentesCoordenadorDepartamento"
                          :key="propostaPendenteDiretorDepartamento.id"
                        >
                          <td>{{ propostaPendenteDiretorDepartamento.nome_completo }}</td>
                          <td>{{ propostaPendenteDiretorDepartamento.tipo_contrato }}</td>
                          <td>{{ propostaPendenteDiretorDepartamento.role }}</td>
                          <td>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verDetalhesCoordenadorDepartamento(propostaPendenteDiretorDepartamento, index)"
                            >Ver detalhes</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </b-tab>
                  <b-tab title="Histórico de Propostas">
                    <table class="table">
                      <thead>
                        <th>Nome docente a ser contratado</th>
                        <th>Tipo contrato</th>
                        <th>Unidade Organica</th>
                        <th>Ações</th>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(propostaHistorico, index) in historicoPropostasCoordenadorDepartamento"
                          :key="propostaHistorico.id"
                        >
                          <td>{{ propostaHistorico.nome_completo }}</td>
                          <td>{{ propostaHistorico.tipo_contrato }}</td>
                          <td>{{ propostaHistorico.unidade_organica }}</td>
                          <td>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="editarProposta(propostaHistorico, index)"
                              v-if="(user.roleDB == 'proponente_departamento' && propostaHistorico.fundamentacao_coordenador_curso == null) ||
                              (user.roleDB == 'proponente_curso' && propostaHistorico.fundamentacao_coordenador_departamento == null)"
                            >Editar</button>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verAssinarCoordenadorDepartamento(propostaHistorico, index)"
                              v-if="(propostaHistorico.fundamentacao_coordenador_curso != null) ||
                              (propostaHistorico.fundamentacao_coordenador_departamento == null)"
                            >Assinar</button>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verDetalhesCoordenadorDepartamento(propostaHistorico, index)"
                            >Ver detalhes</button>
                            <!--<button
                              type="button"
                              class="btn btn-info"
                              @click="gerarPdfProposta(propostaHistorico, index)"
                              >Dowload</button>-->
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </b-tab>
                </b-tabs>
              </div>
            </div>

            <br />
            <div v-if="user.roleDB == 'proponente_curso' && !isNovaPropostaVisible">
              COORDENADOR CURSO
              <div class="separator">
                <b-tabs content-class="mt-3" align="left">
                  <b-tab title="Propostas Pendentes" active>
                    <table class="table">
                      <thead>
                        <th>Nome docente a ser contratado</th>
                        <th>Tipo contrato</th>
                        <th>Unidade Organica</th>
                        <th>Role</th>
                        <th>Ações</th>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(propostaPendenteCoordenadorCurso, index) in propostasPendentesCoordenadorCurso"
                          :key="propostaPendenteCoordenadorCurso.id"
                        >
                          <td>{{ propostaPendenteCoordenadorCurso.nome_completo }}</td>
                          <td>{{ propostaPendenteCoordenadorCurso.tipo_contrato }}</td>
                          <td>{{ propostaPendenteCoordenadorCurso.unidade_organica }}</td>
                          <td>{{ propostaPendenteCoordenadorCurso.role }}</td>

                          <td>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verDetalhesCoordenadorCurso(propostaPendenteCoordenadorCurso, index)"
                            >Ver detalhes</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </b-tab>
                  <b-tab title="Histórico de Propostas">
                    <table class="table">
                      <thead>
                        <th>Nome docente a ser contratado</th>
                        <th>Tipo contrato</th>
                        <th>Role</th>
                        <th>Unidade Organica</th>
                        <th>Ações</th>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(propostaHistorico, index) in historicoPropostasCoordenadorCurso"
                          :key="propostaHistorico.id"
                        >
                          <td>{{ propostaHistorico.nome_completo }}</td>
                          <td>{{ propostaHistorico.tipo_contrato }}</td>
                          <td>{{ propostaHistorico.role }}</td>
                          <td>{{ propostaHistorico.unidade_organica }}</td>
                          <td>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verDetalhesCoordenadorCurso(propostaHistorico, index)"
                              v-if="(propostaHistorico.fundamentacao_coordenador_curso == null) ||
                              (propostaHistorico.fundamentacao_coordenador_departamento == null)"
                            >Ver detalhes</button>
                            <button
                              type="button"
                              class="btn btn-info"
                              @click="verAssinarCoordenadorCurso(propostaHistorico, index)"
                              v-if="(propostaHistorico.fundamentacao_coordenador_curso != null) ||
                              (propostaHistorico.fundamentacao_coordenador_departamento != null)"
                            >Assinar</button>
                          </td><td>
                           <button
                              type="button"
                              class="btn btn-info"
                              @click="editarProposta(propostaHistorico, index)"
                              v-if="(user.roleDB == 'proponente_departamento' && propostaHistorico.fundamentacao_coordenador_curso == null) ||
                              (user.roleDB == 'proponente_curso' && propostaHistorico.fundamentacao_coordenador_departamento == null)"
                            >Editar</button>
                          </td>
                          <!--<td>
                           <button
                              type="button"
                              class="btn btn-info"
                              @click="gerarPdfProposta(propostaHistorico, index)"
                              >Dowload</button>
                          </td>-->
                        </tr>
                      </tbody>
                    </table>
                  </b-tab>
                </b-tabs>
              </div>
            </div>
          </div></div>

          <estatisticaProponente v-if="(user.roleDB == 'proponente_departamento' || user.roleDB == 'proponente_curso') && isDashboardVisible"></estatisticaProponente>
          <estatisticaDiretorUO v-if="user.roleDB == 'diretor_uo' && isDashboardVisible && isResumoPropostaVisible != false"></estatisticaDiretorUO>
          <estatisticaCTC v-if="user.roleDB == 'ctc' && isDashboardVisible && isResumoPropostaVisible != false"></estatisticaCTC>
          <estatisticaSecretariadoDirecao v-if="user.roleDB == 'secretariado_direcao' && isDashboardVisible"></estatisticaSecretariadoDirecao>
          <estatisticaRecursosHumanos v-if="user.roleDB == 'recursos_humanos' && isDashboardVisible"></estatisticaRecursosHumanos>

   


        </div>
      </div>



    </div>
  </div>



</template>

<script>
import jsPDF from 'jspdf'
//import autoTable from 'jspdf-autotable' 
import VeLine from 'v-charts/lib/line.common'
import { constants } from 'crypto';

export default {
  components: { VeLine },
  data: function() {
    return {
      isDashboardVisible: true,
	  isFundamentacaoVisible: false,
      isNovaPropostaVisible: false,
      isActiveProponente: false,
      isActiveDiretorUO: false,
      isActiveCTC: false,
      isActiveSD: false,
      isActiveRH: false,
      isEditarPropostaVisible: false,
      isEnviarPropostaCursoVisible: false,
      isEnviarPropostaDepartamentoVisible: false,
      isEnviarPropostaCTCVisible: false,
      isEnviarPropostaDiretorVisible: false,
      propostasPendentesCoordenadorDepartamento: "",
      historicoPropostasCoordenadorDepartamento: "",
      propostasPendentesCoordenadorCurso: "",
      historicoPropostasCoordenadorCurso: "",
      isResumoPropostaVisible: false,
      propostaSelecionada: "",
      mostrarTabela: true,
    };
  },
  methods: {
    logout() {
      axios.post("api/logout").then(response => {
        this.$store.commit("clearUserAndToken");
        this.$router.push({
          name: "login"
        });
      });
    },
    novaProposta() {
      //* Componente Proponente fica visivel
      this.isNovaPropostaVisible = true;
      this.isDashboardVisible = false;

      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;
      this.isActiveSD = false;
	  this.isFundamentacaoVisible = false;
    },
    home() {
      this.isDashboardVisible = true;
      this.isNovaPropostaVisible = false;
      this.isEditarPropostaVisible = false;

      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;

	  this.isFundamentacaoVisible = false;
    },
    verDetalhesCoordenadorCurso(propostaPendenteCoordenadorCurso, index) {
      this.isResumoPropostaVisible = true;
      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;
      this.isDashboardVisible = false;
	  this.isFundamentacaoVisible = false;
      this.propostaSelecionada = Object.assign(
        {},
        propostaPendenteCoordenadorCurso
      );
      this.mostrarTabela = false;
      this.isDashboardVisible = false;
      },
    verDetalhesCoordenadorDepartamento(
      propostaPendenteCoordenadorDepartamento,
      index
    ) {
      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;
      this.isResumoPropostaVisible = true;
      this.isDashboardVisible = true;
      this.isFundamentacaoVisible = false;
      this.propostaSelecionada = Object.assign(
        {},
        propostaPendenteCoordenadorDepartamento
      );
      this.mostrarTabela = false;
      this.isDashboardVisible = false;
    },


    verAssinarCoordenadorCurso(propostaAssinarCoordenadorCurso, index) {
      this.isEnviarPropostaCursoVisible = true;
      this.isEnviarPropostaDepartamentoVisible = false;
      this.isDashboardVisible = true;
      this.isFundamentacaoVisible = false;
      this.propostaSelecionada = Object.assign(
        {},
        propostaAssinarCoordenadorCurso
      );
      this.mostrarTabela = false;
      this.isDashboardVisible = false;
      
    },
    verAssinarCoordenadorDepartamento(propostaAssinarCoordenadorCurso, index) {
      console.log("Departamento");
      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = true;
      this.isDashboardVisible = true;
      this.propostaSelecionada = Object.assign(
        {},
        propostaAssinarCoordenadorCurso
      );
      this.mostrarTabela = false;
      this.isDashboardVisible = false;
      
    },
    /*
    verPdsProposta(pdfsVer, index) {
      this.isVerPdfsVisible = true;
      this.isDashboardVisible = true;
      this.propostaSelecionada = Object.assign(
        {},
        pdfsVer
      );
      this.mostrarTabela = false;
      this.isDashboardVisible = false;
      
    },*/

    editarProposta(propostaParaEditar, index) {
      this.isEditarPropostaVisible = true;
      this.isDashboardVisible = true;
      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;

	  this.isFundamentacaoVisible = false;

      this.mostrarTabela = false;
      this.propostaSelecionada = Object.assign(
        {},
        propostaParaEditar
      );
      this.isDashboardVisible = false;
    },



    gerarPdfProposta(propostaID, index){
        let pdfName = propostaID.email;
       
        var doc = new jsPDF();
        /*
        doc.autoTable(proposta);
        doc.autoTable({
             head: [['Name', 'Email', 'Country']],
             body: [
                ['David', 'david@example.com', 'Sweden'],
                ['Castille', 'castille@example.com', 'Spain'],
                 // ...
            ],
          });
        doc.save('table.pdf');*/

        //Introduz um elemento html para o pdf
        doc.setFont('PTSans');
        doc.setFontSize(10);
        doc.setFont("Roboto-Regular");
        doc.html(downloadPdf, { 
                html2canvas: {
                    scale: 0.226,
                    scrollY:0
                },
                x: 5,
                y: 10, 
            callback: function (doc) {
                doc.save("Proposta Contratação de "+ propostaID.nome_completo +".pdf");
                }
            });
        
        //Introduz um linha de cada vez
        /*
        doc.text("ID: " +propostaID.id_proposta_proponente, 10, 10);
        doc.text("Nome Completo: " +propostaID.nome_completo, 10, 20);
        doc.text("Email: " +pdfName, 10, 30);
        doc.text("Numero Telefone: " +propostaID.numero_telefone, 10, 40);
        var data = propostaID.data_de_assinatura_coordenador_de_curso;
        console.log (data);
        doc.text("Data de Assinatura do coordenado de curso: " + data, 10, 50);
        doc.text("Data de Assinatura do coordenador de departamento: " +propostaID.data_de_assinatura_coordenador_departamento, 10, 60);
        doc.text("Tipo Contrato: " +propostaID.tipo_contrato, 10, 70);
        doc.text("Grau: " +propostaID.grau, 10, 80);
        doc.text("Curso: " +propostaID.curso, 10, 90, 0, 40, "justify", 55, 12);
        doc.text("Area Cientifica: " +propostaID.area_cientifica, 10, 100);
        doc.text("Fudamentação Coordenador de Curso: " +propostaID.fundamentacao_coordenador_curso, 10, 110);
        doc.text("Fudamentação Coordenador de Departamento: " +propostaID.fundamentacao_coordenador_departamento, 10, 120);
        doc.text("Primeito Proponente: " +propostaID.primeiro_proponente, 10, 130);
        doc.text("Segundo Proponente: " +propostaID.segundo_proponente, 10, 140);
        doc.text("Role: " +propostaID.role, 10, 150);
        
        doc.save("Proposta Contratação de "+ propostaID.nome_completo +".pdf");
        */
    },


	mostrarFundamentacoes() {
		this.isFundamentacaoVisible = true;
		this.isNovaPropostaVisible = false;
		this.mostrarTabela = false;
		this.isResumoPropostaVisible = false;
		this.isDashboardVisible = true;
		this.isEditarPropostaVisible = false;
		},
    mostrarProponentes() {
      this.isEnviarPropostaCursoVisible = false;
      this.isEnviarPropostaDepartamentoVisible = false;
	  this.isFundamentacaoVisible = false;
      this.isNovaPropostaVisible = false;
      this.mostrarTabela = true;
      this.isResumoPropostaVisible = false;
      this.isDashboardVisible = true;
      this.isEditarPropostaVisible = false;
      if(this.$store.state.user.roleDB == 'proponente_departamento'){
      axios
        .get("/api/coordenadorDepartamento/propostasPendentes")
        .then(response => {
          this.propostasPendentesCoordenadorDepartamento = response.data;
        });
      axios
        .get("/api/coordenadorDepartamento/historicoPropostas")
        .then(response => {
          this.historicoPropostasCoordenadorDepartamento = response.data;
        });
      }
       if(this.$store.state.user.roleDB == 'proponente_curso'){
        axios.get("/api/coordenadorCurso/propostasPendentes").then(response => {
        this.propostasPendentesCoordenadorCurso = response.data;
      });
      axios.get("/api/coordenadorCurso/historicoPropostas").then(response => {
        this.historicoPropostasCoordenadorCurso = response.data;
      });
       }
    },
	
  },
  computed: {
    user() {
      return this.$store.state.user;
    }
  },
  mounted() {
    if (this.$store.state.user.roleDB == "proponente_departamento") {
      this.isActiveProponente = true;
      axios
        .get("/api/coordenadorDepartamento/propostasPendentes")
        .then(response => {
          this.propostasPendentesCoordenadorDepartamento = response.data;
        });
      axios
        .get("/api/coordenadorDepartamento/historicoPropostas")
        .then(response => {
          this.historicoPropostasCoordenadorDepartamento = response.data;
        });
    } else if (this.$store.state.user.roleDB == "proponente_curso") {
      this.isActiveProponente = true;
      axios.get("/api/coordenadorCurso/propostasPendentes").then(response => {
        this.propostasPendentesCoordenadorCurso = response.data;
      });
      axios.get("/api/coordenadorCurso/historicoPropostas").then(response => {
        this.historicoPropostasCoordenadorCurso = response.data;
      });
    } else if (this.$store.state.user.roleDB == "diretor_uo") {
      this.isActiveDiretorUO = true;
    } else if (this.$store.state.user.roleDB == "ctc") {
      this.isActiveCTC = true;
    } else if (this.$store.state.user.roleDB == "secretariado_direcao") {
      this.isActiveSD = true;
    } else if (this.$store.state.user.roleDB == "recursos_humanos") {
      this.isActiveRH = true;
    }
    
       /* axios.get("/api/ficheiros/" + this.propostaID).then(response => {

        this.ficheiroAssinadoCoordenadorCurso = this.ficheiros[5];
          this.fichAssinadoCoordenadorCurso = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinado_Coordenador_Curso.pdf",
          this.ficheiroAssinadoCoordenadorDepartamento = this.ficheiros[6];
          this.fichAssinadoCoordenadorDepartamento = "storage/ficheiros/"+ this.propostaSelecionada.id_proposta_proponente +"/"+ this.propostaSelecionada.id_proposta_proponente +"_Proposta_Assinado_Coordenador_Departamento.pdf",
          
          */




          
  }
};
</script>

<style lang="scss">
//* NAVBAR
.navbar-brand {
  font-size: 30px;
  font-weight: 300;
}

.navbar-brand img {
  cursor: pointer;
}

.navbar {
  border-bottom: 1px solid gray;
}

//* SIDEBAR
.sidebar-item {
  color: #1f1f1f;
  background-color: #f5f5f5;
  font-weight: 600;
  font-size: 20px;
  text-align: center;
  height: 20%;
  padding: 70px;
  border-bottom: 1px solid white;
  border-top: 1px solid white;
}

.sidebar-item.active {
  background-color: #1f1f1f;
  color: white;
}

//* MAIN
.main {
  margin: 40px;
}
</style>
