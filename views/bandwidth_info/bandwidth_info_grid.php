<?php
require '../../bootstrap.php';
?>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="allClientsList">
            <div class="card">
                <div class="card-header">
                    <span>Bandwidth Info</span>
                    <a class="pageLoadBtn btn btn-primary btn-sm" href="views/bandwidth_info/add_bandwidth_info.php">
                        <i class="fa fa-plus"></i> Add Bandwidth Info
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Name of Bandwidth Provider(s) <br>
                                    <sup>(Bandwidth Buying from which ISP)</sup>
                                </th>
                                <th>Connected Date</th>
                                <th>Bandwidth(Mbps)</th>
                                <th>For Month</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;

                            $bandwidthInfos = $library->findAll('tbl_bandwidth_info');

                            foreach($bandwidthInfos as $bandWiinfo){
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $bandWiinfo['name'];?></td>
                                    <td><?php echo $bandWiinfo['connected_date'];?></td>
                                    <td><?php echo $bandWiinfo['bandwidth'];?></td>
                                    <td><?php echo $month = date('M', strtotime($bandWiinfo['month']));?></td>
                                    <td><a href="views/bandwidth_info/add_bandwidth_info.php?id=<?php echo $bandWiinfo['id']; ?>" id="clientEditBtn" class="pageLoadBtn btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../../scriptfiles.php';
?>
