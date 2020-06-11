<?php

class Company{
    
    public $pdo;
    public $library;


    public function __construct($pdo){
        $this->pdo = $pdo;
        $this->library = new Library($this->pdo);
    }







    public function selectCompanyById($id){
        $statement = $this->pdo->prepare("SELECT *, 
            Date_format(date_of_license, ' %d -% m -% y')      AS date_of_license, 
            Date_format(last_reenal_date, ' %d -% m -% y')     AS last_reenal_date, 
            Date_format(license_validity_date, '%d -% m -% y') AS 
            license_validity_date, 
            Date_format(date_of_launch, '%d -% m -% y')        AS date_of_launch 
            FROM   tbl_company 
            WHERE  company_id = '1' ");
        $statement->execute();
        return $results = $statement->fetch(PDO::FETCH_ASSOC);
    }








    public function updateCompany($data){

        extract($data);

        $sql = "UPDATE tbl_company 
            SET    company_name = '$company_name', 
                   address = '$address', 
                   phone = '$phone',
                   phone_emergency = '$phone_emergency', 
                   fax = '$fax', 
                   hst_no = '$hst_no', 
                   email = '$email', 
                   account_email = '$account_email', 
                   state = '$state', 
                   postal_code = '$postal_code', 
                   city = '$city', 
                   country = '$country', 
                   type_of_isp = '$type_of_isp', 
                   date_of_license = '$date_of_license', 
                   last_reenal_date = '$last_reenal_date', 
                   license_validity_date = '$license_validity_date', 
                   date_of_launch = '$date_of_launch', 
                   parmitted_area = '$parmitted_area', 
                   contact_name = '$contact_name', 
                   noc_location = '$noc_location', 
                   pop_address = '$pop_address', 
                   mrtg_id_pass = '$mrtg_id_pass', 
                   tranamission = '$tranamission', 
                   own = '$own', 
                   leased = '$leased', 
                   transmission_capacity = '$transmission_capacity' 
            WHERE company_id = ? ";
        $statement = $this->pdo->prepare($sql);

        $updateCom = $statement->execute(array(1));

        if($updateCom){

            echo 'Company Updated successfully';


        }else{

            echo 'Failed to update';

            echo '<pre>';

            var_dump($statement->errorInfo());

        }

    }









    public function saveNewClient($data){

        $client_img_name = $_FILES['client_img']['name'];

        $nid_img_name = $_FILES['nid_img']['name'];

        // echo "<pre>";
        // print_r($_FILES);
        // print_r($data);

        if(isset($_FILES['client_img'])){

            $client_img_tmp =$_FILES['client_img']['tmp_name'];

            move_uploaded_file($client_img_tmp,"assets/images/".$client_img_name);

        }

        if(isset($_FILES['nid_img'])){

            $nid_img_tmp =$_FILES['nid_img']['tmp_name'];

            move_uploaded_file($nid_img_tmp,"assets/images/".$nid_img_name);

        }

        if($_POST['user_id'] != ''){
            $clientID = $_POST['user_id'];
        }else{
            $clientID = mt_rand(0, 999999);
        }

        extract($data);

        $statement = $this->pdo->prepare("INSERT INTO clients_info(
            clients_name, 
            father_husband_name, 
            date_of_birth, 
            blood_group,
            gender,
            occupation,
            fb_id, 
            nid_number, 
            email,
            phone,
            mobile1,
            mobile2,
            vat_status,
            road_no, 
            house_flat_no,
            area,
            thana,
            business_type,
            address,
            contract_person,
            ac_no,
            user_id,
            password,
            ip_number,
            zone,
            bandwidth_plan,
            client_type,
            cable_type,
            router, 
            bandwidth,
            switch,
            switch_port,
            client_catagory,
            rate_amnt, 
            vat,
            bill_type,
            sales_price,
            paid_amount,
            mrn,
            inst_date,
            ip_charge,
            ip_mr_number,
            cstatus,
            comments,
            client_img,
            nid_img) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
        $inserted = $statement->execute(
            array( $clients_name,
            $father_husband_name,
            $date_of_birth, 
            $blood_group, 
            $gender,
            $occupation,
            $fb_id,
            $nid_number,
            $email,
            $phone,
            $mobile1,
            $mobile2,
            1,
            $road_no,
            $house_flat_no,
            $area,
            $thana,
            $business_type,
            $address,
            $contract_person,
            $ac_no,
            $clientID,
            $password,
            $ip_number,
            $zone,
            $bandwidth_plan,
            $client_type,
            $cable_type,
            $router,
            $bandwidth,
            $switch,
            $switch_port,
            $client_catagory,
            $txtamnt,
            $vat,
            1,
            $sales_price,
            $paid_amount,
            $mrn,
            $inst_date,
            $ip_charge,
            $ip_mr_number,
            $client_status,
            $comments,
            $client_img_name,
            $nid_img_name
            )

        );

        if($inserted){

            echo 'Client Info Saved successfully';

        }else{

            echo 'failed to Save';

            echo '<pre>';

            var_dump($statement->errorInfo());

        }
        
    }









    public function getAllClients(){

        $statement = $this->pdo->prepare("
        SELECT clients_info.id, 
           clients_info.user_id, 
           clients_info.clients_name, 
           clients_info.mobile1, 
           tbl_client_type.NAME                             AS package, 
           clients_info.cstatus, 
           Date_format(clients_info.inst_date, '%d/%m/%Y')  AS instDate, 
           Date_format(clients_info.start_date, '%d/%m/%Y') AS billStartDate, 
           tbl_client_catagory.NAME                         AS clientTypeName, 
           tbl_bill_type.NAME                               AS billTypeName 
        FROM   
           clients_info 
           LEFT JOIN tbl_client_type 
              ON tbl_client_type.id = clients_info.client_type 
           LEFT JOIN tbl_bill_type 
              ON tbl_bill_type.id = clients_info.bill_type 
           LEFT JOIN tbl_client_catagory 
              ON tbl_client_catagory.id = clients_info.client_catagory 
           ORDER BY clients_info.id ASC");

        $statement->execute();

        return $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    }









    public function getSingleClientDetailsById($id){

        $statement = $this->pdo->prepare("
    SELECT 
        clients_info.id, 
        clients_info.user_id, 
        clients_info.clients_name, 
        clients_info.father_husband_name, 
        clients_info.date_of_birth, 
        tbl_blood_group.blood_group, 
        tbl_gender.gender, 
        clients_info.occupation, 
        clients_info.fb_id, 
        clients_info.no_print, 
        clients_info.cstatus, 
        tbl_client_type.name AS package,
        clients_info.company_name, 
        clients_info.contract_person, 
        clients_info.address, 
        clients_info.address1, 
        clients_info.road_no, 
        clients_info.house_flat_no, 
        clients_info.area, 
        tbl_thana.thana_name, 
        tbl_business_type.bus_name, 
        clients_info.phone, 
        clients_info.mobile1, 
        clients_info.mobile2, 
        clients_info.email, 
        clients_info.web_address, 
        clients_info.ac_no, 
        clients_info.ip_number, 
        tbl_bandwidth_plan.bandwidth_plan, 
        tbl_cable_type.cable_type, 
        tbl_router.router_name, 
        clients_info.bandwidth, 
        tbl_switch.switch_name, 
        clients_info.switch_port, 
        tbl_client_catagory.name AS clientCategoryName, 
        clients_info.rate_amnt, 
        clients_info.vat, 
        clients_info.vat_status AS vatStatus, 
        tbl_bill_type.name AS billTypeName, 
        clients_info.sales_price, 
        clients_info.paid_amount, 
        clients_info.mrn, 
        clients_info.nid_number, 
        clients_info.inst_date, 
        clients_info.ip_charge, 
        clients_info.ip_mr_number, 
        clients_info.comments, 
        clients_info.client_img, 
        clients_info.nid_img,
        tbl_zone.zone_name
    FROM   
        clients_info 
        LEFT JOIN tbl_blood_group 
           ON clients_info.blood_group = tbl_blood_group.id 
        LEFT JOIN tbl_gender 
           ON clients_info.gender = tbl_gender.id 
        LEFT JOIN tbl_client_type 
           ON clients_info.client_type = tbl_client_type.id 
        LEFT JOIN tbl_thana 
           ON clients_info.thana = tbl_thana.thana_id 
        LEFT JOIN tbl_business_type 
           ON clients_info.business_type = tbl_business_type.bus_id 
        LEFT JOIN tbl_bandwidth_plan 
           ON clients_info.bandwidth_plan = tbl_bandwidth_plan.id 
        LEFT JOIN tbl_cable_type 
           ON clients_info.cable_type = tbl_cable_type.id 
        LEFT JOIN tbl_router 
           ON clients_info.router = tbl_router.router_id 
        LEFT JOIN tbl_switch 
           ON clients_info.switch = tbl_switch.switch_id 
        LEFT JOIN tbl_client_catagory 
           ON clients_info.client_catagory = tbl_client_catagory.id 
        LEFT JOIN tbl_zone 
           ON clients_info.zone = tbl_zone.zone_id 
        LEFT JOIN tbl_bill_type 
           ON clients_info.bill_type = tbl_bill_type.id
        WHERE clients_info.id = ? ");

        $statement->execute(array($id));

        return $results = $statement->fetch(PDO::FETCH_ASSOC);

    }








    public function updateClient($data){

        $cPrevImages = $this->library->findById('clients_info', 'id', $data['editClientID']);

        $cNidImagName = $cPrevImages[0]['nid_img'];

        $clientEditImgName = $cPrevImages['client_img'];

        if(isset($_FILES['client_img']) AND $_FILES['client_img']['name'] != ""){

            $clientEditImgName = $_FILES['client_img']['name'];

            $clientEditImgTmp =$_FILES['client_img']['tmp_name'];

            move_uploaded_file($clientEditImgTmp,"assets/images/".$clientEditImgName);

        }

        if(isset($_FILES['nid_img']) AND $_FILES['nid_img']['name'] != ""){

            $cNidImagName = $_FILES['nid_img']['name'];

            $cNidImgtmp =$_FILES['nid_img']['tmp_name'];

            move_uploaded_file($cNidImgtmp,"assets/images/".$cNidImagName);

        }

        extract($data);


        $sql = "UPDATE clients_info 
            SET clients_name = ?,
            father_husband_name = ?,
            date_of_birth = ?,
            blood_group = ?,
            gender = ?,
            occupation = ?,
            fb_id = ?,
            nid_number = ?,
            email = ?,
            phone = ?,
            mobile1 = ?,
            mobile2 = ?,
            vat_status = ?,
            road_no = ?,
            house_flat_no = ?,
            area = ?,
            thana = ?,
            business_type = ?,
            address = ?,
            contract_person = ?,
            ac_no = ?,
            user_id = ?,
            password = ?,
            ip_number = ?,
            zone = ?,
            bandwidth_plan = ?,
            client_type = ?,
            cable_type = ?,
            router = ?,
            bandwidth = ?,
            switch = ?,
            switch_port = ?,
            client_catagory = ?,
            rate_amnt = ?,
            vat = ?,
            bill_type = ?,
            sales_price = ?,
            paid_amount = ?,
            mrn = ?,
            inst_date = ?,
            ip_charge = ?,
            ip_mr_number = ?,
            cstatus = ?,
            comments = ?,
            client_img = ?,
            nid_img = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $updateRow = $statement->execute(array( $clients_name,
            $father_husband_name,
            $date_of_birth,
            $blood_group,
            $gender,
            $occupation,
            $fb_id,
            $nid_number,
            $email,
            $phone,
            $mobile1,
            $mobile2,
            1,
            $road_no,
            $house_flat_no,
            $area,
            $thana,
            $business_type,
            $address,
            $contract_person,
            $ac_no,
            $user_id,
            $password,
            $ip_number,
            $zone,
            $bandwidth_plan,
            $client_type,
            $cable_type,
            $router,
            $bandwidth,
            $switch,
            $switch_port,
            $client_catagory,
            $txtamnt,
            $vat,
            1,
            $sales_price,
            $paid_amount,
            $mrn,
            $inst_date,
            $ip_charge,
            $ip_mr_number,
            $client_status,
            $comments,
            $clientEditImgName,
            $cNidImagName,
            $editClientID
        ));

        if($updateRow){

            echo 'Client Info Updated successfully';

        }else{

            echo 'failed to Update';

            echo '<pre>';

            var_dump($statement->errorInfo());

        }

    }





    public function getEmployees(){
        $sql = "SELECT
                    mas_employees.emp_id,
                    mas_employees.emp_name,
                    DATE_FORMAT(mas_employees.date_of_birth,'%d/%m/%Y') as date_of_birth,
                    DATE_FORMAT(mas_employees.date_of_joing,'%d/%m/%Y') as date_of_joing,
                    mas_department.department as department,
                    mas_designation.designation as designation,
                    mas_employees.address,
                    mas_employees.mobile,
                    mas_employees.email
                FROM 
                    mas_employees						
                    LEFT JOIN mas_department 
                        ON  mas_department.depart_id = mas_employees.department
                    LEFT JOIN mas_designation 
                        ON  mas_designation.desig_id = mas_employees.designation";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }






}