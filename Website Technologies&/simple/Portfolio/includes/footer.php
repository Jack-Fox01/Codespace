<!-- FOOTER -->
<footer class="bg-dark text-light mt-5 pt-5 pb-3">
  <div class="container">
    <div class="row">

      <!-- Brand / About -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase" style="letter-spacing:1px;">MKTIME</h5>
        <p style="font-size: 0.9rem; opacity: 0.85;">
          Exceptional resources. Elevated design.<br>
          Built for those who value precision.
        </p>
      </div>

      <!-- Email Signup -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase mb-3" style="letter-spacing:1px;">Stay Connected</h6>
        <form>
          <div class="form-group">
            <input type="email"
                   class="form-control form-control-sm"
                   placeholder="Enter your email"
                   required>
          </div>
          <button type="submit" class="btn btn-outline-light btn-sm">
            Subscribe
          </button>
        </form>
      </div>

      <!-- Social Links -->
      <div class="col-md-4 mb-4">
        <h6 class="text-uppercase mb-3" style="letter-spacing:1px;">Follow</h6>
        <ul class="list-unstyled">
          <li><a href="https://www.instagram.com/" class="text-light">Instagram</a></li>
          <li><a href="https://x.com/" class="text-light">Twitter / X</a></li>
          <li><a href="https://www.linkedin.com/" class="text-light">LinkedIn</a></li>
        </ul>
      </div>

    </div>

    <hr style="border-color: rgba(255,255,255,0.1);">

    <!-- Bottom -->
    <div class="text-center" style="font-size: 0.85rem; opacity: 0.75;">
      &copy; <span id="year"></span> MKTIME. All rights reserved.
    </div>
  </div>
</footer>

<script>
  document.getElementById('year').textContent = new Date().getFullYear();
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
crossorigin="anonymous"></script>

</body>
</html>
