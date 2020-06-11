<?php
class Library{
    protected $pdo;
    public $group;
    public $pgroup;
    public $psubgroup;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }



    
    // Select Box Combo
    public function createCombo($ComboName,$TableName,$ID,$Name,$Condition, $selected = null){

        $statement = $this->pdo->prepare("SELECT $ID as ID, $Name as Name FROM $TableName ".$Condition);

        $statement->execute();

        print("<option>Select a $ComboName</option>\n");

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){

            if($row['ID']==$selected)

                echo '<option value="'.$row['ID'].'" selected>'.$row['Name'].'</option>';

            else

                echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';

        }

    }


    // Select Box Combo | Clients
    public function createClientCombo($ComboName,$TableName,$ID,$Name,$Condition, $selected = null){

        $statement = $this->pdo->prepare("SELECT $ID as ID, $Name as Name, ip_number FROM $TableName ".$Condition);

        $statement->execute();

        print("<option>Select a $ComboName</option>\n");

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){

            if($row['ID']==$selected)

                echo '<option value="'.$row['ID'].'" selected>'.$row['Name'].' ('.$row['ip_number'].')</option>';

            else

                echo '<option value="'.$row['ID'].'">'.$row['Name'].' ('.$row['ip_number'].')</option>';

        }

    }

    public function comboDay($CurDate){
        $i=1;
        if($CurDate=="" || $CurDate==null)
            $CurDate=date("d");

        if($CurDate==-1)
            echo "<option value='' selected>D</option>";
        while($i!=32) {
            echo "<option value='$i'"; if($i==$CurDate) echo "selected";echo ">$i</option>";
            $i++ ;
        }
    }

    public function comboMonth($CurMon){
        if($CurMon=="" || $CurMon==null)
            $CurMon=date("m");

        if($CurMon==-1)
        echo "<option value='' selected>M</option>";
        echo "<option value='1'"; if($CurMon==1) echo "selected";echo ">January</option>";
        echo "<option value='2'"; if($CurMon==2) echo "selected";echo ">February</option>";
        echo "<option value='3'"; if($CurMon==3) echo "selected";echo ">March</option>";
        echo "<option value='4'"; if($CurMon==4) echo "selected";echo ">April</option>";
        echo "<option value='5'"; if($CurMon==5) echo "selected";echo ">May</option>";
        echo "<option value='6'"; if($CurMon==6) echo "selected";echo ">June</option>";
        echo "<option value='7'"; if($CurMon==7) echo "selected";echo ">July</option>";
        echo "<option value='8'"; if($CurMon==8) echo "selected";echo ">August</option>";
        echo "<option value='9'"; if($CurMon==9) echo "selected";echo ">September</option>";
        echo "<option value='10'"; if($CurMon==10) echo "selected";echo ">October</option>";
        echo "<option value='11'"; if($CurMon==11) echo "selected";echo ">November</option>";
        echo "<option value='12'"; if($CurMon==12) echo "selected";echo ">December</option>";
    }

    public function comboYear($Startyear,$EndYear,$CurYear){
        if($CurYear=="" || $CurYear==null)
            $CurYear=date("Y");

        if($Startyear=="" || $Startyear==null || $EndYear=="" || $EndYear==null )
        {
            $Startyear=date("Y")-15;
            $EndYear=date("Y")+5;
        }
        if($CurYear==-1)
            echo "<option value='' selected>Y</option>";
        while($Startyear!=$EndYear+1)
        {
            echo "<option value='$Startyear'"; if($Startyear==$CurYear) echo "selected";echo ">$Startyear</option>";
            $Startyear++;
        }
    }


    // select all data from any table

    public function findAll($table){

        $statement = $this->pdo->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    // select all data from any table

    public function findAllbyCond($table, $cond){

        $statement = $this->pdo->prepare("SELECT * FROM {$table} {$cond}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    // select Single data by id

    public function findOneById($table,$idKey, $idValue){

        $sql = "SELECT * FROM {$table} WHERE {$idKey} = ? LIMIT 1";

        $statement = $this->pdo->prepare($sql);

        $statement->execute(array($idValue));

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    // select Multiple data by id

    public function findAllById($table,$idKey, $idValue){

        $sql = "SELECT * FROM {$table} WHERE {$idKey} = ?";

        $statement = $this->pdo->prepare($sql);

        $statement->execute(array($idValue));

        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
 
    public function getRowCount($table){

        $statement = $this->pdo->prepare("SELECT * FROM {$table}");

        $statement->execute();

        return $statement->rowCount();

    }

    public function rowCountByCond($table, $cond){

        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$cond}");

        $statement->execute();

        return $statement->rowCount();

    }

    public function fetchAssocQuery($sql){
        
        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
        
    }


    public function findField($table, $col, $cond){

        if($cond == ""){

            $statement = $this->pdo->prepare("SELECT {$col} as field FROM {$table}");

        }else{

            $statement = $this->pdo->prepare("SELECT {$col} as field FROM {$table} WHERE {$cond}");

        }

        $statement->execute();

        $results = $statement->fetch();

        return $results['field'];

    }


    // Dynamic Insert Data With table name and columnName, columnValues

    public function save($table, $data){

        try{

            $columnsArray = array_keys($data);

            $columnsString = implode(',', $columnsArray);


            $valuesArray = array_values($data);

            $valuesCount = count($valuesArray);


            $valuesPlaceholder = '';

            for ($i=0; $i < $valuesCount; $i++) {

                $valuesPlaceholder .= '?,';

            }

            $valuesPlaceholder = rtrim($valuesPlaceholder, ',');


            $query = "INSERT INTO $table ($columnsString) VALUES ($valuesPlaceholder)";

            $statement = $this->pdo->prepare($query);

            $inserted = $statement->execute($valuesArray);


            if ($inserted){

                echo 'Saved Successfully';

            }else{

                echo 'Failed to save';

            }

        }catch (PDOException $e){

            die('Failed to save'.$e->getMessage());

        }

    }

    public function saveNgetId($table, $data, $cond = ''){

        $columnsArray = array_keys($data);

        $columnsString = implode(',', $columnsArray);

        $valuesArray = array_values($data);

        $valuesCount = count($valuesArray);

        $valuesPlaceholder = '';

        for ($i=0; $i < $valuesCount; $i++) {

            $valuesPlaceholder .= '?,';

        }

        $valuesPlaceholder = rtrim($valuesPlaceholder, ',');

        $query = "INSERT INTO $table ($columnsString) VALUES ($valuesPlaceholder) {$cond}";

        $statement = $this->pdo->prepare($query);

        $inserted = $statement->execute($valuesArray);


        if ($inserted){

            return $this->pdo->lastInsertId();

        }

    }


    public function getLastInsertedId(){
        $stmt = $this->pdo->prepare("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }




    //Update Row
    public function update($table, array $data, array $cond){

        try {

            $i = 0;

            foreach ($data as $key => $value) {

                $setColumns[$i] = $key."='".$value."'";

                $i++;

            }

            $setColumns = implode(", ", $setColumns);

            $a = 0;

            foreach ($cond as $key => $value) {

                $setCondition[$a] = $key."='".$value."'";

                $a++;

            }

            $setCondition = implode(" AND ", $setCondition);

            $stmt = $this->pdo->prepare("UPDATE $table SET $setColumns WHERE $setCondition");

            $stmt->execute();

            $row = $stmt->rowCount();

            if ($row >= 1){

                echo "Updated successfully";

            }else{

                echo "Failed to update";

                echo '<pre>';

                var_dump($stmt->errorInfo());

            }


        } catch (Exception $e) {

            echo $e->getMessage();

        }

    }





    public function categoryLevelCombo($selected){

        echo '<option>Select a Category</option>';

        $pCat = $this->findAllById('tbl_category', 'cat_parent_id', 0);

        foreach ($pCat as $pcat) {

            echo "<optgroup label='{$pcat['cat_name']}'></optgroup>";

            $subCat = $this->findAllbyCond('tbl_category', "cat_parent_id = {$pcat['cat_id']}");

            foreach ($subCat as $subcat) {

                echo "<optgroup class='subCat' label='&nbsp;&nbsp;&nbsp;&nbsp;{$subcat['cat_name']}'></optgroup>";

                $cats = $this->findAllbyCond('tbl_category', "cat_parent_id = {$subcat['cat_id']}");

                foreach ($cats as $mcat) {
                    $categId = $mcat['cat_id'];
                    $catName = $mcat['cat_name'];

                    if ($categId == $selected){

                        echo "<option value='$categId' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$catName}</option>";

                    }else{
                        echo "<option value='$categId'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$catName}</option>";
                    }

                }

            }

        }
    }




    public function delete($table, $cond, $limit = 1){

        $sql = "DELETE FROM {$table} WHERE {$cond} LIMIT {$limit}";

        return $this->exec($sql);

    }




    public function preArray($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }














}
