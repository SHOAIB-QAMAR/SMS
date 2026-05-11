<?php include('shared/_header.php'); ?>

<main>
  <div class="big-wrapper light">
    <img src="./images/shape.png" alt="" class="shape" />

    <?php include('shared/_navbar.php'); ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-md-6 d-flex justify-content-center get-started">
          <div class=" d-flex justify-content-center align-items-center">
            <div>
              <div class="big-title">
                <h1>Future is here,</h1>
                <h1>Start Exploring now.</h1>
              </div>
              <p class="text">
                streamline processes, manage resources, track student data, facilitate
                communication, and enhance administrative tasks effectively.
              </p>
              <div class="cta">
                <a href="../auth/login.php" class="btn">Get started</a>
              </div>


            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 image-box">

          <img src="./images/children.png" alt="Person Image" class="person" />
        </div>
      </div>
    </div>


    <?php include('shared/feature-cards.php'); ?>


    <div class="container">
      <hr>
    </div>

    <?php include('shared/why-us.php'); ?>
  </div>
  </div>


</main>




<?php include('shared/_footer.php'); ?>