<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<table border="0.1">
    <thead>
        <tr>
            <th>SR No.</th>
            <th>Group Name</th>
        </tr>
    </thead>
    <tbody>
    <?php  
       if(count($records)== 0)
            echo '<tr><td colspan="5">No Admin Type Found!</td></tr>';
        else
        {
			$sr_no = 1;
            foreach($records as $key=>$val)
            {	?>
        <tr>
            <td><center><?php echo $sr_no; ?></center></td>
            <td><center><?php echo $val['type_name']; ?></center></td> 
        </tr>
        <?php
			$sr_no = $sr_no +1 ;
             }
        } ?>
    </tbody>
</table>
</body>
</html>

