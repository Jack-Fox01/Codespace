<?php
include('includes/nav.php');
require('connect_db.php');
require('includes/session-cart.php'); // session + cart
?>

<!-- HERO / BANNER SECTION -->
<div class="container-fluid p-0">
    <div style="
        position: relative;
        width: 100%;
        height: 400px;
        background-image: url('images/hero.jpg');
        background-size: cover;
        background-position: center;
    ">
        <!-- Overlay -->
        <div style="
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
        "></div>

        <!-- Text content -->
        <div style="
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        ">
            <h1 style="font-size: 3rem; font-weight: 300; letter-spacing: 1px;">
                MKTime
            </h1>

            <p style="font-size: 1.25rem; max-width: 700px; opacity: 0.95;">
                Exceptional resources. Elevated design. For those who know.
            </p>

            <!-- CTA -->
            <a href="#products"
               class="btn btn-outline-light mt-4 px-5 py-2"
               style="letter-spacing: 1px; text-transform: uppercase;">
                Shop the Collection.
            </a>
        </div>
    </div>
</div>

<!-- Smooth Scroll -->
<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href'))
            .scrollIntoView({ behavior: 'smooth' });
    });
});
</script>

<?php
echo '<div id="products" class="container mt-5"><div class="row">';

// Fetch products
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

        // Get average rating for this product
        $avg_stmt = $link->prepare("SELECT AVG(rating) as avg_rating FROM reviews WHERE item_id = ?");
        $avg_stmt->bind_param("i", $row['item_id']);
        $avg_stmt->execute();
        $avg_result = $avg_stmt->get_result();
        $avg_row = $avg_result->fetch_assoc();
        $avg_rating = round($avg_row['avg_rating']);
        $avg_stmt->close();

        echo '
        <div class="col-md-3 d-flex justify-content-center mb-4">
            <div class="card" style="width: 18rem;">
                <a href="product.php?id='. (int)$row['item_id'] .'">
                    <img src="'. htmlspecialchars($row['item_img']) .'" class="card-img-top" alt="'. htmlspecialchars($row['item_name']) .'">
                </a>

                <div class="card-body text-center">
                    <h5 class="card-title">
                        <a href="product.php?id='. (int)$row['item_id'] .'" class="text-dark" style="text-decoration:none;">
                            '. htmlspecialchars($row['item_name']) .'
                        </a>
                    </h5>

                    <p class="card-text">'. htmlspecialchars($row['item_desc']) .'</p>';

        // Stars
        echo '<p>';
        for ($i = 1; $i <= 5; $i++) {
            echo $i <= $avg_rating
                ? '<span style="color:gold;">&#9733;</span>'
                : '<span style="color:#ccc;">&#9733;</span>';
        }
        echo '</p>';

        echo '
                </div>

                <div class="card-footer bg-transparent border-dark text-center">
                    <p class="card-text">&pound; '. number_format($row['item_price'], 2) .'</p>
                </div>

                <div class="card-footer text-muted">
                    <a href="added.php?id='. (int)$row['item_id'] .'" class="btn btn-light btn-block">
                        Add to Cart
                    </a>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>There are currently no items to display.</p>';
}

echo '</div></div>';

mysqli_close($link);
include('includes/footer.php');
?>
