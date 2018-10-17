        <div class="offset-md-2 col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="./index.php">Customers</a></li>
                    <?php
                        if($currentPage != "index")
                            echo "<li class='breadcrumb-item active' aria-current='page'>".($customerName != "" ? $customerName : "New Customer")."</li>";
                    ?>
                </ol>
            </nav>
        </div>
