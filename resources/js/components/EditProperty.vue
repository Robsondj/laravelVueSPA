<template>
    <div>
        <h3 class="text-center">Editar Imóvel</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProperty">
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
                        <input type="text" class="form-control" v-model="property.number">
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
                        <input type="text" class="form-control" v-model="property.state">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                property: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8081/api/property/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.property = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateProperty() {
                this.axios
                    .post(`http://localhost:8081/api/property/update/${this.$route.params.id}`, this.property)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>