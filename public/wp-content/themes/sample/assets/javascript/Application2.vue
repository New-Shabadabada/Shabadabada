<template>
    <div class="container">
        <!-- IMPORTANT  pour utiliser vuetify, l'application doit être encapsulée dans une balise v-app //-->
        <v-app style="height: 100%; min-height: 100%">

            <div style="margin-bottom: 3rem;">
                <v-form>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field :counter="10" label="First name" required></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field :counter="10" label="Last name" required></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field label="E-mail" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </div>

            <div>

                <v-card class="mx-auto my-12" max-width="374">
                    <template slot="progress">
                        <v-progress-linear color="deep-purple" height="10" indeterminate></v-progress-linear>
                    </template>

                    <v-img height="250" src="https://cdn.vuetifyjs.com/images/cards/cooking.png"></v-img>

                    <v-card-title>Cafe Badilico</v-card-title>

                    <v-card-text>
                        <v-row align="center" class="mx-0">
                            <v-rating :value="4.5" color="amber" dense half-increments readonly size="14"></v-rating>

                            <div class="grey--text ml-4">
                                4.5 (413)
                            </div>
                        </v-row>

                        <div class="my-4 subtitle-1">
                            $ • Italian, Cafe
                        </div>

                        <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio
                            seating.</div>
                    </v-card-text>

                    <v-divider class="mx-4"></v-divider>

                    <v-card-title>Tonight's availability</v-card-title>

                    <v-card-text>
                        <v-chip-group active-class="deep-purple accent-4 white--text" column>
                            <v-chip>5:30PM</v-chip>

                            <v-chip>7:30PM</v-chip>

                            <v-chip>8:00PM</v-chip>

                            <v-chip>9:00PM</v-chip>
                        </v-chip-group>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="deep-purple lighten-2" text>
                            Reserve
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </div>
        </v-app>
        <div>
</template>

<script>
    export default {
        name: "application2",
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