<!-- JS Files -->

<!-- Jquery 3.4.1 | require for bootstrap 4 -->
<script src="assets/js/jquery-3.4.1.min.js" ></script>

<!-- Popper Js | require for bootstrap 4 -->
<script src="assets/js/popper.min.js" ></script>

<!-- Bootstarp Js -->
<script src="assets/js/bootstrap.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script src="assets/js/NumberFormat.js"></script>


<script src="assets/js/jquery-ui.js"></script>

<!-- MyBilling Js File -->
<script src="assets/js/mybilling.js"></script>


<script>
	// Initilize DataTable
	$(document).ready(function() {

        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });


        $('.pageLoadBtn').click(function(e){
            var pageSrc = $(this).attr('href');
            e.preventDefault();
            if(pageSrc != ''){
                $('#includePageArea').load(pageSrc);
            }
        });


        $('.select2').select2();

	});









</script>