<?php
foreach  ($List_Intervenants as $intervenant) {
	?><option value="<?php echo $intervenant['id']; ?>"><?php echo $intervenant['nom']; ?></option><?php
}
?>