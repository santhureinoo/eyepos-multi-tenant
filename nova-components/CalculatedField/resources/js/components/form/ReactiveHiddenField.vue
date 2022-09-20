<script>
    import ReactiveField from '../../mixins/ReactiveField';
    import HiddenField from '@nova/components/Form/HiddenField';

    export default {
        extends: HiddenField,
        mixins: [ReactiveField],
        props: ['resourceId'],

        mounted() {
            this.watches('value');
        },

        methods: {
            setValue(response) {
                this.value = response.data.value;
            }
        }
    };
</script>
