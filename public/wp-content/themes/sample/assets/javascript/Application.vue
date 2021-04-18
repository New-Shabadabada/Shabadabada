<template>
    <div class="container">
        <!-- IMPORTANT  pour utiliser vuetify, l'application doit être encapsulée dans une balise v-app //-->
        <v-app style="height: 100%; min-height: 100%">
            <div class="text-center">
                <v-chip class="ma-2" color="success" outlined>
                    <v-icon left>
                        mdi-server-plus
                    </v-icon>
                    Server Status
                </v-chip>

                <v-chip class="ma-2" color="primary" outlined pill>
                    User Account
                    <v-icon right>
                        mdi-account-outline
                    </v-icon>
                </v-chip>

                <v-chip class="ma-2" color="deep-purple accent-4" outlined>
                    <v-icon left>
                        mdi-wrench
                    </v-icon>
                    Update Settings
                </v-chip>

                <v-chip class="ma-2" close color="indigo darken-3" outlined>
                    <v-icon left>
                        mdi-fire
                    </v-icon>
                    New Posts Available
                </v-chip>
            </div>



            <div>

                <v-range-slider :max="100" :min="0">
            </div>

            <div>
                <v-card flat>
                    <v-card-text>
                        <v-container fluid>
                            <v-row>
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="red" color="red" value="red" hide-details></v-checkbox>
                                    <v-checkbox label="red darken-3" color="red darken-3" value="red darken-3"
                                        hide-details></v-checkbox>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="indigo" color="indigo" value="indigo" hide-details></v-checkbox>
                                    <v-checkbox label="indigo darken-3" color="indigo darken-3" value="indigo darken-3"
                                        hide-details></v-checkbox>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="orange" color="orange" value="orange" hide-details></v-checkbox>
                                    <v-checkbox label="orange darken-3" color="orange darken-3" value="orange darken-3"
                                        hide-details></v-checkbox>
                                </v-col>
                            </v-row>

                            <v-row class="mt-12">
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="primary" color="primary" value="primary" hide-details>
                                    </v-checkbox>
                                    <v-checkbox label="secondary" color="secondary" value="secondary" hide-details>
                                    </v-checkbox>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="success" color="success" value="success" hide-details>
                                    </v-checkbox>
                                    <v-checkbox label="info" color="info" value="info" hide-details></v-checkbox>
                                </v-col>
                                <v-col cols="12" sm="4" md="4">
                                    <v-checkbox label="warning" color="warning" value="warning" hide-details>
                                    </v-checkbox>
                                    <v-checkbox label="error" color="error" value="error" hide-details></v-checkbox>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>
            </div>




            <div class="text-center">
                <v-progress-circular indeterminate color="primary"></v-progress-circular>

                <v-progress-circular indeterminate color="red"></v-progress-circular>

                <v-progress-circular indeterminate color="purple"></v-progress-circular>

                <v-progress-circular indeterminate color="green"></v-progress-circular>

                <v-progress-circular indeterminate color="amber"></v-progress-circular>
            </div>



            <div class="text-center">
                <v-rating
                background-color="purple lighten-3"
                color="purple"
                large
                ></v-rating>
                <v-rating

                background-color="pink lighten-3"
                color="pink"
                large
                ></v-rating>
                <v-rating

                background-color="orange lighten-3"
                color="orange"
                large
                ></v-rating>
                <v-rating

                background-color="green lighten-3"
                color="green"
                large
                ></v-rating>
                <v-rating

                background-color="red lighten-3"
                color="red"
                large
                ></v-rating>
                <v-rating

                background-color="indigo lighten-3"
                color="indigo"
                large
                ></v-rating>
            </div>

        </v-app>
        <div>
</template>

<script>
    export default {
        name: "application",
        components: {},

        created() {},

        data() {
            return {}
        },

        methods: {

        }
    };
</script>

<style scoped lang="scss">
    @import '../scss/main.scss';

    .container {
        position: relative;
        overflow: hidden;

        ::v-deep .v-application--wrap {
            min-height: 100%;
        }
    }
</style>