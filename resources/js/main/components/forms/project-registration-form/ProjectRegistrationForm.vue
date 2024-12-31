<template>
    <form>
        <div class="md:row mb-4">
            <div class="col">
                <div class="form-control">
                    <label for="team">Equipo</label>
                    <text-field 
                        name="team" 
                        v-model="fields.team" 
                        initial=""
                    >
                    </text-field>
                    <field-errors name="team"></field-errors>
                </div>
            </div>
        </div>
        <div class="md:row mb-4">
            <div class="col">
                <div class="form-control">
                    <label for="project">Proyecto</label>
                    <text-field 
                        name="project" 
                        v-model="fields.project" 
                        initial=""
                    >
                    </text-field>
                    <field-errors name="project"></field-errors>
                </div>
            </div>
        </div>
        <div class="md:row mb-4">
            <div class="col">
                <div class="form-control">
                    <label for="description">Descripción del proyecto</label>
                    <text-field 
                        name="description" 
                        v-model="fields.description" 
                        initial=""
                    >
                    </text-field>
                    <field-errors name="description"></field-errors>
                </div>
            </div>
        </div>
        
        <div>
            <ProjectAuthorForm v-for="i in fields.participant_count" :key="i"
                :index="i"
                :min-participants="minParticipants"
                :participants-data="participantsData"
                :assigned-participants="assignedParticipants"
                :errors="errors"
                :fields="fields"
                @remove="removeParticipant"
            >
            </ProjectAuthorForm>

            <p class="pt-4">
                <button v-if="fields.participant_count < participants"
                    class="btn btn--light mr-4"
                    type="button"
                    @click="fields.participant_count++"
                >
                    <img class="mr-1 align-top"
                        :src="$root.path + '/img/icons/plus-circle-primary.svg'"
                        alt=""
                        width="20px"
                    >
                    <span class="align-top">Agregar participante</span>
                </button>

                <span v-if="participants > 1 "> Puedes registrar a un máximo de {{ participants }} participantes.</span>
                <span v-else> Puedes registrar únicamente un participante.</span>
            </p>
        </div>
        <div class="text-center pt-8">
            <form-button class="btn--primary btn--wide">
                Enviar
            </form-button>
        </div>
   </form>
</template>

<script>
    import BaseForm from '../base/BaseForm.vue';
    import ProjectAuthorForm from './ProjectAuthorForm.vue';

    export default {
        extends: BaseForm,

        components: { ProjectAuthorForm },
        props: {
            participants: {
                required: true,
                type: Number
            },
            minParticipants: {
                required: true,
                type: Number
            },
            participantsData: {
                required: true,
                type: Object
            },
            assignedParticipants: {
                required: true,
                type: Array
            },


        },
        data() {
            return {
                firstTime: null,
                fields: {
                    participant_count: this.minParticipants,
                }
            };
        },
        mounted() {
            if (this.assignedParticipants.length != 0) {
                this.fields.participant_count = this.assignedParticipants.length;
            }

        },
        watch: {
            firstTime: function(val) {
                this.fields._method = val === false ? 'patch' : 'post';
            }
        },

        methods: {
            /**
             * Copy all author's fields from one card to another.
             *
             * @param {Integer} source
             * @param {Integer} target
             */
            copyAuthorFields(source, target) {
                const regex = new RegExp('^participant' + source + '_');

                this.deleteAuthorFields(target);

                for (let field in this.fields) {
                    if (regex.test(field)) {
                        this.$set(this.fields, field.replace(source, target), this.fields[field]);
                    }
                }
            },


            /**
             * Delete all fields for the given author.
             *
             * @param {Integer} index
             */
            deleteAuthorFields(index) {
                const regex = new RegExp('^participant' + index + '_');

                for (let field in this.fields) {
                    if (regex.test(field)) {
                        delete this.fields[field];
                    }
                }
            },


            /**
             * Copy all necessary author fields to move their index
             * and then remove the last card.
             *
             * @param {Integer} index
             */
            removeParticipant(index) {
                for (let i = 0; i < this.fields.participant_count - index; i ++) {
                    this.copyAuthorFields(index + i + 1, index + i);
                }

                this.fields.participant_count--;

                this.deleteAuthorFields(this.fields.participant_count + 1);
            }
        }
    };
</script>
