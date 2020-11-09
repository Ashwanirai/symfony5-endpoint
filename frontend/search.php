<?php
$postIdentifierArr = [];

if ($_POST && $_POST['submit']=='Submit')
{
     // Array of post values for each different form on your page.
     $postNameArr = ['model', 'ram', 'hdd_value', 'hdd_unit', 'hdd_type', 'model_location'];       
     $queryString = null;
     // Find all of the post identifiers within $_POST
        
     foreach ($postNameArr as $postName)
     {
         if (array_key_exists($postName, $_POST))
         {
              $postIdentifierArr[$postName] = $_POST[$postName];
              $queryString .= "filter[d.".$postName."]=".$_POST[$postName]."&";
         }
     }
     

    $apiUrl = 'http://localhost/symfony/api/public/index.php/api/device';
    $apiUrl = !empty($queryString) ? $apiUrl.'?'.$queryString : $apiUrl; 
    $apiUrl .= 'limit=100';

    //echo $apiUrl;

    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $apiUrl);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $phoneList = curl_exec($cURLConnection);
    curl_close($cURLConnection);
    $jsonArrayResponse = json_decode($phoneList);
}

?>
<!DOCTYPE html>
<html lang=en>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/css/form.css" rel="stylesheet" type="text/css" >
</head>
<body>

<h3>Device Serach :</h3>

<div class="container">
    <table style="width: 80%;">
        <tr>
              <td>
                <form action="search.php" method="POST">
                    <table style="width:100%; font-size: 13px;">
                        <tr>
                            <td><label for="fname">&nbsp;Model</label>
                                <input type="text" id="model" value="<?php echo !empty($postIdentifierArr['model']) ? $postIdentifierArr['model'] : null; ?>" name="model" placeholder="Search string like - Dell">
                            </td>
                            <td>
                                <label for="ram">&nbsp;Ram</label>
                                <input type="text" id="ram" value="<?php echo !empty($postIdentifierArr['ram']) ? $postIdentifierArr['ram'] : null; ?>" name="ram" placeholder="Search string like - 12GBDDR3">
                            </td>    
                        
                            <td>
                                <label for="hdd_value">&nbsp;HDD Quantity</label>
                                <input type="text" id="hdd_value" value="<?php echo !empty($postIdentifierArr['hdd_value']) ? $postIdentifierArr['hdd_value'] : null; ?>" name="hdd_value" placeholder="HDD 500">
                            </td>
                            <td>
                                <label for="hdd_unit">&nbsp;HDD Unit</label>
                                <select id="hdd_unit" name="hdd_unit">
                                    <option value="GB" <?php echo (!empty($postIdentifierArr['hdd_value']) && $postIdentifierArr['hdd_value'] == 'GB') ? 'selected' : null; ?> >GB</option>
                                    <option value="TB" <?php echo (!empty($postIdentifierArr['hdd_value']) && $postIdentifierArr['hdd_value'] == 'TB') ? 'selected' : null; ?>>TB</option>
                                </select>
                            </td> 
                            <td>
                                <label for="hdd_type">&nbsp;HDD Type</label>
                                <select id="hdd_type" name="hdd_type">
                                    <option value="SSD" <?php echo (!empty($postIdentifierArr['hdd_type']) && $postIdentifierArr['hdd_type'] == 'SSD') ? 'selected' : null; ?>>SSD</option>
                                    <option value="SATA2" <?php echo (!empty($postIdentifierArr['hdd_type']) && $postIdentifierArr['hdd_type'] == 'SATA2') ? 'selected' : null; ?>>SATA2</option>
                                </select>
                            </td> 
                            <td>
                                <label for="model_location">&nbsp;Location</label>
                                <select id="model_location" name="model_location">
                                    <option value="">-Select Location-</option>
                                    <option value="Amsterdam"  <?php echo (!empty($postIdentifierArr['model_location']) && $postIdentifierArr['model_location'] == 'Amsterdam') ? 'selected' : null; ?>>Amsterdam</option>
                                    <option value="Dallas"  <?php echo (!empty($postIdentifierArr['model_location']) && $postIdentifierArr['model_location'] == 'Dallas') ? 'selected' : null; ?>>Dallas</option>
                                    <option value="Frankfurt" <?php echo (!empty($postIdentifierArr['model_location']) && $postIdentifierArr['model_location'] == 'Frankfurt') ? 'selected' : null; ?>>Frankfurt</option>
                                    <option value="San Francisco" <?php echo (!empty($postIdentifierArr['model_location']) && $postIdentifierArr['model_location'] == 'San Francisco') ? 'selected' : null; ?>>San Francisco</option>
                                    <option value="Washington D.C" <?php echo (!empty($postIdentifierArr['model_location']) && $postIdentifierArr['model_location'] == 'Washington D.C') ? 'selected' : null; ?>>Washington D.C</option>
                                </select>
                            </td>
                      
                            <td >
                                <input type="submit" name="submit" value="Submit">
                            </td>
                        </tr>
                    </table>
                  </form>
              </td>
        </tr>
        
        <tr><td colspan="7">
                <table style="width:100%; font-size: 14px;">
                <tr style="background-color:#5e4eba; color: white;line-height: 25px; text-align: center;">
                    <td><strong>Model</strong></td>
                    <td><strong>Ram</strong></td>
                    
                    <td><strong>HDD</strong></td>
                    <td><strong>Location</strong></td>
                    <td><strong>Price</strong></td>
                </tr>

                <?php
                //echo"<pre>";
                //print_r($jsonArrayResponse);
                    if (!empty($jsonArrayResponse)) {
                        foreach ($jsonArrayResponse as $key=>$objects) {
                            
                            if (!empty($objects->total_records)) { ?>
                            <tr><td class="contentColumn" colspan="5">Record(s) : <?php echo ucfirst($objects->total_records); ?></td></tr>
                            <?php }
                            if (!empty($objects) && $key=='data') {
                            foreach ($objects as $object) { 
                            ?>
                                <tr>
                                    <td class="contentColumn"><?php echo ucfirst($object->model); ?></td>
                                    <td class="contentColumn"><?php echo $object->ram; ?></td>
                                    
                                    <td class="contentColumn"><?php echo $object->hddValue.' '.$object->hddUnit.' '.$object->hddType;?></td>
                                    <td class="contentColumn"><?php echo $object->modelLocation; ?></td>
                                    <td class="contentColumn"><?php echo $object->price; ?></td>
                                </tr>
                            <?php }
                            } 
                        }
                } ?>
                </table>
        </td></tr>
        </table>
    
</div>
</body>
</html>
