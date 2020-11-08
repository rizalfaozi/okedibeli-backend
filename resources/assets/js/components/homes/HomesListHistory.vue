<template>
        <tr>
            <td history-title="No">{{ history.number }}</td>
            <td history-title="Username">
                {{ history.username }}
            </td>
            
            <td history-title="Type">{{ history.type }} {{ history.point }}</td>
            <td history-title="Deskripsi">{{ history.deskripsi }}</td>
            <td history-title="Type">{{ history.status }}</td>
            
        </tr>   
</template>


<script>
    
    export default {
        props:["history"],
        data() {
            return {
                loading: false,
                urlID: '',
                isCircle: true,
                isSpinner: false,
            }
        },
        
    }

</script>