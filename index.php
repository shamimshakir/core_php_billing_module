<?php require 'header.php'; ?>

    <!-- Main Area Start -->
    <div id="mainArea">

      <?php $selectParentNodes = $dashboard->getMenuNodes($SUserID, 0); ?>
      <div id="sidebar">
          <li class="buttonDashboard"><a href="index.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
      </div>


      <!-- Side Navigation End here -->

      <!-- Content Area Start -->
      <div id="contentArea">

        <!-- content container start -->
        <div class="container-fluid">
        
          <div class="yourModules">
            <h2>Application Modules</h2>
            <span>( Your Accessable Modules )</span>
          </div>

          <div class="mainDashBoradMenu">
            <?php foreach($selectParentNodes as $nodes): ?>
              <div class="singleDashboradNavMenu">
                <a href="dashboard.php?id=<?php echo $nodes->id;?>">
                  <i class="<?= $nodes->icon;?>"></i> 
                  <?= $nodes->nodename;?>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
          


<?php require 'footer.php';?>