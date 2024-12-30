<template>
    <div :id="id" class="form-field" 
        :class="{ 
            'form-field--invalid': hasErrors, 
            'form-field--no-scrollbar': !hasScrollbar 
        }">
        <div ref="editor" class="editor"></div>
    </div>
</template>

<script>
import FormField from '../../../mixins/FormField.js';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';


export default {
    mixins: [FormField],

    props: {
        maxlength: {
            type: String,
            required: false,
            default: '10000'
        },
        initialValue: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            quill: null,
            hasScrollbar: false
        };
    },

    mounted() {
        this.$nextTick(() => {
            this.initializeEditor();
            this.setInitialContent();
        });
    },

    methods: {
        setInitialContent() {
            if (this.initialValue) {
                this.quill.clipboard.dangerouslyPasteHTML(this.initialValue);
                this.$emit('input', this.initialValue);  // Emite el valor inicial
            }
        },

        initializeEditor() {
            this.quill = new Quill(this.$refs.editor, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link']
                    ]
                }
            });

            this.quill.on('text-change', this.onInput);
        },

        onInput() {
            const content = this.quill.root.innerHTML;
            this.$emit('input', content);
        }
    },
};

</script>

<style scoped>
    .editor {
        min-height: 200px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
    }
</style>
