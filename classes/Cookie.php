<?php
ob_start();
class Cookie {
    public static function exists($name) {
        return (isset($_COOKIE[$name])) ? true : false ;
    
    }
    
    public static function get($name) {
        return $_COOKIE[$name];
    }
    
    public static function put($name, $value, $expiry)
    {
        ?>
        <script>
            var date = new Date();
            date.setTime(date.getTime() + <?php echo $expiry; ?>);
            expires = "; expires=" + date.toUTCString();
            document.cookie = "<?php echo $name; ?>=<?php echo $value; ?>" + expires + "; path=/";
        </script>
        <?php
        return true;
    }
    
    public static function delete($name) {
        self::put($name, '', time() -1);
    }
}