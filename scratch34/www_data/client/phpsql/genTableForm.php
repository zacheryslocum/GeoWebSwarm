<?php
// This code generates a datatables compatible HTML table. The function uses inline HTML, only rendered when the function runs.
function pv_genTableForm($TABLE_DATA = array("a" => "1", "b" => "2", "c" => "3"))
{ ?>
    <table id="tableForm1" class="table table-bordered table-sm" style="width:100%; margin-bottom: 0;">
        <thead>
        <tr>
            <th scope="col" class="table-active">Distress Type</th>
            <th scope="col" class="table-active">Severity Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($TABLE_DATA as $typeCode => $severity) : ?>
            <tr>
                <?php
                //$types = lookup_typename($typecode);
//                $types = array(
//                    "1" => "Longitudinal",
//                    "2" => "Transverse",
//                    "3" => "Alligator",
//                    "4" => "Patching",
//                    "5" => "Manhole",
//                    "6" => "Marking",
//                    "7" => "Other");
                $types = array(
                    "1" => "Cracking",
                    "2" => "Patching",
                    "3" => "Manhole",
                    "4" => "Marking");
                //$severityRatings = lookup_severity();
                $severityRatings = array(
                    999 => ["Not Rated", "text-info"],
                    0 => ["None", "text-success"],
                    1 => ["Low", "text-yellow"],
                    2 => ["Medium", "text-warning"],
                    3 => ["High", "text-danger"]
                );
                $typeName = $types[$typeCode];

                echo "<th scope='row'>" . $typeName . "</td>";
                echo "<td><select class='form-control' id='dt" . $typeName . "'>";
                foreach ($severityRatings as $val => $sData) {
                    $isSelected = '';
                    if ($severity == $val) { $isSelected = 'selected';}
                    echo "<option id='dto' class='". $sData[1] . "'" . $isSelected . " value='" . $val . "'>" . $sData[0] . "</option>";
                }
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php } ?>
