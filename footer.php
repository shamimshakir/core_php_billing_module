        </div>
        <!-- content container end -->

      </div>
      <!-- Content Area End  -->

    </div>
    <!-- Main Area End -->

</div>


<!-- LogOut Modal Start -->
<div class="modal fade" id="logOutModal" tabindex="-1" role="dialog" aria-labelledby="logOutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="logOutModalLabel"><i class="icofont-lock"></i> LogOut</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mb-2">
      Are you sure you want to log-off?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="?logStatus=logout" type="button" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- LogOut Modal End -->


<?php include 'scriptfiles.php'; ?>
<script>

    var sidebar = document.querySelector('#sidebar');
    var mobileScreen = window.matchMedia('(max-width: 700px)');
    function screenTest(e) {
        if (e.matches) {
            sidebar.classList.add('mobileNav');
        } else {
            sidebar.classList.remove('mobileNav');
        }
    }
    screenTest(mobileScreen);
    mobileScreen.addListener(screenTest);

</script>
<script>
    $(document).ready(function(){

      // SideBar Submenu Active Start
      $('.sideBarNav li:has(ul)').addClass('hasSub');
      $('.sideBarDropDown').hide();
      $('.hasSub a').click(function(e){
        e.stopPropagation();
        e.preventDefault();
        $(this).parent().children('.sideBarDropDown').slideToggle(500);
      });



      // SideBar HumbarGer Icon
      $('.sideBarHumberger i').click(function(){
        if ($('#sidebar').hasClass('hideOnMobile')){
             $('#sidebar').removeClass('hideOnMobile');
        }else{
            $('#sidebar').toggleClass('hideSideNav');
            $('#contentArea').toggleClass('largeContentArea');
        }
      });

      // Animation on Modal
      $('.modal').on('show.bs.modal', function (e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipInX  animated');
      })
      $('.modal').on('hide.bs.modal', function (e) {
        $('.modal .modal-dialog').attr('class', 'modal-dialog  flipOutX  animated');
      })



      //Load Content Page With Ajax In Dashboard
      $('#includePageArea').load('dashboardContents.php');
      $('.sideBarNav li a').click(function(e){
          $('#sidebar').addClass('hideOnMobile');
        var pageSrc = $(this).attr('href');
        e.preventDefault();
        if(pageSrc != '#'){
          $('#includePageArea').load(pageSrc);
        }
      });


});
</script>


</body>

</html>
