<?php
// This code generates a datatables compatible HTML table. The function uses inline HTML, only rendered when the function runs.
function pv_genTable($T_COLUMNS = array('a', 'b', 'c'), $T_DATA = array("a" => "1", "b" => "2", "c" => "3"))
{ ?>
    <table id="table_id" class="table table-striped table-bordered table-sm" style="width:100%">
        <thead>
        <tr>
            <?php foreach ($T_COLUMNS as $oneColumn) {
                switch($oneColumn) {
                    case "Time24_instant":
                        $oneColumn = "Time (24hr)";
                        break;
                    case "Date_time":
                    case "Date_time_":
                    case "DateTime":
                    case "Data_time":
                        $oneColumn = "Date Time";
                        break;
                    default: // redundant but to note: if renamed column not in this switch, use the col as is
                        break;
                }
                echo "<th>" . $oneColumn . "</th>";
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($T_DATA as $oneRow) : ?>
            <tr>
                <?php
                foreach ($T_COLUMNS as $oneColumn) {
                    if ($oneRow[$oneColumn] == "") {
                        $val = "NULL";
                    } else {
                        $val = $oneRow[$oneColumn];
                    }
                    try {
                        echo "<td>" . $val . "</td>";
                    } catch (Exception $e){
                    }
                }
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            var table = $('#table_id').DataTable({
                paging: true, // dont use pages, just a scroll bar.
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], // if you enable paging, this is useful
                //scrollY: 1200, // one row is about 50 here. 600/50=12 rows
                //autoWidth: false,
                //"columnDefs": [
                //    { "width": "6em", "targets": "_all" } // set column widths to 6em to prevent word-wrap.
                //],
                autoWidth: false,
                defaultContent: 'NULL',


                scrollX: true,
                responsive: true, // make sure this table is responsive to layout changes
                dom: '<"top"Bif>tp', // add datatables items to the webpage -- https://datatables.net/reference/option/dom
                // dom: "<'row justify-content-around'<'col-sm-9'B><'col-sm-3'f>>" +
                //     "<'row'<'col-sm-12'tr>>" +
                //     "<'row justify-content-between'<'col-sm-6'il><'col-sm-6'p>>",
                // buttons: [
                //     {
                //         extend: 'csv',
                //         text: 'Export to CSV',
                //         className: 'bg-primary',
                //         exportOptions: {modifier: {search: 'none'}}
                //     }
                // ]
            });
        });
    </script>

<?php } ?>
