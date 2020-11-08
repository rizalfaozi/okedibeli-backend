<template>
		<tr>
			<td data-title="No">{{ data.number }}</td>
		    <td data-title="Username">
		    	{{ data.username }}
		    </td>
		   
		    <td data-title="Poin">{{ data.point }}</td>
           
		    
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