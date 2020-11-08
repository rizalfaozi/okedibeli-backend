<template>
  <div>
	  	<div class="dataTables_paginate paging_bootstrap" id="example_paginate">
	    <p>Current page: {{ currentPage }}</p>
	    <v-pagination v-model="currentPage"
	                  :page-count="totalPages"
	                  :classes="bootstrapPaginationClasses"
	                  :labels="paginationAnchorTexts"></v-pagination>
	  	</div>
  </div>
</template>

<script>
	import vPagination from 'vue-plain-pagination';

	export default {
	  props:["total","halaman"],
	  components: { vPagination },
	  data() {
	    return {
	      currentPage: this.halaman,
	      totalPages: this.total,
	      bootstrapPaginationClasses: {
	        ul: 'pagination',
	        li: 'page-item',
	        liActive: 'active',
	        liDisable: 'disabled',
	        button: 'page-link'  
	      },
	      paginationAnchorTexts: {
	        first: 'First',
	        prev: 'Previous',
	        next: 'Next',
	        last: 'Last'
	      }
	    }
	  }
	}

</script>





