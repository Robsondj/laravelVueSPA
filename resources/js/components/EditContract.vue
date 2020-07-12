<template>
    <div>
        <h3 class="text-center">Editar Contrato</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateContract">
                    <p class="alert alert-danger" v-if="errors.length">
                        <b>Ocorreram errors ao salvar</b>
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>
                    <div class="form-group">
                        <label>Propriedade</label>
                        <select class="form-control col-md-4" v-model="contract.property_id">
                            <option v-for="property in properties" :value="property.id">{{ property.street }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo Pessoa</label>
                        <select class="form-control col-md-4" v-model="contract.person_type" @change="setMaskDocument">
                            <option :value="1">Física</option>
                            <option :value="2">Jurídica</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>CPF/CNPJ</label>
                        <input type="text" class="form-control" v-model="contract.document" v-mask="documentMask">
                    </div>
                    <div class="form-group">
                        <label>E-mail do contratante</label>
                        <input type="text" class="form-control" v-model="contract.contractor_email">
                    </div>
                    <div class="form-group">
                        <label>Nome do contratante</label>
                        <input type="text" class="form-control" v-model="contract.contractor_name">
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
                contract: {},
                properties: [],
                errors: [],
                documentMask: ''
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8081/api/contract/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.contract = response.data;
                    this.getProperties(this.contract.property_id)
                    this.chargeMaskDocument()
                });
        },
        methods: {
            updateContract() {
                this.errors = []
                if (!this.contract.property_id) this.errors.push("Propriedade é obrigatório.")
                if (!this.contract.person_type) this.errors.push("Tipo de Pessoa é obrigatório.")
                if (!this.contract.document) this.errors.push("CPF/CNPJ é obrigatório.")
                if (this.contract.document
                    && this.contract.document.match(/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/) === null) 
                    this.errors.push("CPF/CNPJ deve ser um documento válido.")
                if (!this.contract.contractor_email) this.errors.push("Email do contratante é obrigatório.")
                if (this.contract.contractor_email 
                    && this.contract.contractor_email.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/) === null) 
                    this.errors.push("Email do contratante deve ser válido.")
                if (!this.contract.contractor_name) this.errors.push("Nome do contratante é obrigatório.")
                
                if (this.errors.length === 0) {
                    this.axios
                        .post(`http://localhost:8081/api/contract/update/${this.$route.params.id}`, this.contract)
                        .then(response => {
                            this.$router.push({name: 'allContracts'})
                        })
                        .catch(error => {
                            if (typeof(error.response.data.errors) !== 'undefined') {
                                let errors = Object.values(error.response.data.errors).map((error) => error)
                                errors.map((msgerror) => this.errors.push(msgerror[0]))
                            } else {
                                this.errors.push('Erro ao salvar Contrato. Contate o suporte')
                            }
                        })
                        .finally(() => this.loading = false)
                }
            },
            getProperties(id) {
                this.axios
                    .get(`http://localhost:8081/api/contract/properties/${id}`)
                    .then(response => {
                        this.properties = response.data;
                    });
            },
            setMaskDocument() {
                this.contract.document = null
                if (this.contract.person_type === 1) {
                    this.documentMask = '###.###.###-##'
                } else {
                    this.documentMask = '##.###.###/####-##'
                }
            },
            chargeMaskDocument() {
                if (this.contract.person_type === 1) {
                    this.documentMask = '###.###.###-##'
                } else {
                    this.documentMask = '##.###.###/####-##'
                }
            }
            
        }
    }
</script>