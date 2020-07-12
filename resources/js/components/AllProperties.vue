<template>
    <div>
        <h3 class="text-center">Imóvies</h3><br/>

        <table id="propertyTable" class="table table-bordered">
            <thead>
            <tr class="bg-secondary text-white">
                <th>Código</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody class="bg-light">
            <tr v-for="property in properties" :key="property.id">
                <td>{{ property.id }}</td>
                <td>{{ property.owner_email }}</td>
                <td>{{ property.street }}, {{ property.number }}, {{property.city}}, {{property.state }}</td>
                <td>{{ property.status }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editProperty', params: { id: property.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteProperty(property.id)">Delete</button>
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
                properties: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8081/api/properties')
                .then(response => {
                    this.properties = response.data;
                });
        },
        methods: {
            deleteProperty(id) {
                this.axios
                    .delete(`http://localhost:8081/api/property/delete/${id}`)
                    .then(response => {
                        let i = this.properties.map(item => item.id).indexOf(id);
                        this.properties.splice(i, 1)
                    });
            }
        }
    }
</script>