<template>
  
    <div>
      <div class="separator">
        <b-tabs content-class="mt-3" align="left">
          <b-tab title="Fundamentações" active>
            <table class="table">
              <thead>
                <th>Fundamentação</th>
				<th>Ações</th>
              </thead>
              <tbody>
				<tr v-if= "fundamentacoes.lenght<1">
				Não tem fundamentacoes guardadas</tr>
                <tr
                  v-for="(fundamentacao, index) in fundamentacoes"
                  :key="fundamentacao.id"
                >
                  <td>{{ fundamentacao.fundamentacao }}</td>
				  <td>
                    <button
                      type="button"
                      class="btn btn-danger"
                      v-on:click="deleteFundamentacao(index)"
                    >Remover</button>
                  </td>
                </tr>
              </tbody>
            </table>
			</b-tab>
        </b-tabs>
      </div>
	  <div>
			<label for="newFundamentacao">Nova Fundamentação: </label>
			<br>
			<b-form-textarea rows="3" max-rows="6" width=80% v-model="newfundamentacao" placeholder="fundamentação"> </b-form-textarea>
			<br>
			<button type="button" class="btn btn-info" @click="novaFundamentacao()">Nova Fundamentação</button>
          
    </div>
	</div>
</template>
<script>
export default {
  data() {
    return {
      header: "dark",
	  fundamentacoes: [],
	  newfundamentacao: null
    };
  },
  methods: {
	getFundamentacoes(){
		axios.get("/api/fundamentacoes/" + this.$store.state.user.id).then(response => {
		this.fundamentacoes = response.data;
			this.fundamentacoes.push();
		});
	},
    novaFundamentacao() {
		axios.post('/api/fundamentacoes/create/' + this.$store.state.user.id + '/'+ this.newfundamentacao).then(response => {
		this.$swal("Success", "Fundamentação guardada!", "success");});
		this.$nextTick(() => {this.getFundamentacoes();});
		
	},
	
	deleteFundamentacao(index){
		let key =this.fundamentacoes[index].id;
		axios.delete('/api/fundamentacoes/'+ key).then(response => {
		this.$swal("Success", "Fundamentação removida!", "success");});;
		this.$nextTick(() => {
		this.getFundamentacoes();
		this.fundamentacoes.splice(index, 1);});
	}
  },
  mounted() {
      this.getFundamentacoes();
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