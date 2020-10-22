<template>
    <div class="container p-3 big">
        <div class="row">
            <div class="col col-12 border p-3">
                <div class="character-details-list">
                    <h3 class="mb-4">Characters' details from local database</h3>
                    <b-button variant="primary" class="mb-4" :disabled="disableImport" @click="updateCharacters()">
                        Update Database
                    </b-button>
                    <p class="mb-4"><em>Note: This will update characters from files/characters_to_update.csv to local database.
                            After updated, the page will refresh to display updated data.
                    </em></p>
                    <p v-if="dataUpdatedSuccessfully" class="text-success mb-4">Data updated successfully</p>
                    <b-table
                        striped
                        hover
                        :items="items"
                        :fields="fields"
                        responsive
                        head-variant="dark"
                    >
                        <template v-slot:head(birth_year)="data">
                            <div>Birth Year</div>
                        </template>
                        <template v-slot:head(homeworld_name)="data">
                            <div>Home World</div>
                        </template>
                        <template v-slot:head(species_name)="data">
                            <div>Species</div>
                        </template>
                        <template v-slot:head(hair_color)="data">
                            <div>Hair Color</div>
                        </template>
                        <template v-slot:head(skin_color)="data">
                            <div>Skin Color</div>
                        </template>
                    </b-table>
                </div>
            </div>
        </div>
        <loader v-if="loading"/>
    </div>
</template>

<script>
    export default {
        name: "MassUpdate",
        data(){
            return {
                loading: false,
                disableImport: true,
                items: [],
                dataUpdatedSuccessfully: false,
                dataImportFailed: false,
                fields: [
                    {
                        key: 'name',
                    },
                    {
                        key: 'height',
                    },
                    {
                        key: 'mass',
                    },
                    {
                        key: 'hair_color',
                    },
                    {
                        key: 'skin_color',
                    },
                    {
                        key: 'birth_year',
                    },
                    {
                        key: 'gender',
                    },
                    {
                        key: 'homeworld_name',
                    },
                    {
                        key: 'species_name',
                    },
                ],
            }
        },
        mounted() {
            this.loadCharactersDetails();
        },
        methods: {
            async loadCharactersDetails(){
                this.loading = true;
                await axios.get('/characters/get-local')
                    .then(response => {
                        if (response.data) {
                            this.items = response.data;
                            if(this.items.length){
                                this.disableImport = false;
                            }
                        }
                    }).catch(error => {
                        console.log(error);
                        alert('Error getting data from local db');
                        this.loading = false;
                    });
                this.loading = false;
            },

            async updateCharacters(){
                this.dataUpdatedSuccessfully = false;
                this.loading = true;
                await axios.post('/characters/mass-update', this.items)
                    .then(response => {
                        this.dataUpdatedSuccessfully = true;
                        this.loadCharactersDetails();
                    }).catch(error => {
                        console.log(error);
                        this.loading = false;
                        this.dataUpdatedSuccessfully = true;
                    });
                this.loading = false;
            }
        }
    }
</script>
