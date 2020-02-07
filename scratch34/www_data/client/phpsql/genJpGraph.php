<?php

// Usage:
//$myGraph = santee_genJpGraph(600,400,array('a','b','c','d'),array(1,2,3,4),'Graph Title','Times','Values',1)
// echo '<img class="img-border" src="' . $myGraph . '"/>';

function santee_genJpGraph($GRAPH_WIDTH = 600, $GRAPH_HEIGHT = 400,
                           $GRAPH_XDATA = array('a', 'b', 'c', 'd'), $GRAPH_YDATA = array(1, 2, 3, 4),
                           $GRAPH_GTITLE = 'Graph Title', $GRAPH_XTITLE = 'Times', $GRAPH_YTITLE = 'Values',
                           $GRAPH_SKIP_XLABELS = 1)
{
    try {
        if (count($GRAPH_XDATA) <= 0) {
            throw new Exception("No data");
        }
        $GRAPH_CALC_MARGIN = number_format((float)$GRAPH_WIDTH / 14, 0, '.', '');
        $XDATA_FIRST = $GRAPH_XDATA[0];
        $XDATA_LAST = $GRAPH_XDATA[count($GRAPH_XDATA) - 1];
        $GRAPH_SUBTITLE_STRING = "(" . $XDATA_FIRST . " - " . $XDATA_LAST . ")";

        $graph = new Graph($GRAPH_WIDTH, $GRAPH_HEIGHT);
        $graph->SetMargin($GRAPH_CALC_MARGIN * 1.4, $GRAPH_CALC_MARGIN * 0.4, $GRAPH_CALC_MARGIN, $GRAPH_CALC_MARGIN * 1.1);
        $graph->SetScale('linlin');
        $graph->title->Set($GRAPH_GTITLE);
        $graph->subtitle->Set($GRAPH_SUBTITLE_STRING);

        $graph->xaxis->title->Set($GRAPH_XTITLE,'center');
        $graph->xaxis->SetTickLabels($GRAPH_XDATA);
        $graph->xaxis->SetTextLabelInterval($GRAPH_SKIP_XLABELS);

        $graph->yaxis->title->Set($GRAPH_YTITLE);
        $graph->yaxis->SetTitleMargin(40);
        $graph->yaxis->scale->SetGrace(5,5); // graph scale extends 5% up and down from all data.

        $lineplot = new LinePlot($GRAPH_YDATA);
        $lineplot->SetColor('blue');
        $lineplot->SetWeight(2); // Two pixel wide
        $graph->Add($lineplot);
        $graph->xaxis->SetPos('min');
        //$cachedFilename = $_SERVER['DOCUMENT_ROOT'] . PROJECT_ROOT . "/tmp/chart1.png";
        $img = $graph->Stroke(_IMG_HANDLER);
        ob_start();
        imagepng($img);
        $imageData = ob_get_contents();
        ob_end_clean();
    } catch (Exception $e) {
        //echo "Exception in genJpGraph: " . $e;
        return "<p><span class='text-warning'>ERROR: Unable to graph (invalid/incomplete data)=> <span class='text-monospace'>".$GRAPH_GTITLE."</span></span></p>";
    }
    return '<img class="img-border" src="' . 'data:image/png;base64,' . base64_encode($imageData) . '"/>';
    //return 'data:image/png;base64,' . base64_encode($imageData)
}

?>

