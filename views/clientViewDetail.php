<?php
    require '../bootstrap.php';
    require '../stylesheet.php';
?>
<div class="clientViewDetails">
<?php 
    $id = $_GET['id'];
    $clientInfos = $company->getSingleClientDetailsById($id);
?>

<style>
    .clienInfos {
        padding: 20px;
    }

    img.clinetProfileImg {
        width: 100%;
        height: 300px;
        border-radius: 4px;
    }
    .cBasicInfoTop h1 {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 12px;
    }
    .clienInfos table td {
        font-size: 14px;
        font-weight: 400;
        line-height: 23px;
        color: #525252;
    }

    .clienInfos table td b {
        padding-right: 10px;
        font-weight: 600;
        font-size: 13px;
    }
    h2.detailInfoTitle {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #000;
    }
    .cOtherInformation img {
        height: 130px;
        width: auto;
    }
</style>
<div class="card">
    <div class="clienInfos">
        <div class="row">
            <div class="col-lg-4">
                <img class="clinetProfileImg" src="assets/images/<?= $clientInfos['client_img']; ?>" alt="">
            </div>
            <div class="col-lg-8 mt-5 pt-2 ">
                <div class="cBasicInfoTop cInfoContens ml-5">
                    <h1><?= $clientInfos['clients_name']; ?></h1>
                    <table>
                        <tr>
                            <td><b>Occupation:</b></td>
                            <td><?= $clientInfos['occupation']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td><?= $clientInfos['phone']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><?= $clientInfos['email']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Facebook ID:</b></td>
                            <td><a href="https://www.facebook.com/<?= $clientInfos['fb_id']; ?>">https://www.facebook.com/<?= $clientInfos['fb_id']; ?></a></td>
                        </tr>
                        <tr>
                            <td><b>Present Address:</b></td>
                            <td><?= $clientInfos['address']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Parmanent Address:</b></td>
                            <td><?= $clientInfos['address1']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-3">
            <div class="col-lg-6">
                <div class="cBasicInfobottom">
                    <h2 class="detailInfoTitle">Basic Inforamtion</h2>
                    <table>
                        <tr>
                            <td><b>User Id: </b></td>
                            <td><?= $clientInfos['user_id']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Gender: </b></td>
                            <td><?= $clientInfos['gender']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Business Type: </b></td>
                            <td><?= $clientInfos['bus_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Father/Husband Name: </b></td>
                            <td><?= $clientInfos['father_husband_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Date of Birth: </b></td>
                            <td><?= $clientInfos['date_of_birth']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Blood Group: </b></td>
                            <td><?= $clientInfos['blood_group']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Mobile 1: </b></td>
                            <td><?= $clientInfos['mobile1']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Mobile 2: </b></td>
                            <td><?= $clientInfos['mobile2']; ?></td>
                        </tr>
                        <tr>
                            <td><b>VAT Status: </b></td>
                            <td><?php
                                if($clientInfos['vatStatus'] == 0){echo 'No';}else{echo 'Yes';}
                                ?></td>
                        </tr>
                        <tr>
                            <td><b>Road No: </b></td>
                            <td><?= $clientInfos['road_no']; ?></td>
                        </tr>
                        <tr>
                            <td><b>House & Flat No.: </b></td>
                            <td><?= $clientInfos['house_flat_no']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Area: </b></td>
                            <td><?= $clientInfos['phone']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Thana: </b></td>
                            <td><?= $clientInfos['thana_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Contract Person: </b></td>
                            <td><?= $clientInfos['contract_person']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="serviceInformation">
                    <h2 class="detailInfoTitle">Service Information</h2>
                    <table>
                        <tr>
                            <td><b>A/C No: </b></td>
                            <td><?= $clientInfos['ac_no']; ?></td>
                        </tr>
                        <tr>
                            <td><b>IP Number: </b></td>
                            <td><?= $clientInfos['ip_number']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Zone: </b></td>
                            <td><?= $clientInfos['zone_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Package: </b></td>
                            <td><?= $clientInfos['package']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Cable Type: </b></td>
                            <td><?= $clientInfos['cable_type']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Router: </b></td>
                            <td><?= $clientInfos['router_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bandwidth Plan: </b></td>
                            <td><?= $clientInfos['bandwidth_plan']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bandwidth(K): </b></td>
                            <td>
                                <?php $cunit = $library->findOneById('tbl_client_type', 'id', $clientInfos['bandwidth']); echo $cunit['unit']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Switch: </b></td>
                            <td><?= $clientInfos['switch_name']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Switch Port: </b></td>
                            <td><?= $clientInfos['switch_port']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-3">
            <div class="col-lg-6">
                <div class="accountInforamtion">
                    <h2 class="detailInfoTitle">Account Information</h2>
                    <table>
                        <tr>
                            <td><b>Monthly Bill: </b></td>
                            <td><?= $clientInfos['rate_amnt']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Bill Start Date: </b></td>
                            <td><?= 'bill start date'; ?></td>
                        </tr>
                        <tr>
                            <td><b>VAT Include: </b></td>
                            <td><?php if($clientInfos['vat'] == 1){echo "yes";}else{echo "No";} ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="installmentCharge">
                    <h2 class="detailInfoTitle">Installation Charge</h2>
                    <table>
                        <tr>
                            <td><b>Sale Amount: </b></td>
                            <td><?= $clientInfos['sales_price']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Paid Amount: </b></td>
                            <td><?= $clientInfos['paid_amount']; ?></td>
                        </tr>
                        <tr>
                            <td><b>MRN: </b></td>
                            <td><?= $clientInfos['mrn']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Inst. Date: </b></td>
                            <td><?= $clientInfos['inst_date']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-3">
            <div class="col-lg-6">
                <div class="cOtherInformation">
                    <h2 class="detailInfoTitle">Other Information</h2>
                    <table>
                        <tr>
                            <td><b>Client Status: </b></td>
                            <td><?php if($clientInfos['cstatus'] != 0) { echo 'Active'; }else{ echo 'InActive'; }?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Comments: </b></td>
                            <td><?= $clientInfos['comments']; ?></td>
                        </tr>
                        <tr>
                            <td><b>NID/Passport/DL/Others Image: </b></td>
                            <td><img src="assets/images/<?= $clientInfos['nid_img']; ?>" alt=""</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>