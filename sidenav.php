    <!-- Main Area Start -->
    <div id="mainArea">

      <div id="sidebar">

      <li class="bactToMain"><a href="index.php"><i class="fa fa-undo"></i>Main Menu</a></li>
      
        <ul class="sideBarNav">
          

          <span class="moduleHeading">

            <?php $cNode = $library->findOneById('_nisl_tree_entries', 'id', $parentsid); ?>

          <?php echo $cNode['NodeName'];?>

          </span>

          <?php $selectSubParentNodes = $dashboard->getMenuNodes($SUserID, $parentsid);

          foreach($selectSubParentNodes as $sbNodes):?>

          <li><a href="<?= $sbNodes->url; ?>">

            <i class="<?= $sbNodes->icon; ?>"></i>

            <?= $sbNodes->nodename; ?></a>
              <ul class="sideBarDropDown">

              <?php $selectSubParentChildNodes = $dashboard->getMenuNodes($SUserID, $sbNodes->id);

              if($selectSubParentChildNodes){

                foreach($selectSubParentChildNodes as $sbChilds){ ?>



                  <li><a href="<?= $sbChilds->url;?>">

                  <i class="<?= $sbChilds->icon; ?>"></i>

                  <?= $sbChilds->nodename;?>

                  </a></li>
                  <?php }}?>
                </ul>


          </li>

          <?php endforeach; ?>


        </ul>

      </div>

      <!-- Side Navigation End here -->

      <!-- Content Area Start -->
      <div id="contentArea">

        <!-- content container start -->
        <div class="container-fluid">
