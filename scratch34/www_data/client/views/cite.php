<!-- begin cite -->
<div class="row p-o m-0">
    <footer class="footer bg-dark text-white container-fluid text-center">
        2019 © <a class="text-white" href="https://gis.uncc.edu">Center for Applied GIScience, UNC Charlotte</a>
<!--        <br/>-->
<!--        Portions of Data From <a class="text-white" href="https://www.epri.com">Electric Power Research Institute</a>-->
    <!--    &nbsp;&nbsp;&nbsp;-->
    <!--    <span class="text-white">-->
        <?php //echo gethostname(); ?>
    <!--    </span>-->
    </footer>
</div> <!-- end cite -->

<script>
    // if in iframe, do not add footer to page.
    if (top.location != self.location) {
        // console.log('Cite in an iframe');
        $("footer").addClass('d-none');
    }
</script>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

<!-- Bootstrap Extended JS -->
<script src="<?php echo PROJECT_ROOT . '/libraries/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js'; ?>" crossorigin="anonymous"></script>
<!-- DataTables JS after jQuery -->
<script type="text/javascript" src="<?php echo PROJECT_ROOT . '/libraries/DataTables/datatables.min.js'; ?>" crossorigin="anonymous"></script>

</body>
</html>
