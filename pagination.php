<div class="dataTables_paginate paging_simple_numbers" id="users-contacts_paginate">
	<ul class="pagination">

<?php
$total_records = count($stmt_paged); 
$page_name = basename($_SERVER["SCRIPT_FILENAME"]);
//echo $total_records;

$page = number_format($page);
$avant = ($page - 1);
	if($total_records == $Items_Par_Page) {
		$apres = ($page + 2);
	} else {
		$apres = ($page + 1);	
	}

	
for ($i = $avant; $i<$apres; $i++) { 

			?> 
			<li class="paginate_button page-item <?php if ($i == $page){ echo "active"; } ?> <?php if ($i == 0) { echo 'disabled'; } ?>">	
				<a href="<?php echo "$page_name?page=$i"; ?>" aria-controls="users-contacts" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i; ?></a>
			</li>					
			<?php						
									
}; 

?>


	</ul>
</div>