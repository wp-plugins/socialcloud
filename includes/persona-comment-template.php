<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(get_option("_PERSONA_COMMENT_APPROVE")){
    $commentStatus="approved";
}else{
    $commentStatus="unapproved";
}

?>
<div id="engage_commentBoxWidget" engage_contentId="0" postId="<?php echo the_ID(); ?>" commentStatus="<?php echo $commentStatus?>" >
   <script type="text/javascript">engage.commentWidget.commentWidgetLoad("<?php echo get_option('_PERSONA_API_KEY'); ?>");</script>
</div>