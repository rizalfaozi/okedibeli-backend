<template>
		<tr>
			
		    
    	</tr>	
</template>


<script>
	
	export default {
		props:["data"],
        data() {
            return {
                loading: false,
                urlID: '',
                isCircle: true,
                isSpinner: false,
            }
        },
        computed: {
            base_url() {
                return BASE_URL;
            },
        },
        components: {
        },
        methods: {
        	
        }
    }

</script>