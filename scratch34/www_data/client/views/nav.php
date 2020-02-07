<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark heightNav" style="min-font-size: 16px;">
        <img src="<?php echo PROJECT_ROOT . '/images/CAGIS_Logo_WhiteTransparent_Tiny.png'; ?>" class="d-inline-block align-top mr-2" id="navLogo" alt="">
        <a id="titlePopover" class="navbar-brand" href="#" rel="popover" style="font-size: 2em;">GeoWebSwarm Client</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
<!--                <li class="nav-item active px-2">-->
<!--                    <a class="nav-link" href="#">Home</span></a>-->
<!--                </li>-->
<!--                <li class="nav-item px-2">-->
<!--                    <a class="nav-link text-white" target="_blank" href="https://gis.uncc.edu/funding-and-support" style="font-size: 2em;">Funding</a>-->
<!--                </li>-->
            </ul>
        </div>
    </nav>
</header>

<script>
    if (top.location != self.location) {
        // console.log('Nav in an iframe');
        $("nav").addClass('d-none');
    }
    tpOptions = {
        trigger: 'hover',
        placement: 'bottom',
        html: true,
        content: '<h3><b>GeoWebSwarm Client</b>' +
            '<hr/>' +
            '</h3>'
    };

    $('#titlePopover').popover(tpOptions);

    $('.navbar a').click(function () {
        $('.nav-collapse').collapse('hide');
    });
</script>