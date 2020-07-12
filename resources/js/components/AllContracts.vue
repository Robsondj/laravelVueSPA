<template>
    <div>
        <h3 class="text-center">Contratos</h3><br/>

        <table id="contractTable" class="table table-bordered">
            <thead>
            <tr class="bg-secondary text-white">
                <th>Código</th>
                <th>E-mail Contratante</th>
                <th>Nome Contratante</th>
                <th>CPF/CNPJ</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody class="bg-light">
            <tr v-for="contract in contracts" :key="contract.id">
                <td>{{ contract.id }}</td>
                <td>{{ contract.contractor_email }}</td>
                <td>{{ contract.contractor_name }}</td>
                <td>{{ contract.document }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editContract', params: { id: contract.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteContract(contract.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contracts: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8081/api/contracts')
                .then(response => {
                    this.contracts = response.data;
                });
        },
        methods: {
            deleteContract(id) {
                this.axios
                    .delete(`http://localhost:8081/api/contract/delete/${id}`)
                    .then(response => {
                        let i = this.contracts.map(item => item.id).indexOf(id);
                        this.contracts.splice(i, 1)
                    });
            }
        }
    }
</script>