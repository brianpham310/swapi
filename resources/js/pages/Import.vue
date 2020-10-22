<template>
    <div class="container p-3 big">
        <div class="row">
            <div class="col col-12 border p-3">
                <div class="character-details-list">
                    <h3 class="mb-4">Characters' details</h3>
                    <b-button variant="primary" class="mb-4" :disabled="disableImport" @click="importCharacters()">Import To Database</b-button>
                    <p class="mb-4"><em>Note: Only valid data will be imported</em></p>
                    <p v-if="gettingRemoteData" class="text-info">Getting data from SWAPI...</p>
                    <p v-if="dataImportedSuccessfully" class="text-success mb-4">Data imported successfully</p>
                    <p v-if="dataImportFailed" class="text-danger mb-4">Oops, errors happened during import</p>
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
        name: "Import",
        data(){
          return {
              loading: false,
              gettingRemoteData: false,
              disableImport: true,
              items: [],
              dataImportedSuccessfully: false,
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
                this.gettingRemoteData = true;
                await axios.get('/characters/get-remote')
                    .then(response => {
                        if (response.data) {
                            this.items = response.data;
                            if(this.items.length){
                                this.disableImport = false;
                            }
                        }
                    }).catch(error => {
                        console.log(error);
                        alert('Error getting data from Swapi');
                        this.loading = false;
                        this.gettingRemoteData = false;
                    });
                this.loading = false;
                this.gettingRemoteData = false;
            },

            async importCharacters(){
                this.dataImportFailed = false;
                this.dataImportedSuccessfully = false;
                this.loading = true;
                await axios.post('/characters/import', this.items)
                    .then(response => {
                        this.dataImportedSuccessfully = true;
                    }).catch(error => {
                        console.log(error);
                        this.loading = false;
                        this.dataImportFailed = true;
                    });
                this.loading = false;
            }
        }
    }
</script>
