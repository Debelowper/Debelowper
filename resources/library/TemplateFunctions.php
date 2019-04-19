<link rel="stylesheet" href="http://localhost/public/css/style.css?<?php echo time(); ?>">

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/Config.php");

    function renderLayoutWithContentFile($contentFile, $variables = array())
    {
        $contentFileFullPath = $_SERVER["DOCUMENT_ROOT"] . "/" . "resources/templates/" . $contentFile;

        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }

        require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/header.php");

        echo "
        <div class=\"container-fluid text-center\">
          <div class=\"row content\">
            <div class=\"col-sm-3 sidenav\">";
            require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/leftPanel.php");

        echo "</div>
            <div class=\"col-sm-6 text-left\">";

            if (file_exists($contentFileFullPath)) {
                require_once($contentFileFullPath);
            } else {
                /*
                    If the file isn't found the error can be handled in lots of ways.
                    In this case we will just include an error template.
                */
                require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/error.php");
            }

        echo "</div>
            <div class=\"col-sm-3 sidenav\">";

              require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/rightPanel.php");

        echo "
            </div>
          </div>
        </div>";

        // close container div
        //echo "</div>\n";

        require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/footer.php");
    }
?>
