<?php

class Dashboard{
    protected $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Method For View / Select Node In Menu
    public function   getMenuNodes($userId, $pid){
        $statement = $this->pdo->prepare("SELECT _nisl_tree_entries.id, 
                _nisl_tree_entries.pid, 
                _nisl_tree_entries.nodename, 
                _nisl_tree_entries.url, 
                _nisl_tree_entries.view_status, 
                _nisl_tree_entries.icon, 
                _nisl_tree_entries.sl 
            FROM   _nisl_tree_entries 
                JOIN (SELECT id 
                    FROM   _nisl_user_permission 
                    WHERE  user_id = ?) t1 
                ON t1.id = _nisl_tree_entries.id 
            WHERE  _nisl_tree_entries.view_status = 'ON' 
                AND _nisl_tree_entries.pid = ? 
            ORDER  BY sl ");

            $statement->execute(array($userId, $pid));
            return $statement->fetchAll(PDO::FETCH_OBJ);
    }



    public function getPermissionNodesMenu($SUserID, $User_ID){

        if ($SUserID == 1) {
            $sql = "SELECT _nisl_tree_entries.id, 
                    _nisl_tree_entries.pid, 
                    _nisl_tree_entries.NodeName, 
                    _nisl_tree_entries.url, 
                    _nisl_tree_entries.view_status, 
                    t1.id as uid
                FROM _nisl_tree_entries
                LEFT JOIN
                    (SELECT id 
                    FROM _nisl_user_permission 
                    WHERE user_id = '$User_ID') t1
                    on t1.id=_nisl_tree_entries.id
                WHERE
                _nisl_tree_entries.view_status = 'ON'
                ORDER BY sl";
        }
        else{
            $sql = "SELECT _nisl_tree_entries.id, 
                    _nisl_tree_entries.pid, 
                    _nisl_tree_entries.NodeName, 
                    _nisl_tree_entries.url, 
                    _nisl_tree_entries.view_status, 
                    t2.id as uid
                FROM _nisl_tree_entries
                JOIN
                    (SELECT id 
                    FROM _nisl_user_permission 
                    WHERE user_id = '$SUserID') t1
                    on t1.id=_nisl_tree_entries.id
                LEFT JOIN
                    (SELECT id 
                    FROM _nisl_user_permission 
                    WHERE user_id = '$User_ID') t2
                    on t2.id=_nisl_tree_entries.id
                WHERE
                _nisl_tree_entries.view_status = 'ON'
                ORDER BY _nisl_tree_entries.id";
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $menu = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
          $menu['menus'][$row['id']] = $row;
          $menu['parent_menus'][$row['pid']][] = $row['id'];
        }
        return $menu;

    }



    public function buildPermissionMenu($parent, $menu) {
        $html = "";
        if (isset($menu['parent_menus'][$parent])) {
            if($parent!=0){$html .= "<ul>";}
            foreach ($menu['parent_menus'][$parent] as $menu_id) {
                if (!isset($menu['parent_menus'][$menu_id])) {
                    if ($menu['menus'][$menu_id]['id'] == $menu['menus'][$menu_id]['uid']) 
                    { $cond = 'checked';}else{ $cond = ''; }
                    $html .= "<li>
                        <div class='checkbox'>
                        <label >
                            <input type='checkbox' level='subchild' name='id[]' value='". $menu['menus'][$menu_id]['id'] ."'". $cond.">". $menu['menus'][$menu_id]['NodeName'] ."</label>
                        </div>
	                </li>";
                }
                if (isset($menu['parent_menus'][$menu_id])) {
                  if($parent==0){$sc= "class='left-menu-parent'";}else{$sc= "";}
                  if ($menu['menus'][$menu_id]['id'] == $menu['menus'][$menu_id]['uid']) 
                  { $cond = 'checked';}else{$cond = ''; }
                   $html .= "<li> 
                      <div class='checkbox'>
				        <label>
	                    <input type='checkbox' level='subchild' id='' name='id[]' value='". $menu['menus'][$menu_id]['id'] ."'". $cond.">". $menu['menus'][$menu_id]['NodeName'] . "</label> 
                        </div>";
                   $html .= $this->buildPermissionMenu($menu_id, $menu);
                   $html .= "</li>";
               }
            }
            if($parent!=0){ $html .= "</ul>"; }
        }
        return $html;
    }






}