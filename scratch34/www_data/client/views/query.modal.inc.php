<!-- Query Modal -->
<div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="queryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="queryModalTitle" style="font-weight: 500 !important;">Data Query</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo PROJECT_ROOT . '/phpsql/queryWorker.php'?>" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <h5>Query type: </h5>
                    </div>
                    <div class="form-row">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="queryType" id="qtRoadName" value="RoadName">
                            <label class="form-check-label" for="qtRoadName">By Road Name</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="queryType" id="qtComparison" value="Comparison">
                            <label class="form-check-label" for="qtComparison">Compare Roads</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="queryType" id="qtRanking" value="Ranking">
                            <label class="form-check-label" for="qtRanking">Ranking</label>
                        </div>
                    </div>
                    <br/>
                    <script>
                        $(document).ready(function() {
                            $("div#qtDivRoadName").hide();
                            $("div#qtDivComparison").hide();
                            $("div#qtDivRanking").hide();
                            $("div#qtDivSpacer").show();

                            $("input[name$='queryType']").change(function() {
                                var test = $(this).val();
                                $("#qt"+test).prop('checked', true);

                                $("div#qtDivRoadName").hide();
                                $("div#qtDivComparison").hide();
                                $("div#qtDivRanking").hide();
                                $("div#qtDivSpacer").hide();
                                $("div#qtDiv"+test).show();

                            });
                        });
                    </script>
                    <div class="form-row" id="qtDivSpacer">
                        <hr/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                    <div class="form-row" id="qtDivRoadName"> <!-- By Road Name -->
                        <hr/>
                        <div class="form-group col">
                            <label for="inRoadName">Road Name</label>
                            <input type="email" class="form-control" id="inRoadName" placeholder="">
                        </div>
                    </div>
                    <div class="form-row" id="qtDivComparison"> <!-- Comparison -->
                        <hr/>
                        <div class="form-group col">
                            <label for="inRoadName1">First Road Name</label>
                            <input type="email" class="form-control" id="inRoadName1" placeholder="">
                            <label for="inRoadName2">Second Road Name</label>
                            <input type="email" class="form-control" id="inRoadName2" placeholder="">
                        </div>
                    </div>
                    <div class="form-row"  id="qtDivRanking"> <!-- Ranking -->
                        <hr/>
                        <div class="form-group col">
                            <label for="inputState">Rank By </label>
                            <select id="inputState" class="form-control">
                                <option selected>Overall</option>
                                <option>Longitudinal</option>
                                <option>Rutting</option>
                                <option>Potholes</option>
                                <option>Transverse</option>
                                <option>Bleeding</option>
                                <option>Other Objects</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>