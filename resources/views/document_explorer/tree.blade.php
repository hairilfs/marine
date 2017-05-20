<?php print '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>
  <tree id="0" radio="1">  
    <item   text="Direktori Regulasi" id="<?php print $root->id; ?>" open="1">
    <?php  
        print_child_xml($folders, $target_id, $root->id);
     ?>
    </item>
</tree>
<?php 

function print_child_xml($folders, $target_id, $dir_id){
    $child_dir = array_filter(array_values($folders), function ($f) use($dir_id) {
      return $f->parent_id == $dir_id;
    });

    if(!empty($child_dir)){
      foreach ($child_dir as $d) {
        $open_attr = '0';
        if($d->id == $target_id) $open_attr= '1';
        print '<item text="'. $d->name .'" id="'.$d->id.'" open="'.$open_attr.'" im0="folderClosed.gif" im1="folderOpen.gif"  im2="folderClosed.gif"> ';
        print_child_xml($folders, $target_id, $d->id);
        print '</item> ';
      }
    }
}
?>