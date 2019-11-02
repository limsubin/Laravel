<?php
	define("MAIN_PAGE", "../bbs/main.php");
    function okGo($message, $url){
?>
    <script>
        alert('<?= $message ?>');
        location.href = '<?= $url ?>';
    </script>
<?php
    }

	function goNow($url) {
?>
        <script>				
            location.href = '<?= $url ?>';
        </script>
            
<?php
        exit();
    }
?>