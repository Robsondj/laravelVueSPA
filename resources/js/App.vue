<template>
    <div class="container border rounded">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary bold"><h1>Accordous</h1></span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light border  border-secondary rounded">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/addProperty" class="nav-item nav-link">Adicionar Imóvel</router-link>
                    <router-link to="/contracts" class="nav-item nav-link">Contratos</router-link>
                    <router-link to="/addContract" class="nav-item nav-link">Adicionar Contrato</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>