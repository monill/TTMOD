
<?php
use App\Models\Layout;
?>
                <?php Layout::middle(); ?>
                </div>
                <!-- Main Column -->

                <!-- Right Column -->
                <div class="col-lg-2 col-sm-12">
                    <?php Layout::right(); ?>
                </div>
                <!--// Right Column -->
            </div>
        </div>
        <!-- Content -->

    <footer class="footer">
        <div class="container text-center">
            Copyright &copy; <?= date("Y"); ?> - Powered by <a href="<?= url("/home"); ?>"> TTMOD </a>
            <?php $endtime = array_sum(explode(" ", microtime()));
            printf("Page generated in %f secs.", $endtime - $startime); ?>
        </div>
    </footer>

    <script src="<?= URL; ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= URL; ?>/js/popper.js"></script>
    <script src="<?= URL; ?>/js/bootstrap.min.js"></script>
    <script src="<?= URL; ?>/js/java_klappe.js"></script>

  </body>
</html>
<?php ob_end_flush(); ?>
