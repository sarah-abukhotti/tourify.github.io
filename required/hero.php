<link rel="stylesheet" type="text/css" href="css/search.css">
<section id="hero" class="d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 order-2 order-lg-1 hero-content">
        <h1>Your Hotel and Resort Booking Website</h1>
        <ul>
          <li><i class="ri-check-line"></i> Easily navigate between entertainment resorts and villas.</li>
          <li><i class="ri-check-line"></i> Browse all villas, view details, and book the villa that suits you without any hassle.</li>
          <li><i class="ri-check-line"></i> Visa card payment option available.</li>
        </ul>
        <div class="mt-1">
          <form class="col-10 p-4">
            <div class="s-box">
              <input type="text" id="input" class="s-input" placeholder="Enter villa name">
              <ul class="dropdownSearch" id="dropdownSearch"></ul>
            </div>
            </div>
            <div class="mt-1">
          </form>
          <a href="" class="btn-get-quote" style="margin-left: 5%;">Search</a>
          <a href="browse.php" class="btn-get-started scrollto">Browse</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 d-flex justify-content-end hero-img mobile-margin visible-xs">
        <img src="assets/img/logo9.png" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section>


<script>
  $(document).ready(function() {
    function fetchData() {
      var data = $("#input").val();

      if (data == '') {
        $('#dropdownSearch').css('display', 'none');
      }
      $.post("Api/auto_complet.php", {
          data: data
        },
        function(data, status) {
          if (data != "not found") {
            $('#dropdownSearch').css('display', 'block');
            $('#dropdownSearch').html(data);
          }
        });
    }
    $('#input').on('input', fetchData);
    $("body").on('click', () => {
      $('#dropdownSearch').css('display', 'none');
    });
    $('#input').on('click', fetchData);
  });
</script>
