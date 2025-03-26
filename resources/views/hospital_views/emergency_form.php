<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>
    <body>
        <?php include 'includes/header.php'; ?>
        <form action="#" class="new_custom_form">
            <h2>Add Emergency Form</h2>
            <fieldset>
                <div class="custom_fields_holder">
                    <input type="text" placeholder="Condition">
                    <input type="text" placeholder="Patient Name">
                    <input type="text" placeholder="Address">
                    <input type="tel" placeholder="Contact No">
                    <input type="text" placeholder="BP">
                    <input type="text" placeholder="HEART">
                    <input type="text" placeholder="Temp">
                    <input type="text" placeholder="P/OX">
                    <input type="text" placeholder="Illness">
                    <input type="submit" value="Add Report">
                </div>
            </fieldset>
        </form>
        <script src="js/jquery.js"></script>
        <script src="js/fastclick.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script>
            $(document).ready(function () {
                $('select:not(.ignore)').niceSelect();
                FastClick.attach(document.body);
            });
        </script>
    </body>
</html>