<?php
class Config
{
    public function __construct()
    {

    }

    public function setEmails($uploadedFile)
    {
        $emailList = file_get_contents($uploadedFile['tmp_name']);
        if (get_option('comment-post-sender-email-list'))
        {
            update_option('comment-post-sender-email-list', $emailList);
        }
        else
        {
            add_option('comment-post-sender-email-list', $emailList);
        }
    }
}
?>