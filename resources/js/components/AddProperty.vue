<template>
    <div>
        <h3 class="text-center">Adicionar Imóvel</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProperty">
                    <p class="alert alert-danger" v-if="errors.length">
                        <b>Ocorreram errors ao salvar</b>
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>
                    <div class="form-group">
                        <label>E-mail Proprietário</label>
                        <input type="text" class="form-control" v-model="property.owner_email">
                    </div>
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" class="form-control" v-model="property.street">
                    </div>
                    <div class="form-group">
                        <label>Número</label>
                        <input type="number" class="form-control" v-model.number="property.number">
                    </div>
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" class="form-control" v-model="property.complement">
                    </div>
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" class="form-control" v-model="property.neighborhood">
                    </div>
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" class="form-control" v-model="property.city">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control col-md-4" v-model="property.state">
                            <option v-for="state in states" :value="state" :selected="1">{{ state }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                property: {},
                states: [],
                errors: []
            }
        },
        methods: {
            addProperty() {
                this.errors = []
                if (!this.property.owner_email) this.errors.push("Email é obrigatório.")
                if (this.property.owner_email 
                    && this.property.owner_email.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/) === null) 
                    this.errors.push("Email deve ser válido.")
                if (!this.property.street) this.errors.push("Rua é obrigatório.")
                if (!this.property.neighborhood) this.errors.push("Bairro é obrigatório.")
                if (!this.property.city) this.errors.push("Cidade é obrigatório.")
                if (!this.property.state) this.errors.push("Estado é obrigatório.")
                
                if (this.errors.length === 0) {
                    this.axios
                        .post('http://localhost:8081/api/property/store', this.property)
                        .then(response => {
                            this.$router.push({name: 'home'})
                        })
                        .catch(error => {
                            if (typeof(error.response.data.errors) !== 'undefined') {
                                let errors = Object.values(error.response.data.errors).map((error) => error)
                                errors.map((msgerror) => this.errors.push(msgerror[0]))
                            } else {
                                this.errors.push('Erro ao salvar Imóvel. Contate o suporte')
                            }
                        })
                        .finally(() => this.loading = false)
                }
            },
            getStates() {
            this.axios
                .get('http://localhost:8081/api/property/states')
                .then(response => {
                    this.states = response.data;
                });
            }
        },
        mounted() {
            this.getStates()
        }
    }
</script>