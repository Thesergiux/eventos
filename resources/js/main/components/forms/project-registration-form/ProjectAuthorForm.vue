<template>
    <div class="box box--lg bg-white b-1 rounded relative">
        <h3>
            Participante {{ index }}
        </h3>

        <button v-if="index > minParticipants"
            class="btn btn--danger btn--xs rounded-0 absolute top-0 right-0"
            type="button"
            @click="$emit('remove', index)"
        >
            Eliminar
        </button>
        <div class="row mb-4">
            <div class="md:col-1/2 sm:col">
                <div class="form-control">
                    <label :for="'participant' + index + '-name'">Nombre</label>
                    <text-field
                    :name="'participant' + index + '_name'"
                    v-model="fields['participant' + index + '_name']"
                    :initial="((typeof assignedParticipants[index-1] !== 'undefined') ? assignedParticipants[index-1].name : '')"
                    >
                    </text-field>
                    <field-errors :name="'participant' + index + '_name'"></field-errors>
                </div>
            </div>
            <div class="md:col-1/2 sm:col">
                <div class="form-control">
                    <label :for="'participant' + index + '-lastname'">Apellidos</label>
                    <text-field
                    :name="'participant' + index + '_lastname'"
                    v-model="fields['participant' + index + '_lastname']"
                    :options="participantData"
                    :initial="((typeof assignedParticipants[index-1] !== 'undefined') ? assignedParticipants[index-1].lastname : '')"
                    >
                    </text-field>
                    <field-errors :name="'participant' + index + '_lastname'"></field-errors>
                </div>
            </div>
            
        </div>
        <div class="row mb-4">
            <div class="md:col-1/2 sm:col">
                <div class="form-control">
                    <label :for="'participant' + index + '-email'">Correo electrónico</label>
                    <text-field
                    :name="'participant' + index + '_email'"
                    v-model="fields['participant' + index + '_email']"
                    :initial="((typeof assignedParticipants[index-1] !== 'undefined') ? assignedParticipants[index-1].email : '')"
                    >
                    </text-field>
                    <field-errors :name="'participant' + index + '_email'"></field-errors>
                </div>
            </div>
            
            
        </div>
    </div>
</template>

<script>
    import SelectField from '../base/SelectField.vue';
    import TextField from '../base/TextField.vue';
    import FieldErrors from '../base/FieldErrors.vue';

    export default {
        components: { SelectField, FieldErrors, TextField },

        props: {
            participantData: {
                type: Object,
                required: true
            },
            index: {
                type: Number,
                required: true
            },

            errors: {
                type: Object,
                required: true
            },

            fields: {
                type: Object,
                required: true
            },
            
            minParticipants: {
                required: true,
                type: Number
            },
            assignedParticipants: {
                required: true,
                type: Array
            },
        },
        data() {
            return {
                noExistAlert: false,

            };
        },
    };
</script>
