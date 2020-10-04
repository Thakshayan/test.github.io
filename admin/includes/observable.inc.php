<?php
/**
 * interface for observable complain object
 * it has only admin observer 
 * it has notify object
 */

interface observable{
    public function notify(Admin $admin);
}
?>