<div id='preloader'><div class='preloader'></div></div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>

    <script>
        $(document).ready(function(){
            $('.submenu-toggle').click(function(e){
                e.preventDefault();
                $(this).next('.submenu').slideToggle(); // Efek slide naik/turun
                $(this).find('.pull-right').toggleClass('fa-angle-down fa-angle-up'); // Ubah panah
            });
        });
    </script>

</body>
</html>