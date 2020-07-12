<template>
    <div>
        <h3 class="text-center">Imóvies</h3><br/>

        <table id="propertyTable" class="table table-bordered">
            <thead>
            <tr class="bg-secondary text-white">
                <th class="align-middle">Código <button class="btn btn-secondary" @click="sortById"><i class="fas fa-arrows-alt-v"></i></button></th>
                <th class="align-middle">E-mail <button class="btn btn-secondary" @click="sortByEmail"><i class="fas fa-arrows-alt-v"></i></button></th>
                <th class="align-middle">Endereço</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Ações</th>
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
                properties: [],
                sortId: 'asc',
                sortEmail: 'asc',
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
            },
            sortById() {
                if (this.sortId === 'asc') {
                    this.properties.sort((a,b) => a.id < b.id ? -1 : a.id > b.id ? 1 : 0)
                    this.sortId = 'desc'
                } else {
                    this.properties.sort((a,b) => b.id < a.id ? -1 : b.id > a.id ? 1 : 0)
                    this.sortId = 'asc'
                }
            },
            sortByEmail() {
                if (this.sortEmail === 'asc') {
                    this.properties.sort((a,b) => a.owner_email < b.owner_email ? -1 : a.owner_email > b.owner_email ? 1 : 0)
                    this.sortEmail = 'desc'
                } else {
                    this.properties.sort((a,b) => b.owner_email < a.owner_email ? -1 : b.owner_email > a.owner_email ? 1 : 0)
                    this.sortEmail = 'asc'
                }
            }
        }
    }
</script>