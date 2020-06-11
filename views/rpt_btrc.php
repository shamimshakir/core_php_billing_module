
<?php

    require '../bootstrap.php';
    $singlecompanyInfos = $company->selectCompanyById(1);

?>

<div class="card">

    <style>
        .ispGeneralInformation {
            padding: 30px;
        }

        .ispGeneralInformation h1 {
            font-size: 22px;
            font-weight: 600;
            color: #3f51b5;
        }

        .ispGeneralInformation p {
            font-size: 13px;
            padding-bottom: 20px;
            padding-top: 3px;
            color: #39468e;
        }

        .ispGeneralInformation  table {
            font-size: 13px;
        }

        .ispGeneralInformation table tr td:first-child {
            padding-right: 20px;
        }

        .ispGeneralInformation table tr td {
            padding: 3px 0;
        }
        .ispGeneralInformation table tr td b {
            font-weight: 600;
            color: #000;
        }
    </style>


    <div class="btrcReports">
        <div class="ispGeneralInformation">
            <h1>ISP General Information</h1>
            <p><strong>Sheet Name: </strong> General Info</p>
            <div class="row">
                <div class="col-lg-6">
                    <table>
                        <tr>
                            <td><b>Type of ISP: </b></td>
                            <td><?= $singlecompanyInfos['company_name'];?></td>
                        </tr>
                        <tr>
                            <td><b>Approved date of last renewal: </b></td>
                            <td><?= $singlecompanyInfos['last_reenal_date'];?></td>
                        </tr>
                        <tr>
                            <td><b>Date of Launch/Commencement: </b></td>
                            <td><?= $singlecompanyInfos['date_of_launch'];?></td>
                        </tr>
                        <tr>
                            <td><b>Contact Person Name: </b></td>
                            <td><?= $singlecompanyInfos['contact_name'];?></td>
                        </tr>
                        <tr>
                            <td><b>Contact Cell No: </b></td>
                            <td><?= $singlecompanyInfos['phone'];?></td>
                        </tr>
                        <tr>
                            <td><b>NOC Location (Longitude & Lattitude): </b></td>
                            <td><?= $singlecompanyInfos['noc_location'];?></td>
                        </tr>
                        <tr>
                            <td><b>MRTG Link with ID & Password: </b></td>
                            <td><?= $singlecompanyInfos['mrtg_id_pass'];?></td>
                        </tr>
                        <tr>
                            <td><b>a. Own: </b></td>
                            <td><?= $singlecompanyInfos['own'];?></td>
                        </tr>
                        <tr>
                            <td><b>Transmission Capacity (Core & MB): </b></td>
                            <td><?= $singlecompanyInfos['transmission_capacity'];?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table>
                        <tr>
                            <td><b>Name of ISP: </b></td>
                            <td><?= $singlecompanyInfos['type_of_isp'];?></td>
                        </tr>
                        <tr>
                            <td><b>Date of License: </b></td>
                            <td><?= $singlecompanyInfos['date_of_license'];?></td>
                        </tr>
                        <tr>
                            <td><b>License Validity Date: </b></td>
                            <td><?= $singlecompanyInfos['license_validity_date'];?></td>
                        </tr>
                        <tr>
                            <td><b>Parmitted Area/Thana(s): </b></td>
                            <td><?= $singlecompanyInfos['parmitted_area'];?></td>
                        </tr>
                        <tr>
                            <td><b>Contact Email Address: </b></td>
                            <td><?= $singlecompanyInfos['email'];?></td>
                        </tr>
                        <tr>
                            <td><b>NOC Address: </b></td>
                            <td><?= $singlecompanyInfos['address'];?></td>
                        </tr>
                        <tr>
                            <td><b>PoP Address: </b></td>
                            <td><?= $singlecompanyInfos['pop_address'];?></td>
                        </tr>
                        <tr>
                            <td><b>Transmission (Km): </b></td>
                            <td><?= $singlecompanyInfos['tranamission'];?></td>
                        </tr>
                        <tr>
                            <td><b>b. Leased: </b></td>
                            <td><?= $singlecompanyInfos['leased'];?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>