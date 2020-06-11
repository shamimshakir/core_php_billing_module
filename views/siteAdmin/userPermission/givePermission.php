<?php
require '../../../bootstrap.php';
require '../../../stylesheet.php';

$User_ID = $_GET['id'];
$SUserID = 1;
?>

<div class="givingPermission">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    <span>Profile Permission for  <strong><?= $library->findField('_nisl_mas_user', 'Name', "User_ID = {$User_ID}") ?></strong></span>
                    <a class="pageLoadBtn btn btn-primary btn-sm" href="views/siteAdmin/userPermission/UserPermission.php">
                        Profile Permission
                    </a>
                </div> 
                <div class="card-body">
                    <?php $menu = $dashboard->getPermissionNodesMenu($SUserID, $User_ID); ?>
                    <ul class="treeTypeNavigation">
                        <?php echo $dashboard->buildPermissionMenu(0, $menu); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../../../scriptfiles.php';?>

<script>
$(document).ready(function(){
    $('ul.treeTypeNavigation li ul').hide();
    $('ul.treeTypeNavigation li').has('ul').children('div').append('<i class="fa fa-caret-down"></i>');
    $('ul.treeTypeNavigation li i.fa').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        $(this).parent().parent().children('ul').slideToggle(500);
    });
});
</script>